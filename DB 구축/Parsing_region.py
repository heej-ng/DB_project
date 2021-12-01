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

# REGION의 attribute는 12개
for i in range(len(df)):
    region_code = df.iloc[i, 23]
    province = df.iloc[i, 4]
    city = df.iloc[i, 5]
    latitude = df.iloc[i, 24]
    longitude = df.iloc[i, 25]
    elementary_school_count = df.iloc[i, 26]
    kindergarten_count = df.iloc[i, 27]
    university_count = df.iloc[i, 28]
    academy_ratio = df.iloc[i, 29]
    elderly_population_ratio = df.iloc[i, 30]
    elderly_alone_ratio = df.iloc[i, 31]
    nursing_home_count = df.iloc[i, 32]

    region_val = "%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s" % (region_code, '"{}"'.format(province), '"{}"'.format(city),
                    latitude, longitude, elementary_school_count, kindergarten_count, university_count, academy_ratio,
                    elderly_population_ratio, elderly_alone_ratio, nursing_home_count)
    sql = 'INSERT INTO REGION VALUES (%s)' % (region_val)

    # "NULL"로 표시된 부분을 NULL로 바꿈
    sql = sql.replace('\"NULL\"', "NULL")
    print(sql)

    try:
        cursor.execute(sql)
        print("[OK] Inserting [%s] to Region" % (region_val))
    except mysqldb.IntegrityError:
        print("[Error] %s already in Region" % (region_val))

    mydb.commit()
# Connection 닫기
cursor.close()
