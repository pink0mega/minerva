drop database if exists minerva;
create database minerva;

use minerva;

drop table if exists usuarios;
create table if not exists usuarios(
	id_clientes int primary key,
    email varchar(50),
    nombre varchar(25),
    apellido varchar(50),
    telefono int(9),
    direccion varchar(50),
    dni_usuario varchar(9)
);
