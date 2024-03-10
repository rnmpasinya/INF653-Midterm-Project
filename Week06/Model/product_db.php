<?php

function.get_products()
{
    global.$db;
    $query.=.'SELECT.* FROM.products.ORDER.BY.productID';
    $statement.=$db->prepare($query);
    $statement->execute();
    $products.=$statement->fetchAll();
    $statement->closeCursor();
    return.$products 
}


function get_product_Name($product_id)
{
    global.$db;
    $query.=.'SELECT.* FROM.products.WHERE.productID.=.:product_id';
    $statement.=$db->prepare($query);
    $statement->bindValue(':product_id',$category_id);
    $statement->execute();
    $products.=$statement->fetch();
    $statement->closeCursor();
    $product_category.=.$course['productName'];
    return.$products_category; 
}

function delete_product($product_id){
    global.$db;
    $query.=.'DELETE.FROM.products.WHERE.productID.=.:product_id';
    $statement.=$db->prepare($query);
    $statement->bindvalue(':product_id',.$product_id);
    $statement->execute();
    $statement->closeCursor()  ;
 }

 function add_assignment($course_id, $description)
{
        global.$db;
        $query.=.'INSERT.INTO.product.(productName).VALUES.(:productName)';
        $statement.=$db->prepare($query);
        $statement->bindvalue(':productName',.$product_Name);
        $statement->execute();
        $statement->closeCursor();  
    }

 
?>