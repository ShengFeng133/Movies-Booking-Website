create table customerdetails
(
    customerid int unsigned not null auto_increment primary key,
    username char(30) not null,
    phone char (20) not null,
    password char(50) not null,
    email char (50) not null
);