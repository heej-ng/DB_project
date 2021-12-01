import pandas as pd
import numpy as np
import os
import pymysql as mysqldb
import re

dbname = 'k_covid19_db'

# connect to MySQL server
mydb = mysqldb.connect(
    #host='root',
    user='root',
    password='gmlwnd11',
    db=dbname)
cursor = mydb.cursor()

data = pd.read_csv('K_COVID19.csv')
df = pd.DataFrame(data)
# NaN 값 NULL로 문자열화
df = df.fillna('NULL')

# CASEINFO의 attribute는 8개
for i in range(len(df)):
    case_id = df.iloc[i, 17]
    province = df.iloc[i, 4]
    city = df.iloc[i, 18]
    infection_group = df.iloc[i, 19]
    infection_case = df.iloc[i, 6]
    confirmed = df.iloc[i, 20]
    latitude = df.iloc[i, 21]
    longitude = df.iloc[i, 22]

    caseinfo_val = "%s, %s, %s, %s, %s, %s, %s, %s" % (case_id, '"{}"'.format(province), '"{}"'.format(city),
                    infection_group, '"{}"'.format(infection_case), confirmed, latitude, longitude)
    sql = 'INSERT INTO CASEINFO VALUES (%s)' % (caseinfo_val)

    # "NULL"로 표시된 부분을 NULL로 바꿈
    sql = sql.replace('\"NULL\"', "NULL")
    print(sql)

    try:
        cursor.execute(sql)
        print("[OK] Inserting [%s] to Case" % (caseinfo_val))
    except mysqldb.IntegrityError:
        print("[Error] %s already in Case" % (caseinfo_val))

    mydb.commit()
# Connection 닫기
cursor.close()
