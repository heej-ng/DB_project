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

age=['0s','10s','20s','30s','40s','50s','60s','70s','80s','90s','100s']

for n in age:
    co_cnt=de_cnt=0
    
    for li in open('addtional_Timeinfo.csv'):
        if li[0]=='d':
            continue
        tok=li.strip().split(',')
        date=tok[0]

        for l in open('K_COVID19.csv'):
            if l[0]=='p':
                continue
            t=l.strip().split(',')
            p=t[2]
            if p==n:
                confirmed_date=t[10]
                deceased_date=t[12]
                if date==confirmed_date:
                    co_cnt+=1
                if date==deceased_date:
                    de_cnt+=1
        timeage_val="%s,%s,%s,%s"%('"{}"'.format(date), '"{}"'.format(n), co_cnt, de_cnt)
        sql='INSERT INTO TIMEAGE VALUES (%s);'%(timeage_val)
        sql=sql.replace('\"NULL\"',"NULL")
        print(sql)
        try:
            cursor.execute(sql)
            print("Succes : Inserting %s to Timeage" % (date))
        except mysqldb.IntegrityError:
            print("Fail : %s already in Timeage" % (date))
        
        mydb.commit()
mydb.close()