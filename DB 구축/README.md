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
<br>

### 특이사항
> df = df.fillna('NULL')를 통해 NaN 값을 NULL로 문자열화 한다. <br>
> 이후 각 행에서 추출한 데이터들을 formatting 할 때, date나 varchar 처럼 숫자 타입이 아닌 데이터들의 경우 '"{}"'.format(데이터)으로 formatting 하여 "데이터"와 같이 ""를 붙인 문자열 형태로 sql문에 넣었다.

> 다만, '"{}"' 으로 formatting 할 경우, NULL 값이 "NULL"처럼 ""가 추가된 문자열 형태로 들어가는 경우가 생겼다. <br>
> 이를 해결하기 위해 replace('\"NULL\"', "NULL")를 사용하여 "NULL"에서 ""를 지우는 방식을 사용하였다.

> Parsing_timegender.py 에서 male, female 값이 적혀있지않은 NULL 값들도 따로 저장하였다.
<br>

----------------------------------

##### Hospital table update 21.12.12

### Hospital 테이블
- Hospital_id (primary key)
- Province
- City
- Latitude : 위도
- Longitude : 경도
- Capacity : 최대 수용인원
- Current : 현재 수용인원
