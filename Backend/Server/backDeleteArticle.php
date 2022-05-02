
<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
$ArticleId = $_POST['id'];

if (isset($_POST['DeleteProduct'])) {

    $Sqlshowname = "Select article_name FROM articles WHERE id='$ArticleId'";
    $resultName = $conn->query($Sqlshowname);
    $row = $resultName->fetch_assoc();
    $articleName = $row['article_name'];

    $sql = "DELETE FROM articles WHERE id='$ArticleId'";
    $result = $conn->query($sql);
    $_SESSION['zmianaArtykulu'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    <div>
        Produkt o nazwie "' . $articleName . '" został usunięty.
    </div>
</div>';
}

header("Location: ../../Frontend/AdminMenu/editArticles.php");


?>