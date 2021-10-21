<!DOCTYPE html>
<?php

require_once('vendor/autoload.php');

// Establish DB connecton
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <!-- Pulls in the bootstrap header navigation bar-->
    <div id="header">
        <?php include "header.html" ?>
    </div>
    <div class="container">
        <?php
        // check if a listing button was clicked

        if (isset($_GET['listing'])) {
            $listing = $_GET['listing']; // grabs the listing id value to find the correct one in the DB
            $sql = "SELECT Title, Description, Price, Image_Path FROM listings WHERE ID = {$listing}";

            $image = '';
            $title = '';
            $descr = '';
            $price = '';

            $results = $GLOBALS['conn']->query($sql);
            if ($results->num_rows == 1) {
                $row = $results->fetch_assoc();
                
                // grabs info from each column
                $image = $row['Image_Path'];
                $title = $row["Title"];
                $descr = $row["Description"];
                $price = $row['Price'];

                $m = new Mustache_Engine;

                $template = file_get_contents('templates/listing.mustache');
                $hash = array(
                    "image" => $image,
                    "title" => $title,
                    "descr" => $descr,
                    "price" => $price
                );
            
                echo $m->render($template, $hash);

            } else if ($results->num_rows > 1) { // unlikely scenario where there would be 2 listings with the same ID. Primary key prevents this but figured I'd throw it in just in case.
                echo "More than one listing found!";
            } else {
                echo "No Listing found";
            }
        }
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="app.js"> </script>
</body>

</html>