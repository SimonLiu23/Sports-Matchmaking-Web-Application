README
======================================

This project is a website for Rack-It, a platform for badminton players to connect.

1. Set up database connection

Open dbh.inc.php in the "includes" folder. Set $dbServername, $dbUsername, $dbPassword, $dbName to match your server name, root username, root password and database name respectively.


2. Set up tables

In your MyPhpAdmin, create the following tables. You can copy paste from here:

CREATE TABLE users(
	usersId INT(11) AUTO_INCREMENT PRIMARY KEY,
	usersName VARCHAR(128),
	usersEmail VARCHAR(128),
	usersUid VARCHAR(128),
	usersPwd VARCHAR(128),
	location VARCHAR(50),
	matchtype VARCHAR(20),
	skill VARCHAR(20),
	goal VARCHAR(20)
	);

CREATE TABLE posts(
	id INT(11) AUTO INCREMENT PRIMARY KEY,
	userid VARCHAR(20),
	text VARCHAR(1000),
	image VARCHAR(50),
	date DATETIME
	);

CREATE TABLE posts(
	id INT(11) AUTO INCREMENT PRIMARY KEY,
	userid VARCHAR(20),
	title VARCHAR(256),
	description VARCHAR(1000),
	date DATETIME,
	eventdate DATETIME,
	location VARCHAR(20),
	image VARCHAR(256)
	);

3. Run website

Run index.php on your localhost. To post on the home page, create events and find players you will need to create an account and be logged in.


Feautures to explore:

- Newsfeed posts
- Create new badminton events
- Search for players and challenge them to a match via email
