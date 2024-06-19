create database LastAction;

drop table if exists users;
create table users(
	id int primary key AUTO_INCREMENT,
	name varchar(64),
	email varchar(64),
    password varchar(64),
	active int not null default 1
);

