<?php

if (isset($_POST['searchCategory']) && isset($_POST['search'])) {
    $searchCat = $_POST['searchCategory'];
    $searchCat = htmlentities($searchCat, ENT_QUOTES, "UTF-8");
    $search = $_POST['search'];

    header('Location: ../../Frontend/SearchResults/SearchResults.php?searchCategory=' . $searchCat . '&search=' . $search . '');
}
