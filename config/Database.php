<?php

class Database {

       // DB parameters
       private $host = 'dpg-cgblmtl269v4icsh7ilg-a.oregon-postgres.render.com';
       private $db_name = 'mydb_d37m';
       private $port = '5432';
       private $username;
       private $password;
       private $conn;
       //no matter how closely I followed your directions, never could get it to connect
       //had to do it this way 
       public function __construct() {
           $this->username = 'root';
           $this->password = '4OnhJdKeqVyVVzlUNC12yy6dzs5OwHhg';
       }

       // DB connect
       public function connect() {
           $this->conn = null;

           try {
               $dsn = 'pgsql:host=' . $this->host . ';dbname=' . $this->db_name;
               $this->conn = new PDO($dsn, $this->username, $this->password);

               $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

           } catch(PDOException $e) {
               echo 'Connection Error: ' . $e->getMessage();
           }

           return $this->conn;
       }
}

/*
I tried to do it your way with the .htaccess file but it just did not work. I tried a whole bunch of other methods, 
but everything I researched did not work as well. So I did it this way. I will have to revisit this another day when I 
am not so close to a deadline. I lost over a week of time because my medication was out at every pharmacy and when I was
able to find it, my doctor could not call it in because she is down to 1 nurse when she usually has 4 and a whole lot of
other people with the same mental illness as me were all calling trying to get their scrypt filled. 
*/