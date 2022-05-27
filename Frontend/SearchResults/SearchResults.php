<!DOCTYPE html>
<html lang="PL">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />

</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container" id="MainContent">
        <h2 class="d-flex justify-content-center" style="margin-top:40px">Prozdrowotne produkty pszczele</h2>



        <?php
        if (isset($_GET['searchCategory'])) {
            $searchCat = $_GET['searchCategory'];
        }


        if ($searchCat === 'Products') {
        ?>
            <link href="../../../Praca_dyplomowa/Frontend/ProductList/productList.css" rel="stylesheet" type="text/css" />

            <div class="row mt-5">

                <?php
                require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
                $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];
                }


                if (preg_match("/{$search}/i", "Miód")) {
                    $sql = "SELECT * FROM product_list WHERE product_type='Miód' || product_type='Przetwory' AND product_name LIKE '%$search%'";
                } else {
                    $sql = "SELECT * FROM product_list WHERE product_name LIKE '%$search%'";
                }
                $result = mysqli_query($conn, $sql);
                $number_of_products = mysqli_num_rows($result);

                $max_results_per_page = 6;
                $page_amount = ceil($number_of_products / $max_results_per_page);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $this_page_first_result = ($page - 1) * $max_results_per_page;

                if (preg_match("/{$search}/i", "Miód")) {
                    $sql = "SELECT * FROM product_list WHERE product_type='Miód' || product_type='Przetwory' AND product_name LIKE '%$search%' ORDER BY product_name ASC LIMIT $this_page_first_result,$max_results_per_page ";
                } else {
                    $sql = "SELECT * from product_list WHERE product_name LIKE '%$search%' ORDER BY product_name ASC LIMIT $this_page_first_result,$max_results_per_page";
                }

                $result = $conn->query($sql);

                if (mysqli_num_rows($result) > 0) {
                    for ($a = 0; $a < mysqli_num_rows($result); $a++) {
                        $row = $result->fetch_assoc();
                        echo '
                 <div class="col-4">
                 <div class="card border-0 bg-light text-center productsFromDatabase">
                     <a href="../../../Praca_dyplomowa/Frontend/ProductList/singleProduct.php?data=' .  $row['id'] . '" class="Products">
                         <div class="d-flex justify-content-center card-body">
                             <img src="' .  $row['product_image'] . '" class="img-fluid" alt="...">
                         </div>
                         <h6 class="card-body">' . $row['product_name'] . '</h6>
                         <p>' . $row['product_price'] . ' zł</p>
                     </a>
                 </div>
                 </div>';
                    }
                } else if (mysqli_num_rows($result) <= 0) {
                    echo '<h2 style="color:red; text-align: center; margin-top: 7%">Brak wyników wyszukiwania</h2>';
                }

                $firstPage = 1;

                ?>

                <div class="mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination customFont">
                            <?php
                            for ($page = 1; $page <= $page_amount; $page++) {
                                echo '<li class="page-item"><a class="page-link" href="../../Frontend/SearchResults/SearchResults.php?page=' . $page . '&search=' . $search . '&searchCategory=' . $searchCat . '">' . $page . '</a> </li> ';
                            }
                            $page = 1;
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>


        <?php
        } else if ($searchCat === 'Articles') {
        ?>

            <link href="../../../Praca_dyplomowa/Frontend/Articles/articles.css" rel="stylesheet" type="text/css" />

            <div class="row mt-5">

                <?php
                require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
                $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
                if (isset($_GET["search"])) {
                    $search = $_GET["search"];
                }

                $max_results_per_page = 4;

                $sql = "SELECT * FROM articles WHERE article_name LIKE '%$search%'";
                $result = mysqli_query($conn, $sql);
                $number_of_articles = mysqli_num_rows($result);


                $page_amount = ceil($number_of_articles / $max_results_per_page);

                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $this_page_first_result = ($page - 1) * $max_results_per_page;

                $sql = "SELECT * from articles WHERE article_name LIKE '%$search%' ORDER BY article_name ASC LIMIT $this_page_first_result,$max_results_per_page";
                $result = $conn->query($sql);

                if (mysqli_num_rows($result) > 0) {
                    for ($a = 0; $a < mysqli_num_rows($result); $a++) {
                        $row = $result->fetch_assoc();
                        echo '
                 <div class="col-6">
                 <img src="' . $row['article_image'] . '" alt="" class="img-fluid mb-3 articlePhoto">
                 <h3>' . $row['article_name'] . '</h3>
                 <p id="hideLongText">' . $row['article_content'] . '</p>
                 <div style="margin-top: 10px; font-size: 15px">
                     <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?data=' . $row['id'] . '" class="readSingleArticle">Czytaj dalej>>></a>
                 </div>
                 </div>';
                    }
                } else if (mysqli_num_rows($result) <= 0) {
                    echo '<h2 style="color:red; text-align: center; margin-top: 7%">Brak wyników wyszukiwania</h2>';
                }

                $firstPage = 1;

                ?>

                <div class="mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination customFont">
                            <?php
                            for ($page = 1; $page <= $page_amount; $page++) {
                                echo '<li class="page-item"><a class="page-link" href="../../Frontend/SearchResults/SearchResults.php?page=' . $page . '&search=' . $search . '&searchCategory=' . $searchCat . '">' . $page . '</a> </li> ';
                            }
                            $page = 1;
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>

        <?php

        } ?>


    </div>



    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>