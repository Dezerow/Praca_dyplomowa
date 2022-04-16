<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../Praca_dyplomowa/Frontend/AdminMenu/AdminMenuCss/addArticle.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>


    <div class="container py-5">
        <h1 class="text-center">Panel zamieszczania artykułu do witryny</h1>
        <form method="POST" action="../../../Praca_dyplomowa/Backend/Server/backAddArticle.php">
            <div class="row">
                <div class="col-6">
                    <img src="#" id="Photo" alt="#" class="img-fluid mb-3 mt-4">
                    <input type="text" placeholder="Podaj link do zdjęcia">
                </div>

                <div class="col-6">
                    <div class="d-flex justify-content-center mt-3 card">
                        <h5 class="d-flex justify-content-center mt-3">
                            <div class="mt-3">Podaj nazwę artykułu</div>
                        </h5>
                        <div class="d-flex justify-content-center mt-3">
                            <input type="text" name="addArticleName" style="width: 250px;">
                        </div>

                        <div class="card-body">
                            <h5 class="d-flex justify-content-center mt-3">
                                Podaj treść artykułu
                            </h5>
                            <div class="mt-3">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="addArticleContent" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <input type="submit" class="btn btn-success mt-5" value="Zatwierdź nowy artykuł" style="height: 60px; width:400px; font-size: 20px">
            </div>
        </form>
    </div>


    <?php include "../Components/Footer/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>