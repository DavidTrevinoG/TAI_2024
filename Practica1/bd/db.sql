create database if not exists controlVentas;

use controlVentas;

create table if not exists Categorias (
    id_categorias int primary key auto_increment,   
    nombre varchar(50) not null
);

create table if not exists Productos (
    id_productos int primary key auto_increment,
    nombre varchar(50) not null,
    id_categorias int not null,
    precio_venta decimal(10,2) not null,
    precio_compra decimal(10,2) not null,
    fecha_compra date not null,
    color varchar(50) not null,
    descripcion_corta varchar(50) not null,
    descripcion_larga varchar(50) not null,
    foreign key (id_categorias) references Categorias(id_categorias)
);

create table if not exists Inventarios (
    id_inventarios int primary key auto_increment,
    id_productos int not null,
    fecha_salida date not null,
    fecha_entrada date not null,
    movimiento varchar(50) not null,
    motivo varchar(50) not null,
    cantidad int not null,
    foreign key (id_productos) references Productos(id_productos)
);

create table if not exists Clientes (
    id_clientes int primary key auto_increment,
    nombre varchar(50) not null,
    correo varchar(50) not null,
    telefono varchar(50) not null,
    direccion varchar(50) not null
    rfc varchar(50) not null,
    razon_social varchar(50) not null,
    codigo_postal varchar(50) not null,
    regimen_fiscal varchar(50) not null
);

create table if not exists Proveedores (
    id_proveedores int primary key auto_increment,
    nombre varchar(50) not null,
    nombre_contacto varchar(50) not null,
    correo varchar(50) not null,
    telefono varchar(50) not null
);

create table if not exists FormaPago (
    id_forma_pago int primary key auto_increment,
    nombre varchar(50) not null
);

create table if not exists Compras (
    id_compras int primary key auto_increment,
    id_proveedores int not null,
    id_productos int not null,
    id_forma_pago int not null,
    fecha_compra date not null,
    cantidad int not null,
    precio decimal(10,2) not null,
    descuento decimal(10,2) not null,
    total decimal(10,2) not null,
    foreign key (id_proveedores) references Proveedores(id_proveedores),
    foreign key (id_productos) references Productos(id_productos),
    foreign key (id_forma_pago) references FormaPago(id_forma_pago)
);

create table if not exists Vendedores (
    id_vendedores int primary key auto_increment,
    nombre varchar(50) not null,
    correo varchar(50) not null,
    telefono varchar(50) not null
);

create table if not exists Cotizaciones (
    id_cotizaciones int primary key auto_increment,
    id_clientes int not null,
    id_productos int not null,
    fecha_cotizacion date not null,
    vigenca date not null,
    comentarios varchar(50) not null
);

create table if not exists Ventas (
    id_ventas int primary key auto_increment,
    id_clientes int not null,
    id_productos int not null,
    id_vendedores int not null,
    id_forma_pago int not null,
    fecha_venta date not null,
    cambio decimal(10,2) not null,
    subtotal decimal(10,2) not null,
    iva decimal(10,2) not null,
    total decimal(10,2) not null,
    foreign key (id_clientes) references Clientes(id_clientes),
    foreign key (id_productos) references Productos(id_productos),
    foreign key (id_forma_pago) references FormaPago(id_forma_pago),
    foreign key (id_vendedores) references Vendedores(id_vendedores)
);