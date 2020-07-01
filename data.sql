drop database if exists carbussiness;
create database carbussiness;
use carbussiness;

create table users
(
id int auto_increment primary key,
gmail varchar(200) unique,
password varchar(200),
fullname varchar(300),
role varchar(30)
);
insert into users
values(1,'admin@gmail.com','$2y$10$biGC7CqooBGVkwtdXin87O46tm85YWjpy1zNwWtCH3D5W26zAmWYu','Nguyen Ngoc Thao','admin');
create table products(
id int auto_increment primary key,
name varchar(200),
type varchar(10),
brand varchar(200),
year varchar(5),
model varchar(100),
mileage int,
price float,
image varchar(1000),
quantity int
);
create table orders(
id int auto_increment primary key,
product_id int,
quantity int,
user_id int,
date datetime,
address varchar(200),
status boolean,
foreign key (product_id) references products(id),
foreign key (user_id) references users(id)
);

select image from products;
