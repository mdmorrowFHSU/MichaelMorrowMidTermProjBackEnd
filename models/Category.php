<?php

class Category {
    // DB stuff
    private $conn;
    private $table = 'categories';

    // Category Props
    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table. ' (category)
        values(:category);';

        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind the data
        $stmt->bindParam(':category', $this->name);

        // query execution
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // Print errors
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // retrieve Categories
    function read() {
        $query =    'SELECT *
                    FROM ' . $this->table . '
                    ORDER BY id';
        
        // Prep statement
        $stmt = $this->conn->prepare($query);

        // statement execution
        $stmt->execute();

        return $stmt;
    }


    // read a single category
    function read_single() {
        $query =    'SELECT *
                    FROM ' . $this->table . '
                    WHERE id = :id';

        // Prep  statement
        $stmt = $this->conn->prepare($query);

        // bind the data
        $stmt->bindParam(':id', $this->id);

        // statement execution
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set props if exists
        if ($row) {
            $this->name = $row['category'];
        }

    }

    function update(){
        $query =    'UPDATE ' .$this->table . '
                    SET category = :category
                    WHERE 
                    id = :id';

        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind the data
        $stmt->bindParam(':category', $this->name);
        $stmt->bindParam(':id', $this->id);

        // statement execution
        if ($stmt->execute()) {
            return true;
        }

        // Print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete() {
        $query = '  DELETE FROM ' . $this->table . '
        WHERE id = :id'; 

        // prep statement
        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind the data
        $stmt->bindParam(':id', $this->id);

        // statement execution
        if ($stmt->execute()) {
            return true;
        }

        // print error 
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}

?>