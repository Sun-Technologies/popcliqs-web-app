Local url : 
===================================
http://localhost:8888/checkinevents.service.php?key=5$qazwsx&tz=-330&deviceToken=0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78


http://localhost:8888/login.service.php?usernm=tahir@popcliqs.com&pwd=qazwsx&deviceToken=0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78

http://localhost:8888/logout.service.php?key=5$qazwsx&deviceToken=0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78


prod

http://popcliqs.com/beta/checkinevents.service.php?key=1$123456&tz=-330&deviceToken=0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78


http://popcliqs.com/beta/login.service.php?usernm=tahir@popcliqs.com&pwd=qazwsx&deviceToken=0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78

http://popcliqs.com/beta/logout.service.php?key=5$qazwsx&deviceToken=0f744707bebcf74f9b7c25d48e3358945f6aa01da5ddb387462c7eaf61bbad78



http://localhost:8888/createevent.service.post.php



http://popcliqs.com/beta/zipgeo/zipimport.php?cd=US
http://popcliqs.com/beta/zipgeo/zipimport.php?cd=IN

//zip code url 

//US 
http://localhost:8888/zipgeo/zipimport.php?cd=US

//IN
http://localhost:8888/zipgeo/zipimport.php?cd=IN

==========================================
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
  `zip5` char(6) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `county` varchar(250) NOT NULL,
  country varchar(250) NOT NULL ,
  primary key(zip5)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE  phpfox_event_rsvp (
	rsvp_id INT AUTO_INCREMENT,
	event_id INT,
	user_id INT,
	rsvp_cd INT,
	update_ts datetime,
	create_ts datetime,
	primary key(rsvp_id)
)

CREATE TABLE popcliqs_reset(
	email  varchar(200),
	sessionkey varchar(200),
	create_ts DATETIME,
	update_ts DATETIME
	
)



CREATE TABLE mobile_session(
	deviceToken  varchar(200),
	user_id   varchar(200),
	sessionType  varchar(200),
	status       INT,
	create_ts    DATETIME,
	update_ts    DATETIME,
	primary key(user_id)
)

=======================