import pandas as pd
import pymysql as mysqldb

dbname = 'k_covid19_db'

# connect to MySQL server
mydb = mysqldb.connect(
    #host='root',
    user='root',
    password='gmlwnd11',
    db=dbname)
cursor = mydb.cursor()


data = pd.read_csv('K_COVID19.csv')
time_data = pd.read_csv('addtional_Timeinfo.csv')
df = pd.DataFrame(data)
tdf = pd.DataFrame(time_data)
# NaN 값 NULL로 문자열화
df = df.fillna('NULL')

test = 0
negative = 0
confirmed = 0
released = 0
deceased = 0
dict = {}
for i in range(len(tdf)):
    date = tdf.iloc[i, 0]
    test_temp = tdf.iloc[i, 1]
    negative_temp = tdf.iloc[i, 2]
    test = test_temp + test
    negative = negative_temp + negative

    vlist = [test, negative, confirmed, released, deceased]
    dict[date] = vlist

for j in range(len(df)):
    province = df.iloc[j, 4]
    confirmed_date = df.iloc[j, 10]
    released_date = df.iloc[j, 11]
    deceased_date = df.iloc[j, 12]

    if confirmed_date != 'NULL':
        dict[confirmed_date][2] = dict[confirmed_date][2] + 1
    if released_date != 'NULL':
        dict[released_date][3] = dict[released_date][3] + 1
    if deceased_date != 'NULL':
        dict[deceased_date][4] = dict[deceased_date][4] + 1

# print(dict)
first_confirmed = df.sort_values(by='confirmed_date', ascending=True).iloc[0, 10]
first_released = df.sort_values(by='released_date', ascending=True).iloc[0, 11]
first_deceased = df.sort_values(by='deceased_date', ascending=True).iloc[0, 12]

con_save = dict[first_confirmed][2]
rel_save = dict[first_released][3]
dec_save = dict[first_deceased][4]

rel_index = 0
dec_index = 0

for index, (key,value) in enumerate(dict.items()):
    if key == first_released:
        rel_index = index
        break
for index, (key,value) in enumerate(dict.items()):
    if key == first_deceased:
        dec_index = index
        break

# print(rel_index, dec_index)
first = 1
for key, value in dict.items():
    if first == 1:
        first = 0
        continue
    dict[key][2] = dict[key][2] + con_save
    con_save = dict[key][2]

for key, value in dict.items():
    if rel_index != -1:
        rel_index = rel_index - 1
        continue
    dict[key][3] = dict[key][3] + rel_save
    rel_save = dict[key][3]

for key, value in dict.items():
    if dec_index != -1:
        dec_index = dec_index - 1
        continue
    dict[key][4] = dict[key][4] + dec_save
    dec_save = dict[key][4]

# print(dict)
for key, value in dict.items():
    time_val = "%s, %s, %s, %s, %s, %s" % ('"{}"'.format(key), value[0], value[1], value[2],
                                           value[3], value[4])
    sql = 'INSERT INTO TIMEINFO VALUES (%s)' % (time_val)
    sql = sql.replace('\"NULL\"', "NULL")
    print(sql)

    try:
        cursor.execute(sql)
        print("[OK] Inserting [%s] to Timeinfo" % (time_val))
    except mysqldb.IntegrityError:
        print("[Error] %s already in Timeinfo" % (time_val))

    mydb.commit()
# Connection 닫기
cursor.close()
