# MySQL/PHP Interview Project

Project created as a display of ability for an interview with a local company.

Project was created and tested on the Raspberry Pi using Apache web server.

## Explicit project criteria is as follows:

1. Create a basic web form with 2 text boxes, 1 select box, two checkbox groups with four options a piece, and 1 text area box.

2. Project criteria specifies that frameworks CANNOT be used and appearance is NOT important.

3. When the user submits the form, the form gets saved using PHP into a MySQL Database.

4. The test project is to be shared on Github

.
.
.

## Implicit project criteria is as follows:

1. Code should be humanly readable

2. Code should be DRY (Don't Repeat Yourself)

3. Code should be well commented

.
.
.

## Schemas
```
Database changed
mysql> DESCRIBE main;
+----------+--------------+------+-----+---------+----------------+
| Field    | Type         | Null | Key | Default | Extra          |
+----------+--------------+------+-----+---------+----------------+
| id       | int(11)      | NO   | PRI | NULL    | auto_increment |
| booktype | varchar(20)  | YES  |     | NULL    |                |
| fillin1  | varchar(30)  | YES  |     | NULL    |                |
| fillin2  | varchar(30)  | YES  |     | NULL    |                |
| comments | varchar(200) | YES  |     | NULL    |                |
+----------+--------------+------+-----+---------+----------------+
5 rows in set (0.01 sec)

mysql> DESCRIBE sport;
+-------------+-------------+------+-----+---------+----------------+
| Field       | Type        | Null | Key | Default | Extra          |
+-------------+-------------+------+-----+---------+----------------+
| entryid     | int(11)     | NO   | PRI | NULL    | auto_increment |
| id          | int(11)     | NO   |     | NULL    |                |
| selectsport | varchar(30) | YES  |     | NULL    |                |
+-------------+-------------+------+-----+---------+----------------+
3 rows in set (0.00 sec)

mysql> DESCRIBE activity;
+----------------+-------------+------+-----+---------+----------------+
| Field          | Type        | Null | Key | Default | Extra          |
+----------------+-------------+------+-----+---------+----------------+
| entryid        | int(11)     | NO   | PRI | NULL    | auto_increment |
| id             | int(11)     | NO   |     | NULL    |                |
| selectactivity | varchar(30) | YES  |     | NULL    |                |
+----------------+-------------+------+-----+---------+----------------+
3 rows in set (0.01 sec)

mysql> 

```
