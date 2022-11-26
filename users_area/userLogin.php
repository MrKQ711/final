<!-- connect file -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- // bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- // font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        overflow-x: hidden;
    }
    </style>
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- username field -->
                    <div class="form-outline mb-4">
                        <label for="user_username" class="form-label">Username</label>
                        <input type="text" id="user_username" class="form-control" placeholder="Enter your username"
                            autocomplete="off" required="required" name="user_username" />
                    </div>
                    <!-- password field -->
                    <div class="form-outline mb-4">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="Enter your password"
                            autocomplete="off" required="required" name="user_password" />
                    </div>

                    <!-- regis -->
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Login" class="bg-secondary py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ? <a href="userRegistration.php"
                                class="text-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['user_login'])) {
    global $con;
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];
    //echo $user_password;
    $select_query = "SELECT * FROM user_table WHERE username = '$user_username'";
    $select_query_result = mysqli_query($con, $select_query);
    $total_rows_fetched = mysqli_num_rows($select_query_result);
    $row_data = mysqli_fetch_assoc($select_query_result);
    $user_ip =  getIPAddress();

    // cart item
    $select_query_cart = "SELECT * FROM cart_details WHERE ip_address = '$user_ip'";
    $select_cart = mysqli_query($con, $select_query_cart);
    $total_rows = mysqli_num_rows($select_cart);
    if ($total_rows_fetched > 0) {
        $_SESSION['username'] = $user_username;
        if (password_verify($user_password, $row_data['user_password'])) {
            if ($total_rows_fetched == 1 and $total_rows == 0) {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('profile.php', '_self')</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('payment.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Password is incorrect')</script>";
        }
    } else {
        echo "<script>alert('Account do not exist')</script>";
    }
}

?>