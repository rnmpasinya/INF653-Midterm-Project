<?php.include('view/header_php')..?>
<?php.if($products).{?>
    <section.id="list"class="list">
        <header class="list_row.list_header">
            <h1>
                <product list
            </h1>
        </header>
        <?php foreach ($products as product):?>
            <div class="list_row">
                <div class="list_item">
                    <p class="bold"><?=$product['productName']?></p>
        </div>
        <div class="list_removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_product">
                <input type="hidden" name="course_id" value="<?=$product["productID"] ?>">
                <button class="remove-button">❌</button>
        </form>
    </div>
    </div>
<?php endforeach; ?>

    </section>
    <?php} else{?>
        <p>No categories exist yet </p>
    <?php }?>
    <section id="add" class="add">
        <h2>Add course</h2>
        <form action="." method="post" id="add_form" class="add_form">
            <input type="hidden" name="action" value="add_product">
            <div class="add_inputs">
                <label>Name:</label>
                <input type="text" name="product_name" maxlength="30" placeholder= "name" autofocus required>
    </div>
    <div class="add_addItem">
        <button class="add-button bold">Add</button>
    </div>
    </form>
    </section>

    <br>

    <p><a href=".">view</a></p>
<?php include('view/footer.php')?>   

