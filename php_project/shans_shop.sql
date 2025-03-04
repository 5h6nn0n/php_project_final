-- create and select the database
DROP DATABASE IF EXISTS shans_shop;
CREATE DATABASE shans_shop;
USE shans_shop;

-- creates the tables
CREATE TABLE categories (
  categoryID        INT            	NOT NULL	AUTO_INCREMENT,
  categoryName      VARCHAR(50)		  NOT NULL,
  PRIMARY KEY (categoryID)
);

CREATE TABLE items (
  itemID        	  INT            	NOT NULL	AUTO_INCREMENT,
  categoryID        INT            	NOT NULL,
  itemCode       	  VARCHAR(10)     NOT NULL,
  itemName       	  VARCHAR(50)   	NOT NULL,
  itemDesc       	  VARCHAR(255)    NOT NULL,
  itemPrice         DECIMAL(10,2)  	NOT NULL,
  itemSale          DECIMAL(10,2)   NOT NULL    DEFAULT 0.00,
  PRIMARY KEY (itemID), 
  INDEX categoryID (categoryID), 
  UNIQUE INDEX itemCode (itemCode),
  FOREIGN KEY (categoryID) REFERENCES categories (categoryID)
);

CREATE TABLE users (
  userID        	  INT            	NOT NULL	AUTO_INCREMENT,
  userName      	  VARCHAR(50)		  NOT NULL,
  userEmail         VARCHAR(50)		  NOT NULL,
  password         	VARCHAR(50)    	NOT NULL,
  userShipping      VARCHAR(255)		            DEFAULT NULL,
  userBilling       VARCHAR(255)		            DEFAULT NULL,
  PRIMARY KEY (userID),
  UNIQUE INDEX userEmail (userEmail)
);

CREATE TABLE orders (
  orderID           INT            	NOT NULL   	AUTO_INCREMENT,
  userID         	  INT            	              DEFAULT NULL,
  orderDate         DATETIME      	NOT NULL,
  orderTotal        DECIMAL(20,2)  	NOT NULL,
  shipCost          DECIMAL(5,2)    NOT NULL      DEFAULT 0.00,
  cardType          VARCHAR(20)     NOT NULL,
  cardNumber        VARCHAR(20)     NOT NULL,
  cardExpires       VARCHAR(20)     NOT NULL,
  orderShip         VARCHAR(255)    NOT NULL,
  orderBill       	VARCHAR(255)    NOT NULL,
  PRIMARY KEY (orderID), 
  INDEX userID (userID),
  FOREIGN KEY (userID) REFERENCES users (userID)
);

CREATE TABLE orderItems (
  lineID            INT            	NOT NULL   	AUTO_INCREMENT,
  orderID           INT            	NOT NULL,
  itemID          	INT            	NOT NULL,
  linePrice         DECIMAL(10,2)   NOT NULL,
  discount		      DECIMAL(10,2) 	NOT NULL,
  quantity          INT 			      NOT NULL,
  PRIMARY KEY (lineID), 
  INDEX orderID (orderID), 
  INDEX itemID (itemID),
  FOREIGN KEY (orderID) REFERENCES orders (orderID),
  FOREIGN KEY (itemID) REFERENCES items (itemID)
);

CREATE TABLE administrators (
  adminID           INT            NOT NULL   	AUTO_INCREMENT,
  adminEmail      	VARCHAR(255)   NOT NULL,
  password          VARCHAR(255)   NOT NULL,
  adminName         VARCHAR(255)   NOT NULL,
  PRIMARY KEY (adminID)
);

-- Insert data into the tables
INSERT INTO categories (categoryID, categoryName) VALUES
(1, 'Shirts'),
(2, 'Pants'),
(3, 'Outerwear');

-- non discounted items
INSERT INTO items (itemID, categoryID, itemCode, itemName, itemDesc, itemPrice) VALUES
(1, 1, 'tee', 'Graphic T-shirt', 'Material: organic cotton \n Style: fitted \n Color: white', '10.00'),
(3, 1, 'sweats', 'Sweatshirt', 'Material: polyester body fleece lined \n Style: relaxed \n Color: yellow', '20.00'),
(5, 1, 'tank', 'Ribbed Tanktop', 'Material: organic cotton \n Style: cropped \n Color: tan', '6.00'),
(6, 2, 'djeans', 'Denim Jeans', 'Material: cotton blend \n Style: classic \n Color: blue', '25.00'),
(7, 2, 'cjeans', 'Corduroy Jeans', 'Material: cotton blend \n Style: flare \n Color: green', '25.00'),
(8, 2, 'bjeans', 'Bootcut Jeans', 'Material: cotton blend \n Style: bootcut \n Color: blue', '25.00'),
(9, 2, 'slacks', 'Chino Pants', 'Material: cotton blend \n Style: straight \n Color: tan', '20.00'),
(12, 3, 'moto', 'Moto Jacket', 'Material: vegan leather \n Style: regular \n Color: brown', '30.00'),
(14, 3, 'trench', 'Trench Coat', 'Material: cotton blend \n Style: straight \n Color: tan', '25.00');

-- discounted items
INSERT INTO items (itemID, categoryID, itemCode, itemName, itemDesc, itemPrice, itemSale) VALUES
(2, 1, 'longs', 'Thermal Long Sleeve', 'Material: polyester \n Style: fitted \n Color: black', '15.00', '2.99'),
(4, 1, 'knit', 'Cableknit Sweater', 'Material: acrylic \n Style: knitted \n Color: grey', '20.00', '3.99'),
(10, 3, 'rain', 'Rain Jacket', 'Material: nylon \n Style: regular \n Color: red', '30.00', '8.00'),
(11, 3, 'sport', 'Sport Coat', 'Material: cotton blend \n Style: regular \n Color: blue', '40.00', '15.00'),
(13, 3, 'blazer', 'Suit Jacket', 'Material: cotton \n Style: formal \n Color: black', '40.00', '15.00'),
(15, 3, 'parka', 'Parka Coat', 'Material: nylon body lined with faux fur \n Style: relaxed \n Color: grey', '35.00', '5.00');

INSERT INTO users (userID , userEmail, password, userName, userShipping, userBilling) VALUES
(1, 'allan.sherwood@yahoo.com', '$2y$10$UjBQLRLPvL0sTv69KfNl3e..J5my0JYrY4O2Tw2K/hfX1/PO1Kcc2', 'Allan Sherwood', 'PO BOX 74 Bridgewater NJ 08807', 'PO BOX 74 Bridgewater NJ 08807'),
(2, 'barryz@gmail.com'        , '$2y$10$gt6wFRzdBJgqNfpEVDzx9ujZHT4v0vyqy.9m1L50FrZgd2g5T7N/.', 'Barry Zimmer', '112 Apt 2C Trent St Conyers GA 30013', '112 Apt 2C Trent St Conyers GA 30013'),
(3, 'christineb@solarone.com' , '$2y$10$Z/PextRMfKKf9Ah7CQ/Rd.WWx8YvAjhFIZMyZeEy3qcCupv6v8sS.', 'Christine Brown', 'Skyfall #55 Aurora CO 80018', 'Skyfall #55 Aurora CO 80018'),
(4, 'spark2200@ymail.com'     , '$2y$10$Z/PextRMfKKf9Ah7CQ/Rd.WWx8YvAjhFIZMyZeEy3qcCupv6v8sS.', 'Sarah Parker', '101 Main St Hartsville TN 37074', '101 Main St Hartsville TN 37074'),
(5, 'bobby@gmail.com'         , '$2y$10$UjBQLRLPvL0sTv69KfNl3e..J5my0JYrY4O2Tw2K/hfX1/PO1Kcc2', 'Bobby Henderson', '100 East Ridgewood Ave Paramus NJ 07652', '100 East Ridgewood Ave Paramus NJ 07652'),
(6, 'larry@gmail.com'         , '$2y$10$Z/PextRMfKKf9Ah7CQ/Rd.WWx8YvAjhFIZMyZeEy3qcCupv6v8sS.', 'Larry Colmar', '21 Rosewood Rd Woodcliff Lake NJ 07677', '21 Rosewood Rd Woodcliff Lake NJ 07677'),
(7, 'specis@gmail.com'        , '$2y$10$gt6wFRzdBJgqNfpEVDzx9ujZHT4v0vyqy.9m1L50FrZgd2g5T7N/.', 'Specis Cobrana', '19270 NW Cornell Rd Beaverton OR 97006', '19270 NW Cornell Rd Beaverton OR 97006');

INSERT INTO orders (orderID, userID, orderDate, orderTotal, cardType, cardNumber, cardExpires) VALUES
(1, 1, '2018-05-30 09:40:28', '24.02', 'visa', '4111111111111111', '04/2025'),
(2, 2, '2021-06-01 11:23:20', '16.01', 'visa', '4111111111111111', '08/2026'),
(3, 1, '2021-02-03 02:44:58', '90.00', 'visa', '4111111111111111', '04/2025'),
(4, 3, '2021-05-30 09:40:28', '57.01', 'Mastercard', '2111111111111111', '04/2025'),
(5, 2, '2021-04-01 11:23:20', '44.04', 'visa', '4111111111111111', '08/2026'),
(6, 3, '2022-04-09 08:44:58', '50.00', 'Mastercard', '2111111111111111', '04/2025'),
(7, 3, '2022-05-30 09:40:28', '70.00', 'visa', '4111111111111111', '04/2025'),
(8, 4, '2022-06-01 11:23:20', '98.03', 'visa', '4111111111111111', '08/2026'),
(9, 5, '2023-08-03 06:44:58', '137.02', 'visa', '4111111111111111', '04/2025'),
(10, 5, '2023-05-30 09:40:28', '40.00', 'visa', '4111111111111111', '04/2025'),
(11, 2, '2023-06-01 09:23:20', '105.00', 'visa', '4111111111111111', '08/2026'),
(12, 5, '2023-06-03 09:44:58', '96.06', 'visa', '4111111111111111', '04/2025'),
(13, 1, '2023-12-30 12:40:28', '62.00', 'visa', '4111111111111111', '04/2025'),
(14, 6, '2024-06-01 01:23:20', '75.00', 'American Express', '3111111111111111', '08/2026'),
(15, 5, '2024-07-03 09:44:58', '20.00', 'visa', '4111111111111111', '04/2025');

INSERT INTO orderItems (lineID, orderID, itemID, linePrice, discount, quantity) VALUES
(1, 1, 2, '24.02', '5.98', 2),
(2, 2, 4, '16.01','3.99', 1),
(3, 3, 3, '40.00', '0.00', 2),
(4, 3, 6, '50.00', '0.00', 2),
(5, 4, 6, '25.00','0.00', 1),
(6, 4, 3, '20.00', '0.00', 1),
(7, 4, 2, '12.01', '2.99', 1),
(8, 5, 4, '64.04','15.96', 4),
(9, 5, 3, '20.00', '0.00', 1),
(10, 6, 6, '50.00', '0.00', 2),
(11, 7, 6, '25.00','0.00', 1),
(12, 7, 8, '25.00', '0.00', 1),
(13, 7, 9, '20.00', '0.00', 1),
(14, 8, 4, '48.03','11.97', 3),
(15, 8, 13, '50.00', '30.00', 2),
(16, 9, 15, '60.00', '10.00', 2),
(17, 9, 6, '25.00','0.00', 1),
(18, 9, 5, '24.00', '0.00', 4),
(19, 9, 2, '12.01', '2.99', 1),
(20, 9, 4, '16.01','3.99', 1),
(21, 10, 3, '40.00', '0.00', 2),
(22, 11, 8, '50.00', '0.00', 2),
(23, 11, 6, '25.00','0.00', 1),
(24, 11, 3, '20.00', '0.00', 1),
(25, 11, 1, '10.00', '0.00', 1),
(26, 12, 4, '96.06','23.94', 6),
(27, 13, 5, '12.00', '0.00', 2),
(28, 13, 8, '50.00', '0.00', 2),
(29, 14, 6, '75.00','0.00', 3),
(30, 15, 3, '20.00', '0.00', 1);

INSERT INTO administrators (adminID, adminEmail, password, adminName) VALUES
(1, 'admin@myshop.com', '$2y$10$Z/PextRMfKKf9Ah7CQ/Rd.WWx8YvAjhFIZMyZeEy3qcCupv6v8sS.', 'Moderator'),
(2, 'shan@myshop.com' , '$2y$10$UjBQLRLPvL0sTv69KfNl3e..J5my0JYrY4O2Tw2K/hfX1/PO1Kcc2', 'Shannon K');

-- mgs_user 
GRANT SELECT, INSERT, UPDATE
ON *
TO mgs_user@localhost
IDENTIFIED BY 'pa55word';
