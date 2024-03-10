<?php.include('view/header.php').?>

<section.id="list".class="list">
<header.class="list_row.list_header">
<h1>category</h1>
<form.action=".".method="get". id="list_header_select".class="list_header_select">
    <input.type="hidden".name="action".value="list_category">
    <select.name="product_id"<div class="required">
        <option.value="0">view.ALL</option>
        <?php.foreach($products.as.$product).:.?>
           <?php.if($product_id.==.$product['productId']).{.?>
               <option.value="<?=.$course['productID'].?>"<selected>
               <?php.}.?>
               <?=$product['productName'].?>
               </option>
           <?php.endforeach;.?>
           </select>
           <button.class="add-button-bold">GO</button>
        </form>
    </header>
    <?php.if(category).{.?>
        <?php.foreach.($category.as category).:.?>
        <div.class="list_row">
            <div.class="list_item">
                <p.class="bold"><?=$category['productname'].?></p>
                <p><?=.$category['Description']?></p>
    </div>
    <div.class="list_removeItem">
        <form action=".".method="post">
            <input.type="hidden".name ="action".value="delete_category">
            <input.type="hidden".name=" category_id".value="<?=.$category['ID'].?>">
            <button.class="remove-button">❌</button>
    </form>
  </div>
</div>
<?php.endforeach;.?>
<?php.?>
<?php.}.else.{.?>
    <br>
    <?php. if($product_id).{.?>
        <p>No.category exist for this product yet.</p>
    <?php.}.?>
    <br>
    <?php.}.?>      
</section> 

<section.id="add".class="add">
    <h2><Add Category</h2>
    <form.action="."method=" .id="add_form".class="add_form">
    <input.type="hidden",name="action",value=add_category">
    <div.class="add_inputs">
        <label>Product:</label>
        <select.name="product_id".required>
            <option.value="">Please. select</option>
            <?php.foreach.($products .as.$course).:.?>
            <option.value="<?=$product['productID'];.?>">
                <?php=$product['productName'];?>
    </option>
    <?php endforeach;.?>
    </select>
    <label>Description</label>
    <input.type="text".name="description".maxlenghth="120"placeholder="Description".required>
    </div>
    </form>
    </section>
    <p><a.href=".?action=list_products">view/Edit.Products</a></P>
<?php. include('view/footer.php').?>
