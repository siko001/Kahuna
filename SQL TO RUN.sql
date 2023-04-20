CREATE DATABASE kahuna;
use kahuna;


CREATE TABLE users (
  UserId INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  number INT  NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE registeredProducts (
  ID INT PRIMARY KEY AUTO_INCREMENT,
  userId INT NOT NULL,
  serialNumber INT NOT NULL,
  dateOfPurchase TEXT NOT NULL,
  FOREIGN KEY (userId) REFERENCES users(UserId),
  FOREIGN KEY (serialNumber) REFERENCES products(SerialNumber)
);

CREATE TABLE products (
  serialNumber INT PRIMARY KEY NOT NULL,
  type VARCHAR(255) NOT NULL,
  productDescription TEXT NOT NULL,
  imgUrl VARCHAR(255) NOT NULL
);

INSERT INTO  products (serialNumber, Type, productDescription, imgUrl)
VALUES  ('110','Oven','the perfect convection oven for your home!','https://i.postimg.cc/SNQYv5JQ/oven.png'),
		('111','Dish washer','Easy plate cleaning for you and your family on the fly!','https://i.postimg.cc/nhCjHD46/dishwasher.png'),
		('112','Washing machine','Great looking and smelling clothes in no time and effort!','https://i.postimg.cc/5ygYt5kM/washingmachine.jpg'),
		('113','Hob','Easy fire(if you go gas) at your convience','https://i.postimg.cc/fL40qR01/hob.png'),
		('114','TV','Entertainment on the go','https://i.postimg.cc/3xRpd6Tf/tv.png'),
		('115','Coffee machine','Nice boost of motivation','https://i.postimg.cc/Dy5Lfhtb/coffeemachine.png'),
		('116','Tumble dryer','Dry clothes in the middle of rainy day? No Problem!','https://i.postimg.cc/XYz5F8Nj/tumble.png'),
		('117','Fridge','Keep your food good for longer!','https://i.postimg.cc/xTsNDRzv/fridge.png'),
		('118','Water heater','nice hot shower in the middle of wet cold rainy day? got you sorted!','https://i.postimg.cc/ryNtgcyY/waterheater.png'),
		('119','Robot vaccum cleaner','long day at work? only thinking about the sofa? NO PROBLEM!','https://i.postimg.cc/3w0vZvWg/vaccum.png'),
		('120','The Legendary DRAGONBALLS','WOW! The mystical dragonballs!! You amazing Developer! ;)','https://i.postimg.cc/3NY07f1B/dragonballs.png');

