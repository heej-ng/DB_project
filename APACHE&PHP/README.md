### WAMP (APACHE + Mysql + PHP) 사용

- 목표 : parsing하고 데이터베이스에 insert한 데이터들을 이용하여 web 상에 출력하면서 의미 있는 data들을 뽑아내는 것
> (Patientinfo, Case, Region, Weather, Time_info 5개의 테이블 이용)

- 내용
1. Patientinfo, Case, Region, Weather, Time_info 테이블을 웹 페이지 상에 출력(전체 select), 최상단에 row갯수(select된 튜플 수)를 출력!
2. 테이블들 attribute들중에서 하나를 고르고, 선택한 attribute를 기준으로 filtering한 것을 웹 페이지 상에 출력 (5개의 테이블 중 3개
선택), 최상단에 row갯수(select된 튜플 수)를 출력!
3. 5개의 테이블을 자유롭게 사용하여(select, join, where, group by, having, union등) 하나의 의미 있는 view를 뽑아낸 후 웹페이지 상에
출력 
<br>

## php file description
#### case2.php
> CASEINFO 테이블의 attribute 중 province를 기준으로 filtering 하였다.<br>
> filtering 방법은 text 타입으로 province를 입력한 뒤 입력 text에 해당하는 province를 가진 row들을 출력하는 것이다.

#### time2.php
> TIMEINFO 테이블의 attribute 중 Date를 기준으로 filtering 하였다.<br>
> filtering 방법은 date 타입(달력 날짜 선택)으로 원하는 날짜를 고른 뒤 해당 date의 row를 출력하는 것이다.

#### patient2.php
> PATIENTINFO 테이블의 attribute 중 Sex를 기준으로 filtering 하였다.<br>
> filtering 방법은 select 타입으로 all, male, female, none(=null) 중 하나를 선택하면 해당 성별의 row들을 출력하는 것이다.

#### view_province.php
`CREATE view PROVINCE_COUNT AS select province, count(*) as patient_count from PatientInfo group by province order by count(*) DESC;`

> PATIENTINFO 테이블의 attribute 중 province를 기준으로 group by를 하였고 province, count(*)를 select 하여 count(*) 내림차순으로 PROVINCE_COUNT 라는 VIEW 테이블을 생성했다.
> province 별 환자수를 내림차순으로 출력.
<br>

--------------------------------
##### patient3.php index.php update 21.12.12
##### Google Cloud Platform의 Maps Javascript API 사용

## php file description
#### patient3.php
> Hospital_id 입력시 해당 hospital에 배정되어 있는 patient 목록 출력
> Hospital_id 값 클릭시 구글맵 api를 사용한 index.php로 이동하여 위도, 경도를 통하여 해당 hospital 위치를 지도로 출력
