<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
  die("Połączenie zakończyło się błędem: " . $conn->connect_error);
} else {

  $ArticleId = $_POST['id'];
  $result;

  if (isset($_POST['newArticleName'])  && $_POST['newArticleName'] !== "") {
    $ArticleName = $_POST['newArticleName'];
    $sql = "UPDATE articles SET article_name='$ArticleName' WHERE id='$ArticleId' ";
    $result = $conn->query($sql);

    $_SESSION['zmianaArtykulu'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Zmiana nazwy artykułu, wykonana pomyślnie.
        </div>
      </div>';
  } else if (isset($_POST['newArticleContent']) && $_POST['newArticleContent'] !== "") {
    $ArticleContent = $_POST['newArticleContent'];
    $sql = "UPDATE articles SET article_content='$ArticleContent' WHERE id='$ArticleId' ";
    $result = $conn->query($sql);
    $_SESSION['zmianaArtykulu'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
        <div>
          Treść artykułu została zmieniona pomyślnie.
        </div>
      </div>';
  }

  header("Location: ../../Frontend/AdminMenu/editArticles.php");
}
