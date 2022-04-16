<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <?php
    require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
    $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);

    $articleID = $_GET["data"];
    $sql = "SELECT id, article_name, article_content, article_image, product_article from articles WHERE id='$articleID'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    ?>


    <div class="container py-5">
        <div class="d-flex justify-content-center mt-3">
            <img src="<?php echo $row['article_image'] ?>" id="mainPhoto" alt="" class="img-fluid mb-3 articlePhoto">
        </div>
        <h1 class="d-flex justify-content-center mt-3"><?php echo $row['article_name'] ?></h1>
        <div class="d-flex justify-content-center mt-3 card" id="break_word">
            <div class="card-body">
                <?php echo $row['article_content'] ?>
            </div>
        </div>
    </div>



    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>