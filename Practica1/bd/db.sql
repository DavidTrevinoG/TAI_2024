create database if not exists controlVentas;

use controlVentas;

create table if not exists categorias(
    id_categoria int auto_increment primary key,
    nombre varchar(100) not null
);


create table if not exists productos(
    id_producto int auto_increment primary key,
    nombre varchar(100) not null,
    id_categoria int not null,
    precio_venta float not null,
    precio_compra float not null,  
    fecha_anadido date not null,
    color varchar(100) not null,
    descripcion_corta varchar(100) not null,
    descripcion_larga varchar(100) not null,
    foreign key(id_categoria) references categorias(id_categoria)
);

create table if not exists clientes(
    id_cliente int auto_increment primary key,
    nombre varchar(100) not null,
    email varchar(100) not null,
    telefono varchar(100) not null,
    direccion varchar(100) not null,
    rfc varchar(100) not null
);

create table if not exists ventas(
    id_venta int auto_increment primary key,
    id_producto int not null,
    id_categoria int not null,
    id_cliente int not null,
    cantidad int not null,
    fecha_venta date not null,
    subtotal float not null,
    iva float not null,
    total float not null,
    foreign key(id_producto) references productos(id_producto),
    foreign key(id_categoria) references categorias(id_categoria),
    foreign key(id_cliente) references clientes(id_cliente)
);

create table if not exists inventarios(
    id_inventario int auto_increment primary key,
    id_producto int not null,
    id_categoria int not null,
    fecha_entrada date not null,
    fecha_salida date not null,
    motivo varchar(100) not null,
    tipo_movimiento varchar(100) not null,
    cantidad int not null,
    foreign key(id_producto) references productos(id_producto),
    foreign key(id_categoria) references categorias(id_categoria)
);





