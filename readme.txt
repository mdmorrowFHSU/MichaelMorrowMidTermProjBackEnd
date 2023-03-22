render db links  
--internal url--
postgres://root:4OnhJdKeqVyVVzlUNC12yy6dzs5OwHhg@dpg-cgblmtl269v4icsh7ilg-a/mydb_d37m
--external url--
postgres://root:4OnhJdKeqVyVVzlUNC12yy6dzs5OwHhg@dpg-cgblmtl269v4icsh7ilg-a.oregon-postgres.render.com/mydb_d37m
--psql command--
PGPASSWORD=4OnhJdKeqVyVVzlUNC12yy6dzs5OwHhg psql -h dpg-cgblmtl269v4icsh7ilg-a.oregon-postgres.render.com -U root mydb_d37m

-------------------------------------------------------------
-------------------- quotes testing -------------------------
-------------------------------------------------------------
----IMPORTANT - REPLACE FOLDERNAME WITH NAME OF FOLDER PROJ -
---- IS STORED IN -------------------------------------------

get - no params returns all quotes
http://localhost/foldername/api/quotes/index.php

get with param returns single quote
http://localhost/foldername/api/quotes/index.php?id=10

create/post - http://localhost/foldername/api/quotes/index.php

{
    "quote": "test",
    "author_id": 4,
    "category_id": 3
}

delete - http://localhost/foldername/api/quotes/index.php

{
    "id": 20
    
}

update/put - http://localhost/foldername/api/quotes/index.php

was 
id=19,quote='quote',author_id=2,category_id=3

{
    "id": 19,
    "quote": "updated quote text",
    "author_id": 8,
    "category_id": 8 
}

id=19,quote='updated quote text',author_id=8,category_id=8


-------------------------------------------------------------
--------------------authors testing -------------------------
-------------------------------------------------------------

--retrieving all authors or specific by id---

get - http://localhost/foldername/api/authors/index.php 
get - http://localhost/foldername/api/authors/index.php?id=11


create/post- http://localhost/foldername/api/authors/index.php

{   
    "author": "testAuth"    
}
PUT/UPDATE - http://localhost/foldername/api/authors/index.php

{   
    "id": 15,
    "author": "alterTestDelete"   
}

delete - http://localhost/foldername/api/authors/index.php
{
    "id": 15 
}



-------------------------------------------------------------
-------------------categories testing------------------------
-------------------------------------------------------------

-retrieving categories or specific by id-

GET - http://localhost/foldername/api/categories/index.php
GET - http://localhost/foldername/api/categories/index.php?id=8

POST/create - http://localhost/foldername/api/categories/index.php
{
    "category": "testCat"
}

PUT/UPDATE - http://localhost/foldername/api/categories/index.php
{
    "id": 9,
    "category": "updatedTestCat"
}

DELETE - http://localhost/foldername/api/categories/index.php
{
    "id": 9
}

------------------------------------------------------------------------
-----------steps I took while building my Database----------------------
------------------------------------------------------------------------

insert into quotes (quote,author_id,category_id) values('test 3',1,1)

insert into quotes (quote,author_id,category_id) values ('closing your eyes feels like the middle of no where',2,2);


insert into authors (author) values ('jamie')


a) quotes (id, quote, author_id, category_id) - the last two are foreign keys
b) authors (id, author)
c) categories (id, category)
d) id is the primary key in each table
e) The id column should also auto-increment
f) All columns should be non-null

create table categories (
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY ('id'),
category VARCHAR(30) NOT NULL
);

create table authors (
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY ('id'),
author VARCHAR(30) NOT NULL
);

create table quotes(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY ('id'),
quote VARCHAR(255) NOT NULL,
author_id INT NOT NULL, 
category_id INT NOT NULL,
FOREIGN KEY ('author_id')
REFERENCES authors ('id'),
FOREIGN KEY ('category_id')
REFERENCES authors ('id')
);

-------------------------------------------------------------
--------------postgres has alter syntax----------------------
-------------------------------------------------------------

create table categories (
id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
category VARCHAR(30) NOT NULL
);

create table authors (
id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
author VARCHAR(30) NOT NULL
);

create table quotes(
id int GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
quote VARCHAR(255) NOT NULL,
author_id int NOT NULL, 
category_id int NOT NULL,
FOREIGN KEY (author_id) REFERENCES authors(id), 
FOREIGN KEY (category_id) REFERENCES categories(id)
);


-------------------------------------------------------------
----------------building postgs DB---------------------------
-------------------------------------------------------------

NOTE: Grabbed all my quotes from https://allauthor.com/quotes/    - with a couple bonus ones from my son Jamie
NOTE: Have a total of 18 quotes, 11 authors and 8 categories to query from on my database. Made sure to add
NOTE: quotes belonging to different categories by the same author for more query options.  

Authors:
Jamie = 1
Jim Morrison = 2
Jane gill-watson = 3
Ben franklin = 4
Bill Gates = 5
Mother Teresa = 6
Aristotle = 7
William Shakespeare = 8
Winston Churchill = 9
Confucius = 10
Whitney Houston = 11

Categories:
Stuff kid says = 1
Friendship = 2
Inspirational = 3
Love = 4
Politics = 5
Nature = 6
Success = 7
beauty = 8

------ STUFF MY KID SAYS = 1------

insert into authors (author) 
values ('Jamie');
insert into categories (category)
values ('Stuff my son says');
insert into quotes (quote,author_id,category_id) 
values ('closing your eyes feels like the middle of no where',1,1);

-not added yet-

------1 FRIENDSHIP = 2---------

insert into authors (author) 
values ('Jim Morrison');
insert into categories (category)
values ('Friendship');
insert into quotes (quote,author_id,category_id) 
values ('A friend is someone who gives you total freedom to be yourself.',2,2);

-------
insert into authors (author) 
values ('Jane Gill-Wilson');
insert into quotes (quote,author_id,category_id) 
values ('Friends are like sunshine They can brighten up your day, A true friend is someone who Will chase the clouds away.',3,2);

-------

insert into authors (author) 
values ('Benjamin Franklin');
insert into quotes (quote,author_id,category_id) 
values ('A brother may not be a friend, but a friend will always be a brother.',4,2);

-------INSPIRATIONAL = 3 ------------

insert into authors (author) 
values ('Bill Gates');
insert into categories (category)
values ('Inspirational');
insert into quotes (quote,author_id,category_id) 
values ('I failed in some subjects in exam, but my friend passed in all. Now he is an engineer in microsoft and i am the owner of microsoft.',5,3);

------ 

insert into authors (author) 
values ('Mother Teresa');
insert into quotes (quote,author_id,category_id) 
values ('Not all of us can do great things. But we can do small things with great love.',6,3);

------ love = 4 -----------------
insert into categories (category)
values ('Love');
insert into quotes (quote,author_id,category_id) 
values ('The hunger for love is much more difficult to remove than the hunger for bread.',6,4);

------

insert into quotes (quote,author_id,category_id) 
values ('Spread love everywhere you go. Let no one ever come to you without leaving happier.',6,4);


------ Politics = 5
insert into authors (author) 
values ('Aristotle');
insert into categories (category)
values ('Politics');
insert into quotes (quote,author_id,category_id) 
values ('Democracy is when the indigent, and not the men of property, are the rulers.',7,5);


insert into quotes (quote,author_id,category_id) 
values ('Democracy is two wolves and a lamb voting on what to have for lunch.Liberty is a well-armed lamb contesting the vote.',4,5);


------- Nature = 6 ----------------

insert into authors (author) 
values ('William Shakespeare');
insert into categories (category)
values ('Nature');
insert into quotes (quote,author_id,category_id) 
values ('The earth has music for those who listen.',8,6);

insert into authors (author) 
values ('Winston Churchill');
insert into quotes (quote,author_id,category_id) 
values ('Solitary trees, if they grow at all, grow strong.',9,6);

------- success = 7 --------------

insert into authors (author) 
values ('Confucius');
insert into categories (category)
values ('Success');
insert into quotes (quote,author_id,category_id) 
values ('Success depends upon previous preparation, and without such preparation there is sure to be failure.',10,7);


insert into quotes (quote,author_id,category_id) 
values ('Without continual growth and progress, such words as improvement, achievement, and success have no meaning.',4,7);

insert into quotes (quote,author_id,category_id) 
values ('My dad loves money, we take it to Walmart to buy toys.',1,7);


------- Beauty = 8 ---------------

insert into authors (author) 
values ('Whitney Houston');
insert into categories (category)
values ('Beauty');
insert into quotes (quote,author_id,category_id) 
values ('I believe that children are our future. Teach them well and let them lead the way. Show them all the beauty they possess inside.',11,8);


insert into quotes (quote,author_id,category_id) 
values ('Beauty is a greater recommendation than any letter of introduction.',7,8);



------------------------------------
------query data practice-----------
------------------------------------

------tables----

quotes - id, quote, author_id, quote_id
authors - id, author
categories - id, category


-----2 table join example ----

select quotes.quote, authors.author
from quotes
JOIN authors on quotes.author_id = authors.id;


select quotes.quote, categories.category
from quotes
JOIN categories on quotes.category_id = categories.id;

------3 table join example --------

SELECT
quotes.quote, authors.author, categories.category
From
quotes 
inner join authors 
on quotes.author_id = authors.id 
inner join categories 
on quotes.category_id = categories.id;





-------------------------------------------------------------
-------------authors/categories - debug ---------------------
-------------------------------------------------------------

I had to alter my id columns in authors and categories, took a lot of searching online
to find out why it was not inserting an id automatically, and then why it was not a valid
entry when I did state an id value to be inserted into the column??? Still not very confident
with it. Going to continue trying to figure this out and how to create my tables the right way
every time. 


ALTER TABLE authors   
    ALTER COLUMN id   
    set GENERATED BY DEFAULT; 

-------------------------------------------------------------
------------------DB TESTING---------------------------------
-------------------------------------------------------------

---I was just writing stuff down here so I could reference/copy quickly
---from instead of opening my browser and navigating over and over
--------------

http://localhost/testapifolder/api/authors/index.php?id=2
http://localhost/php-quote-project-main/api/quotes/index.php?id=1


SetEnv USERNAME = "root"
SetEnv PASSWORD = "4OnhJdKeqVyVVzlUNC12yy6dzs5OwHhg"

http://localhost/testapifolder/api/quotes/create.php

http://localhost/php-quote-project-main/api/quotes/create.php

http://localhost/maybe/api/quotes/index.php
