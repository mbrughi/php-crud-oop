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

// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
  
// set number of records per page
$records_per_page = 5;
  
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
  
// include database and object files
include_once 'config/database.php';
include_once 'inc/product.php';
include_once 'inc/category.php';
  
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
  
$product = new Product($db);
$category = new Category($db);
  
// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();


// set page header
$page_title = "Read Products";
include_once "header.php";

 echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="create_product.php" class="btn btn-primary">Create product</a></div>';


// display the products if there are any
if($num>0){
  
    echo "<table class='table table-hover table-responsive caption-top'>";
        echo "<caption>List of products</caption>";
        echo "<thead>";
        echo "<tr>";
            echo "<th scope='col'>Product</th>";
            echo "<th scope='col'>Price</th>";
            echo "<th scope='col'>Description</th>";
            echo "<th scope='col'>Category</th>";
            echo "<th scope='col'>Actions</th>";
        echo "</tr>";
        echo "</thead>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo '<tr scope="row">';
                echo "<td>{$name}</td>";
                echo "<td>$ {$price}</td>";
                echo "<td>{$description}</td>";
                echo "<td>";
                    $category->id = $category_id;
                    $category->readName();
                    echo $category->name;
                echo "</td>";
  
                echo "<td>";
                    // read, edit and delete buttons
					echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>
					    <span class='glyphicon glyphicon-list'></span> Read
					</a>
					  
					<a href='update_product.php?id={$id}' class='btn btn-info left-margin'>
					    <span class='glyphicon glyphicon-edit'></span> Edit
					</a>
					  
					<a delete-id='{$id}' class='btn btn-danger delete-object'>
					    <span class='glyphicon glyphicon-remove'></span> Delete
					</a>";
                echo "</td>";
  
            echo "</tr>";
  
        }
  
    echo "</table>";
  
    // the page where this paging is used
	$page_url = "index.php?";
  
	// count all products in the database to calculate total pages
	$total_rows = $product->countAll();
  
	// paging buttons here
	include_once 'paging.php';

}
  
// tell the user there are no products
else{
    echo "<div class='alert alert-info'>No products found.</div>";
}


  
// set page footer
include_once "footer.php";
?>