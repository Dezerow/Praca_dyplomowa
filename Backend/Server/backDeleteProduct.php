
<?php
session_start();

require_once('../DB_Connection/dbConnect.php');

$conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
$ProductId = $_POST['id'];

if (isset($_POST['DeleteProduct'])) {

    $Sqlshowname = "Select product_name,product_image FROM product_list WHERE id='$ProductId'";
    $resultName = $conn->query($Sqlshowname);
    $row = $resultName->fetch_assoc();
    $product_image = $row['product_image'];
    unlink(realpath($product_image));
    $productName = $row['product_name'];

    $sql = "DELETE FROM product_list WHERE id='$ProductId'";
    $result = $conn->query($sql);
    $_SESSION['wynikEdycji'] = '<div class="alert alert-success d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="20" height="20" role="img" aria-label="Danger:">
        <use xlink:href="#exclamation-triangle-fill" />
    </svg>
    <div>
        Produkt o nazwie "' . $productName . '" został usunięty.
    </div>
</div>';
}

header("Location: ../../Frontend/AdminMenu/editProducts.php");


?>