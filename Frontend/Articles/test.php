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


        <?php
        require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
        $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


        $sql = "SELECT id, article_name, article_content, article_image from articles";
        $result = $conn->query($sql);

        ?>


        <div class="row py-5">

            <?php
            require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
            $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

            $i = 1;
            $loopvalue = $i + 3;

            while ($i <= $loopvalue) {


                $sql = "SELECT id, article_name, article_content, article_image, product_article from articles WHERE id='$i'";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();


                echo '
                    <div class="col-md-6 col-sm-12 mt-5">
                    <img src="' . $row['article_image'] . '" alt="" class="img-fluid mb-3 articlePhoto">
                    <h3>' . $row['article_name'] . '</h3>
                    <p id="hideLongText">' . $row['article_content'] . '</p>
                    <div style="margin-top: 10px; font-size: 15px">
                        <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php?data=' . $row['id'] . '" class="readSingleArticle">Czytaj dalej>>></a>
                    </div>
                    </div>';

                $i++;
            };

            ?>
        </div>

    </div>

    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>