# SQL

![](images/sql-diagram.png)

## 1. Query

Based on the SQL diagram above, write the following queries:

**A.** Get authors with a last name beginning with "M" or who are born after 1950.

**Answer:**
```mysql
# SELECT * FROM author WHERE last_name LIKE "M%" OR birth_date >= 1950-01-01 00:00:00'
```

**B.** Count the number of books per category (empty categories too).

**Answer:**
```mysql
--NB : Added columns category.id & category.name because we usually want the info of how many on which category. 
# SELECT count(*) as number, category.id, category.name FROM book LEFT JOIN category ON (category.id = book.category_id) GROUP BY book.category_id 
```

**C.** Find authors who wrote at least 2 books.

**Answer:**
```mysql
# Answer here
--NB : Fetching only the author's ID, did we want more info on author here?  
SELECT author.id, count(*) as number_of_books FROM book INNER JOIN author ON (book.author_id = author.id) GROUP BY book.author_id HAVING number_of_books > 1
```

**D.** Get 50 authors with at least one event between the start and the end of this year.

**Answer:**
```mysql
# Answer here 
--NB : What if there isn't 50 entries in db :P
SELECT author.id, author.first_name, author.last_name 
	FROM author 
	INNER JOIN author_event ON (author_event.author_id = author.id) 
	INNER JOIN event ON (event.id = author_event.event_id) 
	WHERE YEAR(event.date) = YEAR(CURDATE())
	LIMIT 0, 50
```

**E.** Get the average number of books written by authors.

**Answer:**
```mysql
# Answer here
SELECT AVG(a.bookcount) as M
FROM (SELECT count(*) as bookcount FROM book GROUP BY author_id) a
```

**F.** Get authors, sorted by the date of their **latest** event.

**Answer:**
```mysql
# Answer here
SELECT DISTINCT author.id 
	FROM author 
	INNER JOIN author_event ON (author_event.author_id = author.id) 
	INNER JOIN event ON (event.id = author_event.event_id)
	ORDER BY event.date DESC
```

## 2. Database Structure

**A.** Based on the SQL diagram above, what can be done to improve the performance of this query ?

```mysql
SELECT id, name FROM book WHERE YEAR(published_date) >= '1973';
```

**Answer:**  
Plusieurs réponses possibles selon moi;
L'une d'elles : Si l'on souhaite maximiser la performance d'une requête il est possible de quitter la forme 3N de la base ici et de créer un champ "published_year" small int (4) qui contient l'année de publication. 
C'est une information redondante certes, mais qu'on peut automatiser OnUpdate() de published_date => SET year = Year(published_date); 
On crée ensuite un INDEX sur le champ published_year, la requête devient SELECT id, name FROM book WHERE published_year >= 1973 et on peut difficilement faire plus rapide. 


**B.** Give 3 common good practice on a database structure to optimize queries.

**Answer:** 
 - Créer des Index sur les champs utilisés en LECTURE (SELECT), dans les conditons (WHERE) et dans les jointures. Plus la cardinalité des valeurs est grande plus l'index est intéressant. Ne pas le faire pour les autres champs (perte espace stockage)
 - Utiliser des champs le plus proche possible des valeurs finales (ne pas faire du TEXT là ou on peut faire du VARCHAR) réduire la taille des INT;VARCHR etc au stricte minimum nécessaire. 
 - Eviter les grandes tables avec de nombreuses colonnes dont plusieurs de types textuelles
 - Utiliser la dé-normalisation ou applatissement des tables aux longues trend (mutliples jointures) pour requeter une Vue ou des tables intermédiaires
 HORS Archi BDD :
 - S'informer des requetes lentes (slow_query_log) et coupler le serveur MySQL avec un Server de cache (MEMCached en RAM pour les requêtes lentes & fréquentes) 