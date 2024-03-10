<?php

require('model/database.php');
require('model/product_db.php');
require('model/category_db.php');

$category_id = filter_input(INPUT_POST,'category_id',FILTER_VALIDATE_INT);
$product_name = filter_input(INPUT_POST,'product_name',FILTER_UNSAFE_RAW);
$description= filter_input(INPUT_POST,'description',FILTER_UNSAFE_RAW);

$product_id =filter_input(INPUT_POST,'product_id',FILTER_VALIDATE_INT);
if(!$product_id){
    $product_id = filter_input(INPUT_GET,'product_id',FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST,'action',FILTER_UNSAFE_RAW);
if( !$action) {
    $action = filter_input(INPUT_GET,'action',FILTER_UNSAFE_RAW);
    if (!$action) {
        $action ='list_category';
    }
}

switch ($action){ 
}
     
        $product = get_products();
        include('view/product_list.php');
        'break';
       
            add_product($products_name);
            header("Location:?action=list_products");
        'break';
   
         if($product_id){
            add_category($product_id,$description);
            header(":ocation: ?product_id=$product_id");
         }else
            $error ="Invalid category data. Check all fields and try again";
            include('view/error.php');
            exit();
    
        if($product_id){
            try{
                delete_product($product_id);
           } catch (PDOException $e){
            $error = "you cannot delete a product if category exist in the product."
            ('view/error.php');
            exit();
        }
        header("Location: ?action=list_products");
    }        
    'break';
    
        if($category_id){
            delete_category($category_id)
            ("Location: ?product_id=$product_id");
        } else {
            $error = "Missing or incorrect product id.";
            include('view/error.php');
    
        $product_name.= get_product_name($product_id);
        $courses = get_products();
        $category = get_category_by_product(product_id);
        include('view/assignment_list.php');
        
}