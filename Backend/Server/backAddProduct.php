<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

    $ProductName = $_POST['ProductName'];
    $ProductDesc = $_POST['ProductDesc'];
    $ProductPrice = $_POST['ProductPrice'];


    $sql = "INSERT INTO product_list(id, product_name, product_description, product_price, product_image, product_article)
    VALUES ('', '$ProductName', '$ProductDesc', '$ProductPrice', '', '')";
    $result = mysqli_query($conn, $sql);

    $_SESSION['adminAddUser'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Produkt został dodany do naszej oferty.
        </div>
      </div>';


    header("Location: ../../Frontend/AdminMenu/adminMenu.php");
}
