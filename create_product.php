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


// include database and object files
include_once './config/database.php';
include_once './inc/product.php';
include_once './inc/category.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$product = new Product($db);
$category = new Category($db);

// set page headers
$page_title = "Create Product";
include_once "header.php";
  
echo '<div class="d-grid gap-2 d-md-flex justify-content-md-end"><a href="index.php" class="btn btn-primary">Read Products</a></div>';
  
?>

	<?php 
	// if the form was submitted save database
	if($_POST){
	  
	    // set product property values
	    $product->name = $_POST['name'];
	    $product->price = $_POST['price'];
	    $product->description = $_POST['description'];
	    $product->category_id = $_POST['category_id'];
	  
	    // create the product
	    if($product->create()){
	        echo "<div class='alert alert-success'>Product was created.</div>";
	    }
	  
	    // if unable to create the product, tell the user
	    else{
	        echo "<div class='alert alert-danger'>Unable to create product.</div>";
	    }
	}
	?>
  

		<!-- HTML form for creating a product -->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		  
		    <div class="mb-3">
		        
		            <label class="form-label">Name</label>
		            <input type='text' name='name' class='form-control' />
		                
		            <label class="form-label">Price</label>
		            <input type='text' name='price' class='form-control' />
		                  
		            <label class="form-label">Description</label>
		            <textarea name='description' class='form-control'></textarea>
		        
		            <label class="form-label">Category</label>
		            
					<?php
					// read the product categories from the database
					$stmt = $category->read();
					  
					// put them in a select drop-down
					echo '<select class="form-select" name="category_id">';
					    echo "<option>Select category...</option>";
					  
					    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
					        extract($row_category);
					        echo "<option value='{$id}'>{$name}</option>";
					    }
					  
					echo "</select>";
					?>

			</div>		
		            
		            <button type="submit" class="btn btn-primary">Create</button>
		  
		    
		</form>



<?php
 
// footer
include_once "footer.php";
?>