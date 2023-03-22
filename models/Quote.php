<?php

class Quote {
    // DB stuff
    private $conn;
    private $table = 'quotes';

    // Properties
    public $id;
    public $quote;
    public $theAuthor;
    public $theCategory;
    public $author_id;
    public $category_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = 'INSERT INTO ' . $this->table . ' (quote, author_id, category_id) 
            VALUES (:quote, :author_id, :category_id);';

        // prep statement
        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // Bind values
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        // statement execution
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        // print error
        printf("ErrorL %s.\n", $stmt->error);
        return false;

    }

    // query returns json object of all quotes in the db
    function read() {
        $query = 'SELECT q.id, q.quote, a.author, c.category 
            FROM ' . $this->table . ' q 
            LEFT JOIN 
            authors a on q.author_id = a.id
            LEFT JOIN 
            categories c on q.category_id = c.id;';

        // prep statement
        $stmt = $this->conn->prepare($query);

        //statement execution
        $stmt->execute();

        return $stmt;
    }

    // query returns all quotes from the matching author_id
    function read_author() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN 
            authors a on  q.author_id = a.id
            LEFT JOIN 
            categories c on q.category_id = c.id
            WHERE 
            a.id = :author_id';

        // prep statement
        $stmt = $this->conn->prepare($query);

        // bind the data
        $stmt->bindParam(':author_id', $this->author_id);

        // statement execution
        $stmt->execute();

        return $stmt;
    }

    // query returns all quotes from the matching category
    function read_category() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN 
            authors a on  q.author_id = a.id
            LEFT JOIN 
            categories c on q.category_id = c.id
            WHERE 
            c.id = :category_id';

        // prep statement
        $stmt = $this->conn->prepare($query);

        // bind the data
        $stmt->bindParam(':category_id', $this->category_id);

        // statement execution
        $stmt->execute();

        return $stmt;
    }

    // query for matching author and category
    function read_author_and_category() {
        $query = 'SELECT q.id, q.quote, a.author, c.category
            FROM ' . $this->table . ' q
            LEFT JOIN 
            authors a on  q.author_id = a.id
            LEFT JOIN 
            categories c on q.category_id = c.id
            WHERE 
            a.id = :author_id AND c.id = :category_id';

        // prep statement
        $stmt = $this->conn->prepare($query);

        // bind the data
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':author_id', $this->author_id);

        // statement execution
        $stmt->execute();

        return $stmt;
    }

    // query returns a single quote based on the quote id
    function read_single() {
        $query = 'SELECT q.id, q.quote, a.author, c.category, a.id AS "author_id", c.id AS "category_id"
            FROM ' . $this->table . ' q
            LEFT JOIN 
            authors a on  q.author_id = a.id
            LEFT JOIN 
            categories c on q.category_id = c.id
            WHERE 
            q.id = :id;';

        // prep statement
        $stmt = $this->conn->prepare($query);

        // bind the data
        $stmt->bindParam(':id', $this->id);

        // query execution
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set props
        if ($row) { 
            $this->quote = $row['quote'];
            $this->theAuthor = $row['author'];
            $this->theCategory = $row['category'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];
        }
    }

    function update() {
        $query = 'UPDATE ' . $this->table . ' 
            SET quote = :quote, 
                author_id = :author_id, 
                category_id = :category_id
            WHERE 
            id = :id;';

        $stmt = $this->conn->prepare($query);

        // clean the data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        // bind the data
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        // query execution
        if ($stmt->execute()) {
            return true;
        }

        // print error
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    function delete() {
        $query = 'DELETE FROM ' . $this->table . '
        WHERE id = :id';

        // prep statement
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