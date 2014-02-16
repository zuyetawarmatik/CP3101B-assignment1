DROP SCHEMA IF EXISTS "public" cascade;
CREATE SCHEMA "public";

CREATE SEQUENCE user_id_seq;
CREATE SEQUENCE task_id_seq;

CREATE TABLE "users" (
	id INTEGER NOT NULL default nextval('user_id_seq') PRIMARY KEY,
	username VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(200) NOT NULL UNIQUE,
	password VARCHAR(50)
);

CREATE TABLE "tasks" (
	id INTEGER NOT NULL default nextval('task_id_seq') PRIMARY KEY,
	user_id integer 
	constraint FK_task_user
	REFERENCES users(id) ,
	description VARCHAR(200)
);


SELECT * FROM users;
SELECT * FROM tasks;
