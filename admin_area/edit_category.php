<?php
if (isset($_GET['edit_category'])) {
    $edit_category = $_GET['edit_category'];
    $get_category = "select * from categories where categories_id='$edit_category'";
    $run_category = mysqli_query($con, $get_category);
    $row_category = mysqli_fetch_assoc($run_category);
    $category_title = $row_category['categories_title'];
}

if(isset($_POST['edit_cat'])){
    $cat_title = $_POST['category_title'];

    $update_query = "update categories set categories_title='$cat_title' where categories_id='$edit_category'";
    $run_update = mysqli_query($con,$update_query);
    if($run_update){
        echo "<script>alert('Category has been updated!')</script>";
        echo "<script>window.open('./index.php?view_categories.php','_self')</script>";
    }
}
?>

<div class="container mt-3">
    <h1 class="text-center">Edit Category</h1>
    <form action="" method="POST" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category Title</label>
            <input type="text" name="category_title" id="category_title" class="form-control" required="required"
                value="<?php echo $category_title; ?>">
        </div>

        <input type="submit" value="Update Category" class="btn btn-secondary px-3 mb-3"
        name="edit_cat">
    </form>
</div>