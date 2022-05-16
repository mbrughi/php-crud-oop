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

class Database{
   
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "php_oop_crud";
    private $username = "php_oop_crud";
    private $password = "Zpg0#h46";
    public $conn;
   
    // get the database connection
    public function getConnection(){
   
        $this->conn = null;
   
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
   
        return $this->conn;
    }
}
?>