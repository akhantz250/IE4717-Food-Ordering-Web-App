-- get total sale and total number of orders amount from orders between two dates

SELECT SUM(TotalSale), COUNT(OrderID) FROM orders WHERE DateCreated >= '2022-11-04' AND DateCreated < DATE_ADD('2022-11-04', INTERVAL 24 DAY_HOUR);

-- aggregrate quanitity and total sale by each menu item
SELECT menu.Name, orderitems.MenuID, SUM(orderitems.Quantity), SUM(orderitems.Quantity * orderitems.UnitPrice)
FROM menu 
INNER JOIN orderitems ON menu.MenuID = orderitems.MenuID
INNER JOIN orders ON orderitems.OrderID = orders.OrderID
WHERE DateCreated >= '2022-11-04' AND DateCreated < DATE_ADD('2022-11-04', INTERVAL 24 DAY_HOUR)
GROUP BY orderitems.MenuID;


 -- get top selling mains, starters, dessert and drink

 SELECT menu.Name, orderitems.MenuID, SUM(orderitems.Quantity) 
 FROM menu INNER JOIN orderitems ON menu.MenuID = orderitems.MenuID 
 INNER JOIN orders ON orderitems.OrderID = orders.OrderID WHERE DateCreated >= '2022-11-10' AND DateCreated < DATE_ADD('2022-11-10', INTERVAL 24 DAY_HOUR) 
 AND menu.Category = 'desserts' GROUP BY orderitems.MenuID 
 ORDER BY SUM(orderitems.Quantity) 
 DESC LIMIT 1;