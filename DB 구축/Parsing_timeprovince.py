import getpass
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

province=['Jeollanam-do', 'Daegu', 'Gyeongsangbuk-do', 'Daejeon', 'Incheon', 'Gyeongsangnam-do', 'Chungcheongnam-do', 'Sejong', 'Gangwon-do', 'Chungcheongbuk-do', 'Jeju-do', 'Gwangju', 'Ulsan', 'Seoul', 'Busan', 'Jeollabuk-do', 'Gyeonggi-do']

for n in province:
    co_cnt=de_cnt=0
    re_cnt=0
    for li in open('addtional_Timeinfo.csv'):
        #print(li)
        if li[0]=='d':
            continue
        tok=li.strip().split(',')
        date=tok[0]

        for l in open('K_COVID19.csv'):
            if l[0]=='p':
                continue
            t=l.strip().split(',')
            p=t[4]
            if p==n:
                confirmed_date=t[10]
                released_date=t[11]
                deceased_date=t[12]
                if date==confirmed_date:
                    co_cnt+=1
                if date==released_date:
                    re_cnt+=1
                if date==deceased_date:
                    de_cnt+=1
        timeprovince_val="%s,%s,%s,%s,%s"%('"{}"'.format(date), '"{}"'.format(n), co_cnt, re_cnt, de_cnt)
        #print(timegender_val)
        sql='INSERT INTO TIMEPROVINCE VALUES (%s);'%(timeprovince_val)
        #sql=sql.replace('\"NULL\"',"NULL")
        print(sql)
        try:
            cursor.execute(sql)
            print("Succes : Inserting %s to TIMEPROVINCE" % (date))
        except mysqldb.IntegrityError:
            print("Fail : %s already in TIMEPROVINCE" % (date))
        
        mydb.commit()
mydb.close()