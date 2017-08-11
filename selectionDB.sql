
SELECT * FROM  wine;
SELECT * FROM food;
SELECT * FROM temperature;
SELECT * FROM country;
SELECT * FROM grape_variety;
SELECT * FROM pair;

--  food categories to wine


SELECT food_category Category, food.name Name
FROM food 
INNER JOIN pair ON food.id=pair.food_id
INNER JOIN wine ON wine.id=pair.wine_id
WHERE wine.name = 'Prosecco' 
ORDER BY food_category ASC;
--  food categories + name to wine 


SELECT food_category Category, food.name Name
FROM food 
INNER JOIN pair ON food.id=pair.food_id
INNER JOIN wine ON wine.id=pair.wine_id
WHERE wine.wine_type = 'Bold Red' 
ORDER BY food_category ASC;

--  Food belonging to 1-2 catagories paired with wine --


SELECT DISTINCT food.food_category Category, food.name Name
FROM food 
INNER JOIN pair ON food.id=pair.food_id
INNER JOIN wine ON wine.id=pair.wine_id
WHERE wine.name = 'Moscato'
AND food.food_category = 'Dessert'
OR food.food_category = 'Cheese'
ORDER BY food.food_category ASC;

SELECT DISTINCT food.food_category Category, food.name Name
FROM food 
INNER JOIN pair ON food.id=pair.food_id
INNER JOIN wine ON wine.id=pair.wine_id
WHERE wine.name = 'Moscato'
AND food.food_category = 'Dessert'
OR food.food_category = 'Cheese'
OR food.food_category = 'Starch'
ORDER BY food.food_category ASC;

-- Name of wine paired with food --


SELECT wine.wine_type AS Type, wine.name Name 
FROM wine 
INNER JOIN pair ON wine.id=pair.wine_id
INNER JOIN food ON food.id=pair.food_id
WHERE food.name = 'Brie'
ORDER BY wine_type ASC;

-- Wine by name paired with 2 foods -- 

SELECT DISTINCT qry1.name Name 
FROM(
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.food_category = 'Meat' )) AS qry1 
INNER JOIN (
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.food_category = 'Cheese')) AS qry2
WHERE qry1.id = qry2.id;


-- wine by name that pairs with food by name -- 

SELECT DISTINCT qry1.name Name 
FROM(
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.name = 'Tenderloin')) AS qry1 
INNER JOIN (
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.name= 'Kale' )) AS qry2
WHERE qry1.id = qry2.id;


SELECT DISTINCT qry1.name Name 
FROM(
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.name = 'Brie')) AS qry1 
INNER JOIN (
SELECT wine.id, wine.name
FROM (( wine 
INNER JOIN pair ON (wine.id=pair.wine_id ))
INNER JOIN food ON (food.id=pair.food_id ))
WHERE (  food.name = 'Brown Rice' )) AS qry2
WHERE qry1.id = qry2.id;





SELECT name Name
FROM wine 
INNER JOIN is_from ON wine.id=is_from.wine_id
INNER JOIN country ON wine.country_id=country.id
WHERE country.country_name = 'France'
ORDER BY wine_type ASC;

SELECT temp Temperature 
FROM wine
INNER JOIN served_at ON wine.id=served_at.wine_id
INNER JOIN temperature ON wine.temp_id=temperature.id
WHERE wine.name = 'Champagne';




SELECT country.country_name country, grape_variety.grape_name Name
FROM country 
INNER JOIN wine ON wine.country_id=country.id
INNER JOIN is_from ON wine.id=is_from.wine_id
INNER JOIN grape_variety ON grape_variety.id=wine.variety_id
INNER JOIN made_from ON grape_variety.id=made_from.grape_id
WHERE wine.name = 'Merlot';
 
SELECT wine.name Name 
FROM pair 
INNER JOIN wine ON wine.id=pair.wine_id
GROUP BY wine.name
ORDER BY COUNT(*) DESC
LIMIT 1;




SELECT wine.wine_type, wine.name Name
FROM temperature 
INNER JOIN wine ON wine.temp_id=temperature.id
INNER JOIN served_at ON wine.temp_id=served_at.wine_id
WHERE temperature.temp = '40-50'
ORDER BY wine_type ASC;