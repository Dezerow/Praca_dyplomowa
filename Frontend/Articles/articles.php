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
            <div class="row">
                <div class="col-md-6 col-sm-12 ">
                    <img src="../Components/Images/honeyHand.jpg" alt="" class="img-fluid mb-3 articlePhoto">
                    <h3>Nazwa artykułu z bazy danych</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem labore in quisquam consectetur sequi nostrum doloremque expedita veritatis maxime aut id veniam aliquam nisi corrupti exercitationem, molestias deleniti ab dicta fuga. Suscipit harum culpa id ullam similique molestias sed, consectetur veniam. Suscipit earum id quibusdam commodi, delectus enim similique odio.</p>
                    <div style="margin-top: 10px; font-size: 15px">
                        <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php" class="readSingleArticle">Czytaj dalej>>></a>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <img src="../Components/Images/honeySell.jpg" alt="" class="img-fluid mb-3 articlePhoto">
                    <h3>Nazwa artykułu z bazy danych</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Delectus sequi adipisci, temporibus libero nostrum ratione quis officia, provident magnam molestias possimus repudiandae rerum sed quasi dignissimos, recusandae tempora expedita. Delectus temporibus laudantium necessitatibus nisi voluptatum. Vero in sequi dolores tempore quas, odio neque architecto dicta eum debitis vel esse? Ex.</p>
                    <div style="margin-top: 10px; font-size: 15px">
                        <a href="../../../Praca_dyplomowa/Frontend/Articles/articleFull.php" class="readSingleArticle">Czytaj dalej>>></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>