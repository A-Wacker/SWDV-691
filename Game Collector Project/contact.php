<!DOCTYPE html>

<?php
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id="header">
        <!-- Pulls in the bootstrap header navigation bar-->
        <?php include "header.html" ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">
                <div class="px-2">
                    <form class="justify-content-center" name="contactMe">
                        <h4 style="text-align: center"> Contact Me </h4>
                        <div class="form-group">
                            <p id="introText">
                                If you have any questions, please feel free to send me a message :)
                            </p>
                            
                            <label for="messageBox" id="lblMessage"> Message: </label>
                            <textarea class="form-control col-sm-12" rows="4" name="messageBox" id="messageBox"></textarea>
                            <div style="margin-top: 10px; width: 100%; text-align: right">
                                <button type="button" class="btn btn-primary" name="btnSend" id="sendMsg">Submit </button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-success" id="messageSuccess"> Sent! </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
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