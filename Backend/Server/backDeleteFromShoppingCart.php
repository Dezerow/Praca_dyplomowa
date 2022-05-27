<?php
session_start();

require_once('../DB_Connection/dbConnect.php');
$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

$productId = $_POST['id'];

foreach ($_SESSION['userShoppingCart'] as $singleProduct) {
    $sql = "SELECT * from product_list WHERE id='$singleProduct'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['id'] === $productId) {
        $_SESSION['CartTotalPrice'] -= $row['product_price'];
        $key = array_search($productId, $_SESSION['userShoppingCart']);
        unset($_SESSION['userShoppingCart'][$key]);
    }
}

header("Location: ../../Frontend/UserMenu/shoppingCart.php");
