--
-- Table structure for table `ci_sessions`
--
CREATE TABLE ci_sessions 
(
  session_id varchar(40) NOT NULL,
  ip_address varchar(16) NOT NULL DEFAULT '0',
  user_agent varchar(150) NOT NULL,
  last_activity integer NOT NULL DEFAULT 0,
  user_data text NOT NULL,
  CONSTRAINT ci_session_pkey PRIMARY KEY (session_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

-- 
-- create sequence for login attempts table
--
CREATE SEQUENCE login_attempts_seq;

CREATE TABLE login_attempts 
(
  id integer NOT NULL DEFAULT NEXTVAL('login_attempts_seq'),
  ip_address varchar(16) NOT NULL,
  login varchar(50) NOT NULL,
  time timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT login_attempts_pkey PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE user_autologin 
(
  key_id varchar(32) NOT NULL,
  user_id integer NOT NULL,
  user_agent varchar(150) NOT NULL,
  last_ip varchar(40) NOT NULL,
  last_login timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT user_autologin_pkey PRIMARY KEY (key_id, user_id)
);

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

--
-- Create sequence for user profiles table
--
CREATE SEQUENCE user_profiles_seq;

CREATE TABLE user_profiles 
(
  id integer NOT NULL DEFAULT NEXTVAL('user_profiles_seq'),
  user_id integer NOT NULL,
  country varchar(20) DEFAULT NULL,
  website varchar(255) DEFAULT NULL,
  profile_image varchar(200) DEFAULT 'default_profile_image.png',
  CONSTRAINT user_profiles_pkey PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

--
-- create sequence for user table
--
CREATE SEQUENCE users_seq;

CREATE TABLE users 
(
  id integer NOT NULL DEFAULT NEXTVAL('users_seq'),
  username varchar(50) NOT NULL,
  password varchar(255) NOT NULL,
  email varchar(100) NOT NULL,
  activated integer NOT NULL DEFAULT 1,
  banned integer NOT NULL DEFAULT 0,
  ban_reason varchar(255) DEFAULT NULL,
  new_password_key varchar(50) DEFAULT NULL,
  new_password_requested timestamp without time zone DEFAULT NULL,
  new_email varchar(100) DEFAULT NULL,
  new_email_key varchar(50) DEFAULT NULL,
  last_ip varchar(40) NOT NULL,
  last_login timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  created timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  modified timestamp without time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT users_pkey PRIMARY KEY (id)
);


TRUNCATE TABLE ci_sessions;
TRUNCATE TABLE login_attempts;
TRUNCATE TABLE user_autologin;
TRUNCATE TABLE user_profiles;
TRUNCATE TABLE users;
