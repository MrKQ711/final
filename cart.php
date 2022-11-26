<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Details</title>
    <!-- // bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- // font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- // CSS link -->
    <link rel="stylesheet" href="style.css">
    <style>
    .cart_img {
        height: 150px;
        width: 150px;
        object-fit: contain;
    }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child-->
        <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
            <div class="container-fluid">
                <img src="./image/logo.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/userRegistration.php">Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"> <i class="fa-sharp fa-solid fa-cart-shopping"></i><sup>
                                    <?php
                                    cart_item();
                                    ?>
                                </sup></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- calling cart function -->
        <?php
        cart();
        ?>
        <!-- second child -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                    </li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/userLogin.php'>Login</a>
                    </li>";
                } else {
                    echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                    </li>";
                }
                ?>
            </ul>
        </nav>

        <!-- third child -->
        <div class="bg-light">
            <h3 class="text-center">
                Hidden Store
            </h3>
            <p class="text-center">Communication </p>
        </div>

        <!-- fourth child -->
        <div class="container">
            <div class="row">
                <form action="" method="POST">
                    <table class="table table-bordered text-center">

                        <!-- php code  to display dynamic data-->
                        <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $total = 0;
                        $cart_query =   "SELECT * FROM cart_details where ip_address='$get_ip_add'";
                        $result_query = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        if ($result_count > 0) {
                            echo " <thead>
                                <tr>
                                    <th>Product Title</th>
                                    <th>Product Image</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                    <th colspan='2'>Operations</th>
                                </tr>
                            </thead>
                            <tbody>";
                            while ($row = mysqli_fetch_array($result_query)) {
                                $product_id = $row['product_id'];
                                $select_product = "SELECT * FROM products where product_id='$product_id'";
                                $result_product = mysqli_query($con, $select_product);
                                while ($row = mysqli_fetch_array($result_product)) {
                                    $product_price = array($row['product_price']);
                                    $price_table = $row['product_price'];
                                    $product_title = $row['product_title'];
                                    $product_image1 = $row['product_image1'];
                                    $product_values = array_sum($product_price);
                                    $total += $product_values;

                        ?>
                        <tr>
                            <td><?php echo $product_title ?></td>
                            <td><img src="./image/<?php echo $product_image1 ?>" alt="" class="cart_img"></td>
                            <td><input type="text" name="qty" id="" class="form-check-input w-50 h-50"></td>
                            <?php
                                    if (isset($_POST['update_cart'])) {
                                        $qty = $_POST['qty'];
                                        $product_id = $row['product_id'];
                                        $update_qty = "UPDATE cart_details set quantity='$qty' where ip_address='$get_ip_add' and product_id='$product_id'";
                                        $result_qty = mysqli_query($con, $update_qty);
                                        $total = $total * $qty;
                                    }
                                        ?>
                            <td><?php echo $price_table ?></td>
                            <td><input type="checkbox" name="removeitem[]" id="" value="<?php
                                                                                                    echo $product_id;
                                                                                                    ?>"></td>
                            <td>
                                <!-- <button class="bg-secondary px-3 py-2 border-0 mx-3">Update</button> -->
                                <input type="submit" value="Update Cart" class="bg-secondary px-3 py-2 border-0 mx-3"
                                    name="update_cart">
                                <!-- <button class="bg-secondary px-3 py-2 border-0 mx-3">Remove</button> -->
                                <input type="submit" value="Remove Cart" class="bg-secondary px-3 py-2 border-0 mx-3"
                                    name="remove_cart">
                            </td>
                        </tr>

                        <?php
                                }
                            }
                        } else {
                            echo "<h3 class='text-center'>Cart is Empty</h3>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <!-- subtotal -->
                    <div class="d-flex mb-5">
                        <?php
                        global $con;
                        $get_ip_add = getIPAddress();
                        $cart_query =   "SELECT * FROM cart_details where ip_address='$get_ip_add'";
                        $result_query = mysqli_query($con, $cart_query);
                        $result_count = mysqli_num_rows($result_query);
                        if ($result_count > 0) {
                            echo " <h4 class='px-3'>Subtotal: <strong class='text-danger'>$total</strong>
                        </h4>
                        <input type='submit' value='Continue Shopping' class='bg-secondary px-3 py-2 border-0 mx-3'
                        name='continue_shopping'>
                        <button class='bg-dark px-3 py-2 border-0'><a href='./users_area/checkout.php'
                        class='text-light text-decoration-none'>Checkout</a></button>";
                        } else {
                            echo "<input type='submit' value='Continue Shopping' class='bg-secondary px-3 py-2 border-0 mx-3'
                        name='continue_shopping'>";
                        }
                        if (isset($_POST['continue_shopping'])) {
                            echo "<script>window.open('index.php','_self')</script>";
                        }
                        ?>



                    </div>
            </div>
        </div>
        </form>

        <!-- function to remove item-->
        <?php
        function removeCartItem()
        {
            global $con;
            $get_ip_add = getIPAddress();
            if (isset($_POST['remove_cart'])) {
                foreach ($_POST['removeitem'] as $remove_id) {
                    $delete_product = "DELETE FROM cart_details where product_id='$remove_id' and ip_address='$get_ip_add'";
                    $result_delete = mysqli_query($con, $delete_product);
                    if ($result_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
        }

        //echo $removeItem = removeCartItem();
        removeCartItem();
        ?>



        <!-- last child -->
        <!-- include footer -->
        <?php
        include('./includes/footer.php');
        ?>

    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>