create table HOSPITAL(
	hospital_id int,
	hname varchar(60),
	hprovince varchar(50),
	hcity varchar(50),
	latitude float,
	longitude float,
	capacity int,
	current int,
	PRIMARY KEY(hospital_id)
);

alter table PATIENTINFO add hospital_id int;