<!DOCTYPE html>
<?php

require_once('vendor/autoload.php');

// Establish DB connection in order to pull in listing information below
$serverName = "localhost";
$user = "awacker";
$pass = "test123";

$conn = mysqli_connect($serverName, $user, $pass, "mymarket");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Link for bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        h3 {
            font-weight: bold;
        }
    </style>
</head>

<body role="main">
    <form action="viewListing.php" method="GET">
        <div id="header">
            <!-- Pulls in the bootstrap header navigation bar-->
            <?php include "header.html" ?>
        </div>
        <div class="container">
            <h4> Current Listings </h4>

            <?php
            // Grabs all of the current listings
            // Loops through them and creates the cards in a grid format
            $sql = "SELECT * FROM listings";
            $results = $GLOBALS['conn']->query($sql);

            $count = 0;
            if ($results->num_rows > 0) {
                echo '<div class="row">';

                while ($row = $results->fetch_assoc()) {
                    $id = $row['ID'];
                    $title = $row["Title"];
                    if (strlen($title) > 15) {
                        $title = substr($title, 0, 15) . "...";
                    }
                    
                    $descr = $row["Description"];
                    if (strlen($descr) > 22) {
                        $descr = substr($descr, 0, 22) . "...";
                    }

                    $price = $row["Price"];
                    $imagePath = $row["Image_Path"];

                    $m = new Mustache_Engine;

                    $template = file_get_contents('templates/main_grid.mustache');
                    $hash = array(
                        "imagePath" => $imagePath,
                        "title" => $title,
                        "descr" => $descr,
                        "price" => $price,
                        "id" => $id
                    );

                    echo $m->render($template, $hash);
                }
            } else {
                echo "No Listings Available"; // if no listings are found. this is displayed
            }
            ?>
        </div>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script src="app.js"></script>

    <?php
        // if no profiles currently exist, need to disable ability to create a listing
        $sql = "SELECT * FROM profiles";
        
        $numProfiles = $GLOBALS['conn']->query($sql);
        if ($numProfiles->num_rows == 0) {
            echo '<script type="text/javascript"> toggleListing(); </script>';
        }
    ?>
</body>

</html>