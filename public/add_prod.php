<?php
include_once('../src/inc/nav.php');
sessionCheck();
?>

<div class="add-product">
    <h2>Add Product</h2><br><br>
    <form action='' method='POST' enctype="multipart/form-data">
        <label for='product_name'>Product Name</label>
        <input type='text' id='product_name' name='product_name' required>
        <label for='price'>Price</label>
        <input type='text' id='price' name='price' required>
        <label for='serialnumber'>Serialnumber</label>
        <input type='text' id='serialnumber' name='serialnumber' required>
        <label for='product_category'>Category</label>
        <input type='text' id='product_category' name='product_category' required>
        <label for='product_details'>Details</label>
        <input type='text' id='product_details' name='product_details' required>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/jpg, image/jpeg, image/png, image/gif">
        <br>
        <div class="button-or-edit">
            <button class="form-button" type='submit' name='upload'>Add</button>
        </div>
    </form>

    <?php
    if (isset($_POST['upload'])) {

        if (isset($_FILES['fileToUpload']) && is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
            $target_dir = "imgs/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]['tmp_name']);
        if ($check !== false) {
            echo "File is an Image - " . $check["mime"] . ".";
        } else {
            echo "File is not an Image";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]['tmp_name'], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]['name'])) . " has been uploaded.";
                addProducts($con, $target_file, $_FILES);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
    ?>
</div>

<?php
include_once('../src/inc/footer.php');
?>
