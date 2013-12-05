
INSERT INTO USERS (first_name, last_name, username, email, password) VALUES
('arjun', 'kumar', 'amk145', 'amk145', 'pittsburgh'),
('Cory', 'Savit', 'cas241', 'cas241@pitt.edu', 'cory1'),
('John', 'Smith', 'js101', 'john.smith@gmail.com', 'password'),
('Peter', 'Lancaster', 'pel37', 'pel37@pitt.edu', 'peter1'),
('Stephanie', 'Zini', 'saz27', 'saz27@pitt.edu', 'steph1'),
('Zach', 'Liss', 'zll1', 'zll1@pitt.edu', 'zach1');


INSERT INTO COURSES (course_id, course_num, course_name, instructor, ta, location, start_time, end_time, days) VALUES
(1, 'CS0401', 	'Intermediate Programming Using Java', 	'Hoffman, Timothy L', 	NULL, '05129 SENSQ', 	'2013-12-04 12:00', 	'2013-12-04 13:00', NULL),
(2, 'CS0445', 	'Data Structures', 						'Ramirez, John C', 		NULL, '05502 SENSQ', 	'2013-12-03 2:00', 		'2013-12-03 2:45', NULL),
(3, 'CS0449', 	'Intro To Systems Software', 			'Misurda, Jonathan R', 	NULL, '05502 SENSQ', 	'2013-12-00 00:00:00', 	'2013-12-00 00:00:00', NULL),
(4, 'CS1501', 	'Algorithm Implementation', 			'Novacky, George A', 	NULL, '00202 FKART', 	'2013-12-00 00:00:00', 	'2013-12-00 00:00:00', NULL),
(5, 'MATH0220', 'Analytic Geometry & Calculus 1', 		'Athanas, Angela', 		NULL, '00422 THACK', 	'2013-12-00 14:00:00', 	'2013-12-00 15:30:00', NULL),
(6, 'MATH0230', 'Analytic Geometry & Calculus 2', 		'Pakzad, Reza', 		NULL, '00704 THACK', 	'2013-12-00 11:00:00', 	'2013-12-00 11:50:00', NULL),
(7, 'MATH0290', 'Differential Equations', 				'Rubin, Jonathan E', 	NULL, '0A115 PUBHL', 	'2013-12-00 00:00:00', 	'2013-12-00 00:00:00', NULL),
(8, 'STAT1000', 'Applied Statistical Methods', 			'Weinberg, Gordon Jay', NULL, '00232 CL', 		'2013-12-00 00:00:00', 	'2013-12-00 00:00:00', NULL),
(9, 'SPAN0003', 'Intermediate Spanish 3', 				'Wesserling, Anne', 	NULL, '0G16B CL', 		'2013-12-00 00:00:00', 	'2013-12-00 00:00:00', NULL),
(10, 'SPAN0004','Intermediate Spanish 4', 				'Arredondo, Ulises', 	NULL, '0G19A CL', 		'2013-12-00 00:00:00', 	'2013-12-00 00:00:00', NULL);



INSERT INTO GROUPS (group_id, group_name, description, course_id, creator, location, start_time, end_time) VALUES
(1, 'Midterm Review', 	'', 									1, 	'cas241', 	'Sennott Square', 	'12:00pm', 	NULL),
(2, 'Test Study', 		'We will study for tests and stuff', 	3, 	'cas241', 	'Sennott Square', 	'12:00', 	NULL),
(3, 'Final Study', 		'We will study, finally', 				2, 	'cas241', 	'Here', 			'Now', 		NULL);

