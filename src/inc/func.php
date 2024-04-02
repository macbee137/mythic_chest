<?php
include_once('db.php');

// SignUp function 
if (!function_exists('signUp')) {
    function signUp($con)
    {

        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $pw = $_POST['password'];
        $pwc = $_POST['pwconfirm'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $street = $_POST['street'];
        $postcode = $_POST['postcode'];
        $country = $_POST['country'];
        $role = "2";

        if ($pw == $pwc) {

            $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE username=? OR email=?");
            mysqli_stmt_bind_param($stmt, 'ss', $username, $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 0) {
                $uuid = uniqid();

                $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);
                $created_at = date('Y-m-d');

                $stmt = mysqli_prepare($con, "INSERT INTO user (UUID, username, firstname, lastname, email, password,
                gender, birthday, street, postcode, country, role, joined_at) VALUES
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param(
                    $stmt,
                    'sssssssssssss',
                    $uuid,
                    $username,
                    $firstname,
                    $lastname,
                    $email,
                    $hashedPassword,
                    $gender,
                    $birthday,
                    $street,
                    $postcode,
                    $country,
                    $role,
                    $created_at
                );
                mysqli_stmt_execute($stmt);


                echo "<p>Registration successfull</p> <br>";
                header("Refresh:2; '../public/login.php'");
                exit();
            } else {
                echo "Username or Email are already used <br>";
            }
        } else {
            echo "Passwords are not identic";
        }
    }
}


// login function
if (!function_exists('login')) {
    function login($con)
    {
        $login = $_POST['login'];
        $pw = $_POST['pw'];

        $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE username=? OR email=? LIMIT 1");
        mysqli_stmt_bind_param($stmt, 'ss', $login, $login);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $result = mysqli_fetch_assoc($result);


            if (password_verify($pw, $result['password'])) {
                $_SESSION['loggedin'] = 1;
                $_SESSION['uuid'] = $result['UUID'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['role'] = $result['role'];

                echo "<div class='loginscs'>Login Successfull </div>";
                header("Refresh:2; url=../inc/dashboard.php");
            } else {
                echo "Incorrect password";
            }
        } else {
            echo "User not found";
        }
    }
}

// Session Check
if (!function_exists('sessionCheck')) {
    function sessionCheck()
    {
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== 1) {
            header('Location: login.php');
            exit;
        }
    }

    // USER LINKS, right side of navbar.
    if (!function_exists('userLinks')) {
        function userLinks()
        {
            if (!$_SESSION || !$_SESSION['loggedin'] || $_SESSION['loggedin'] !== 1) {
                echo '<div class="userlinks">
                     <div class="signupbtn">
                    <a href="signup.php">Sign Up</a>
                    </div>
                    <div class="userlogin">
                    <a href="login.php">Login</a>
                    </div>
                    </div>';
            } else {
                if ($_SESSION['role'] == 1) {
                    echo '
                     <div class="userlinks">
                    <div class="profilbtn">
                    <a href="../public/add_prod.php">Add</a>
                    </div>
                    <div class="profilbtn">
                    <a href="../public/userlist.php">Userlist</a>
                    </div>
                    <div class="searchbtn">
                    <a href="../public/profile.php">Profile</a>
                    </div>
                    <div class="logout">
                    <a href="../public/logout.php">Logout</a>
                    </div>
                    </div>';
                } else {
                    echo '<div class="userlinks">
                    <div class="profilbtn">
                    <a href="../public/userlist.php">Userlist</a>
                    </div>
                    <div class="searchbtn">
                    <a href="../public/profile.php">Profile</a>
                    </div>
                    <div class="logout">
                    <a href="../public/logout.php">Logout</a>
                    </div>
                    </div>';
                }
            }
        }
    }


    // INDEX FUNCTION, for welcoming the user and tell him if logged in or not

    if (!function_exists('indexWelcome')) {
        function indexWelcome()
        {
            if (isset($_SESSION['loggedin'])) {
                $username = $_SESSION['username'];

                echo "<h2>Hello, dear  " . $username . " !</h2>";
            } else {
                echo "<p>Welcome! Please " . "<a class='indexlink' href='login.php'>Login</a>" .
                    " or " . "<a class='indexlink' href='signup.php'>Sign Up</a> first!</p>";
            }
        }
    }


    if (!function_exists('loadUserProfile')) {
        function loadUserProfile($con)
        {
            $userId = $_SESSION['uuid'];

            $stmt = mysqli_prepare($con, "SELECT username, firstname, lastname, pfp, joined_at FROM user WHERE uuid = ?");
            mysqli_stmt_bind_param($stmt, 's', $userId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $userData = mysqli_fetch_assoc($result);

                echo "<div class='profile_container'>";
                echo "<h1>" . $userData['username'] . "'s Profile</h1><br>";
                echo "<div class='profile-details'>";
                echo "<p><strong>username:</strong>" . htmlspecialchars($userData['username']) . "</p>";
                echo "<p><strong>first name:</strong>" . htmlspecialchars($userData['firstname']) . "</p>";
                echo "<p><strong>last name:</strong>" . htmlspecialchars($userData['lastname']) . "</p>";
                echo "<p><strong>member since:    </strong>" . htmlspecialchars($userData['joined_at']) . "</p>";
                echo "<p><a class='editbutton' href='../edituser.php?user_uuid=" . htmlspecialchars($_SESSION['uuid']) . "'>Edit</a></p>";
                echo "</div></div>";
            } else {
                header('Location: login.php');
                exit();
            }
        }
    }


    if (!function_exists('showUser')) {
        function showUser($con)
        {

            $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == '1';

            $sql = "SELECT uuid, username, firstname, lastname, gender, email, street, postcode, country FROM user";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<h2>Userlist</h2>";
                echo "<table>";
                echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th>
                  <th>Gender</th><th>Email</th><th>Street</th><th>Postcode</th>
                  <th>Country</th>";
                if ($isAdmin) {
                    echo "<th>Edit</th><th>Delt</th></tr>";
                } else {
                    echo "</tr>";
                }

                while ($list = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($list['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['firstname']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['lastname']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['gender']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['street']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['postcode']) . "</td>";
                    echo "<td>" . htmlspecialchars($list['country']) . "</td>";
                    if ($isAdmin) {
                        echo "<td><a class='editbutton' href='../edituser.php?user_uuid=" . htmlspecialchars($list['uuid']) . "'><i class='fa fa-folder'></i></i></a></td>";
                        echo "<td><a class='editbutton' href='../deluser.php?user_uuid=" . htmlspecialchars($list['uuid']) . "'><i class='fa fa-close'></i></a></td>";
                        echo "</tr>";
                    } else {
                        echo "</tr>";
                    }
                }
            } else {
                echo "No users found.";
            }
            echo "</table>";
        }
    }


    if (!function_exists('editUser')) {
        function editUser($con)
        {

            $isAdmin = ($_SESSION['role'] == '1');
            $userID = $_SESSION['uuid'];

            if (isset($_GET['user_uuid'])) {
                $ID = mysqli_real_escape_string($con, $_GET['user_uuid']);

                if ($userID !== $ID && !$isAdmin) {
                    die("Unauthorized access.");
                }

                $stmt = mysqli_prepare($con, "SELECT * FROM user WHERE UUID = ?");
                mysqli_stmt_bind_param($stmt, 's', $ID);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    $userData = mysqli_fetch_assoc($result);
                } else {
                    die("Error fetching user data: " . mysqli_error($con));
                }

                if (isset($_POST['update'])) {
                    $updatedFirstName = mysqli_real_escape_string($con, $_POST['firstname']);
                    $updatedLastName = mysqli_real_escape_string($con, $_POST['lastname']);
                    $updatedEmail = mysqli_real_escape_string($con, $_POST['email']);
                    $updatedStreet = mysqli_real_escape_string($con, $_POST['street']);
                    $updatedPostcode = mysqli_real_escape_string($con, $_POST['postcode']);
                    $updatedCountry = mysqli_real_escape_string($con, $_POST['country']);

                    $updateStmt = mysqli_prepare($con, "UPDATE user SET firstname = ?, lastname = ?, email = ?, street = ?, postcode = ?, country = ? WHERE uuid = ?");
                    mysqli_stmt_bind_param($updateStmt, 'sssssss', $updatedFirstName, $updatedLastName, $updatedEmail, $updatedStreet, $updatedPostcode, $updatedCountry, $ID);
                    $updateResult = mysqli_stmt_execute($updateStmt);

                    if ($updateResult) {
                        echo "User successfully updated";
                        header("Refresh:1; url='../userlist.php'");
                        exit();
                    } else {
                        echo "Error updating user: " . mysqli_error($con);
                    }
                }

                echo "<h2>Edit User</h2><br><br>
            <form action='' method='POST'>
                <label for='firstname'>First Name</label>
                <input type='text' id='firstname' name='firstname' value='" . htmlspecialchars($userData['firstname']) . "' required>
                <label for='lastname'>Last Name</label>
                <input type='text' id='lastname' name='lastname' value='" . htmlspecialchars($userData['lastname']) . "' required>
                <label for='email'>E-Mail</label>
                <input type='email' id='email' name='email' value='" . htmlspecialchars($userData['email']) . "' required>
                <label for='street'>Street</label>
                <input type='text' id='street' name='street' value='" . htmlspecialchars($userData['street']) . "' required>
                <label for='postcode'>Postcode</label>
                <input type='text' id='postcode' name='postcode' value='" . htmlspecialchars($userData['postcode']) . "' required>
                <label for='country'>Country</label>
                <input type='text' id='country' name='country' value='" . htmlspecialchars($userData['country']) . "' required>
                <button type='submit' name='update'>Update</button>
            </form>";
            } else {
                die("No user specified.");
            }
        }
    }
}



if (!function_exists('delUser')) {
    function delUser($con)
    {

        if (!isset($_SESSION['loggedin']) && !$_SESSION['role'] !== '1') {
            die("Unauthorized access.");
        }
        if (!isset($_GET['user_uuid'])) {
            die("No user specified.");
        }
        $userID = $_GET['user_uuid'];
        $stmt = mysqli_prepare($con, "DELETE FROM user WHERE UUID = ?");
        mysqli_stmt_bind_param($stmt, 's', $userID);
        mysqli_stmt_execute($stmt);

        echo "<h2> user gone </h2>";
        header("Refresh:2; '../public/userlist.php'");
    }
}

if (!function_exists('delProduct')) {
    function delProduct($con)
    {

        if (!isset($_SESSION['loggedin']) && !$_SESSION['role'] !== '1') {
            die("Unauthorized access.");
        }
        if (!isset($_GET['pid'])) {
            die("No product specified.");
        }
        $productID = $_GET['pid'];
        $stmt = mysqli_prepare($con, "DELETE FROM products WHERE PID = ?");
        mysqli_stmt_bind_param($stmt, 's', $productID);
        mysqli_stmt_execute($stmt);

        echo "<h2> product gone </h2>";
        header("Refresh:2; '../public/products.php'");
    }
}


if (!function_exists('listProducts')) {
    function listProducts($con)
    {
        $sql = "SELECT PID, product_name, price, product_category, product_image FROM products ORDER BY price";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<h1> Products </h1>";
            echo "<div class='product-grid'>";

            while ($product = mysqli_fetch_assoc($result)) {
                echo "<div class='product-item'>";
                echo "<a href='product_profile.php?pid=" . htmlspecialchars($product['PID']) . "'><img src='" . htmlspecialchars($product['product_image']) . "' alt=''></a>";
                echo "<h3>" . htmlspecialchars($product['product_name']) . "</h3>";
                echo "<p>Price: " . htmlspecialchars($product['price']) . " €</p>";
                echo "<a href='product_profile.php?pid=" . htmlspecialchars($product['PID']) . "'>See More -></a>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "No products found.";
        }
    }
}





if (!function_exists('showProduct')) {
    function showProduct($con)
    {
        if (!isset($_GET['pid'])) {
            die("Product not specified.");
        }

        $productID = $_GET['pid'];

        $stmt = mysqli_prepare($con, "SELECT * FROM products WHERE PID = ?");
        mysqli_stmt_bind_param($stmt, 'i', $productID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            echo "<h1> " . $product['product_name'] . "</h1>";
            echo "<div class='product-profile-container'>";
            echo "<a href='product_profile.php?pid=" . htmlspecialchars($product['PID']) . "'><img src='" . htmlspecialchars($product['product_image']) . "' alt=''></a>";
            echo "<div class='product_info'>";
            echo "<p>" . htmlspecialchars($product['product_name']) . "</p>";
            echo "<p>Price: " . htmlspecialchars($product['price']) . " €</p>";
            echo "<p>Category: " . htmlspecialchars($product['product_category']) . "</p>";
            echo "<p>Description: <br><br> " . htmlspecialchars($product['product_details']) . "</p>";
            echo "<p>Last Change at: " . htmlspecialchars($product['last_changed']) . "</p>";
            echo "</div></div>";
        } else {
            echo "Product not found";
            exit;
        }
    }
}








if (!function_exists('editProducts')) {
    function editProducts($con)
    {
        if (!isset($_GET['pid'])) {
            die("No product specified.");
        }

        $productID = mysqli_real_escape_string($con, $_GET['pid']);

        $stmt = mysqli_prepare($con, "SELECT * FROM products WHERE pid = ?");
        mysqli_stmt_bind_param($stmt, 'i', $productID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $productData = mysqli_fetch_assoc($result);
        } else {
            die("Error fetching product data: " . mysqli_error($con));
        }

        if (isset($_POST['update'])) {
            $updatedName = mysqli_real_escape_string($con, $_POST['product_name']);
            $updatedPrice = mysqli_real_escape_string($con, $_POST['price']);
            $updatedCategory = mysqli_real_escape_string($con, $_POST['product_category']);
            $updatedDetails = mysqli_real_escape_string($con, $_POST['product_details']);
            $updatedImage = $_POST['product_image'];
            $updatedTime = mysqli_real_escape_string($con, date('Y-m-d H:i:s'));


            $updateStmt = mysqli_prepare($con, "UPDATE products SET product_name = ?, price = ?, product_category = ?, product_details = ?,
            product_image = ?, last_changed = ? WHERE pid = ?");
            mysqli_stmt_bind_param(
                $updateStmt,
                'ssssssi',
                $updatedName,
                $updatedPrice,
                $updatedCategory,
                $updatedDetails,
                $updatedImage,
                $updatedTime,
                $productID
            );
            $updateResult = mysqli_stmt_execute($updateStmt);

            if ($updateResult) {
                echo "Product successfully updated";
                header("Refresh:1; url='../products.php'");
                exit();
            } else {
                echo "Error updating product: " . mysqli_error($con);
            }
        }

        echo "<h2>Edit Product</h2><br><br>
        <form action='' method='POST'>
            <label for='product_name'>Product Name</label>
            <input type='text' id='product_name' name='product_name' value='" . htmlspecialchars($productData['product_name']) . "' required>
            <label for='price'>Price</label>
            <input type='text' id='price' name='price' value='" . htmlspecialchars($productData['price']) . "' required>
            <label for='product_category'>Category</label>
            <input type='text' id='product_category' name='product_category' value='" . htmlspecialchars($productData['product_category']) . "' required>
            <label for='product_category'>Details</label>
            <input type='text' id='product_details' name='product_details' value='" . htmlspecialchars($productData['product_details']) . "' required>
            <label for='product_category'>Image Link</label>
            <input type='text' id='product_image' name='product_image' value='" . htmlspecialchars($productData['product_image']) . "' required>
            <div class='del-btns'>
            <button type='submit' name='update'>Update</button></form>
            <a href='../product_profile.php?pid=" . htmlspecialchars($_GET['pid']) . "' class='del-action-btn'>No, go back</a>
            </div>";
    }
}



// Add Product function 
if (!function_exists('addProducts')) {
    function addProducts($con, $targetFile)
    {
        // Ensure database connection is valid
        if (!$con) {
            echo "Database connection error";
            exit();
        }

        $productName = $_POST['product_name'];
        $price = $_POST['price']; // Validate and possibly convert to the correct type
        $serialnumber = $_POST['serialnumber'];
        $category = $_POST['product_category'];
        $details = $_POST['product_details'];
        $image = $targetFile;

        $stmt = mysqli_prepare($con, "SELECT * FROM products WHERE product_name = ? OR serialnumber = ?");
        mysqli_stmt_bind_param($stmt, 'ss', $productName, $serialnumber);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 0) {
            $created_at = date('Y-m-d H:i:s');

            $stmt = mysqli_prepare($con, "INSERT INTO products (product_name, price, serialnumber, product_category, product_details, product_image, last_changed) VALUES(?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, 'sssssss', $productName, $price, $serialnumber, $category, $details, $image, $created_at);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_affected_rows($stmt) > 0) {
                echo "<p>Product successfully added</p>";
                echo "<script>setTimeout(() => window.location.href = '../public/products.php', 2000);</script>";
            } else {
                echo "Error adding product";
            }
        } else {
            echo "Product already listed";
        }
    }
}

