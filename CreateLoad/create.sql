drop table if exists rcomment;
drop table if exists orderdishes;
drop table if exists orders;
drop table if exists customer;
drop table if exists dish;
drop table if exists owner;
drop table if exists restaurant;
CREATE TABLE restaurant(
	rID integer,
        rName varchar(50),
	rAddress varchar(100), 
	rPhone varchar(20),
	cost varchar(5),
	isOpen boolean,
	rimg varchar(100),
	primary key(rID)
);
CREATE TABLE owner(
        userID integer,
        username varchar(50),
        password varchar(20),
        rID integer,
        primary key(userID),
	foreign key(rID) references restaurant(rID)
);
CREATE TABLE dish(
        rID integer,
        dName varchar(50),
        dPrice float,
        dimg varchar(100),
        primary key(rID, dName),
        foreign key(rID) references restaurant(rID)
);
CREATE TABLE customer(
        userID integer,
        username varchar(50),
        password varchar(20),
        Email varchar(100),
	phone varchar(20),
	address varchar(100),
        primary key(userID)
);
CREATE TABLE orders(
	orderID integer,
	rID integer,
	userID integer,
	dAddress varchar(100),
        time datetime,
        price float,
        status integer,
        paymethod integer,
	primary key(orderID),
	foreign key(rID) references restaurant(rID),
	foreign key(userID) references customer(userID)
);
CREATE TABLE orderdishes(
        orderID integer,
        rID integer,
        dName varchar(50),
        primary key(orderID, rID, dName),
	foreign key(orderID) references orders(orderID)
);
CREATE TABLE rcomment(
        rID integer,
        userID integer,
        score integer,
        cimg varchar(100),
        time datetime,
        comment text,
        primary key(rID, userID, time),
        foreign key(rID) references restaurant(rID),
        foreign key(userID) references customer(userID)
);
