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

# WEATHER의 attribute는 6개
for i in range(len(df)):
    region_code = df.iloc[i, 23]
    province = df.iloc[i, 4]
    wdate = df.iloc[i, 10]
    avg_temp = df.iloc[i, 14]
    min_temp = df.iloc[i, 15]
    max_temp = df.iloc[i, 16]

    weather_val = "%s, %s, %s, %s, %s, %s" % (region_code, '"{}"'.format(province),
                    '"{}"'.format(wdate), avg_temp, min_temp, max_temp)
    sql = 'INSERT INTO WEATHER VALUES (%s)' % (weather_val)

    # "NULL"로 표시된 부분을 NULL로 바꿈
    sql = sql.replace('\"NULL\"', "NULL")
    print(sql)

    try:
        cursor.execute(sql)
        print("[OK] Inserting [%s] to Weather" % (weather_val))
    except mysqldb.IntegrityError:
        print("[Error] %s already in Weather" % (weather_val))

    mydb.commit()
# Connection 닫기
cursor.close()
