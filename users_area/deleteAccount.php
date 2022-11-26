<h3 class="text-dark mb-4">
    Delete Account
</h3>
<form action="" method="POST" class="mt-5">
    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="delete" value="Delete Account">
    </div>

    <div class="form-outline mb-4">
        <input type="submit" class="form-control w-50 m-auto" name="dont_delete" value="Dont't Delete Account">
    </div>
</form>

<?php
    $username_session =  $_SESSION['username'];
    if(isset($_POST['delete'])){
        $delete_query = "DELETE FROM user_table WHERE username = '$username_session'";
        $result_query = mysqli_query($con, $delete_query);
        if($result_query){
           session_destroy();
           echo "<script>alert('Your account has been deleted!')</script>";
           echo "<script>window.open('../index.php', '_self')</script>";
        }
    }

    if(isset($_POST['dont_delete'])){
        echo "<script>window.open('profile.php', '_self')</script>";
    }
?>