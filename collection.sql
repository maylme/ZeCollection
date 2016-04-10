DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS games;
DROP TABLE IF EXISTS consoles;

CREATE TABLE user (
	user_id int(11) NOT NULL auto_increment,
	username varchar(20) NOT NULL,
	password char(40) NOT NULL,
	PRIMARY KEY (user_id),
	UNIQUE KEY username (username)
); 


CREATE TABLE owner (
	owner_id int(11) NOT NULL auto_increment,
	owner_label varchar NOT NULL,
	user_id int(11) NOT NULL,
	
	PRIMARY KEY (user_id),



);

CREATE TABLE consoles(
	console_id int(11) NOT NULL auto_increment,
	console_name varchar(20) NOT NULL,
	console_brand varchar(20) NOT NULL,
	
	PRIMARY KEY (console_id),
	UNIQUE KEY console_name (console_name),

	FOREIGN KEY (user_id)
	REFERENCES user(user_id)
	ON UPDATE CASCADE ON DELETE CASCADE,
); 

CREATE TABLE games(
	game_id int(11) NOT NULL auto_increment,
	bar_code varchar(20) NOT NULL,
	game_name varchar(50) NOT NULL,
	version varchar(40) NOT NULL,
	editor varchar(30),
	developer varchar(30),
	release_year int(4),

	console_id int(11) NOT NULL,  
	
	FOREIGN KEY (console_id)
		REFERENCES consoles(console_id)
		ON UPDATE CASCADE ON DELETE CASCADE, 
	PRIMARY KEY (game_id),
	UNIQUE KEY bar_code (bar_code)
); 

CREATE TABLE items(
	item_id int(11) NOT NULL auto_increment,
	user_id int(11) NOT NULL, 
    game_id int(11) NOT NULL,  
    boite BOOLEAN NOT NULL,
    calpin BOOLEAN NOT NULL,
    jeux BOOLEAN NOT NULL,
    price float,
    notes varchar(250),
	FOREIGN KEY (user_id)
	REFERENCES user(user_id)
	ON UPDATE  CASCADE ON DELETE CASCADE,
	
	FOREIGN KEY (game_id)
	REFERENCES games(game_id)
	ON UPDATE CASCADE ON DELETE CASCADE,
	
	PRIMARY KEY (item_id)
);
