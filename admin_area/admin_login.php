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
    <title>Admin Login</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    body {
        overflow: hidden;
    }
    </style>

</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../image/admin1.jpg" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-5">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username"
                            required="required" class="form-control">
                    </div>


                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            required="required" class="form-control">
                    </div>

                    <div>
                        <input type="submit" class="bg-secondary py-2 px-3 border-0" name="admin_login" value="Login">
                        <p class="small fw-bold mt-2 pt-1">Don't you have an account ? <a href="admin_registration.php"
                                class="link-danger">Register</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['admin_login'])) {
    global $con;
    $admin_name = $_POST['username'];
    $admin_password = $_POST['password'];
    //echo $user_password;
    $select_query = "SELECT * FROM admin_table WHERE admin_name = '$admin_name'";
    $select_query_result = mysqli_query($con, $select_query);
    $total_rows_fetched = mysqli_num_rows($select_query_result);
    $row_data = mysqli_fetch_assoc($select_query_result);

    


    if ($total_rows_fetched > 0) {
        $_SESSION['admin_name'] = $admin_name;
        if (password_verify($admin_password, $row_data['admin_password'])) {
            if ($total_rows_fetched == 1) {
                $_SESSION['admin_name'] = $admin_name;
                echo "<script>alert('Login successfully')</script>";
                echo "<script>window.open('index.php', '_self')</script>";
            } 
        } else {
            echo "<script>alert('Password is incorrect')</script>";
        }
    } else {
        echo "<script>alert('Account do not exist')</script>";
    }
}

?>