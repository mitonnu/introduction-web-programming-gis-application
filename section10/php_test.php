<?php
$header = "Welcome To My PHP Page";
$space = " ";
$myString1 = "Michey" . $space . "Mouse";
// $myString2="Mickey$spaceMouse";
$myString3 = "Mickey{$space}Mouse";

$animalType = ['cat', 'dog', 'chicken'];
$animalType[] = "BEAR";
$animalType[6] = "FERRET";
sort($animalType);

if (isset($_GET['lat'])) {
    $lat = $_GET['lat'];
} else {
    $lat = "NA";
}
if (isset($_GET['long'])) {
    $long = $_GET['long'];
} else {
    $long = "NA";
}
if (isset($_GET['alt'])) {
    $alt = $_GET['alt'];
} else {
    $alt = "NA";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1><?php echo $header; ?></h1>
    <h4><?php echo $myString1; ?></h4>
    <h4><?php echo $myString2; ?></h4>
    <h4><?php echo $myString3; ?></h4>

    <hr>

    <h4><?php echo $animalType[0] ?></h4>
    <h4><?php echo $animalType[1] ?></h4>
    <h4><?php echo $animalType[2] ?></h4>
    <h4><?php echo $animalType[3] ?></h4>
    <h4><?php echo $animalType[4] ?></h4>

    <hr>

    <?php
    foreach ($_GET as $key => $val) {
        echo "Key: {$key} , Value: {$val} <br>";
    };

    ?>

    <h4>Form</h4>
    <form method="POST" action="process_lat.php">
        <label for="lat">Latitude: </label><input id="lat" name="lat" type="text"><br>
        <label for="long">Longitude: </label><input id="long" name="long" type="text"><br>
        <label for="alt">Altitude: </label><input id="alt" name="alt" type="text"><br>
        <input type="submit" value="submit"/>
    </form>

    <hr>

    <h3>From Global Variable Through Loop</h3>
    <h4>Latitude: <?php echo $lat; ?></h4>
    <h4>Longitude: <?php echo $long; ?></h4>
    <h4>Altitude: <?php echo $alt; ?></h4>

    <hr>

    <h3>From Global _GET Variable</h3>
    <h4>Latitude: <?php echo $_GET['lat']; ?></h4>
    <h4>Longitude: <?php echo $_GET['long']; ?></h4>
    <h4>Altitude: <?php echo $_GET['alt']; ?></h4>

</body>

</html>