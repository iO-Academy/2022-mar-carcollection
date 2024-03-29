<?php

namespace CarpeDiem;

require 'vendor/autoload.php';

use CarpeDiem\Classes\Services\CarService;
use CarpeDiem\Classes\ViewHelpers\CarViewHelper;
use CarpeDiem\Classes\ViewHelpers\ColoursViewHelper;
use CarpeDiem\Classes\ViewHelpers\MakesViewHelper;
use CarpeDiem\Classes\ViewHelpers\SearchViewHelper;


$isFilter = ['make' => '',
    'colour' => ''];

if (!isset($_POST['search'])) {
    $_POST['search'] = '';
}

if (isset($_POST['makes'])) {
    $isFilter['make'] = $_POST['makes'];
}
if (isset($_POST['colours'])) {
    $isFilter['colour'] = $_POST['colours'];
}

$carCollection = new CarService();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>CarPe-Diem</title>
</head>
<body>
<header>
    <div class="jumbo">
        <div class="jumbo-container">
            <h1 class="title">CarPe-Diem</h1>
            <p class="sub-heading">Car Collection</p>
        </div>
    </div>
</header>
<div class="search-filter">
    <div class="search">
        <?php
        echo SearchViewHelper::setPostToSearchInput($_POST["search"]);
        ?>
    </div>
    <div class="dropdown">
        <form action="index.php" method="post">
            <div class="dropdown-and-buttons">
                <div class="filter-dropdowns">
                    <?php
                    $carMakesResult = $carCollection->getCarMakes();
                    $carMakesList = $carMakesResult->getMakes();
                    echo MakesViewHelper::allMakesDropDown($carMakesList);
                    $carColoursResult = $carCollection->getCarColours();
                    $carColoursList = $carColoursResult->getColours();
                    echo ColoursViewHelper::allColoursDropDown($carColoursList);
                    ?>
                </div>
                <div class="buttons">
                    <button type="submit">Filter</button>
                    <button class="clear-button" onclick="window.location.href='index.php';" type="reset">Clear</button>
                </div>
            </div>
        </form>
    </div>
</div>
<main>
    <div class="cars">
        <?php
        $searchTerm = $_POST['search'];
        $searchTerm = (preg_replace('/[^A-Za-z0-9-\s]/', '', $searchTerm));
        $showCollection = $carCollection->getCarCollection($searchTerm)->getCars($isFilter);
        echo CarViewHelper::showCollection($showCollection);
        ?>
    </div>
</main>
</body>
</html>

