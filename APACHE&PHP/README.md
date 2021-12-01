##### WAMP (APACHE + Mysql + PHP) 사용

- 목표 : parsing하고 데이터베이스에 insert한 데이터들을 이용하여 web 상에 출력하면서 의미 있는 data들을 뽑아내는 것
> (Patientinfo, Case, Region, Weather, Time_info 5개의 테이블 이용)

- 내용
1. Patientinfo, Case, Region, Weather, Time_info 테이블을 웹 페이지 상에 출력(전체 select), 최상단에 row갯수(select된 튜플 수)를 출력!
2. 테이블들 attribute들중에서 하나를 고르고, 선택한 attribute를 기준으로 filtering한 것을 웹 페이지 상에 출력 (5개의 테이블 중 3개
선택), 최상단에 row갯수(select된 튜플 수)를 출력!
3. 5개의 테이블을 자유롭게 사용하여(select, join, where, group by, having, union등) 하나의 의미 있는 view를 뽑아낸 후 웹페이지 상에
출력 
