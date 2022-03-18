<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="" />
    <link href="../../../Praca_dyplomowa/Frontend/Main/index.css" rel="stylesheet" type="text/css" />
</head>

<body class="d-flex flex-column min-vh-100">

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container mt-5" id="" style="border: 4px solid red">
        <div class="row">
            <div class="col-6">
                <img src="http://drive.google.com/uc?export=view&id=1_hrIU656cOCgj6Q9eoUFHpOnptcsfoBl" class="img-fluid" alt="..." id="upperPhoto">

            </div>
            <div class="col-6">
                <p>Nazwa sklepu ...najlepsze produkty pszczele</p>
                <p>Zdjęcie do obróki aby przedłużyć po całości kontenera, zaznaczonego na czerwono</p>
            </div>
        </div>
    </div>

    <div class="container mt-5" id="produktyDnia">
        <div class="row">
            <div class="col-4" style="border: 2px solid red">
                <div style="font-size: 35px">
                    Produkt dnia
                </div>
                <div style="font-size: 25px">
                    Nazwa produktu z bazy
                </div>
                <div>
                    <img src="../Components/Images/honeySell.jpg" class="img-fluid" alt="..." id="upperPhoto">
                    <div class="col" style="font-size: 25px; margin-left: 70px">Cena 100zł</div>
                </div>
            </div>
            <div class="col-8" style="border: 2px solid green;">
                <div class="" style="font-size: 35px">
                    Artykuł dnia
                </div>
                <div style="font-size: 25px">
                    Nazwa artykułu z bazy
                </div>
                <div style="margin-top: 20px; font-size: 25px">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque magnam est perspiciatis ad quod, vitae sunt commodi obcaecati atque vero tenetur quae voluptatem minima ex repellat facere! Ipsam culpa pariatur iusto in distinctio, quisquam magni voluptatem alias doloribus quasi laudantium nulla voluptatibus ducimus blanditiis incidunt porro natus atque repellendus officiis.
                </div>
                <div class="float-end" style="margin-top: 10px; font-size: 20px">
                    Czytaj dalej>>>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5" id="popularneProdukty">
        <div class="row">
            <div class="col-8" style="font-size: 35px">Najchętniej kupowane produkty</div>
            <div class="col-4 mt-2">
                <div class="float-end" style="font-size: 20px">

                    <button class="btn btn-success">
                        < </button>
                            <button class="btn btn-success"> > </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col" style="border: 2px solid red">
                    <div style="font-size: 25px">
                        Nazwa produktu z bazy
                    </div>
                    <div>
                        <img src="../Components/Images/honeySell.jpg" class="img-fluid" alt="..." id="upperPhoto">
                        <div class="col" style="font-size: 25px; margin-left: 70px">Cena 100zł</div>
                    </div>
                </div>
                <div class="col" style="border: 2px solid green">
                    <div style="font-size: 25px">
                        Nazwa produktu z bazy
                    </div>
                    <div>
                        <img src="../Components/Images/honeySell.jpg" class="img-fluid" alt="..." id="upperPhoto">
                        <div class="col" style="font-size: 25px; margin-left: 70px">Cena 100zł</div>
                    </div>
                </div>
                <div class="col" style="border: 2px solid red">
                    <div style="font-size: 25px">
                        Nazwa produktu z bazy
                    </div>
                    <div>
                        <img src="../Components/Images/honeySell.jpg" class="img-fluid" alt="..." id="upperPhoto">
                        <div class="col" style="font-size: 25px; margin-left: 70px">Cena 100zł</div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="container mt-5" id="popularneProdukty">
        <div class="row">
            <div class="col" style="font-size: 35px">Poszerz swoja wiedzę</div>
            <div class="col mt-2">
                <div class="float-end" style="font-size: 20px">

                    <button class="btn btn-success">
                        < </button>
                            <button class="btn btn-success"> > </button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col" style="border: 2px solid red">
                    <div style="font-size: 25px">
                        Nazwa artykułu z bazy
                    </div>
                    <div style="margin-top: 20px; font-size: 25px">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque magnam est perspiciatis ad quod, vitae sunt commodi obcaecati atque vero tenetur quae voluptatem minima ex repellat facere! Ipsam culpa pariatur iusto in distinctio, quisquam magni voluptatem alias doloribus quasi laudantium nulla voluptatibus ducimus blanditiis incidunt porro natus atque repellendus officiis.
                    </div>
                    <div class="float-end" style="margin-top: 10px; font-size: 20px">
                        Czytaj dalej>>>
                    </div>
                </div>
                <div class="col" style="border: 2px solid green">
                    <div style="font-size: 25px">
                        Nazwa artykułu z bazy
                    </div>
                    <div style="margin-top: 20px; font-size: 25px">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cumque magnam est perspiciatis ad quod, vitae sunt commodi obcaecati atque vero tenetur quae voluptatem minima ex repellat facere! Ipsam culpa pariatur iusto in distinctio, quisquam magni voluptatem alias doloribus quasi laudantium nulla voluptatibus ducimus blanditiis incidunt porro natus atque repellendus officiis.
                    </div>
                    <div class="float-end" style="margin-top: 10px; font-size: 20px">
                        Czytaj dalej>>>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container mt-5" id="popularneProdukty" style="margin-bottom: 200px">
        <div style="border: 4px solid red">
            Reklama naszego sklepu, samosłodzenie
        </div>
        <div style="border: 4px solid green">Opis krótko o nas</div>
        <div style="border: 4px solid red">Reklama informującach o okresowych zniżkach/ofertach wraz z ikonami miodów etc</div>

    </div>


    <?php include "../Components/Footer/footer.php" ?>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>