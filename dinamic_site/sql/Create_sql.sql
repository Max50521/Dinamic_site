
create database if not exists dinamic_site;
use dinamic_site;

create table if not exists users(
    id int not null auto_increment,
    admin int(12) not null,
    email varchar(255) not null,
    username varchar(255) not null,
    password varchar(255) not null,
    created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    primary key(id)
    );


create table if not exists pasport(
    id int not null auto_increment,
    name text(255) not null,
    Last_name text(255) not null,
    Father_name text(255) not null,
    seria varchar(255) not null,
    num varchar(255) not null,
    date date not null,
    adres varchar(255) not null,
    img varchar(255) not null,
    primary key(id)
    );

create table if not exists cart(
  id int not null auto_increment,
  num_cart int(255) not null,
  primary key(id)
);


create table if not exists posts(
    id int not null auto_increment,
    status int(100) not null,
    cart_num int(100) not null,
    type varchar(50) not null,
    created_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    id_user int,
    id_pass int,
    id_cart int,
    foreign key (id_user)
    references users(id) on delete cascade on update cascade,
    foreign key (id_pass)
    references pasport(id) on delete cascade on update cascade,
    foreign key (id_cart)
    references cart(id) on delete cascade on update cascade,
    primary key(id)
    );
  
create table if not exists history (
	id int not null auto_increment,
	_text varchar(400) not null,
	primary key(id)
);

DELIMITER //
drop trigger if exists pre_insert_posts//
CREATE TRIGGER pre_insert_posts after insert on posts
for each row
	insert into history (_text) values (
	(select concat("Пользователь ", 
	(select username from users where id = new.id_user limit 1), " создал договор №", new.id) limit 1)
	);
//

drop trigger if exists pre_update_posts//
CREATE TRIGGER pre_update_posts after update on posts
for each row
	insert into history (_text) values (
	(select concat(
	"У договора №", new.id, " пользователя ", 
	(select username from users where id = new.id_user), 
	" поменялся статус с ", old.status, " на ", new.status
	)
	)
	);
//
DELIMITER ;











