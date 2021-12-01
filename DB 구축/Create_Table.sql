create table CASEINFO(
case_id INT NOT NULL,
province VARCHAR(50),
city VARCHAR(50),
infection_group TINYINT(1),
infection_case VARCHAR(50),
confirmed INT,
latitude FLOAT,
longitude FLOAT,
PRIMARY KEY(case_id)
);

create table REGION(
region_code INT NOT NULL,
province VARCHAR(50),
city VARCHAR(50),
latitude FLOAT,
longitude FLOAT,
elementary_school_count INT,
kindergarten_count INT,
university_count INT,
academy_ratio FLOAT,
elderly_population_ration FLOAT,
elderly_alone_ratio FLOAT,
nursing_home_count INT,
PRIMARY KEY(region_code)
);

create table PATIENTINFO(
patient_id BIGINT NOT NULL,
sex VARCHAR(10),
age VARCHAR(10),
country VARCHAR(50),
province VARCHAR(50),
city VARCHAR(50),
infection_case VARCHAR(50),
infected_by BIGINT,
contact_number INT,
symptom_onset_date DATE,
confirmed_date DATE,
released_date DATE,
deceased_date DATE,
state VARCHAR(20),
PRIMARY KEY(patient_id)
);

create table TIMEINFO(
date DATE NOT NULL,
test INT(11),
negative INT(11),
confirmed INT(11),
released INT(11),
deceased INT(11),
PRIMARY KEY(date)
);

create table TIMEAGE(
date DATE NOT NULL,
age VARCHAR(10),
confirmed INT(11),
deceased INT(11),
PRIMARY KEY(date, age)
);

create table TIMEGENDER(
date DATE NOT NULL,
sex VARCHAR(10),
confirmed INT(11),
deceased INT(11),
PRIMARY KEY(date, sex)
);

create table TIMEPROVINCE(
date DATE NOT NULL,
p_province VARCHAR(50),
confirmed INT(11),
released INT(11),
deceased INT(11),
PRIMARY KEY(date, p_province)
);

create table WEATHER(
region_code INT NOT NULL,
province VARCHAR(50),
wdate DATE NOT NULL,
avg_temp FLOAT,
min_temp FLOAT,
max_temp FLOAT,
PRIMARY KEY(region_code, wdate)
);