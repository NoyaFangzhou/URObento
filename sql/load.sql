LOAD DATA LOCAL INFILE "restaurant_new_info.dat"
INTO TABLE UROB_Restaurant
FIELDS TERMINATED BY ", "
LINES TERMINATED BY "\r\n";

LOAD DATA LOCAL INFILE "new_dish.dat"
INTO TABLE UROB_Dish
FIELDS TERMINATED BY ", "
LINES TERMINATED BY "\r\n";


-- set a default image for dishes without picture"
UPDATE UROB_Dish SET dish_img = 'http://nogu-svelo.ru/wp-content/uploads/Coming-Soon.gif' WHERE dish_img IS NULL;

-- insert two customer info
INSERT INTO UROB_Customer
VALUES (1, 'jeremy_gu', 'password', 'salt', 'ngu3@ur.rochester.edu', '+16084405217', '227 University Park');

INSERT INTO UROB_Customer
VALUES (3, 'xiaobo', 'password', 'salt', 'szhuang@ur.rochester.edu', '+15853549682', '227 University Park');

-- insert one owner info
INSERT INTO UROB_Owner
VALUES (2, 'noyafangzhou', 'password', 'salt', '1');

-- insert one order
INSERT INTO UROB_Order
VALUES (1, 1, 1, '227 University Park', '2017-04-04 11:30:23', '31', '1', '1', 'please deliver as soon as possible!');

-- insert one order detail
INSERT INTO UROB_Orderdishes
VALUES (1, 1, 'Fennel Sausage'), (1, 1, 'Braised Oxtail');

-- updated one restaurant comment
INSERT INTO UROB_Rcomment
VALUES (1, 1, 1, 4, '2017-04-04 15:30:53', 'Amazing the best restaurant in Rochester , wow chef thank you , the food is espectacular amazing!');

-- updated one dish comment
INSERT INTO UROB_Dcomment
VALUES (1, 1, 1, 'Fennel Sausage', 5, '2017-04-04 15:35:12', 'best sausage I ever ate!');

