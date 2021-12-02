# DB_project
Database team project

경북대학교 컴퓨터학부 데이타베이스


#### :wrench: 개발 도구
>- Python <br>
>- Mysql <br>
>- WAMP(APACHE + PHP)

-------------------------------
#### :floppy_disk: [DB 구축 repo link](https://github.com/heej-ng/DB_project/tree/main/DB%20%EA%B5%AC%EC%B6%95)

## DB 구축 (MySQL, Python)

![relation](https://user-images.githubusercontent.com/80497254/144187266-86ea8eee-48b4-497d-b1ed-ac7b633e58e7.png)

### Patientinfo 테이블 : Epidemiological data of COVID-19 patients in South Korea

- Patient_id : region_code(5) + patient_number(5)

- Provice : 서울, 부산 같은 특별시 및 광역시 또는 경기도 강원도 와 같은 도

- City :
> province가 서울 부산 같은 특별시, 광역시인 경우 City는
강남구, 서초구, 해운대구<br>
> province가 경상북도 경기도 같은 경우에는 City가
구미시, 안동시

- Infection_case : 감염 원인
ex) overseas inflow, contact with patient, Eunpyeong St. Mary's Hospital

- Infected_by : the ID of who infected this patient
cf) this column refers to the 'patient_id' column.

- Contact_number : 접촉한 사람들 수

- Symptom_onset_date : 증상발생 날짜
- Confirmed_date : 확진(양성 판정) 일
- Released_date : 완치(퇴원)날짜
- Deceased_date : 사망일
- State : isolated / released / deceased

<br>

### Case 테이블 : Data of COVID-19 infection cases in South Korea
- Case_id : The ID of the infection case
> case_id(7) = region_code(5)+case_number(2)
- Infection_group : 집단감염 여부
> TRUE = Group infection <br>
> FALSE = not group
- infection_case : the infection case (the name of group or other cases)
> ex) Itaewon Clubs, Guro-gu Call Center
- Confirmed : 확진자 수

<br>

### Region 테이블 : Location and statistical data of the regions in South Korea
<br>

### Weather 테이블 : Data of the weather in the regions of South Korea
<br>

### TimeInfo 테이블 : COVID-19 data by date
- Date : 코로나 터진 이후 2020-06-30일까지의 날짜(primary key)
- Test : 그 날까지의 누적검사자수
- Negative : 그 날까지의 누적 음성판정자수
- Confirmed : 그 날까지의 누적 양성판정자수
- Released : 확진받고 격리된 사람들중 격리해제된 사람들수(누적)
- Deceased : 누적 사망자수
- 주의) 모든 column은 "누적"됨

-------------------------
#### :computer: [APACHE&PHP repo link](https://github.com/heej-ng/DB_project/tree/main/APACHE%26PHP)

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
