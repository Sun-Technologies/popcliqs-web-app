
DB tables
=======================

CREATE TABLE popcliqs_users(
	user_id INT AUTO_INCREMENT,
	email varchar(30),
	password varchar(30),
	gender INT,
	dob DATE,
	zip INT,
	create_ts DATETIME,
	update_ts DATETIME,
	status INT,
	type int,
	primary key(user_id))

CREATE TABLE popcliqs_events(
	event_id INT AUTO_INCREMENT,
	user_id INT,
	event_title varchar(200),
	description varchar(200),
	category INT,
	event_location varchar(100),
	event_address varchar(100),
	city varchar(100),
	state varchar(100),
	zip INT,
	age_limit INT,
	capacity_limit INT,
	event_start datetime,
	event_end datetime,
	create_ts datetime,
	update_ts datetime,
	status INT,
	event_latitude DOUBLE,
	event_longitude DOUBLE,
	primary key(event_id)
)

CREATE TABLE user_cat_pref(
	preference_id INT AUTO_INCREMENT,
	user_id INT,
	category_id INT,
	pref_cd INT,
	update_ts datetime,
	create_ts datetime,
	primary key(preference_id))


CREATE TABLE  `zipgeo` (
  `zip5` char(5) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `county` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



=======================