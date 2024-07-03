create database LastAction;

drop table if exists users;
create table users(
	id int primary key AUTO_INCREMENT,
	name varchar(64),
	email varchar(64),
    password varchar(64),
	active int not null default 1
);

drop table if exists news;
create table news(
	id int primary key AUTO_INCREMENT,
	title varchar(64),
	content varchar(512),
	display int not null default 1,
	`date` datetime not null default CURRENT_TIMESTAMP
);

drop table if exists faq;
create table faq(
	id int primary key AUTO_INCREMENT,
	`from` varchar(64),
	question varchar(64),
	answer varchar(512),
	display int not null default 0,
	`date` datetime not null default CURRENT_TIMESTAMP
);

drop table if exists stores;
create table stores(
	id int primary key AUTO_INCREMENT,
	token varchar(64) not null default UUID(),
	logo mediumblob,
	owner int not null default 0,
	name varchar(64) not null default "My Store",
	about varchar(512) not null default "Hello! im owner of this store",
	open int not null default 1
);

drop table if exists store_carousel;
create table store_carousel(
	id int primary key AUTO_INCREMENT,
	store int,
	`image` mediumblob,
	title varchar(64) not null default "Carousel Title",
	content varchar(512) not null default "Carousel Content"
);
