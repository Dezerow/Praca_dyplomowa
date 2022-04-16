<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

    $ProductId = $_POST['id'];
    $result;

    if (isset($_POST['newProductName'])  && $_POST['newProductName'] !== "") {
        $ProductName = $_POST['newProductName'];
        $sql = "UPDATE product_list SET product_name='$ProductName' WHERE id='$ProductId' ";
        $result = $conn->query($sql);

        $_SESSION['wynikEdycji'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Zmiana nazwy produktu, wykonana pomyślnie.
        </div>
      </div>';
    } else if (isset($_POST['newProductContent']) && $_POST['newProductContent'] !== "") {
        $ProductContent = $_POST['newProductContent'];
        $sql = "UPDATE product_list SET product_description='$ProductContent' WHERE id='$ProductId' ";
        $result = $conn->query($sql);
        $_SESSION['wynikEdycji'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
         Opis produktu został zmieniony pomyślnie.
        </div>
      </div>';
    } else if (isset($_POST['newProductPrice']) && $_POST['newProductPrice'] !== 0 && $_POST['newProductPrice'] >= 0) {
        $ProductPrice = $_POST['newProductPrice'];
        $sql = "UPDATE product_list SET product_price='$ProductPrice' WHERE id='$ProductId' ";
        $result = $conn->query($sql);
        $_SESSION['wynikEdycji'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
         Cena produktu została zmieniona pomyślnie.
        </div>
      </div>';
    } else if (isset($_POST['newProductKey']) && $_POST['newProductKey'] !== "") {
        $newProductKey = $_POST['newProductKey'];
        $sql = "UPDATE product_list SET product_article='$newProductKey' WHERE id='$ProductId' ";
        $result = $conn->query($sql);
        $_SESSION['wynikEdycji'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
         Klucz produktu został zmieniony pomyslnie.
        </div>
      </div>';
    }






    header("Location: ../../Frontend/AdminMenu/editProducts.php");
}
