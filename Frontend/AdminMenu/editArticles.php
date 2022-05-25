<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    <link href="../../../Praca_dyplomowa/Frontend/AdminMenu/AdminMenuCss/editArticles.css" rel="stylesheet" type="text/css" />



</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <?php
    if (!isset($_SESSION['admin'])) {
        header('Location: ../../Frontend/Main/index.php');
        exit();
    }
    ?>

    <div class="container mt-5">

        <?php
        if (isset($_SESSION['zmianaArtykulu'])) {
            echo $_SESSION['zmianaArtykulu'];
            unset($_SESSION['zmianaArtykulu']);
        }
        ?>


        <?php
        require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
        $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


        $sql = "SELECT * from articles";
        $result = $conn->query($sql);

        ?>
        <table class="table" style="margin-top:100px">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th class="PhotoDiv" scope="col">Zdjęcie</th>
                    <th scope="col">Nazwa Artykułu</th>
                    <th class="Description">Wycinek treści artykułu</th>
                    <th class="Key">Klucz artykuł-produkt</th>
                    <th scope="col">Panel edycji</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>            
            <form method='POST' action='../../Backend/Server/fixPathToEditArticle.php'>                          
            <td><input type='hidden' name='id' value=" . $row['id'] . ">" . $row['id'] . "</td>
            <td class='PhotoDiv'><img src='" . $row['article_image'] . "' class='img-fluid' alt='...' id='articlePhoto'></td>
            <td>" . $row['article_name'] . "</td>
            <td class='Description'><textarea disabled rows='8' cols='33'>" . $row['article_content'] . "</textarea></td>       
            <td>" . $row['product_article'] . "</td>   
            <td><input class='btn btn-warning' type='submit' value='Edytuj artykuł' ></td>
            </form>
            </tr>";
                    }
                }


                ?>
            </tbody>
        </table>
    </div>

    <?php include "../Components/Footer/footer.php" ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>