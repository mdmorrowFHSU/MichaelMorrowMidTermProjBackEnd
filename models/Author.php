<?php

class Author {
    // DB stuff
    private $conn;
    private $table = 'authors';

    // Properties
    public $id;
    public $name;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table . ' (author)
        values(:author);';
       
        // statement prep
        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->name = htmlspecialchars(strip_tags($this->name));

        // bind the data
        $stmt->bindParam(':author', $this->name);

        // query execution
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    // retrieve all Authors
    function read() {
        $query = 'SELECT *
            FROM ' . $this->table . '
            ORDER BY id';

        // statement prep
        $stmt = $this->conn->prepare($query);

        // Execute statement
        $stmt->execute();

        return $stmt;
    }

    // retrieve single author by id
    function read_single() {
        $query = 'SELECT *
            FROM ' . $this->table . '
            WHERE 
            id = :id';

        // statement prep
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(':id', $this->id);

        // query execution
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties if row exists
        if ($row) { $this->name = $row['author']; }
    }

    function update() {
        $query = 'UPDATE ' . $this->table . '
            SET author = :author
            WHERE 
            id = :id';

        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind the data
        $stmt->bindParam(':author', $this->name);
        $stmt->bindParam(':id', $this->id);

        // query execution
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete()
    {
        $query = '  DELETE FROM ' . $this->table . '
        WHERE id = :id';

        // statement prep
        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind the data
        $stmt->bindParam(':id', $this->id);

        // query execution
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


}
?>