--
-- Table structure for table 'USERS'
--

CREATE TABLE IF NOT EXISTS USERS (
  first_name varchar(20) DEFAULT NULL,
  last_name varchar(20) DEFAULT NULL,
  username varchar(10) NOT NULL DEFAULT '',
  email varchar(20) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  PRIMARY KEY (username)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS COURSES (
  course_id int(11) NOT NULL AUTO_INCREMENT,
  course_num varchar(10) DEFAULT NULL,
  course_name varchar(100) DEFAULT NULL,
  instructor varchar(50) DEFAULT NULL,
  ta varchar(50) DEFAULT NULL,
  location varchar(200) DEFAULT NULL,
  start_time varchar(20) DEFAULT NULL,
  end_time varchar(20) DEFAULT NULL,
  days varchar(30) DEFAULT NULL,
  PRIMARY KEY (course_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table 'COURSES_TAKEN'
--

CREATE TABLE IF NOT EXISTS COURSES_TAKEN (
  username varchar(10) NOT NULL DEFAULT '',
  course_id int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (username,course_id),
  KEY courses_taken_fk2 (course_id),
  KEY username (username)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'FRIENDS'
--

CREATE TABLE IF NOT EXISTS FRIENDS (
  username varchar(10) DEFAULT NULL,
  friendname varchar(10) DEFAULT NULL,
  KEY friends_fk1 (friendname)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'GROUPS'
--

CREATE TABLE IF NOT EXISTS GROUPS (
  group_id int(11) NOT NULL AUTO_INCREMENT,
  group_name varchar(100) DEFAULT NULL,
  description text NOT NULL,
  course_id int(11) DEFAULT NULL,
  creator varchar(10) DEFAULT NULL,
  location varchar(200) DEFAULT NULL,
  start_time varchar(100) DEFAULT NULL,
  end_time int(30) DEFAULT NULL,
  PRIMARY KEY (group_id),
  KEY groups_fk1 (creator),
  KEY groups_fk2 (course_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table 'GROUPS_JOINED'
--

CREATE TABLE IF NOT EXISTS GROUPS_JOINED (
  username varchar(10) NOT NULL DEFAULT '',
  group_id int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (username,group_id),
  KEY groups_joined_fk2 (group_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table 'MESSAGES'
--

CREATE TABLE IF NOT EXISTS MESSAGES (
  message_id int(11) NOT NULL AUTO_INCREMENT,
  sender varchar(10) DEFAULT NULL,
  recipient varchar(10) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  message text,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (message_id),
  KEY message_fk1 (sender),
  KEY message_fk2 (recipient)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table 'NOTES'
--

CREATE TABLE IF NOT EXISTS NOTES (
  note_id int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(10) DEFAULT NULL,
  course_id varchar(10) DEFAULT NULL,
  title varchar(50) DEFAULT NULL,
  note text,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (note_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table 'THREADMESSAGES'
--

CREATE TABLE IF NOT EXISTS THREADMESSAGES (
  message_id int(11) NOT NULL AUTO_INCREMENT,
  thread_id varchar(10) DEFAULT NULL,
  content text,
  username varchar(10) DEFAULT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (message_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table 'THREADS'
--

CREATE TABLE IF NOT EXISTS THREADS (
  thread_id int(11) NOT NULL AUTO_INCREMENT,
  group_id varchar(10) DEFAULT NULL,
  title varchar(25) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  PRIMARY KEY (thread_id)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------



--
-- Constraints for dumped tables
--

--
-- Constraints for table COURSES_TAKEN
--
ALTER TABLE COURSES_TAKEN
  ADD CONSTRAINT courses_taken_fk1 FOREIGN KEY (username) REFERENCES `USERS` (username),
  ADD CONSTRAINT courses_taken_fk2 FOREIGN KEY (course_id) REFERENCES COURSES (course_id);

--
-- Constraints for table FRIENDS
--
ALTER TABLE FRIENDS
  ADD CONSTRAINT friends_fk1 FOREIGN KEY (friendname) REFERENCES `USERS` (username);

--
-- Constraints for table GROUPS
--
ALTER TABLE GROUPS
  ADD CONSTRAINT groups_fk1 FOREIGN KEY (creator) REFERENCES `USERS` (username),
  ADD CONSTRAINT groups_fk2 FOREIGN KEY (course_id) REFERENCES COURSES (course_id);

--
-- Constraints for table GROUPS_JOINED
--
ALTER TABLE GROUPS_JOINED
  ADD CONSTRAINT groups_joined_fk1 FOREIGN KEY (username) REFERENCES `USERS` (username),
  ADD CONSTRAINT groups_joined_fk2 FOREIGN KEY (group_id) REFERENCES `GROUPS` (group_id);

--
-- Constraints for table MESSAGES
--
ALTER TABLE MESSAGES
  ADD CONSTRAINT message_fk1 FOREIGN KEY (sender) REFERENCES `USERS` (username),
  ADD CONSTRAINT message_fk2 FOREIGN KEY (recipient) REFERENCES `USERS` (username);
