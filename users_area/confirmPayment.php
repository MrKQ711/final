<!-- connect file -->
<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);
    $row_fetch = mysqli_fetch_assoc($result);
    $invoice_number = $row_fetch['invoice_number'];
    $amont_due = $row_fetch['amount_due'];
}

if(isset($_POST['confirm_payment'])){
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];
    $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode) 
    VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
    $result = mysqli_query($con, $insert_query);
    if($result){
        echo "<h3 class='text-center text-light'>Payment has been submitted successfully</h3>";
        echo "<script>window.open('profile.php?my_orders', '_self')</script>";
    }
    $update_orders = "UPDATE user_orders SET order_status = 'complete' WHERE order_id = $order_id";
    $result_order = mysqli_query($con, $update_orders);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- // bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- // font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-dark">Confirm Payment</h1>
        <form action="" method="POST">
            <div class="form-outline mb-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_number"
                    value="<?php echo  $invoice_number  ?>">
            </div>

            <div class="form-outline mb-4 text-center w-50 m-auto">
                <label for="" class="text-dark">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amont_due ?>">
            </div>

            <div class="form-outline mb-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto">
                    <option>Select Payment Mode</option>
                    <option>UPI</option>
                    <option>NetBanking</option>
                    <option>PayPal</option>
                    <option>Cash on Delivery</option>
                    <option>Pay Offline</option>
                </select>
            </div>

            <div class="form-outline mb-4 text-center w-50 m-auto">
                <input type="submit" class="bg-light py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>

</body>

</html>