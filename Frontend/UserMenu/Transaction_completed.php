<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Login/login.css" rel="stylesheet" type="text/css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container-fluid mt-5 mainContainer" id="whenLittleMove" style="margin-bottom: 450px">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-6 mt-5">
                <div class="card-block text-center bg-light">
                    <label id="Title">
                        <h1 style=" text-align: center; color:green">Transakcja pomyślna</h1>
                    </label>
                    <div class="form-group mt-5">
                        <h3>Dziękujemy za zakup. W przeciągu kilku dni zostanie dostarczona przesyłka.</h3>
                    </div>
                    <div class="mt-4">
                        <a href="../Main/index.php">
                            <h3>Wróć do przeglądania witryny.</h3>
                        </a>
                    </div>
                </div>
            </section>
        </section>
    </div>



    <?php include "../Components/Footer/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>