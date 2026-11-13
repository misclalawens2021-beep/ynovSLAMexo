drop database if exists tp_auth; 
create database tp_auth; 
use tp_auth; 

create table user (
	iduser int(5) not null auto_increment, 
	nom varchar(50), 
	prenom varchar(50), 
	email varchar(50), 
	mdp varchar(255), 
	primary key(iduser)
);

insert into user values (null, "Othmane", "Alexis", 
"a@gmail.com", "123"); 

insert into user values (null, "Thomas", "Mike", 
"b@gmail.com", "456");