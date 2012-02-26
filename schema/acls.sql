CREATE TABLE acl_resources (
	id SERIAL NOT NULL ,
	name VARCHAR(255) ,
	description VARCHAR(255) ,
	parentid INT DEFAULT NULL ,
	PRIMARY KEY (id)
);
 
CREATE TABLE acl_roles (
	id SERIAL NOT NULL ,
	name VARCHAR(255) NOT NULL,
	description VARCHAR(255),
	parentId INT DEFAULT NULL,
	PRIMARY KEY (id)
);
 
CREATE TABLE acl_permissions (
	id SERIAL NOT NULL ,
	role INT,
	resource INT,
	read BOOLEAN DEFAULT FALSE,
	create_stuff BOOLEAN DEFAULT FALSE,
	modify BOOLEAN DEFAULT FALSE,
	delete BOOLEAN DEFAULT FALSE,
	publish BOOLEAN DEFAULT FALSE,
	description VARCHAR(255),
	PRIMARY KEY (id)
);
-- Possibly the column above should not use create as its name because it seems to be a special keyword in postgres.

CREATE TABLE user_role_lookup (
	id SERIAL NOT NULL,
	fk_user_id int NOT NULL,
	fk_acl_roles_id int NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO acl_resources (id, name, description, parentId) VALUES
(1, 'testacl', 'Acl Test Controller', NULL),
(2, 'Org_Test', 'Test Organization', NULL),
(3, 'Event_Test_Gaming_Convetion', 'Test Gaming Convention', 2);

INSERT INTO acl_roles (id, name, description, parentId) VALUES
(1, 'Super_Admin', 'Has rights to everything', NULL),
(2, 'SRA_Guest', 'Not logged in user', NULL),
(3, 'SRA_User', 'Normal user with an account', 2),
(4, 'SRA_Register', 'Can register people for site or any event session on site', 3),
(5, 'SRA_Editor', 'Can edit and manage events site wide', 3),
(6, 'SRA_Admin', 'Can administer all things', 3),
(7, 'Org_Test_Admin', 'Can administer Test Org Things', 3),
(8, 'Org_Editor', 'Can Editing type things for an Org', 3),
(9, 'Event_Test_Gaming_Convention_Admin', 'Can administer all event things', 3);
 
-- Again perhaps this column should not be named create due to it's special keyword status.
INSERT INTO acl_permissions (role ,resource ,read ,create_stuff ,modify ,delete ,publish)
VALUES 
('2', '1', '1', '0', '0', '0', '0'),
('3', '1', '1', '1', '0', '0', '0'),
('4', '1', '1', '1', '0', '1', '0'),
('5', '1', '1', '1', '1', '1', '0'),
('6', '1', '1', '1', '1', '1', '1'),
('2', '2', '1', '0', '0', '0', '0'),
('7', '2', '1', '1', '1', '1', '1'),
('8', '2', '1', '1', '1', '0', '0'),
('9', '3', '1', '1', '1', '1', '1');

