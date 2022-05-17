<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../Praca_dyplomowa/Frontend/SupportContact/contact.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container py-5">
        <div>
            <h1 class="text-center mt-3">Panel wysyłania wiadomości do supportu</h1>
            <div>
                <div class="row text-center d-flex justify-content-center">
                    <div class="col-6">
                        <form action="../../Backend/Server/backSendToSupport.php" method="POST">
                            <div class="mt-5">
                                <?php
                                if (isset($_SESSION['emailSend'])) {
                                    echo  $_SESSION['emailSend'];
                                    unset($_SESSION['emailSend']);
                                }
                                ?>
                                <div class="setValuesFields">
                                    <h5 class="mt-5 ">
                                        Podaj swój adres email
                                    </h5>
                                    <input class="form-control d-flex justify-content-center inputFields" type="email" name="email" required>
                                </div>
                                <div>
                                    <h5 class="mt-5">
                                        Podaj opis problemu
                                    </h5>
                                    <div class="mt-3">
                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="problemDesc" rows="4" col="2" placeholder="" minlength="20" required></textarea>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <input type="submit" class="btn btn-success inputFields" value="Wyślij prośbę o pomoc">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php include "../Components/Footer/footer.php" ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>