create database if not exists logMVC;

use logMVC;

create table if not exists users(
    id int primary key auto_increment,
    username varchar(50) not null,
    password varchar(50) not null
);


