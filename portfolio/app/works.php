<!DOCTYPE html>

<?php

    include("database.php");

    $imageList = array();

    // Gets the table of images
    $sql = "SELECT * FROM images";
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        array_push($imageList, $row);
    };

    array_shift($imageList);

    // Date sorting algorithm
    // Month Sorting
    $months = [];

    foreach ($imageList as $image){
        $date = new DateTime($image['img_date']);

        // Returns int value
        $month = $date->format('m');
        $month = $month + (($date->format('Y') - 2020)*12);

        // echo ($month) . "<br>";
        
        // Adds image to months
        if (!isset($months[$month])) {
            $months[$month] = [];
        }

        $months[$month][] = $image;
        
    }

    // Day Sorting (Not needed now)
    // var_dump($months);

?>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css?v=<?= filemtime(__DIR__ . '/styles.css') ?>">

    <title>Works</title>

</head>

<body>

    <?php include "Layout/header.php"; ?>

    <main>
        <!--Info-->
        <div class="galleryInfo">
            <h1>Gallery</h1>
        </div>

        <!--Gallery-->
        <div class="galleryContainer">
            <?php foreach (array_reverse($months, true) as $monthKey => $month):
                $numMonth = $monthKey % 12;
                $numYear = (floor($monthKey / 12) + 2020);
                $monthName = date('F', mktime(0, 0, 0, $numMonth, 1));
            ?>
                <div class="galleryMonth">
                    <h2><?=  $monthName . " " . $numYear ?></h2>

                    <div class="galleryGrid">
                        <?php foreach (array_reverse($month) as $image):
                            $fullImage = htmlspecialchars($image['img_file'], ENT_QUOTES, 'UTF-8');
                            ?>
                                <div class="imageContainer">
                                    <a href="<?= $fullImage ?>">
                                        <img src="<?= $fullImage ?>" alt="Gallery Image">
                                        <div class="imageOverlay">
                                            <h1><?= $image['img_name'] ?></h1>
                                            <p><?= $image['img_date'] ?></p>
                                        </div>
                                    </a>
                                </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                            
            <?php endforeach; ?>

        </div>
    </main>

    <?php include "Layout/footer.php"; ?>

</body>

</html>