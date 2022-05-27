<?php
session_start();


if (isset($_POST['save_image'])) {

    if (isset($_SESSION['path'])) {
        unlink(realpath($_SESSION['path']));
        unset($_SESSION['path']);

        $id = $_POST['id'];
        $url = $_POST['image_url'];
        $name = $_POST['image_name'];
        $data = file_get_contents($url);
        $new =  '../../Frontend/Components/Images/Product_Images/';
        $pathToImage = $new . $name . 'Sell' . '.jpg';
        file_put_contents($pathToImage, $data);
        $_SESSION['zapisaneID'] = $id;
        $_SESSION['path'] = $pathToImage;
        header('Location: ../../Frontend/AdminMenu/editProduct.php?id=' . $id . '');
    }

    $id = $_POST['id'];
    $url = $_POST['image_url'];
    $name = $_POST['image_name'];
    $data = file_get_contents($url);
    $new =  '../../Frontend/Components/Images/Product_Images/';
    $pathToImage = $new . $name . 'Sell' . '.jpg';
    file_put_contents($pathToImage, $data);
    $_SESSION['zapisaneID'] = $id;
    $_SESSION['path'] = $pathToImage;
    header('Location: ../../Frontend/AdminMenu/editProduct.php?id=' . $id . '');
}

if (isset($_POST['upload_image'])) {

    require_once('../DB_Connection/dbConnect.php');

    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

    $id = $_POST['id'];
    $image = $_SESSION['path'];

    $Sql = "SELECT product_image FROM product_list WHERE id='$id'";
    $resultImage = $conn->query($Sql);
    $row = $resultImage->fetch_assoc();
    $product_image = $row['product_image'];
    unlink(realpath($product_image));


    $upload_image = "UPDATE product_list SET product_image='$image' WHERE id='$id'";
    if (mysqli_query($conn, $upload_image)) {
        unset($_SESSION['path']);
        unset($_SESSION['zapisaneID']);
        $_SESSION['wynikEdycji'] = '<div class="alert alert-success text-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img""><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div style="font-size:25px">
         Zdjęcie produktu zostało zmienione pomyślnie.
        </div>
        </div>';
    } else {
        $_SESSION['wynikEdycji'] = '<div class="alert alert-danger text-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img""><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div style="font-size:25px">
         Zaszedł błąd przy próbie zmiany zdjęcia produktu.
        </div>
        </div>';
    }
    unset($_SESSION["path"]);

    header('Location: ../../Frontend/AdminMenu/editProducts.php');
}
