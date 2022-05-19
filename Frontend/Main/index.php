<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Main/index.css" rel="stylesheet" type="text/css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container mt-5 ">
        <img class="mypicture" src="../Components/Images/Static_Images/LogoMin.jpg" alt="..." id="upperPhoto">
    </div>


    <?php
    require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

    $sqlDayProduct = "SELECT * from product_list WHERE id='5'";
    $resultDayProduct = $conn->query($sqlDayProduct);
    $rowDayProduct = $resultDayProduct->fetch_assoc();

    $sqlDayArticle = "SELECT * from articles WHERE id='5'";
    $resultDayArticle = $conn->query($sqlDayArticle);
    $rowDayArticle = $resultDayArticle->fetch_assoc();

    ?>

    <div class="container mt-5" id="produktyDnia">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="d-flex justify-content-center" style="font-size: 30px">
                        Produkt dnia
                    </div>
                    <a href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.php?data=<?php echo $rowDayProduct['id'] ?>" class="links mb-5">
                        <div class="d-flex justify-content-center" style="font-size: 25px">
                            <?php echo $rowDayProduct['product_name'] ?>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img src="<?php echo $rowDayProduct['product_image'] ?>" class="img-fluid" alt="..." id="upperPhoto">
                        </div>
                        <div class="d-flex justify-content-center" style="font-size: 25px;">Cena: <?php echo $rowDayProduct['product_price'] ?> zł</div>
                    </a>
                </div>

            </div>
            <div class="col-md-8 col-sm-12 card">
                <div class="d-flex justify-content-center" style="font-size: 30px">
                    Artykuł dnia
                </div>
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $rowDayArticle['article_image'] ?>" class="img-fluid mt-2" id="dayArticleImage" alt="...">
                </div>
                <div style="font-size: 25px" class="d-flex justify-content-center">
                    <?php echo $rowDayArticle['article_name'] ?>
                </div>
                <div class="hideLongText mt-2" style="font-size: 22px">
                    <?php echo $rowDayArticle['article_content'] ?>
                </div>
                <div class="d-flex justify-content-center" style="font-size: 20px">
                    <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?data=<?php echo $rowDayArticle['id'] ?>">Czytaj dalej>>></a>
                </div>
            </div>
        </div>
    </div>

    <?php

    $sqlBestSeller1 = "SELECT * from product_list WHERE id='5'";
    $sqlBestSeller2 = "SELECT * from product_list WHERE id='2'";
    $sqlBestSeller3 = "SELECT * from product_list WHERE id='4'";
    $resultBestSeller1 = $conn->query($sqlBestSeller1);
    $resultBestSeller2 = $conn->query($sqlBestSeller2);
    $resultBestSeller3 = $conn->query($sqlBestSeller3);
    $rowBestSeller1 = $resultBestSeller1->fetch_assoc();
    $rowBestSeller2 = $resultBestSeller2->fetch_assoc();
    $rowBestSeller3 = $resultBestSeller3->fetch_assoc();


    ?>

    <div class="container mt-5" id="popularneProdukty">
        <div class="mt-5 d-flex justify-content-center" style="font-size: 30px">Najchętniej kupowane produkty</div>
        <div class="row mt-3">
            <div class="col-md-4 col-sm-12 card mt-3">
                <a href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.php?data=<?php echo $rowBestSeller1['id'] ?>" class="links">

                    <div style="font-size: 25px" class="d-flex justify-content-center">
                        <?php echo $rowBestSeller1['product_name'] ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $rowBestSeller1['product_image'] ?>" class="img-fluid bestsellers mt-2" alt="...">
                    </div>
                    <div class="d-flex justify-content-center" style="font-size: 25px;"><?php echo $rowBestSeller1['product_price'] ?> zł</div>
                </a>
            </div>

            <div class="col-md-4 col-sm-12 card mt-3">
                <a href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.php?data=<?php echo $rowBestSeller2['id'] ?>" class="links">
                    <div style="font-size: 25px" class="d-flex justify-content-center">
                        <?php echo $rowBestSeller2['product_name'] ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $rowBestSeller2['product_image'] ?>" class="img-fluid bestsellers mt-2" alt="...">
                    </div>
                    <div class="d-flex justify-content-center" style="font-size: 25px;"><?php echo $rowBestSeller2['product_price'] ?> zł</div>
                </a>
            </div>

            <div class="col-md-4 col-sm-12 card mt-3">
                <a href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.php?data=<?php echo $rowBestSeller3['id'] ?>" class="links">
                    <div style="font-size: 25px" class="d-flex justify-content-center">
                        <?php echo $rowBestSeller3['product_name'] ?>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="<?php echo $rowBestSeller3['product_image'] ?>" class="img-fluid bestsellers mt-2" alt="...">
                    </div>
                    <div class="d-flex justify-content-center" style="font-size: 25px;"><?php echo $rowBestSeller3['product_price'] ?> zł</div>
                </a>
            </div>
        </div>
    </div>

    <?php

    $sqlBestArticle1 = "SELECT * from articles WHERE id='7'";
    $sqlBestArticle2 = "SELECT * from articles WHERE id='1'";
    $resultBestArticle1 = $conn->query($sqlBestArticle1);
    $resultBestArticle2 = $conn->query($sqlBestArticle2);
    $rowBestArticle1 = $resultBestArticle1->fetch_assoc();
    $rowBestArticle2 = $resultBestArticle2->fetch_assoc();
    ?>

    <div class="container mt-5" id="popularneProdukty">
        <div class="mt-5 d-flex justify-content-center" style="font-size: 30px">Poszerz swoja wiedzę</div>
        <div class="row">
            <div class="col-md-6 col-sm-12 card mt-3">
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $rowBestArticle1['article_image'] ?>" class="img-fluid articlesImages mt-2" alt="...">
                </div>
                <div style="font-size: 25px" class="d-flex justify-content-center">
                    <?php echo $rowBestArticle1['article_name'] ?>
                </div>
                <div style="margin-top: 20px; font-size: 20px" class="hideLongText2Articles">
                    <?php echo $rowBestArticle1['article_content'] ?>
                </div>
                <div class="float-end" style="margin-top: 10px; font-size: 20px">
                    <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?data=<?php echo $rowBestArticle1['id'] ?>">Czytaj dalej>>></a>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 card mt-3">
                <div class="d-flex justify-content-center">
                    <img src="<?php echo $rowBestArticle2['article_image'] ?>" class="img-fluid articlesImages mt-2" alt="...">
                </div>
                <div style="font-size: 25px" class="d-flex justify-content-center">
                    <?php echo $rowBestArticle2['article_name'] ?>
                </div>
                <div style="margin-top: 20px; font-size: 20px" class="hideLongText2Articles">
                    <?php echo $rowBestArticle2['article_content'] ?>
                </div>
                <div class="float-end" style="margin-top: 10px; font-size: 20px">
                    <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?data=<?php echo $rowBestArticle2['id'] ?>">Czytaj dalej>>></a>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5" id="popularneProdukty" style="margin-bottom: 200px">
        <h1 class="d-flex justify-content-center mt-5">Krótko o nas</h1>
        <div class="mt-4" id="shopDesc">
            Jesteśmy firmą zajmującą się od wielu lat pszczelarstwem, jest to nasza pasja jak i praca. Oferujemy produkty najwyższej jakości, wytworzone przez naszych pszczelarzy z wieloletnim doświadczeniem.
            Na naszej witrynie internetowej możesz również poszerzyć swoją więdzę o informacje na temat artykułów prozdrowotnych. Oferujemy alternatywne rozwiązania na złe samopoczucie, za pomocą zdrowej żywności.
        </div>
    </div>


    <?php include "../Components/Footer/footer.php" ?>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>