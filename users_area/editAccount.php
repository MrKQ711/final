<?php
if (isset($_GET['edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM user_table WHERE username = '$user_session_name'";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $username = $row_fetch['username'];
    $user_email = $row_fetch['user_email'];
    $user_address = $row_fetch['user_address'];
    $user_mobile = $row_fetch['user_mobile'];

    if (isset($_POST['user_update'])) {
        $update_id = $user_id;
        $username = $_POST['user_username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // update query
        $update_data = "UPDATE user_table SET username = '$username', user_email = '$user_email', user_address = '$user_address', 
        user_mobile = '$user_mobile', user_image = '$user_image' WHERE user_id = '$update_id'";

        $result_query_update = mysqli_query($con, $update_data);
        if ($result_query_update) {
            echo "<script>alert('Account updated successfully')</script>";
            echo "<script>window.open('logout.php','_self')</script>";
        } else {
            echo "<script>alert('Account not updated')</script>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <!-- // bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- // font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .edit_image {
        width: 100px;
        height: 100px;
        object-fit: contain;
    }
    </style>
</head>

<body>
    <h3 class="text-success mb-4">Edit Account</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php
                                                                        echo  $username
                                                                        ?>" name="user_username">
        </div>

        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" value="<?php
                                                                        echo  $user_email
                                                                        ?>" name="user_email">
        </div>

        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_images/<?php echo $user_image ?>" alt="" class="edit_image">
        </div>

        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php
                                                                        echo  $user_address
                                                                        ?>" name="user_address">
        </div>

        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php
                                                                        echo  $user_mobile
                                                                        ?>" name="user_mobile">
        </div>

        <input type="submit" value="Update" class="bg-secondary py-2 px-3 border-0" name="user_update">
    </form>
</body>

</html>