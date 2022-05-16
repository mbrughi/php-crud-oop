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

ini_set("display_errors",1);
error_reporting(E_ALL);

// set page headers
$page_title = "Read One Product";
include_once "header.php";
  
// read products button
echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="index.php" class="btn btn-primary">Read Products</a></div>';

// get ID of the product to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'inc/product.php';
include_once 'inc/category.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$product = new Product($db);
$category = new Category($db);
  
// set ID property of product to be read
$product->id = $id;
  
// read the details of product to be read
$product->readOne();

// HTML table for displaying a product details
echo "<table class='table table-responsive caption-top mt-5'>";
    
    echo "<tr>";
        echo "<td class='fw-bold'>Name</td>";
        echo "<td>{$product->name}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td class='fw-bold'>Price</td>";
        echo "<td>$ {$product->price}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td class='fw-bold'>Description</td>";
        echo "<td>{$product->description}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td class='fw-bold'>Category</td>";
        echo "<td>";
            // display category name
            $category->id=$product->category_id;
            $category->readName();
            echo $category->name;
        echo "</td>";
    echo "</tr>";
  
echo "</table>";
  
// set footer
include_once "footer.php";
?>
