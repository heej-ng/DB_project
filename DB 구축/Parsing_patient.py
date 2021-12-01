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

# Patientinfo의 attribute는 14개
for i in range(len(df)):
   patient_id = df.iloc[i, 0]
   sex = df.iloc[i, 1]
   age = df.iloc[i, 2]
   country = df.iloc[i, 3]
   province = df.iloc[i, 4]
   city = df.iloc[i, 5]
   infection_case = df.iloc[i, 6]
   infected_by = df.iloc[i, 7]
   contact_number = df.iloc[i, 8]
   symptom_onset_date = df.iloc[i, 9]
   confirmed_date = df.iloc[i, 10]
   released_date = df.iloc[i, 11]
   deceased_date = df.iloc[i, 12]
   state = df.iloc[i, 13]

   patientinfo_val = "%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s" % (patient_id, '"{}"'.format(sex), '"{}"'.format(age), '"{}"'.format(country),
                     '"{}"'.format(province), '"{}"'.format(city), '"{}"'.format(infection_case), infected_by, contact_number, '"{}"'.format(symptom_onset_date),
                     '"{}"'.format(confirmed_date), '"{}"'.format(released_date), '"{}"'.format(deceased_date), '"{}"'.format(state))
   sql = 'INSERT INTO PATIENTINFO VALUES (%s)' % (patientinfo_val)

   # "NULL"로 표시된 부분을 NULL로 바꿈
   sql = sql.replace('\"NULL\"', "NULL")
   print(sql)

   try:
      cursor.execute(sql)
      print("[OK] Inserting [%s] to Patient" % (patientinfo_val))
   except mysqldb.IntegrityError:
      print("[Error] %s already in Patient" % (patientinfo_val))
   
   mydb.commit()
# Connection 닫기
cursor.close()
