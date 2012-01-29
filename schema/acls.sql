CREATE TABLE acl_resources (
	id SERIAL NOT NULL ,
	name VARCHAR(255) ,
	description VARCHAR(255) ,
	parentId INT DEFAULT NULL ,
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
	write BOOLEAN DEFAULT FALSE,
	modify BOOLEAN DEFAULT FALSE,
	delete BOOLEAN DEFAULT FALSE,
	publish BOOLEAN DEFAULT FALSE,
	description VARCHAR(255),
	PRIMARY KEY (id)
);

CREATE TABLE user_role_lookup (
	id SERIAL NOT NULL,
	fk_user_id int NOT NULL,
	fk_acl_roles_id int NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO acl_resources (id, name, description, parentId) VALUES
(1, 'testacl', 'Acl Test Controller', NULL);
 
INSERT INTO acl_roles (id, name, description, parentId) VALUES
(1, 'SRA_Guest', 'Not logged in user', NULL),
(2, 'SRA_User', 'Normal user with an account', 1),
(3, 'SRA_Register', 'Can register people for site or any event session on site', 2),
(4, 'SRA_Editor', 'Can edit and manage events site wide', 2),
(5, 'SRA_Admin', 'Can administer all things', 4),
(6, 'Super_Admin', 'Has rights to everything', NULL);
 
INSERT INTO acl_permissions (role ,resource ,read ,write ,modify ,delete ,publish)
VALUES 
('1', '1', '1', '0', '0', '0', '0'),
('2', '1', '1', '1', '0', '0', '0'),
('3', '1', '1', '1', '0', '1', '0'),
('4', '1', '1', '1', '1', '1', '0'),
('5', '1', '1', '1', '1', '1', '1');