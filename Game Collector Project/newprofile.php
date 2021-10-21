<!DOCTYPE html>

<?php
$serverName = "localhost";
$user = "awacker";
$pass = "test123";

$conn = mysqli_connect($serverName, $user, $pass, "mymarket");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// checks that all fields were populated before adding trying to add to DB
if (
    isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['sex'])
    && isset($_GET['age']) && isset($_GET['strAddr']) && isset($_GET['city']) && isset($_GET['state']) && isset($_GET['zip'])
) {

    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $sex = $_GET['sex'];
    $age = $_GET['age'];
    $streetAddr = $_GET['strAddr'];
    $city = $_GET['city'];
    $state = $_GET['state'];
    $zip = $_GET['zip'];

    addProfile($firstName, $lastName, $sex, $age, $streetAddr, $city, $state, $zip);
}

function addProfile($firstName, $lastName, $sex, $age, $streetAddr, $city, $state, $zip)
{
    $sql = "INSERT INTO profiles (FirstName, LastName, Sex, Age, StreetAddress, City, State, ZipCode)
                              VALUES ('{$firstName}', '{$lastName}', '{$sex}', '{$age}', '{$streetAddr}', '{$city}', '{$state}', '{$zip}')";
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

    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">
                <div class="px-2">
                    <form class="justify-content-center" name="profileCreate" action="" method="GET">
                        <h4 style="text-align: center"> New Profile </h4>
                        <div class="form-group">
                            <label for="firstName" id="lblfirstName"> First Name: </label>
                            <input type="text" class="form-control col-sm-4" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="firstName" id="firstName"></input>

                            <label for="lastName" id="lbllastName"> Last Name: </label>
                            <input type="text" class="form-control col-sm-4" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="lastName" id="lastName"></input>

                            <label for="firstName" id="lblfirstName"> Sex: </label>
                            <select class="form-control col-sm-2" name="sex" id="sex">
                                <option value='M'>M</option>
                                <option value='F'>F</option>
                            </select>

                            <label for="age" id="lblage"> Age: </label>
                            <input type="text" class="form-control col-sm-2" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="age" id="age"></input>

                            <label for="strAddr" id="lblstrAddr"> Street: </label>
                            <input type="text" class="form-control col-sm-6" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="strAddr" id="strAddr"></input>

                            <label for="city" id="lblcity"> City: </label>
                            <input type="text" class="form-control col-sm-6" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="city" id="city"></input>

                            <label for="state" id="lblState"> State: </label>
                            <select class="form-control col-sm-2" name="state" id="state">
                                <option value="AL">AL</option>
                                <option value="AK">AK</option>
                                <option value="AR">AR</option>
                                <option value="AZ">AZ</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DC">DC</option>
                                <option value="DE">DE</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="IA">IA</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="MA">MA</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MO">MO</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="NC">NC</option>
                                <option value="NE">NE</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NV">NV</option>
                                <option value="NY">NY</option>
                                <option value="ND">ND</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VT">VT</option>
                                <option value="VA">VA</option>
                                <option value="WA">WA</option>
                                <option value="WI">WI</option>
                                <option value="WV">WV</option>
                                <option value="WY">WY</option>
                            </select>

                            <label for="zip" id="lblzip"> Zip Code: </label>
                            <input type="text" class="form-control col-sm-4" data-toggle="tooltip" data-placement="right" data-type="danger" title="Required" name="zip" id="zip"> </input>

                            <div id="form-btns">
                                <button type="reset" class="btn btn-danger" name="clearProfile" style="margin-top: 10px">Clear </button>
                                <button type="submit" class="btn btn-primary" name="btnSubmit" id="profileSubmit" style="margin-top: 10px">Submit </button>
                            </div>
                        </div>
                    </form>
                    <div class="alert alert-success" id="profileSuccess"> Success! </div>
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