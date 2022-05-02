<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {


  if (isset($_POST['save_image'])) {

    if (isset($_SESSION['path'])) {
      unlink($_SESSION['path']);
      unset($_SESSION['path']);

      $url = $_POST['image_url'];
      $name = $_POST['image_name'];
      $data = file_get_contents($url);
      $new =  '../../Frontend/Components/Images/Product_Images/';
      $pathToImage = $new . $name . 'Sell' . '.jpg';
      file_put_contents($pathToImage, $data);
      $_SESSION['path'] = $pathToImage;
      header('Location: ../../Frontend/AdminMenu/addOffer.php');
    }

    $url = $_POST['image_url'];
    $name = $_POST['image_name'];
    $data = file_get_contents($url);
    $new =  '../../Frontend/Components/Images/Product_Images/';
    $pathToImage = $new . $name . 'Sell' . '.jpg';
    file_put_contents($pathToImage, $data);
    $_SESSION['path'] = $pathToImage;
    header('Location: ../../Frontend/AdminMenu/addOffer.php');
  }

  if (isset($_POST['addToDatabase'])) {
    $ProductName = $_POST['ProductName'];
    $ProductDesc = $_POST['ProductDesc'];
    $ProductPrice = $_POST['ProductPrice'];
    $ProductKey = $_POST['ProductKey'];
    $image = $_SESSION['path'];



    $sql = "INSERT INTO product_list(id, product_name, product_description, product_price, product_image, product_article)
      VALUES ('', '$ProductName', '$ProductDesc', '$ProductPrice', '$image', '$ProductKey')";
    $result = mysqli_query($conn, $sql);

    $_SESSION['adminAddUser'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
          <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <div>
            Produkt został dodany do naszej oferty.
          </div>
        </div>';

    unset($_SESSION['path']);


    header("Location: ../../Frontend/AdminMenu/adminMenu.php");
  }
}
