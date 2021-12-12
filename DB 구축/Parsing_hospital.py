import pandas as pd
import pymysql as mysqldb
import seaborn as sns
from math import dist


dbname = 'k_covid19_db'

# connect to MySQL server
mydb = mysqldb.connect(
    #host='root',
    user='root',
    password='gmlwnd11',
    db=dbname)
cursor = mydb.cursor()

hospital_data = pd.read_csv('Hospital.csv')
region_data = pd.read_csv('Region.csv')

hdf = pd.DataFrame(hospital_data)
rdf = pd.DataFrame(region_data)

# NaN 값 NULL로 문자열화
hdf = hdf.fillna('NULL')
rdf = rdf.fillna('NULL')


for i in range(len(hdf)):
    id = hdf.iloc[i, 0]
    name = hdf.iloc[i, 1]
    province = hdf.iloc[i, 2]
    city = hdf.iloc[i, 3]
    latitude = hdf.iloc[i, 4]
    longitude = hdf.iloc[i, 5]
    capacity = hdf.iloc[i, 6]
    current = hdf.iloc[i, 7]

    hospital_val = "%s, %s, %s, %s, %s, %s, %s, %s" % (
    id, '"{}"'.format(name), '"{}"'.format(province), '"{}"'.format(city), latitude, longitude, capacity, current)

    sql = 'INSERT INTO HOSPITAL VALUES (%s)' % (hospital_val)

    # "NULL"로 표시된 부분을 NULL 로 바꿈
    sql = sql.replace('\"NULL\"', "NULL")
    #print(sql)

    try:
        cursor.execute(sql)
        print("[OK] Inserting [%s] to Hospital" % (hospital_val))
    except mysqldb.IntegrityError:
        print("[Error] %s already in Hospital" % (hospital_val))

    mydb.commit()

# region 데이터
for i in range(len(rdf)):
    code = rdf.iloc[i, 0]
    province = rdf.iloc[i, 1]
    city = rdf.iloc[i, 2]
    latitude = rdf.iloc[i, 3]
    longitude = rdf.iloc[i, 4]
    elementary_school_cnt = rdf.iloc[i, 5]
    kindergarten_cnt = rdf.iloc[i, 6]
    university_cnt = rdf.iloc[i, 7]
    academy_ratio = rdf.iloc[i, 8]
    elderly_population_ratio = rdf.iloc[i, 9]
    elderly_alone_ratio = rdf.iloc[i, 10]
    nursing_home_cnt = rdf.iloc[i, 11]

    region_val = "%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s" % (
    code, '"{}"'.format(province), '"{}"'.format(city), latitude, longitude, elementary_school_cnt
    , kindergarten_cnt, university_cnt, academy_ratio, elderly_population_ratio, elderly_alone_ratio, nursing_home_cnt)

    sql = 'INSERT IGNORE INTO REGION VALUES (%s)' % (region_val)

    # "NULL"로 표시된 부분을 NULL 로 바꿈
    sql = sql.replace('\"NULL\"', "NULL")
    #print(sql)

    try:
        cursor.execute(sql)
        print("[OK] Inserting [%s] to Region" % (region_val))
    except mysqldb.IntegrityError:
        print("[Error] %s already in Region" % (region_val))
    mydb.commit()


# 환자의 위도 경도 및 region의 위도 경도
sql = '''SELECT p.patient_id, p.province, p.city, r.latitude, r.longitude 
FROM REGION r, PATIENTINFO p 
WHERE p.province = r.province and r.city = CASE WHEN p.city='etc' then p.province ELSE p.city END'''
cursor.execute(sql)
plist = cursor.fetchall()

for p in plist:

    sql = "select * from HOSPITAL"
    cursor.execute(sql)
    hlist = cursor.fetchall()

    near = 100000
    x = (p[3], p[4])
    for h in hlist:
        y = (h[4], h[5])

        # h[6] = capacity, h[7] = current
        if h[6] > h[7]:
            distance = dist(x, y)
            if distance < near:
                near = distance
                near_hospital = h
    print(near)
    print(near_hospital)

    sql = "update PATIENTINFO set hospital_id = {hospital_id} where patient_id = {patient_id}".format(hospital_id=near_hospital[0], patient_id=p[0])
    cursor.execute(sql)
    print(sql)
    sql = "update HOSPITAL set current = current+1 where hospital_id = {id}".format(id=near_hospital[0])
    cursor.execute(sql)
    mydb.commit()
    
# Connection 닫기
cursor.close()
