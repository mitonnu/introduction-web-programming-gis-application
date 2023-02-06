<?php
    // foreach($_POST as $key => $val){
    //     echo "Key: {$key} - {$val} <br>";
    // };

    if (isset($_POST[submit])){
        $ls = $_POST['lastsurvey'];
        $rs = $_POST['recntstatus'];
        $db = new PDO('pgsql:host=localhos;port=5432;dbname=millermo_testgis;', 'joe', '12345');
        $sql = $db->prepare("SELECT nest_id, createdate, lastsurvey, recnetstatus, recentspecies FROM wildlife_raptor_nests WHERE lastsurvey > : ls AND recentstatus = :rs");
        $param = ["ls" =>$ls, "rs" => $rs];
        $sql -> execute($param);
    }

    echo "<table>";
    while ($row = $sql -> fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach($row as $fied => $value) {
            echo "<td>{$value}</td>";
        }
        echo "</tr>";
    }
    echo "</tabel>";
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

    <form method="POST" action="">
        <input type="date" name="lastsurvey" value="2015-01-01">
        <br>
        <select name="recentsatts" id="">
            <option value="ACTIVE NEST">Active Nest</option>
            <option value="INACTIVE NEST">Inactive Nest</option>
            <option value="FLEDGED NEST">Fledged Nest</option>
        </select>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

</body>

</html>