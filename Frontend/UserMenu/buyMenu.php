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
                    'images' => ['https://lh3.googleusercontent.com/QisFgl_O7wFmZqusq-IXeLae_a1-h6tsaxJmNfHG2w2zRQSi0mb4GuE8B7UjsdVkHDIzneY0O-WQEeTinRvmjCgLpLVYjh6Tv-4aWTEaXejXAJLhWlmNmCyBwLabp1tMIU3vb7JP_VzoeRu1KwVRU6mwLU7IlKR7WudLnP0wukly7fJ-UM5HmLjn7o6o4N7BpsuEcvQnUohiQxGad2_dHT59Hve6XAoLpvqHKBYBolXwvn8njmWa0-3IH6Ybej-DZjEFyFgoWmfq7u5YjJgXQQpbKbfM2ojn9HqGb87c1yljcpsjHGX4_3xi71RV_Rpu-skAmulfvDK0h8oefgXFYFOeFsZwA0ZIp_6mggue1oupaw20viGBfLu-9GnINGtTv6FmgNGa-lSZVcB-LdGw2x35FAm49JsJZ5Q_pusbdVWqWr1ki5BuLDwAOj5S2HruUBr7uh4YFyk35ZYe9bPXjDuJn1_PlvTAF_6De3wXchkn4fZQI5ItlyD6fv_d3-6XtEm-CWbBU0JU3eMVTj8JeBlkmPKK-DgkrOR0lxYeYErwfuRGFiEfsVg_0wyi9f0Nq813mRFJxsOWDAAjt-P4JA6KgyqXYdH64aHfy8IADDElkVtQtOyET81eb6vidUc9XcxszAgnss4y1q3hA5GXgUNb2j_ZA8RU3jKR6rlneUIbrGlnJmzOygk43zRhksBM0WqF1CYdR1fkxQwmRBXzvma5AWT_4kv29sXp6RQRqXl5tMq4bBaYBOSUlCT7kA=w612-h458-no?authuser=0'],

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
                    'images' => ['https://lh3.googleusercontent.com/QisFgl_O7wFmZqusq-IXeLae_a1-h6tsaxJmNfHG2w2zRQSi0mb4GuE8B7UjsdVkHDIzneY0O-WQEeTinRvmjCgLpLVYjh6Tv-4aWTEaXejXAJLhWlmNmCyBwLabp1tMIU3vb7JP_VzoeRu1KwVRU6mwLU7IlKR7WudLnP0wukly7fJ-UM5HmLjn7o6o4N7BpsuEcvQnUohiQxGad2_dHT59Hve6XAoLpvqHKBYBolXwvn8njmWa0-3IH6Ybej-DZjEFyFgoWmfq7u5YjJgXQQpbKbfM2ojn9HqGb87c1yljcpsjHGX4_3xi71RV_Rpu-skAmulfvDK0h8oefgXFYFOeFsZwA0ZIp_6mggue1oupaw20viGBfLu-9GnINGtTv6FmgNGa-lSZVcB-LdGw2x35FAm49JsJZ5Q_pusbdVWqWr1ki5BuLDwAOj5S2HruUBr7uh4YFyk35ZYe9bPXjDuJn1_PlvTAF_6De3wXchkn4fZQI5ItlyD6fv_d3-6XtEm-CWbBU0JU3eMVTj8JeBlkmPKK-DgkrOR0lxYeYErwfuRGFiEfsVg_0wyi9f0Nq813mRFJxsOWDAAjt-P4JA6KgyqXYdH64aHfy8IADDElkVtQtOyET81eb6vidUc9XcxszAgnss4y1q3hA5GXgUNb2j_ZA8RU3jKR6rlneUIbrGlnJmzOygk43zRhksBM0WqF1CYdR1fkxQwmRBXzvma5AWT_4kv29sXp6RQRqXl5tMq4bBaYBOSUlCT7kA=w612-h458-no?authuser=0'],

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