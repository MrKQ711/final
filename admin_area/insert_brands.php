<?php
include('../includes/connect.php');
if (isset($_POST['insert_brand'])) {

    // select data from database
    $select_query = "SELECT * FROM brands where brand_title = '$_POST[brand_title]'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);
    if ($number > 0) {
        echo "<script>alert('Brand already exist, please try another one!')</script>";
        echo "<script>window.open('index.php?view_cats','_self')</script>";
    } else {
        // insert data into database
        $brand_title = $_POST['brand_title'];
        $inser_query = "INSERT INTO brands (brand_title) VALUES ('$brand_title')";
        $result = mysqli_query($con, $inser_query);
        if ($result) {
            echo "<script>alert('Brand has been inserted!')</script>";
            echo "<script>window.open('index.php?insert_category', '_self')</script>";
        }
    }
}
?>

<h2 class="text-center">Insert Brands</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert Brands" aria-label="Username" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">

        <input type="submit" class=" bg-info border-0 p-2 mg-3" name="insert_brand" value="Insert Brands">

    </div>
</form>