create database if not exists logMVC;

use logMVC;

create table if not exists users(
    id int primary key auto_increment,
    username varchar(50) not null,
    password varchar(50) not null
);

create table if not exists universidad(
    id_universidad int primary key auto_increment,
    nombre varchar(100) not null,
    fundacion date not null,
    direccion varchar(100) not null
);

create table if not exists carrera(
    id_carrera int primary key auto_increment,
    nombre varchar(100) not null,
    director varchar(100) not null,
    id_universidad int not null,
    foreign key (id_universidad) references universidad(id_universidad)
);

