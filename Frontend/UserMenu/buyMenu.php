<?php
session_start();


require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
if (isset($_SESSION['user'])) {
    $userName = $_SESSION['user'];
    $sql = "SELECT * from users WHERE username='$userName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else if (isset($_SESSION['admin'])) {
    $userName = $_SESSION['admin'];
    $sql = "SELECT * from adminlist WHERE username='$userName'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}



if (isset($_POST['productId'])) {
    require_once('../../vendor/autoload.php');
    \Stripe\Stripe::setApiKey('sk_test_51L414PLj0T470Vgk33W932OrtwGaZZWHezqwUHt5SzIC7tHoLBFdlJ1FQ8pO8qGOfv2cvVy5SDP3og8cNAShilax00IdAtFlC4');

    $idZakupu = $_POST['productId'];
    $sqlProdukt = "SELECT * from product_list WHERE id='$idZakupu'";
    $resultProdukt = $conn->query($sqlProdukt);
    $rowProdukt = $resultProdukt->fetch_assoc();

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'PLN',
                'product_data' => [
                    'name' => '' . $rowProdukt['product_name'] . '',
                    'description' => '' . $rowProdukt['product_description'] . '',
                    'images' => ['http://drive.google.com/uc?export=view&id=1qfkv6ShkYvMq-o_ZKCY6iOEOYdPkqJM-'],

                ],
                'unit_amount' => ($rowProdukt['product_price'] * 100),
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/Praca_dyplomowa/Frontend/UserMenu/Transaction_completed.php',
        'cancel_url' => 'http://localhost/Praca_dyplomowa/Frontend/UserMenu/Transaction_failed.php',
    ]);
} else {
    if (count($_SESSION['userShoppingCart']) <= 0) {
        header('Location: ../UserMenu/shoppingCart.php');
    } else {
        require_once('../../vendor/autoload.php');
        \Stripe\Stripe::setApiKey('sk_test_51L414PLj0T470Vgk33W932OrtwGaZZWHezqwUHt5SzIC7tHoLBFdlJ1FQ8pO8qGOfv2cvVy5SDP3og8cNAShilax00IdAtFlC4');


        $ListaProduktow = '';
        foreach ($_SESSION['userShoppingCart'] as $singleProduct) {
            $sql = "SELECT * from product_list WHERE id='$singleProduct'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $ListaProduktow .=  $row['product_name'] . ', ';
        }

        $ar = array();
        $_SESSION['userShoppingCart'] = $ar;

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'PLN',
                    'product_data' => [
                        'name' => '' . $ListaProduktow . '',
                        'images' => ['http://drive.google.com/uc?export=view&id=1qfkv6ShkYvMq-o_ZKCY6iOEOYdPkqJM-'],

                    ],
                    'unit_amount' => ($_SESSION['CartTotalPrice'] * 100),
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://localhost/Praca_dyplomowa/Frontend/UserMenu/Transaction_completed.php',
            'cancel_url' => 'http://localhost/Praca_dyplomowa/Frontend/UserMenu/Transaction_failed.php',
        ]);
        $_SESSION['CartTotalPrice'] = 0;
    }
}
?>

<html>

<head>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <script>
        window.onload = function() {
            yourFunction(param1, param2);
        };
        var stripe = Stripe('pk_test_51L414PLj0T470VgkiAKWnObqK2dIomdOGWjZl7HS2EMNrdCiMnj0e9RWxvO6cexcJ4Mm73YInTOGTyUwCxnVW2TR00uz8SZYgd');
        stripe.redirectToCheckout({
            sessionId: "<?php echo $session->id; ?>"
        });
    </script>
</body>

</html>