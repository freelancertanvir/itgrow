<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link rel="stylesheet" href="./css/home.css">
</head>

<body>
    <div id="converter">
    <h1>Converter</h1>
<label for="input1">From</label>
<input list="from" name="input1" id="input1">
<datalist id="from">
    <?php
$conn = mysqli_connect('localhost', 'root', '', 'project') or die("Connection failed");
$sql = "select CharCode from currency";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <option value="<?php echo $row['CharCode'] ?>">
    <?php
}
mysqli_close($conn);
?>
</datalist>
<!-- <label for="value">Value</label> -->
<!-- <input type="number" name="value" id="value"> <br><br> -->
<label for="input2">To</label>
<input list="to" name="input2" id="input2"><br><br>
<datalist id="to">
    <?php
$conn = mysqli_connect('localhost', 'root', '', 'project') or die("Connection failed");
$sql = "select CharCode from currency";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <option value="<?php echo $row['CharCode'] ?>">
    <?php
}
mysqli_close($conn);
?>
</datalist>

<p id="result"></p>
<button id="btn">Convert</button>
</div>
<h1>Currency Market</h1>
    <div id="div"></div>
    <?PHP

function retrieveData() {
    $str = file_get_contents("http://www.cbr.ru/scripts/XML_daily.asp");
    $xml = simplexml_load_string($str);
    $json = json_encode($xml);
    $array = json_decode($json, TRUE);
    $conn = mysqli_connect('localhost', 'root', '', 'project') or die("Connection failed");
    $sql = "truncate table currency";
    $result = mysqli_query($conn, $sql);
    $i = 0;
    foreach ($array as $val) {
        $arr[$i] = $val;
        $i++;
    }
    $date = $arr[0]['Date'];
    $date = strtotime($date);
    $date = date('Y-m-d', $date);
    for ($i = 0; $i < sizeof($arr[1]); $i++) {
        $NumCode = ($arr[1][$i]["NumCode"]);
        $CharCode = ($arr[1][$i]["CharCode"]);
        $Name = ($arr[1][$i]["Name"]);
        $Value = ($arr[1][$i]["Value"]);
        $Value1 = str_replace(",", ".", $Value);
        $sql = "insert into currency values('{$NumCode}','{$CharCode}','{$Name}','{$Value1}','{$date}')";
        $result = mysqli_query($conn, $sql);
    }
    mysqli_close($conn);
}

$conn = mysqli_connect('localhost', 'root', '', 'project') or die("Connection failed");
$sql = "select c_date from currency";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $databaseDate = $row['c_date'];
    $curDate = date('Y-m-d');
    $databaseDate = strtotime($databaseDate);
    $curDate = strtotime($curDate);
    if ($databaseDate < $curDate) {
        retrieveData();
    } else {
        // Nothing;
    }
} else {
    retrieveData();
}

?>
    <script src="./js/jquery.min.js"></script>
    <script>
        $(() => {
            function loadTable() {
                $.ajax({
                    url: 'retrievedata.php',
                    type: 'POST',
                    success: function(data) {
                        $('#div').html(data);
                    }
                })
            }
           loadTable();

            $('#btn').click(function(){
                var input1=$('#input1').val();
                var input2=$('#input2').val();
                var value=$('#value').val();
                $.ajax({
                    url: 'calculateresult.php',
                    type: 'POST',
                    data: {inp1:input1, inp2:input2, val:value},
                    success: function(data) {
                        $('#result').text("Result: "+data);
                    }
                })
            })
        })
    </script>
</body>

</html>