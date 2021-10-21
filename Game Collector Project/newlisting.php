<!DOCTYPE html>

<?php
$serverName = "localhost";
$user = "awacker";
$pass = "test123";

$conn = mysqli_connect($serverName, $user, $pass, "mymarket");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// pulls in all profiles to populate drop down
$sql = "SELECT ID, FirstName FROM profiles";
$results = $conn->query($sql);

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['profile'])) {   
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $profile = $_POST['profile'];

    // uploads supplied image file
    $filePath = uploadImage();

    // adds new listing to 'listings' table
    addListing($title, $description, $price, $filePath, $profile);
}

function uploadImage()
{
    $target_dir = "../img/";

    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["name"] != "") {;
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    } else {
        $target_file = $target_dir . "No_Image.png";

        return $target_file; // return the file if we're using the default, to avoid duplicate uploads
    }

    if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { // if the upload fails, returns false and displays msg
        echo "Sorry, there was an error uploading your file.";
    }

    return $target_file;
}

function addListing($title, $description, $price, $filePath, $profile)
{
    $sql = "INSERT INTO listings (Title, Description, Price, Image_Path, AssocProfileID)
                              VALUES ('{$title}', '{$description}', '{$price}', '{$filePath}', '{$profile}')";

    $res = $GLOBALS['conn']->query($sql);
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="header">
        <!-- Pulls in the bootstrap header navigation bar-->
        <?php include "header.html" ?>
    </div>

    <!-- form to take new listing information and submit to server -->
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">
                <div class="px-2">
                    <form class="justify-content-center" name="listingCreate" enctype="multipart/form-data" action="" method="POST">
                        <h4 style="text-align: center"> New Listing </h4>
                        <div class="form-group">
                            <label for="title" id="lblTitle"> Title: </label>
                            <input type="text" class="form-control col-sm-6" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="title" id="title"> </input>

                            <label for="description" id="lblDecription"> Description </label>
                            <textarea class="form-control col-sm-8" rows="4" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="description" id="description"></textarea>

                            <label for="price" id="lblPrice"> Price </label>
                            <input type="text" class="form-control col-sm-4" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="price" id="price"> </input>

                            <label for="profile" id="lblProfile"> Profile </label>
                            <select class="form-control col-sm-4" name="profile" id="profile">
                                <?php
                                if ($results->num_rows > 0) {
                                    while ($row = $results->fetch_assoc()) {
                                        $id = $row['ID'];
                                        $name = $row['FirstName'];
                                        echo '<option value=' . $id . '>' . $name . '</option>';
                                    }
                                }
                                ?>
                            </select>
                            <label>Upload Image</label>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                    </span>
                                </span>
                            </div>
                            <div id="form-btns">
                                <button type="reset" class="btn btn-danger" name="clearListing" style="margin-top: 10px">Clear </button>
                                <button type="submit" class="btn btn-primary" name="btnSubmit" id="listingSubmit" style="margin-top: 10px">Submit </button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-success" id="listingSuccess"> Success! </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>