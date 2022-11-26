<?php

    if(isset($_GET['delete_product'])){
        $delete_id = $_GET['delete_product'];

        // delete product from products table
        $delete_product = "delete from products where product_id='$delete_id'";
        $run_delete = mysqli_query($con, $delete_product);
        if($run_delete){
            echo "<script>alert('Product has been deleted!')</script>";
            echo "<script>window.open('./index.php','_self')</script>";
        }
    }

?>