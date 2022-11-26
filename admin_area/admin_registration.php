<!-- connect file -->
<?php
include('../includes/connect.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
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
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../image/admin.jpg" alt="Admin Registration" class="img-fluid">
            </div>

            <div class="col-lg-6 col-xl-5">
                <form action="" method="POST">
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username"
                            required="required" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" placeholder="Enter your email" required="required"
                            class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            required="required" class="form-control">
                    </div>

                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Enter your confirm_password" required="required" class="form-control">
                    </div>

                    <div>
                        <input type="submit" class="bg-secondary py-2 px-3 border-0" name="admin_registration"
                            value="Register">
                        <p class="small fw-bold mt-2 pt-1">Do you already have an account ? <a href="admin_login.php"
                                class="link-danger">Login</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!-- php code for register-->
<?php
if (isset($_POST['admin_registration'])) {
    $admin_name = $_POST['username'];
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    // if(isValidPassword($password)){
    //     $user_password = password_hash($user_password, PASSWORD_DEFAULT);
    // } else {
    //     echo "Password must be at least 8 characters and must contain at least one lower case letter, one upper case letter, one digit, and one special character.";
    // }
    
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
    $confirm_admin_password = $_POST['confirm_password'];

    // check if password and confirm password are same
    // select query
    $select_query = "SELECT * FROM admin_table WHERE admin_name = '$admin_name' or admin_email = '$admin_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0) {
        echo "<script>alert('Username or Email already exists')</script>";
    } else if ($admin_password != $confirm_admin_password) {
        echo "<script>alert('Passowrd do not match')</script>";
    } else if (isValidEmail($admin_email) == false){
        echo "<script>alert('Email is not valid')</script>";
    } else if (isValidUsername($admin_name) == false){
        echo "<script>alert('Username is not valid')</script>";
    }
    else {
        // insert query
        $insert_query = "INSERT INTO 
    admin_table (admin_name,admin_email, admin_password) 
    VALUES ('$admin_name','$admin_email','$hash_password')";
        $sql_execute = mysqli_query($con, $insert_query);
        if ($sql_execute) {
            echo "<script>alert('Admin Registration Successful')</script>";
            echo "<script>window.location.href='admin_login.php'</script>";
        } else {
            echo "<script>alert('Admin Registration Failed')</script>";
        }
        // if ($sql_execute) {
        //     echo "<script>alert('Registration successful')</script>";
        // } else {
        //     die("Error: " . mysqli_error($con));
        // }
    }
}
?>