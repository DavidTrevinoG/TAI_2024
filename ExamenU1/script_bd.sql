create table if not exists platillos (
    id int not null primary key auto_increment,
    nombre varchar(100) not null,
    tipo_alimento varchar(100) not null,
    ingredientes int,
    precio decimal(10,2) not null
);