<?php
    session_start();

    include_once '../tools/variables.php';
    $page_title = 'Customers';
    $css = 'admin';
    $store= ' active';

    include_once '../includes/header.php';
    include_once '../includes/admin-top.php';
    include_once '../classes/food.class.php';
?>
<h4 style="margin-top: 12px; margin-left: 3px">STORE</h4>

<div class="content">
    <div class="content-container">

        <form class="input-container" style="width: 340px">
            <h4>Edit Current Food</h4>
            <div class="img-container upload-img" style="margin-bottom: 15px;border-radius: 50%; width: 150px; height: 150px; background-color: #FF5E5E">
                <input type="file" class="img-container" style="opacity: 0; margin-bottom: 15px;border-radius: 50%; width: 150px; height: 150px; background-color: #FF5E5E">
            </div>
            
            <div style="width: 70%; margin-bottom: 10px">
                <h4 style="margin-bottom: 0; font-weight: 500">Food Name</h4>
                <input id="foodname" name="foodname">
            </div>

            <div style="width: 70%">
                <h4 style="margin-bottom: 0; font-weight: 500">Food Price</h4>
                <input id="foodprice" name="foodprice">
            </div>

            <div class="btn-container">
                <button type="submit" name="submit" class="saveBtn" style="margin-right: 5px">EDIT</button>
                <a href="food-management.php"><button type="button" name="submit" class="saveBtn">BACK</button></a>
            </div>
        </form>
        
    </div>
</div>

<?php
    include_once '../includes/admin-navbar.php';
    include_once '../includes/admin-footer.php';
?>