CREATE TABLE active_sensors
	(
	sensor_id int,
	serial varchar(200),
	latitude decimal(10, 8),
	longitude decimal(11,8),
	location varchar(500),
	primary key(serial));

CREATE TABLE archived_sensors
	(
	sensor_id int,
	serial varchar(200),
	latitude decimal(10, 8),
	longitude decimal(11,8),
	location varchar(500),
	primary key(sensor_id));

CREATE TABLE users
	(
	user_id int auto_increment,
	username varchar(25),
	password varchar(200),
	fname varchar(25),
	lname varchar(25),
	email varchar(200),
	primary key(user_id));