<?php
/**
 * PHP OOP CRUD
 * 
 * @link        http://noteworkweb.com
 * @since       1.0.0
 * @package     php-crud
 * @subpackage 
 * @author      Marco Brughi <marco.brughi@mail.com>
 * @date        12/05/2022
 * @Copyright   Copyright (c) 2022 Marco Brughi.
 * @License     GPL v3 or later
 * @License URI https://www.gnu.org/licenses/gpl-3.0.html
 */

class Category{
  
    // database connection and table name
    private $conn;
    private $table_name = "categories";
  
    // object properties
    public $id;
    public $name;
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // used by select drop-down list
    function read(){
        //select all data
        $query = "SELECT
                    id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";  
  
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
  
        return $stmt;
    }
    // used to read category name by its ID
    function readName(){
          
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ? limit 0,1";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
          
        $this->name = $row['name'];
    }
  
}
?>