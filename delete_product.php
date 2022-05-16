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

// check if value was posted
if($_POST){
  
    // include database and object file
    include_once 'config/database.php';
    include_once 'inc/product.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare product object
    $product = new Product($db);
      
    // set product id to be deleted
    $product->id = $_POST['object_id'];
      
    // delete the product
    if($product->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>