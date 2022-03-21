<?php
session_start();


if (isset($_POST['save_image'])) {

    if (isset($_SESSION['path'])) {
        unlink($_SESSION['path']);
        unset($_SESSION['path']);

        $id = $_POST['id'];
        $url = $_POST['image_url'];
        $name = $_POST['image_name'];
        $data = file_get_contents($url);
        $new =  '../../Frontend/Components/Images/product_image_upload/';
        $pathToImage = $new . $name . '.jpg';
        file_put_contents($pathToImage, $data);
        $_SESSION['zapisaneID'] = $id;
        $_SESSION['path'] = $pathToImage;
        header('Location: ../../Frontend/AdminMenu/editProduct.php');
    }

    $id = $_POST['id'];
    $url = $_POST['image_url'];
    $name = $_POST['image_name'];
    $data = file_get_contents($url);
    $new =  '../../Frontend/Components/Images/product_image_upload/';
    $pathToImage = $new . $name . '.jpg';
    file_put_contents($pathToImage, $data);
    $_SESSION['zapisaneID'] = $id;
    $_SESSION['path'] = $pathToImage;
    header('Location: ../../Frontend/AdminMenu/editProduct.php');
}

if (isset($_POST['upload_image'])) {

    require_once('../DB_Connection/dbConnect.php');

    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

    $id = $_POST['id'];

    $image = file_get_contents($_SESSION['path']);


    $upload_image = "INSERT INTO articles(id, article_name, article_content, article_image, product_article )
     VALUES('', '', '', '$image', '') WHERE id='$id'";
    $result = $conn->query($upload_image);
}
