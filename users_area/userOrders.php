<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <!-- // bootstrap CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- // font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    $username = $_SESSION['username'];
    $get_user = "SELECT * FROM user_table WHERE username='$username'";
    $result = mysqli_query($con, $get_user);
    $row_fetch = mysqli_fetch_assoc($result);
    $user_id = $row_fetch['user_id'];

    ?>
    <h3 class="text-dark">All my Orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-secondary">
            <tr>
                <th>SL no</th>
                <th>Amount Due</th>
                <th>Total product</th>
                <th>Invoice number</th>
                <th>Date</th>
                <th>Complete / Incomplete</th>
                <th>Status</th>
            </tr>


        </thead>
        <tbody class="">
            <?php
            $get_order_detail = "SELECT * FROM user_orders WHERE user_id='$user_id'";
            $result_orders = mysqli_query($con, $get_order_detail);
            $number = 1;
            while ($row_order = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row_order['order_id'];
                $amount_due = $row_order['amount_due'];
                $total_product = $row_order['total_products'];
                $invoice_number = $row_order['invoice_number'];
                $order_status = $row_order['order_status'];
                if ($order_status == 'pending') {
                    $order_status = 'Incomplete';
                } else {
                    $order_status = 'Complete';
                }
                $order_date = $row_order['order_date'];
                echo "<tr>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_product</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
            <?php
                if ($order_status == 'Complete') {
                    echo "<td>Paid</td>";
                } else {
                    echo "<td><a href = 'confirmPayment.php?order_id=$order_id' class = 'text-dark'>Confirm</a></td>
                    </tr>";
                }
                $number++;
            }
            ?>


        </tbody>
    </table>
</body>

</html>