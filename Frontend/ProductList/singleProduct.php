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
        <div class="row" style="margin-top:50px">
            <div class="col-md-4 col-sm-12">
                <img src="../../../Praca_dyplomowa/Frontend/Components/Images/HoneySell2.jpg" class="img-fluid" id="BigPhoto">
                <div class="mt-2" id="photoList">
                    <img src="../../../Praca_dyplomowa/Frontend/Components/Images/HoneySell2.jpg" class="img-fluid littlePhoto">
                    <img src="../../../Praca_dyplomowa/Frontend/Components/Images/HoneySell2.jpg" class="img-fluid littlePhoto">
                    <img src="../../../Praca_dyplomowa/Frontend/Components/Images/HoneySell2.jpg" class="img-fluid littlePhoto">
                    <i class="fa-solid fa-chevron-right" id="changePhoto"></i>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 text-left" style="border:2px solid red">
                <h2 class="mt-5">Nazwa produktu z bazy</h2>
                <h5 class="mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, aliquam sint magni, eius iure, laudantium recusandae sit nesciunt necessitatibus itaque quis inventore possimus eveniet tempore. Magni inventore sint voluptatibus nobis vel possimus, iusto error. Fuga ducimus asperiores voluptatem iste ipsam praesentium quasi incidunt quibusdam odit atque quam earum molestiae corrupti pariatur reprehenderit deserunt alias nobis consectetur quo dolores veritatis inventore, unde repudiandae. Commodi, expedita aperiam? Sequi tempora aliquam, nostrum nam quas quibusdam libero expedita et minima tempore quidem, itaque quasi ea? Quis dolor magni maxime aliquid, recusandae laudantium consectetur cumque illo, labore, ducimus error illum temporibus. Porro fuga iste voluptatum?</h5>
                <h4 class="mt-4" id="price">Cena z bazy: 50ziko</h4>
                <button class="btn btn-success mt-4 ms-3">Dodaj do koszyka</button>

            </div>
        </div>
    </div>
    </div>




    <?php include "../Components/Footer/footer.php" ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>