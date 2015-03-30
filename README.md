# Shoe Store Brand Database for Epicodus
### Assessment 4
## by Tanner Heffner
### Date: March 24, 2015
#### Description
This app allows users to keep track of local shoe stores and the brands they stock, using Postgres SQL for the back-end and Silex/Twig for the front-end.  For example:

1. A user can keep track of all local shoe stores by entering a store's name and address.

2. A user can keep track of all brands sold by stores by simply providing a brand name. From here, the user should be able to assign brands to a store, so others can know who offers what.

#### Setup instructions
1. Clone this git repository
2. Set your localhost root folder to ~/shoe_store/web/
3. Ensure PHP server is running.
4. Start Postgres and import shoes.sql database into a new database shoes
5. Do the same for the test database: shoes_test.sql
6. Use Composer to install required dependencies in the composer.json file
7. Start the web app by pointing your browser to the root (http://localhost:8000/)


#### PSQL commands
CREATE DATABASE shoes;
\c shoes
CREATE TABLE stores (id serial PRIMARY KEY, name varchar, address varchar);
CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar);
CREATE TABLE sold_by (id serial PRIMARY KEY, store_id int, brand_id int);
CREATE DATABASE shoes_test WITH TEMPLATE shoes;

#### Copyright © 2015, Tanner Heffner

#### License: [MIT](https://github.com/twbs/bootstrap/blob/master/LICENSE)  
