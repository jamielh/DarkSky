CREATE TABLE active_sensors
	(
	serial varchar(200),
	latitude decimal(10, 8),
	longitude decimal(11,8),
	location varchar(500),
	primary key(serial));

CREATE TABLE archived_sensors
	(
	serial varchar(200),
	latitude decimal(10, 8),
	longitude decimal(11,8),
	location varchar(500),
	primary key(serial));

CREATE TABLE users
	(
	username varchar(25),
	password varchar(200));