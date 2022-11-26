<?php
if (isset($_GET['edit_brands'])) {
    $edit_brand = $_GET['edit_brands'];
    $get_brand = "select * from brands where brand_id='$edit_brand'";
    $run_brand = mysqli_query($con, $get_brand);
    $row_brand = mysqli_fetch_assoc($run_brand);
    $brand_title = $row_brand['brand_title'];
}

if(isset($_POST['edit_brands'])){
    $brand_title = $_POST['brand_title'];

    $update_query = "update brands set brand_title='$brand_title' where brand_id='$edit_brand'";
    $run_update = mysqli_query($con,$update_query);
    if($run_update){
        echo "<script>alert('Brand has been updated!')</script>";
        echo "<script>window.open('./index.php?view_brands.php','_self')</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">Edit Brand</h1>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-label">Brand Title</label>
            <input type="text" name="brand_title" id="brand_title" class="form-control" required="required"
                value="<?php echo $brand_title; ?>">
        </div>

        <input type="submit" value="Update Brand" class="btn btn-secondary px-3 mb-3"
        name="edit_brands">
    </form>
</div>