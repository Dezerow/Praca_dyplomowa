<?php

if (isset($_POST['searchCategory']) && isset($_POST['search'])) {
    $searchCat = $_POST['searchCategory'];
    $search = $_POST['search'];

    header('Location: ../../Frontend/SearchResults/SearchResults.php?searchCategory=' . $searchCat . '&search=' . $search . '');
}
