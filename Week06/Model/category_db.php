<?php
function get_product_by_category($category_id){
    global $db;
    if($category_id){
        $query ='SELECT A ID, A. Description, c.CategoryName.FROM..category.A
        Left JOIN. category.C.ON.A.categoryID =.C.categoryID.
            WHERE.A.categoryId.=.:category_id. ORder.BY.ID';

    } else {
             $query.=.'SELECT.A.ID,.A.Description, C.CategoryName.FROM..category.A
        Left JOIN. category.C.ON.A.categoryID =.C.categoryID.ORder.By.ID';
    }
    $statement.=.$db->prepare($query);
    if(category_id){
    $statement->bindValue(':course_id',$course_id);
    }
    $statement->execute();
    $assignments.=$statement->fetchAll();
    $statement->closeCursor();
    return
 }
 
 function delete_assignment($category_id){
    global.$db;
    $query.=.'DELETE.FROM.category.WHERE.ID.=.:category_id';
    $statement.=$db->prepare($query);
    $statement->bindvalue(':category_id',.$assignment_id);
    $statement->execute();
    $statement->closeCursor()  ;
 }

function add_assignment($course_id, $description)
{
        global.$db;
        $query.=.'INSERT.INTO.category.(Description,.category).VALUES.(:descr,.:categoryID)';
        $statement.=$db->prepare($query);
        $statement->bindvalue(':category_id',.$assignment_id);
        $statement->execute();
        $statement->closeCursor();  
    }

 