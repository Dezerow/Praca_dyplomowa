<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.6.0.js"></script>
    <link href="../../../Praca_dyplomowa/Frontend/AdminMenu/AdminMenuCss/editProducts.css" rel="stylesheet" type="text/css" />



</head>

<body>

    <header class="sticky-top">
        <?php include "../Components/Navbar/navbar.php" ?>
    </header>

    <div class="container mt-5">

        <?php
        if (isset($_SESSION['wynikEdycji'])) {
            echo $_SESSION['wynikEdycji'];
            unset($_SESSION['wynikEdycji']);
        }
        ?>


        <?php
        require __DIR__ . "../../../../Praca_dyplomowa/Backend/DB_Connection/dbConnect.php";
        $conn = @new mysqli($hostname, $db_username, $db_password, $db_name);


        $sql = "SELECT id, product_name, product_description, product_price, product_image, product_article from product_list";
        $result = $conn->query($sql);

        ?>
        <table class="table" style="margin-top:100px">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Zdjęcie</th>
                    <th scope="col">Nazwa produktu</th>
                    <th>Opis produktu</th>
                    <th>Cena produktu</th>
                    <th>Klucz produkt-artykuł</th>
                    <th scope="col">Panel edycji</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>            
            <form method='POST' action='../../../Praca_dyplomowa/Frontend/AdminMenu/editProduct.php'>                          
            <td><input type='hidden' name='id' value=" . $row['id'] . ">" . $row['id'] . "</td>
            <td><img src='" . $row['product_image'] . "' class='img-fluid' alt='...' id='productPhoto'></td>
            <td>" . $row['product_name'] . "</td>
            <td><textarea disabled rows='6' cols='25'>" . $row['product_description'] . "</textarea></td>        
            <td>" . $row['product_price'] . " zł</td>  
            <td>" . $row['product_article'] . "</td>
            <td><input class='btn btn-warning' type='submit' value='Edytuj produkt' ></td>
            </form>
            </tr>";
                    }
                }


                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>