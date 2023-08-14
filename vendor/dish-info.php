<?php
    session_start();

    include_once '../classes/food.class.php';
    include_once '../classes/notification.class.php';
    
    $foods = new Food;
    $notification = new Notification;

    if(isset($_GET['food_id'])){
        $page_title = "Edit Dish";
        $food_id = $_GET['food_id'];
        
        if($foods->fetch($food_id)){
            $food = $foods->fetch($food_id);
        }
        else{
            header('location: store.php');
        }
    }
    else {
        $page_title = "Add Dish";
    }

    include_once '../includes/header.php';

    if(isset($_POST['save_new'])){
        $item_name = htmlentities($_POST['item-name']);
        $item_price = htmlentities($_POST['price']);
        $item_description = htmlentities($_POST['description']);
        $item_availabillity = $_POST['availability'];

        if(!empty($_FILES['image']) && !empty($_POST['item-name']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['availability'])){
            $img_name = $_FILES['image']['name'];
            $img_size = $_FILES['image']['size'];
            $tmp_name = $_FILES['image']['tmp_name'];
            $error = $_FILES['image']['error'];

            if($error === 0){
                if($img_size > 350000000){
                    $em = 'Your image size is too large';
                }
                else{
                    $img_ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                    $allowed_exs = array('jpeg', 'jpg', 'png');

                    if(in_array($img_ex, $allowed_exs)){
                        $new_img_name = uniqid('IMG-', true) . '.' . $img_ex;
                        $img_upload_path = '../icons/uploads/dishes/' . $new_img_name;

                        //upload photo
                        move_uploaded_file($tmp_name, $img_upload_path);
                        
                        //create new food in database
                        if($foods->addNew(ucwords($item_name), $item_price, $item_description, $new_img_name, $item_availabillity)){
                            $sm = 'Created new dish successfully!';
                            $notification->addEditDeleteDish($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $food_id, 'create dish'); //Create notification
                            
                            header('location: store.php?success=' . $sm);
                        }
                    }
                    else{
                        $em = "You can't upload files like this";
                    }
                }
            }
            else{
                $em = 'an unknown error occured, please try again';
            }
        }
        else{
            $em = 'Please fill out all the info';
        }
    }
    else if(isset($_POST['save_edit'])){
        $item_name = htmlentities($_POST['item-name']);
        $item_price = htmlentities($_POST['price']);
        $item_description = htmlentities($_POST['description']);
        $item_availabillity = $_POST['availability'];

        if(!empty($_FILES['new_image']) && !empty($_POST['item-name']) && !empty($_POST['price']) && !empty($_POST['description']) && !empty($_POST['availability'])){
            $img_name = $_FILES['new_image']['name'];
            $img_size = $_FILES['new_image']['size'];
            $tmp_name = $_FILES['new_image']['tmp_name'];
            $error = $_FILES['new_image']['error'];

            if($error === 0){
                if($img_size > 350000000){
                    $em = 'Your image size is too large';
                }
                else{
                    $img_ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
                    $allowed_exs = array('jpeg', 'jpg', 'png');

                    if(in_array($img_ex, $allowed_exs)){
                        $new_img_name = uniqid('IMG-', true) . '.' . $img_ex;
                        $img_upload_path = '../icons/uploads/dishes/' . $new_img_name;



                        //upload photo
                        move_uploaded_file($tmp_name, $img_upload_path);
                        
                        //Update dish info. editInfo2 is a function for when upadting the dish and replacing the image of the dish.
                        if($foods->editInfo2($food_id, ucwords($item_name), $item_price, $item_description, $new_img_name, $item_availabillity)){
                            $sm = 'New info saved successfully!';
                            if($notification->addEditDeleteDish($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $food_id, 'edit dish')){ //Create notification
                                header('location: store.php?success=' . $sm);
                            }                            
                        }
                    }
                    else{
                        $em = "You can't upload files like this";
                    }
                }
            }
            else{
                //Update dish info. editInfo is a function for when upadting the dish info without replacing the image of the dish.
                if($foods->editInfo($food_id, ucwords($item_name), $item_price, $item_description, $item_availabillity)){
                    $sm = 'New info saved successfully!';
                    if($notification->addEditDeleteDish($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $food_id, 'edit dish')){ //Create notification
                        header('location: store.php?success=' . $sm);
                    }
                }
            }
        }
        else{
            $em = 'Please fill out all the info';
        }
    }
    else if(isset($_POST['delete'])){
        if($foods->delete($food_id)){
            $dm = $food['name'] . ' deleted successfully!';
            if($notification->addEditDeleteDish($_SESSION['user_type'], $_SESSION['user_id'], $_SESSION['logged_in'], $food_id, 'edit dish')){ //Create notification
                header('location: store.php?success=' . $sm);
            }
        }
    }
?>

<div class="wrapper">
    <?php include_once '../includes/vendor/topnav.php'; ?>

    <!-- if food_id is empty then switch to add food form else edit form -->
    <form class="add-edit-dish <?php if(!isset($food_id)) echo 'add-dish'; ?>" method="post" enctype="multipart/form-data">
        <div class="action">
            <span class="dots"></span>
            <span class="dots"></span>
            <span class="dots"></span>
        </div>

        <span class="overlay"></span>

        <div class="action-modal">
            <div>
                <button type="button" class="delete">Delete Dish</button>
            </div>
        </div>

        <div class="confirmation-modal">
            <div class="content">
                <p>Are you sure you want to delete this dish?</p>
                <div class="buttons">
                    <input type="submit" class="save" name="delete" value="Delete">
                    <button type="button" class="cancel">Cancel</button>
                </div>    
            </div>    
        </div>

        <div class="img">
            <img class="item-img" src="../icons/uploads/dishes/<?= $food['img']; ?>">
            <div class="upload-new">
                <button type="button">Upload new photo<input type="file" name="new_image" class="edit-img"></button>
            </div>

            <img class="upload-img" src="../icons/add-img.svg">
            <p>Upload Image</p>
            <input type="file" name="image" class="add-img">
        </div>

        <div class="description-container">
            <div class="name">
                <label>Dish Name</label>
                <input type="text" name="item-name" value="<?php if(isset($food_id)){ echo $food['name']; } else if(isset($item_name)){ echo $item_name; } ?>">
            </div>

            <div class="price">
                <label>Price</label>
                <div class="price-cont">
                    <span >₱</span>
                    <input type="number" name="price" value="<?php if(isset($food_id)){ echo $food['price']; } else if(isset($item_price)){ echo sprintf("%0.2f", $item_price); } ?>">
                </div>
            </div>

            <div class="availability">
                <label>Availability</label>
                <select name="availability">
                    <option value="available" <?php if(isset($food_id) && $food['availability'] === 'available'){ echo 'selected'; } else if(!empty($item_availabillity) && $item_availabillity === 'available'){ echo 'selected'; } ?>>Available</option>
                    <option value="unavailable" <?php if(isset($food_id) && $food['availability'] === 'unavailable'){ echo 'selected'; } else if(!empty($item_availabillity) && $item_availabillity === 'unavailable'){ echo 'selected'; } ?>>Unavailable</option>
                </select>
            </div>

            <div class="description">
                <label for="item-name">Description</label>
                <textarea cols="30" rows="10" name="description"><?php if(isset($food_id)){ echo $food['description']; } else if(isset($item_description)){ echo $item_description; } ?></textarea>
            </div>
        </div>

        <div class="bottom-button">
            <button type="button" class="buynow_btn">Save New Dish</button>
        </div>

        <div class="save-modal">
            <div class="content">
                <?php
                    if(isset($food_id)){
                ?>
                    <p>Are you sure you want to save this new item info?</p>
                    <div class="buttons">
                        <button type="button" class="cancel">Cancel</button>
                        <input type="submit" class="save" name="save_edit" value="Save">
                    </div>  
                <?php
                    }
                    else{
                ?>
                    <p>Are you sure you want to add this item?</p>
                    <div class="buttons">
                        <button type="button" class="cancel">Cancel</button>
                        <input type="submit" class="save" name="save_new" value="Save">
                    </div>  
                <?php
                    }
                ?>
            </div>    
        </div>
    </form>
</div>

<script src="../script/notification.js"></script>
<script src="../script/admin/add-dish.js"></script>
<?php

    include_once '../includes/footer.php';
?>