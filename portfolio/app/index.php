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

    // Orders the images
    $orderedIds = [3, 15, 13, 17, 9];

    $orderedImages = [];
    foreach ($orderedIds as $id) {
        foreach ($imageList as $image) {
            if ($image['img_id'] == $id) {
                array_push($orderedImages, $image);
            }
        }
    }

?>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="styles.css?v=<?= filemtime(__DIR__ . '/styles.css') ?>">

    <title>Homepage</title>

</head>

<body>

    <?php include "Layout/header.php"; ?>

    <main>
        <!--Website banner-->
        <div class="banner">
            <image src="Images/Painting68-1.jpg" alt="Banner" class="bannerImage">
            <p class="bannerText">"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</p>
        </div>

        <!--About me section-->
        <div class="about">
            <div class="aboutTitle">
                <h2>ABOUT ME</h2>
                <img src="<?= htmlspecialchars($imageList[0]['img_file'], ENT_QUOTES, 'UTF-8') ?>" alt="Profile Picture" class="profilePic">
            </div>
            <hr>
            <div class="aboutText">
                <p>Lorem ipsum <b>Jabberwock</b> sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.<br><br> 
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br>
                    Thank you!
                </p>
            </div>
        </div>
        <hr>

        <!--Gallery-->
        <div class="gallery">
            <h2>WORKS</h2>

            <div class="imageGridContainer">
                <div class="imageGrid">
                    <?php foreach ($orderedImages as $index => $image):
                        $fullImage = htmlspecialchars($image['img_file'], ENT_QUOTES, 'UTF-8');
                    ?>
                        <div class="imageContainer" style="grid-area: box-<?= $index + 1?>">
                            <a href="<?= $fullImage ?>">
                                <img src="<?= $fullImage ?>" alt="Gallery Image">
                                <div class="imageOverlay">
                                    <h1><?= $image['img_name'] ?></h1>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>

                    <!--See More Button-->
                    <div class="seeMore" style="grid-area: box-6">
                        <a href="works.php"> 
                            <p>SEE MORE <br>→</p>
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <?php include "Layout/footer.php"; ?>
    

</body>

</html>
