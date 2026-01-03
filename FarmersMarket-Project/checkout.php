<?php
require "connection.php";

// Decode order data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_data'])) {
    $orderData = json_decode($_POST['order_data'], true);
    if ($orderData && isset($orderData['items']) && isset($orderData['total'])) {
        $items = $orderData['items'];
        $total = (int)$orderData['total'];
    } else {
        echo "Invalid order data.";
        exit;
    }
} else {
    echo "No order data received.";
    exit;
}

// VAT
$vat = round($total * 0.05);
$totalWithVat = $total + $vat;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <div class="header">
        <div class="logo">Checkout</div>
        <div class="nav-menu">
            <a href="index.php">Home</a>
        </div>
    </div>

    <div class="order-section">
        <h2>Order Summary</h2>
        <div class="order-items">
            <?php foreach ($items as $id => $item): ?>
                <p>
                    <?php echo htmlspecialchars($item['name']); ?>:
                    <?php echo htmlspecialchars($item['quantity']); ?> Unit<?php echo $item['quantity'] > 1 ? 's' : ''; ?> -
                    Ksh <?php echo number_format($item['price'] * $item['quantity']); ?>
                </p>
            <?php endforeach; ?>
        </div>


        <div class="payment-details">
            <h3>Payment Details</h3>
            <div class="payment-row">
                <span>Total:</span>
                <span>Ksh <?php echo number_format($total); ?></span>
            </div>
            <div class="payment-row">
                <span>VAT (5%):</span>
                <span>Ksh <?php echo number_format($vat); ?></span>
            </div>
            <hr>
            <div class="payment-row">
                <strong>Total Amount:</strong>
                <strong>Ksh <?php echo number_format($totalWithVat); ?></strong>
            </div>

            <div class="payment-method">
                <p>Payment Method</p>
                <select name="payment_method" required>
                    <option value="mpesa">Mobile Payment</option>
                    <option value="bank">Bank Transfer</option>
                    <option value="cash">Cash on Delivery</option>
                </select>
            </div>

            <button class="pay-button" type="button" onclick="alert('Order completed!')">Complete Order</button>
        </div>
    </div>
</body>
</html>
