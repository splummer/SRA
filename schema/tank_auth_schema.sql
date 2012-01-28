-- --------------------------------------------------------

--
-- Table structure for table ci_sessions
--

CREATE TABLE ci_sessions (
  session_id varchar(40)  NOT NULL DEFAULT '0',
  ip_address inet  NOT NULL DEFAULT '0.0.0.0',
  user_agent varchar(150)  NOT NULL,
  last_activity integer NOT NULL DEFAULT '0',
  user_data text  NOT NULL,
  PRIMARY KEY (session_id)
);

-- --------------------------------------------------------

--
-- Table structure for table login_attempts
--

CREATE TABLE login_attempts (
  id serial PRIMARY KEY,
  ip_address inet  NOT NULL,
  login varchar(50)  NOT NULL,
  time timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table user_autologin
--

CREATE TABLE user_autologin (
  key_id char(32)  NOT NULL,
  user_id integer NOT NULL DEFAULT '0',
  user_agent varchar(150)  NOT NULL,
  last_ip inet  NOT NULL,
  last_login timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (key_id,user_id)
);

-- --------------------------------------------------------

--
-- Table structure for table user_profiles
--

CREATE TABLE user_profiles (
	id serial PRIMARY KEY,
	user_id integer NOT NULL,
	last_name character varying(25),
	first_name character varying(25),
	nickname character varying(25),
	address_1 character varying(40),
	address_2 character varying(40),
	city character varying(30),
	state character varying(20),
	zip character varying(10),
	country character varying(35),
	phone character varying(12),
	website varchar(255) DEFAULT NULL,
	twitter varchar(30),
	over13 boolean DEFAULT true NOT NULL,
	contact_attend boolean DEFAULT true NOT NULL,
	contact_any boolean DEFAULT false NOT NULL,
	contact_external boolean DEFAULT false NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  id serial PRIMARY KEY,
  username varchar(50)  NOT NULL,
  password varchar(255)  NOT NULL,
  email varchar(100)  NOT NULL,
  activated smallint NOT NULL DEFAULT '1',
  banned smallint NOT NULL DEFAULT '0',
  ban_reason varchar(255)  DEFAULT NULL,
  new_password_key varchar(50)  DEFAULT NULL,
  new_password_requested timestamp DEFAULT NULL,
  new_email varchar(100)  DEFAULT NULL,
  new_email_key varchar(50)  DEFAULT NULL,
  last_ip inet  NOT NULL,
  last_login timestamp with time zone,
  created timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP,
  modified timestamp with time zone NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Update datetime columns on update
--

CREATE OR REPLACE FUNCTION update_modified_column_time()
	RETURNS TRIGGER AS $$
	BEGIN
	   NEW.time = now(); 
	   RETURN NEW;
	END;
	$$ language 'plpgsql';

CREATE TRIGGER update_login_attempts_time BEFORE UPDATE
	ON login_attempts FOR EACH ROW EXECUTE PROCEDURE 
	update_modified_column_time();

CREATE OR REPLACE FUNCTION update_modified_column_user_autologin()
	RETURNS TRIGGER AS $$
	BEGIN
	   NEW.last_login = now(); 
	   RETURN NEW;
	END;
	$$ language 'plpgsql';

CREATE TRIGGER update_login_attempts_user_autologin BEFORE UPDATE
	ON user_autologin FOR EACH ROW EXECUTE PROCEDURE 
	update_modified_column_user_autologin();


CREATE OR REPLACE FUNCTION update_modified_column_users()
	RETURNS TRIGGER AS $$
	BEGIN
	   NEW.modified = now(); 
	   RETURN NEW;
	END;
	$$ language 'plpgsql';

CREATE TRIGGER update_login_attempts_users BEFORE UPDATE
	ON users FOR EACH ROW EXECUTE PROCEDURE 
	update_modified_column_users();