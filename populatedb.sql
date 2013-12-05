
INSERT INTO USERS (first_name, last_name, username, email, password) VALUES
('arjun', 'kumar', 'amk145', 'amk145', 'pittsburgh'),
('Cory', 'Savit', 'cas241', 'cas241@pitt.edu', 'cory1'),
('John', 'Smith', 'js101', 'john.smith@gmail.com', 'password'),
('Peter', 'Lancaster', 'pel37', 'pel37@pitt.edu', 'peter1'),
('Stephanie', 'Zini', 'saz27', 'saz27@pitt.edu', 'steph1'),
('Zach', 'Liss', 'zll1', 'zll1@pitt.edu', 'zach1');


INSERT INTO `COURSES` (`course_id`, `course_num`, `course_name`, `instructor`, `ta`, `location`, `start_time`, `end_time`, `days`) VALUES
(1, 'CS0401', 'Intermediate Programming Using Java', 'Hoffman, Timothy L', 'none', '05129 SENSQ', '12/02/2013 12:00 pm', '12/02/2013 01:00 pm', 'MON,WED'),
(2, 'CS0445', 'Data Structures', 'Ramirez, John C', 'none', '05502 SENSQ', '12/03/2013 04:00 pm', '12/03/2013 05:30 pm', 'TUE,THUR'),
(3, 'CS0449', 'Intro To Systems Software', 'Misurda, Jonathan R', 'none', '05502 SENSQ', '12/02/2013 01:00 pm', '12/02/2013 01:40 pm', 'MON,WED'),
(4, 'CS1501', 'Algorithm Implementation', 'Novacky, George A', 'none', '00202 FKART', '12/02/2013 02:30 pm', '12/02/2013 03:30 pm', 'MON,WED'),
(5, 'MATH0220', 'Analytic Geometry & Calculus 1', 'Athanas, Angela', 'none', '00422 THACK', '12/03/2013 02:30 pm', '12/03/2013 03:30 pm', 'TUE,THUR'),
(6, 'MATH0230', 'Analytic Geometry & Calculus 2', 'Pakzad, Reza', 'none', '00704 THACK', '12/02/2013 11:00 am', '12/02/2013 11:50 am', 'MON,WED'),
(8, 'STAT1000', 'Applied Statistical Methods', 'Weinberg, Gordon Jay', 'none', '00232 CL', '12/02/2013 05:00 pm', '12/02/2013 05:40 pm', 'MON,WED'),
(9, 'SPAN0003', 'Intermediate Spanish 3', 'Wesserling, Anne', 'none', '0G16B CL', '12/03/2013 09:00 am', '12/03/2013 09:50 am', 'TUE,THUR'),
(11, 'CS0007', 'Intro To Computer Programming', 'Hoffman, Timothy L', 'none', '05505 SENSQ', '12/03/2013 12:30 pm', '12/03/2013 02:15 pm', 'TUE,THUR');




INSERT INTO GROUPS (group_id, group_name, description, course_id, creator, location, start_time, end_time) VALUES
(1, 'Midterm Review', 	'', 									1, 	'cas241', 	'Sennott Square', 	'12/06/2013 01:00 pm', '12/06/2013 01:40 pm'),
(2, 'Test Study', 		'We will study for tests and stuff', 	3, 	'cas241', 	'Sennott Square', 	'12/07/2013 09:00 pm', '12/7/2013 11:40 pm'),
(3, 'Final Study', 		'We will study, finally', 				2, 	'cas241', 	'Here', 			'12/08/2013 01:00 pm', '12/08/2013 01:40 pm');

