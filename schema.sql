DROP SCHEMA IF EXISTS "public" cascade;
CREATE SCHEMA "public";

CREATE TABLE "users" (
  id integer PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  email VARCHAR(200),
  password VARCHAR(50)
);

CREATE TABLE "tasks" (
  id integer PRIMARY KEY,
  user_id integer 
    constraint FK_task_user
    REFERENCES users(id) ,
  description VARCHAR(200)
);


INSERT INTO users VALUES(1,'name','pwd');
INSERT INTO tasks VALUES(1,1,'task desc');
SELECT * FROM users;
SELECT * FROM tasks;
