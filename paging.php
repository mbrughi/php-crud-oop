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

echo "<nav aria-label='Page navigation example'>";
echo "<ul class='pagination'>";
  
// button for first page
if($page>1){
    echo "<li class='page-item'><a class='page-link' href='{$page_url}' title='Go to the first page.'>";
        echo "First";
    echo "</a></li>";
}
  
// calculate total pages
$total_pages = ceil($total_rows / $records_per_page);
  
// range of links to show
$range = 2;
  
// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range)  + 1;
  
for ($x=$initial_num; $x<$condition_limit_num; $x++) {
  
    // be sure '$x is greater than 0' AND 'less than or equal to the $total_pages'
    if (($x > 0) && ($x <= $total_pages)) {
  
        // current page
        if ($x == $page) {
            echo "<li class='page-item active'><a class='page-link' href=\"#\">$x <span class=\"sr-only\">(current)</span></a></li>";
        } 
  
        // not current page
        else {
            echo "<li class='page-item'><a class='page-link' href='{$page_url}page=$x'>$x</a></li>";
        }
    }
}
  
// button for last page
if($page<$total_pages){
    echo "<li class='page-item'><a class='page-link' href='" .$page_url. "page={$total_pages}' title='Last page is {$total_pages}.'>";
        echo "Last";
    echo "</a></li>";
}
  
echo "</ul>";
echo "</nav>";
?>