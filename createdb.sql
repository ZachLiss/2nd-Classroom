CREATE TABLE USERS(
	first_name varchar(20),
	last_name varchar(20),
	username varchar(10),
	email varchar(20),
	password varchar(10),
	CONSTRAINT users_pk PRIMARY KEY(username)
);

CREATE TABLE COURSES(
	course_id int NOT NULL AUTO_INCREMENT,
	course_num varchar(10),
	course_name varchar(100),
	instructor varchar(50),
	ta varchar(50),
	location varchar(200),
	time varchar(100),
	CONSTRAINT courses_pk PRIMARY KEY(course_id)
);

CREATE TABLE GROUPS(
	group_id int NOT NULL AUTO_INCREMENT,
	group_name varchar(100),
	course_id int,
	creator varchar(10),
	location varchar(200),
	time varchar(100),
	CONSTRAINT groups_pk PRIMARY KEY(group_id),
	CONSTRAINT groups_fk1 FOREIGN KEY(creator) REFERENCES USERS(username),
	CONSTRAINT groups_fk2 FOREIGN KEY(course_id) REFERENCES COURSES(course_id)
);

CREATE TABLE COURSES_TAKEN(
	username varchar(10),
	course_id int,
	CONSTRAINT courses_taken_pk PRIMARY KEY(username, course_id),
	CONSTRAINT courses_taken_fk1 FOREIGN KEY(username) REFERENCES USERS(username),
	CONSTRAINT courses_taken_fk2 FOREIGN KEY(course_id) REFERENCES COURSES(course_id)
);

CREATE TABLE GROUPS_JOINED(
	username varchar(10),
	group_id int,
	CONSTRAINT groups_joined_pk PRIMARY KEY(username, group_id),
	CONSTRAINT groups_joined_fk1 FOREIGN KEY(username) REFERENCES USERS(username),
	CONSTRAINT groups_joined_fk2 FOREIGN KEY(group_id) REFERENCES GROUPS(group_id)
);

CREATE TABLE MESSAGES(
	message_id int NOT NULL AUTO_INCREMENT,
	sender varchar(10),
	recipient varchar(10),
	subject varchar(50),
	message text,
	time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
	CONSTRAINT messages_pk PRIMARY KEY(message_id),
	CONSTRAINT message_fk1 FOREIGN KEY(sender) REFERENCES USERS(username),
	CONSTRAINT message_fk2 FOREIGN KEY(recipient) REFERENCES USERS(username)
);


COMMIT;
