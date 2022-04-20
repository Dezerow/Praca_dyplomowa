<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.css" rel="stylesheet" type="text/css" />

</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <?php
    require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

    $productId = $_GET["data"];
    $sql = "SELECT * from product_list WHERE id='$productId'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>


    <div class="container" id="MainContent">
        <div class="row" style="margin-top:50px">
            <div class="col-md-6 col-sm-12">
                <img src="<?php echo $row['product_image'] ?>" class="img-fluid" id="BigPhoto">
            </div>
            <div class="col-md-6 col-sm-12 text-left">
                <h2 class="mt-5"><?php echo $row['product_name'] ?></h2>
                <h5 class="mt-4"><?php echo $row['product_description'] ?></h5>
                <h5 class="mt-3"><a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?dataKey=<?php echo $row['product_article']; ?>">W celu większej ilości informacji zalecamy przeczytać artykuł</a></h5>
                <h4 class="mt-5" id="price">Cena: <?php echo $row['product_price'] ?> zł</h4>

                <a href='../ProductList/singleProduct.php?data=<?php echo $productId ?>&addCart="teast"'>
                    <button class="btn btn-primary mt-4" type="submit" style="height: 60px; width:200px; font-size: 18px">Dodaj do koszyka</button>
                </a>
                <a href='../UserMenu/buyMenu.php?data=<?php echo $productId ?>'>
                    <button class="btn btn-success mt-4" style="height: 60px; width:200px; font-size: 18px">Kup teraz</button>
                </a>
            </div>
        </div>
    </div>
    </div>


    <?php

    if (isset($_GET['addCart'])) {
        if (count($_SESSION['userShoppingCart']) == 0) {
            $ar = array();
            $val = $row['id'];
            array_push($ar, $val);
            $_SESSION['userShoppingCart'] = $ar;
            print_R($_SESSION['userShoppingCart']);
        } else {
            $val = $row['id'];
            if (end($_SESSION['userShoppingCart']) !== $val) {
                array_push($_SESSION['userShoppingCart'], $val);
                print_R($_SESSION['userShoppingCart']);
            }
        }
    }
    ?>



    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>