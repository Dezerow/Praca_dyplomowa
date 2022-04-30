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

    <div class="container" id="MainContent">
        <h2 class="d-flex justify-content-center" style="margin-top:40px">Prozdrowotne produkty pszczele</h2>



        <div class="row mt-5">

            <?php
            require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
            $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);
            if (isset($_POST["search"])) {
                $search = $_POST["search"];
            } else if (isset($_GET["search"])) {
                $search = $_GET["search"];
            }

            $results_per_page = 6;

            $sql = "SELECT * FROM product_list WHERE product_name LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            $number_of_results = mysqli_num_rows($result);


            $number_of_pages = ceil($number_of_results / $results_per_page);

            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }

            $this_page_first_result = ($page - 1) * $results_per_page;

            $sql = "SELECT * from product_list WHERE product_name LIKE '%$search%' ORDER BY product_name ASC LIMIT $this_page_first_result,$results_per_page";
            $result = $conn->query($sql);

            if (mysqli_num_rows($result) > 0) {
                for ($a = 0; $a < mysqli_num_rows($result); $a++) {
                    $row = $result->fetch_assoc();
                    echo '
                 <div class="col-4">
                 <div class="card border-0 bg-light text-center">
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
            }

            $firstPage = 1;

            ?>

            <div class="mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination customFont">
                        <!--   
                    <li class="page-item">
                            <a class="page-link" href="../../Frontend/SearchResults/SearchResults.php?search=<?php echo $search; ?>&page=<?php
                                                                                                                                            if ($page - 1 > 0) {
                                                                                                                                                echo $page - 1;
                                                                                                                                            } else {
                                                                                                                                                echo $page = 1;
                                                                                                                                            }

                                                                                                                                            ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                                                                                                                                        -->
                        <?php


                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            echo '<li class="page-item"><a class="page-link" href="../../Frontend/SearchResults/SearchResults.php?page=' . $page . '&search=' . $search . '">' . $page . '</a> </li> ';
                        }
                        $page = 1;
                        ?>

                        <!--     <li class="page-item">
                            <a class="page-link" href="../../Frontend/SearchResults/SearchResults.php?search=<?php echo $search; ?>&page=<?php
                                                                                                                                            echo $page + 1;

                                                                                                                                            ?>'" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>-->
                    </ul>
                </nav>
            </div>




        </div>
    </div>






    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>