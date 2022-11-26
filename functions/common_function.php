<?php

// including connect file
// include('./includes/connect.php');
// getting products
function getProducts()
{
    // $con is a local on connect.php file, so we need to use global keyword
    global $con;

    // condition to check isset or not
    // check that if we don't pick any category or brand, there wil be not anything is showed
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            // formating the number of product we want to show
            $select_query = "SELECT * FROM products order by rand() limit 0,3";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                               <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='productDetails.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}

// getting all products
function getAllProduct()
{
    global $con;

    // condition to check isset or not
    // check that if we don't pick any category or brand, there wil be not anything is showed
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            // With no limit, we can show all products
            $select_query = "SELECT * FROM products order by rand()";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_image1 = $row['product_image1'];
                $product_price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
                echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                               <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='productDetails.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
            }
        }
    }
}


// getting uniq categories

function getUniqCategories()
{
    // $con is a local on connect.php file, so we need to use global keyword
    global $con;

    // condition to check isset or not
    // check that if we don't pick any category or brand, there wil be not anything is showed
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];
        $select_query = "SELECT * FROM `products` where category_id ='$category_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_row = mysqli_num_rows($result_query);
        if ($num_of_row == 0) {
            echo "<h2 class='text-center'>No product found in this category</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                               <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='productDetails.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}


function getUniqBrand()
{
    // $con is a local on connect.php file, so we need to use global keyword
    global $con;

    // condition to check isset or not
    // check that if we don't pick any category or brand, there wil be not anything is showed
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "SELECT * FROM `products` where brand_id ='$brand_id'";
        $result_query = mysqli_query($con, $select_query);
        $num_of_row = mysqli_num_rows($result_query);
        if ($num_of_row == 0) {
            echo "<h2 class='text-center'>No product found in this brand</h2>";
        }
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                               <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='productDetails.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                            </div>
                        </div>
                    </div>";
        }
    }
}


// getting brands
function getBrands()
{
    global $con;
    $select_brand = "SELECT * FROM `brands`";
    $result_brand = mysqli_query($con, $select_brand);
    while ($row_data = mysqli_fetch_assoc($result_brand)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo "<li class='nav-item'> 
                        <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
                        </li> ";
    }
}

// getting categories
function getCategories()
{
    global $con;
    $select_categories = "SELECT * FROM `categories`";
    $result_categories = mysqli_query($con, $select_categories);
    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $categories_title = $row_data['categories_title'];
        $categories_id = $row_data['categories_id'];
        echo "<li class='nav-item'> 
                        <a href='index.php?category=$categories_id' class='nav-link text-light'>$categories_title</a>
                        </li> ";
    }
}
// searching product function
function searchProduct()
{
    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_data_value = $_GET['search_data'];
        $search_query = "SELECT * FROM `products` where product_keywords like '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_image1 = $row['product_image1'];
            $product_price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            echo "<div class='col-md-4 mb-2'>
                            <div class='card'>
                                <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                                <div class='card-body'>
                                   <h5 class='card-title'>$product_title</h5>
                                    <p class='card-text'>$product_description</p>
                                    <p class='card-text'>Price: $product_price</p>
                                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                    <a href='productDetails.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                                </div>
                            </div>
                        </div>";
        }
    }
}

// view details function
function viewDetail()
{
    global $con;

    // condition to check isset or not
    // check that if we don't pick any category or brand, there wil be not anything is showed
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM products where product_id ='$product_id'";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    $product_price = $row['product_price'];
                    $category_id = $row['category_id'];
                    $brand_id = $row['brand_id'];
                    echo "<div class='col-md-4 mb-2'>
                        <div class='card'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                            <div class='card-body'>
                               <h5 class='card-title'>$product_title</h5>
                                <p class='card-text'>$product_description</p>
                                <p class='card-text'>Price: $product_price</p>
                                <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                                <a href='index.php' class='btn btn-secondary'>Go Home</a>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-8'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center text-info mb-5'>Related Products</h4>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin_area/product_images/$product_image2' class='card-img-top' alt='$product_title'>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin_area/product_images/$product_image3' class='card-img-top' alt='$product_title'>
                            </div>
                        </div>
                    </div>
                    ";
                }
            }
        }
    }
}

// login function


// get ip address function
function getIPAddress()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();
// echo 'User Real IP Address - ' . $ip;



// cart function
function cart()
{
    global $con;
    if (isset($_GET['add_to_cart'])) {
        $ip = getIPAddress();
        $getProductID = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM cart_details where ip_address='$ip' AND product_id='$getProductID'";
        $result_query = mysqli_query($con, $select_query);
        $count = mysqli_num_rows($result_query);
        if ($count > 0) {
            echo "<script>alert('This product is already added in your cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            $insert_query = "INSERT INTO cart_details (product_id,ip_address, quantity) VALUES ('$getProductID','$ip', 0)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>alert('Item is added to cart')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        }
    }
}

// function to get cart item number
function cart_item()
{
    global $con;
    if (isset($_GET['add_to_cart'])) {
        $ip = getIPAddress();
        $select_query = "SELECT * FROM cart_details where ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $count = mysqli_num_rows($result_query);
    } else {
        $ip = getIPAddress();
        $select_query = "SELECT * FROM cart_details where ip_address='$ip'";
        $result_query = mysqli_query($con, $select_query);
        $count = mysqli_num_rows($result_query);
    }
    echo $count;
}

// total price function

function totalPrice()
{
    global $con;
    $get_ip_add = getIPAddress();
    $total = 0;
    $cart_query =   "SELECT * FROM cart_details where ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $cart_query);
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['product_id'];
        $select_product = "SELECT * FROM products where product_id='$product_id'";
        $result_product = mysqli_query($con, $select_product);
        while ($row = mysqli_fetch_array($result_product)) {
            $product_price = array($row['product_price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }
    }
    echo $total;
}

// get user order detail
function getUserOrderDetails()
{
    global $con;
    $username =  $_SESSION['username'];
    $select_query = "SELECT * FROM user_table where username='$username'";
    $result_query = mysqli_query($con, $select_query);
    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "SELECT * FROM user_orders where user_id='$user_id' and order_status='pending'";
                    $result_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);
                    if ($row_count > 0) {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class = 'text-dark'>$row_count</span> pending orders</h3>
                        <p class= 'text-center'><a href = 'profile.php?my_orders'>Order Details</a></p>";
                    } else {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class= 'text-center'><a href = '../index.php'>Explore Products</a></p>";
                    }
                }
            }
        }
    }
}


// validate username
function isValidUsername($username)
{
    return (!preg_match("/^[a-zA-Z0-9]+$/", $username)) ? FALSE : TRUE;
}

// validate passord
function isValidPassword($password)
{
    if (!preg_match_all('$\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$', $password))
        return FALSE;
    return TRUE;
}
/*
    Regular Expression: $\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$
    $ = beginning of string
    \S* = any set of characters
    (?=\S{8,}) = of at least length 8
    (?=\S*[a-z]) = containing at least one lowercase letter
    (?=\S*[A-Z]) = and at least one uppercase letter
    (?=\S*[\d]) = and at least one number
    (?=\S*[\W]) = and at least a special character (non-word characters)
    $ = end of the string
    // 19102002Thai@
 */

// validate email
// function isValidEmail($email)
// {
//     // return (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email))
//     //  ? TRUE : FALSE;

// }

function isValidEmail($email)
{
    return (!filter_var($email, FILTER_VALIDATE_EMAIL)) ? FALSE : TRUE;
}

// validate phone number
function isValidPhoneNumber($phone)
{
    return (!preg_match("/^[0-9]{10}$/", $phone)) ? FALSE : TRUE;
}

// validate image
function isValidImage($image)
{
    $allowed = array('jpg', 'jpeg', 'png');
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed)) {
        return FALSE;
    }
    return TRUE;
}