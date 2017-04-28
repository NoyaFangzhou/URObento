drop table if exists UROB_Dcomment;

drop table if exists UROB_Rcomment;

drop table if exists UROB_Orderdishes;

drop table if exists UROB_Dish;

drop table if exists UROB_Order;

drop table if exists UROB_Owner;

drop table if exists UROB_Restaurant;

drop table if exists UROB_Customer;

create table UROB_Customer(
	user_id int NOT NULL AUTO_INCREMENT,
	username varchar(50) NOT NULL,
	password char(40) NOT NULL,
	salt char(40) NOT NULL,
	email varchar(50) default NULL,
	phone varchar(20) NOT NULL,
	address varchar(50) NOT NULL,
	PRIMARY KEY (user_id)
);

create table UROB_Restaurant(
	restaurant_id int NOT NULL AUTO_INCREMENT,
	rname varchar(30) NOT NULL,
	raddress varchar(50) NOT NULL,
	rphone varchar(20) NOT NULL,
	average_cost varchar(5),
	is_open boolean NOT NULL,
	restaurant_img varchar(100) default NULL,
	PRIMARY KEY (restaurant_id)
);

create table UROB_Owner(
	user_id int NOT NULL AUTO_INCREMENT,
	username varchar(50) NOT NULL,
	password char(40) NOT NULL,
	salt char(40) NOT NULL,
	restaurant_id int default NULL,
	PRIMARY KEY (user_id),
	CONSTRAINT FOREIGN KEY (restaurant_id) REFERENCES UROB_Restaurant (restaurant_id)
);

create table UROB_Order(
	order_id int NOT NULL AUTO_INCREMENT,
	user_id int NOT NULL,
	restaurant_id int NOT NULL, 
	delivery_address varchar(50) NOT NULL,
	time datetime NOT NULL,
	total_price decimal(6,2) NOT NULL,
	status int(4) default 0,
	paying_method int(4) NOT NULL,
	requirement varchar(100) default NULL,
	PRIMARY KEY (order_id),
	CONSTRAINT FOREIGN KEY (user_id) REFERENCES UROB_Customer (User_id),
	CONSTRAINT FOREIGN KEY (restaurant_id) REFERENCES UROB_Restaurant (restaurant_id)
);

create table UROB_Dish(
	restaurant_id int NOT NULL,
	dname varchar(40) NOT NULL,
	dprice decimal(4,2) NOT NULL,
	dish_img varchar(100) default NULL,
	PRIMARY KEY (restaurant_id, dname),
	CONSTRAINT FOREIGN KEY (restaurant_id) REFERENCES UROB_Restaurant (restaurant_id)
);

CREATE INDEX ix_dname on UROB_Dish (dname);

CREATE TABLE UROB_Orderdishes(
	order_id int NOT NULL,
	restaurant_id int NOT NULL,
	dname varchar(40) NOT NULL,
	quantity int default 1,
	PRIMARY KEY (order_id, restaurant_id, dname),
	CONSTRAINT FOREIGN KEY (order_id) REFERENCES UROB_Order (order_id),
	CONSTRAINT FOREIGN KEY (restaurant_id) REFERENCES UROB_Restaurant (restaurant_id),
	CONSTRAINT FOREIGN KEY (dname) REFERENCES UROB_Dish (dname)
);


create table UROB_Rcomment(
	rcomment_id int NOT NULL AUTO_INCREMENT,
	restaurant_id int NOT NULL,
	user_id int NOT NULL,	
	rscore int(1) NOT NULL,
	time datetime,
	rcomment varchar(300),
	PRIMARY KEY (rcomment_id),
	CONSTRAINT FOREIGN KEY (restaurant_id) REFERENCES UROB_Restaurant (restaurant_id),
	CONSTRAINT FOREIGN KEY (user_id) REFERENCES UROB_Customer (user_id)
);


create table UROB_Dcomment(
	dcomment_id int NOT NULL AUTO_INCREMENT,
	restaurant_id int NOT NULL,
	user_id int NOT NULL,
	dname varchar(40) NOT NULL,	
	dscore int(1) NOT NULL,
	time datetime,
	dcomment varchar(300),
	PRIMARY KEY (dcomment_id),
	CONSTRAINT FOREIGN KEY (restaurant_id) REFERENCES UROB_Restaurant (restaurant_id),
	CONSTRAINT FOREIGN KEY (user_id) REFERENCES UROB_Customer (user_id),
	CONSTRAINT FOREIGN KEY (dname) REFERENCES UROB_Dish (dname)
);


