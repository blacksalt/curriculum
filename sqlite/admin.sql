DROP TABLE IF EXISTS "admin";
CREATE TABLE admin (
	id integer not null unique primary key,
	username varchar(30) unique,
	password varchar(40),
	salt varchar(40)
);
INSERT INTO "admin" VALUES(1,'admin','a39880be61aeed7d19da94912f546e8632967d30','d033e22ae348aeb5660fc2140aec35850c4da997');
