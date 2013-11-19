<?php
$db = mysqli_connect("localhost","SavitC","icy-gut","SavitC") or die("Oooops");
$db->query("drop table users");
$db->query("drop table courses");
$db->query("drop table groups");
$db->query("drop table courses_taken");
$db->query("drop table groups_joined");

$sql = "CREATE TABLE users(
	first_name varchar(20),
	last_name varchar(20),
	username varchar(10),
	email varchar(20),
	password varchar(10),
	CONSTRAINT users_pk PRIMARY KEY(username)
)";

$db->query($sql);

$sql = "CREATE TABLE courses(
	course_id int NOT NULL AUTO_INCREMENT,
	course_num varchar(10),
	course_name varchar(100),
	instructor varchar(50),
	ta varchar(50),
	location varchar(200),
	time varchar(100),
	CONSTRAINT courses_pk PRIMARY KEY(course_id)
)";

$db->query($sql);

$sql = "CREATE TABLE groups(
	group_id int NOT NULL AUTO_INCREMENT,
	group_name varchar(100),
	course_id int,
	creator varchar(10),
	location varchar(200),
	time varchar(100),
	CONSTRAINT groups_pk PRIMARY KEY(group_id),
	CONSTRAINT groups_fk1 FOREIGN KEY(creator) REFERENCES USERS(username),
	CONSTRAINT groups_fk2 FOREIGN KEY(course_id) REFERENCES COURSES(course_id)
)";

$db->query($sql);

$sql = "CREATE TABLE Ccourses_taken(
	username varchar(10),
	course_id int,
	CONSTRAINT courses_taken_pk PRIMARY KEY(username, course_id),
	CONSTRAINT courses_taken_fk1 FOREIGN KEY(username) REFERENCES USERS(username),
	CONSTRAINT courses_taken_fk2 FOREIGN KEY(course_id) REFERENCES COURSES(course_id)
)";

$db->query($sql);

$sql = "CREATE TABLE groups_joined(
	username varchar(10),
	group_id int,
	CONSTRAINT groups_joined_pk PRIMARY KEY(username, group_id),
	CONSTRAINT groups_joined_fk1 FOREIGN KEY(username) REFERENCES USERS(username),
	CONSTRAINT groups_joined_fk2 FOREIGN KEY(group_id) REFERENCES GROUPS(group_id)
)";

$db->query($sql);
?>
Success.

