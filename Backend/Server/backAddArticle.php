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
      $new =  '../../Frontend/Components/Images/Article_Images/';
      $pathToImage = $new . $name . 'Article' . '.jpg';
      file_put_contents($pathToImage, $data);
      $_SESSION['path'] = $pathToImage;
      header('Location: ../../Frontend/AdminMenu/addArticle.php');
    }

    $url = $_POST['image_url'];
    $name = $_POST['image_name'];
    $data = file_get_contents($url);
    $new =  '../../Frontend/Components/Images/Product_Images/';
    $pathToImage = $new . $name . 'Article' . '.jpg';
    file_put_contents($pathToImage, $data);
    $_SESSION['path'] = $pathToImage;
    header('Location: ../../Frontend/AdminMenu/addArticle.php');
  }

  if (isset($_POST['addToDatabase'])) {
    $ArticleName = $_POST['ArticleName'];
    $ArticleContent = $_POST['ArticleContent'];
    $ArticleKey = $_POST['ArticleKey'];
    $image = $_SESSION['path'];

    $sql = "INSERT INTO articles(id, article_name, article_content, article_image, product_article)
    VALUES ('', '$ArticleName', '$ArticleContent', '$image', '$ArticleKey')";
    $result = mysqli_query($conn, $sql);

    $_SESSION['adminAddUser'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Artykuł został pomyślnie dodany do bazy.
        </div>
      </div>';

    unset($_SESSION['path']);



    header("Location: ../../Frontend/AdminMenu/adminMenu.php");
  }
}
