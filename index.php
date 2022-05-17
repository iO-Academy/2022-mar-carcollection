<?php
namespace CarpeDiem;

require 'vendor/autoload.php';

use CarpeDiem\Classes\Services\CarService;
use CarpeDiem\Classes\ViewHelpers\CarViewHelper;
use CarpeDiem\Classes\ViewHelpers\MakesViewHelper;
//use CarpeDiem\Classes\DataAccess\MakesColDAO;
//use CarpeDiem\Classes\Entities\MakesCollection;

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
    <link rel="stylesheet" href="csss/style.css">
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
<section>
    <div class="dropdown">
        <?php
        $carCollectionResult = $carCollection->getCarMakes();
        $carMakesList = $carCollectionResult->getMakes();
        echo MakesViewHelper::allMakesDropDown($carMakesList);
        ?>
    </div>
</section>
<main>
    <div class="cars">
        <?php
        $showCollection = $carCollection->getCarCollection()->getCars();
        echo CarViewHelper::showCollection($showCollection);
        ?>
    </div>
</main>
</body>
</html>


