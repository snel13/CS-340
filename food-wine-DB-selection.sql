-- select queries --

-- general use queries to view tables --

SELECT * FROM  wine;
SELECT * FROM food;
SELECT * FROM temperature;
SELECT * FROM region;
SELECT * FROM grape_variety;
SELECT * FROM pair;

-- select food(s) by category and name that pairs with a specific wine -- 

SELECT food_category Category, food.name Name
FROM food 
INNER JOIN pair ON food.id=pair.food_id
INNER JOIN wine ON wine.id=pair.wine_id
WHERE wine.name = 'Prosecco' 
ORDER BY food_category ASC;

-- select food(s) by category and name that pairs with a specific wine type -- 

SELECT food_category Category, food.name Name
FROM food 
INNER JOIN pair ON food.id=pair.food_id
INNER JOIN wine ON wine.id=pair.wine_id
WHERE wine.wine_type = 'Bold Red' 
ORDER BY food_category ASC;

-- select food(s) by name that will pair with a specific wine and belongs to one of two categories --

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

-- select wine(s) by name and type that pairs with a given food --

SELECT wine.wine_type AS Type, wine.name Name 
FROM wine 
INNER JOIN pair ON wine.id=pair.wine_id
INNER JOIN food ON food.id=pair.food_id
WHERE food.name = 'Brie'
ORDER BY wine_type ASC;

-- select wine(s) by wine name that pairs with two foods (by category)  perfectly -- 

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

-- select wine(s) by wine name that pairs with two foods (by name)  perfectly -- 

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


-- select wine(s) from a  given region --

SELECT name Name
FROM wine 
INNER JOIN is_from ON wine.id=is_from.wine_id
INNER JOIN region ON wine.region_id=region.id
WHERE region.country_name = 'France'
ORDER BY wine_type ASC;

-- find a wine’s suggested serving temperature -- 

SELECT temp Temperature 
FROM wine
INNER JOIN served_at ON wine.id=served_at.wine_id
INNER JOIN temperature ON wine.temp_id=temperature.id
WHERE wine.name = 'Champagne';

-- find a wine’s grape variety and region origin by wine name --

SELECT region.country_name Region, grape_variety.grape_name Name
FROM region 
INNER JOIN wine ON wine.region_id=region.id
INNER JOIN is_from ON wine.id=is_from.wine_id
INNER JOIN grape_variety ON grape_variety.id=wine.variety_id
INNER JOIN made_from ON grape_variety.id=made_from.grape_id
WHERE wine.name = 'Merlot';

-- find the wine that has the most pairs -- 
SELECT wine.name Name 
FROM pair 
INNER JOIN wine ON wine.id=pair.wine_id
GROUP BY wine.name
ORDER BY COUNT(*) DESC
LIMIT 1;


-- find a list of wines that should be chilled -- 

SELECT wine.wine_type, wine.name Name
FROM temperature 
INNER JOIN wine ON wine.temp_id=temperature.id
INNER JOIN served_at ON wine.temp_id=served_at.wine_id
WHERE temperature.temp = '40-50'
ORDER BY wine_type ASC;
