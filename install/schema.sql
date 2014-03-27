DROP TABLE IF EXISTS "tasks";
DROP TABLE IF EXISTS "users";
DROP SEQUENCE IF EXISTS user_id_seq;
DROP SEQUENCE IF EXISTS task_id_seq;

CREATE SEQUENCE user_id_seq;
CREATE SEQUENCE task_id_seq;

CREATE TABLE "users" (
	id INTEGER NOT NULL default nextval('user_id_seq') PRIMARY KEY,
	username VARCHAR(50) NOT NULL UNIQUE,
	email VARCHAR(200) NOT NULL UNIQUE,
	password VARCHAR(200)
);

CREATE TABLE "tasks" (
	id INTEGER NOT NULL default nextval('task_id_seq') PRIMARY KEY,
	user_id integer 
	constraint FK_task_user
	REFERENCES users(id) ,
	name VARCHAR(50),
	description VARCHAR(200),
	blocks integer,
	current_block integer default 0,
	created_time TIMESTAMP
);


SELECT * FROM users;
SELECT * FROM tasks;
