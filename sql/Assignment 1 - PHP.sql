CREATE DATABASE pizza_delivery;.

USE pizza_delivery;

CREATE TABLE orders (
	order_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
	quantity VARCHAR(3) NOT NULL,
	size_pizza VARCHAR(20) NOT NULL,
	shape VARCHAR(20) NOT NULL,
	topping VARCHAR(20) NOT NULL, 
	crust VARCHAR(20) NOT NULL, 
	delivery_takeout VARCHAR(20) NOT NULL, 
	client_name VARCHAR(70) NOT NULL, 
	phone VARCHAR(15) NOT NULL );
	
INSERT INTO orders (quantity, size_pizza, shape, topping, crust, delivery_takeout, client_name, phone)
	VALUES 	('1', 'small', 'square', 'pepperoni', 'thick', 'delivery', 'Jessica Carvalho',	'647787444'),
	('2', 'medium', 'round', 'bacon', 'stuffed', 'takeout	', 'Joana',	'688887444'),
	('1', 'large', 'round', 'ham', 'thin', 'takeout	', 'Tiago',	'688887444');

SELECT * FROM orders;

CREATE TABLE imagesUpload ( 
	id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
	name VARCHAR(100) NOT NULL, 
	path VARCHAR(255) NOT NULL );

CREATE TABLE loginsInfo(
	user_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	firstName VARCHAR(100) NOT NULL,
	lastName VARCHAR(100) NOT NULL,
	username VARCHAR(100) NOT NULL,
	password VARCHAR(255) NOT NULL);