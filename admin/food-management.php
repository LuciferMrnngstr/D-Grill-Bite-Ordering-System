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
        <div class="food-search" style="position: relative;">
            <h4>FOOD MANAGEMENT</h4>
            <input type="text" placeholder="Search Food" style="padding-right: 30px;">
            <img src="../icons/Search.svg" alt="Icon" style="position: absolute; top: 50%; right: 15px; transform: translateY(-50%);" height="15px" width="15px">
        </div>
        <div class="food-container">
            <div class="food-selection-tab">
                <div class="food-selection-buttons">
                    <button class="tablinks" onclick="openFoodMenu(event, 'menu')" id="defaultOpen">MENU</button>
                    <div class="separator"></div>
                    <button class="tablinks" onclick="openFoodMenu(event, 'combos')">COMBOS</button>
                </div>
                <div class="add-new-food">
                    <a href="add-food.php"><button><img src="../icons/plus.svg" width="20px"></button></a>
                </div>
            </div>
            <div id="menu" class="food-main-content">
                <div class="container-box food-box">
                    <div class="food-img-div dropdown">
                        <div class="img-container liver-adobo" style="border-radius: 50%; width: 85px; height: 85px"></div>
                        <img onclick="foodOptions(this)" class="food-options dropbtn" src="../icons/three-dots-vertical.svg">
                        <div id="foodOptionsDropdown" class="dropdown-content" style="margin-top: 18px">
                            <a href="edit-food.php">Edit</a>
                            <a href="#">Available</a>
                            <a href="#">Not Available</a>
                        </div>
                    </div>
                    
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Chicken Liver Adobo</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">&#8369 35.00</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Available</h4>
                </div>
                <div class="container-box food-box">
                    <div class="food-img-div dropdown">
                        <div class="img-container tortang-talong" style="border-radius: 50%; width: 85px; height: 85px"></div>
                        <img onclick="foodOptions(this)" class="food-options dropbtn" src="../icons/three-dots-vertical.svg">
                        <div id="foodOptionsDropdown" class="dropdown-content" style="margin-top: 18px">
                            <a href="edit-food.php">Edit</a>
                            <a href="#">Available</a>
                            <a href="#">Not Available</a>
                        </div>
                    </div>
                    
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Tortang Talong</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">&#8369 25.00</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Available</h4>
                </div>
            </div>
            <div id="combos" class="food-main-content">
                <div class="container-box food-box">
                    <div class="food-img-div dropdown">
                        <div class="img-container liver-adobo" style="border-radius: 50%; width: 85px; height: 85px"></div>
                        <img onclick="foodOptions(this)" class="food-options dropbtn" src="../icons/three-dots-vertical.svg">
                        <div id="foodOptionsDropdown" class="dropdown-content" style="margin-top: 18px">
                            <a href="edit-food.php">Edit</a>
                            <a href="#">Available</a>
                            <a href="#">Not Available</a>
                        </div>
                    </div>
                    
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Combo Meal 1</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">&#8369 35.00</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Available</h4>
                </div>
                <div class="container-box food-box">
                    <div class="food-img-div dropdown">
                        <div class="img-container tortang-talong" style="border-radius: 50%; width: 85px; height: 85px"></div>
                        <img onclick="foodOptions(this)" class="food-options dropbtn" src="../icons/three-dots-vertical.svg">
                        <div id="foodOptionsDropdown" class="dropdown-content" style="margin-top: 18px">
                            <a href="edit-food.php">Edit</a>
                            <a href="#">Available</a>
                            <a href="#">Not Available</a>
                        </div>
                    </div>
                    
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Combo Meal 2</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">&#8369 25.00</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Available</h4>
                </div>
                <div class="container-box food-box">
                    <div class="food-img-div dropdown">
                        <div class="img-container tortang-talong" style="border-radius: 50%; width: 85px; height: 85px"></div>
                        <img onclick="foodOptions(this)" class="food-options dropbtn" src="../icons/three-dots-vertical.svg">
                        <div id="foodOptionsDropdown" class="dropdown-content" style="margin-top: 18px">
                            <a href="edit-food.php">Edit</a>
                            <a href="#">Available</a>
                            <a href="#">Not Available</a>
                        </div>
                    </div>
                    
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Combo Meal 3</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">&#8369 25.00</h4>
                    <h4 style="font-size: 12px; font-weight: 500; margin: 0">Available</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include_once '../includes/admin-navbar.php';
    include_once '../includes/admin-footer.php';
?>