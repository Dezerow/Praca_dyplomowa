<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Articles/articles.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container py-5">

        <div class="col-md-12 text-center">
            <h1>Poszerz swoją wiedzę dzięki naszym artykułom</h1>
        </div>

        <div class="row py-5">

            <?php
            require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
            $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

            // define how many results you want per page
            $results_per_page = 4;

            // find out the number of results stored in database
            $sql = 'SELECT * FROM product_list';
            $result = mysqli_query($conn, $sql);
            $number_of_results = mysqli_num_rows($result);


            // determine number of total pages available
            $number_of_pages = ceil($number_of_results / $results_per_page);



            // determine which page number visitor is currently on
            if (!isset($_GET['page'])) {
                $page = 1;
            } else {
                $page = $_GET['page'];
            }



            // determine the sql LIMIT starting number for the results on the displaying page
            $this_page_first_result = ($page - 1) * $results_per_page;



            // retrieve selected results from database and display them on page
            $sql = 'SELECT * FROM articles LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {



                echo '
                    <div class="col-md-6 col-sm-12 mt-5">
                    <img src="' . $row['article_image'] . '" alt="" class="img-fluid mb-3 articlePhoto">
                    <h3>' . $row['article_name'] . '</h3>
                    <p id="hideLongText">' . $row['article_content'] . '</p>
                    <div style="margin-top: 10px; font-size: 15px">
                        <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?data=' . $row['id'] . '" class="readSingleArticle">Czytaj dalej>>></a>
                    </div>
                    </div>';
            };

            // display the links to the pages
            $firstPage = 1;
            ?>

            <div class="mt-4">
                <nav aria-label="Page navigation example">
                    <ul class="pagination customFont">
                        <li class="page-item">
                            <a class="page-link" href="../../Frontend/Articles/articles.php?page=<?php
                                                                                                    if ($page - 1 > 0) {
                                                                                                        echo $page - 1;
                                                                                                    } else {
                                                                                                        echo $page = 1;
                                                                                                    }

                                                                                                    ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php


                        for ($page = 1; $page <= $number_of_pages; $page++) {
                            echo '<li class="page-item"><a class="page-link" href="../../Frontend/Articles/articles.php?page=' . $page . '">' . $page . '</a> </li> ';
                        }
                        $page = 1;
                        ?>

                        <li class="page-item">
                            <a class="page-link" href="../../Frontend/Articles/articles.php?page=<?php
                                                                                                    echo $page + 1;

                                                                                                    ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
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