<?php

$input1 = $_POST['inp1'];
$input2 = $_POST['inp2'];
// $value = $_POST['val'];

$conn = mysqli_connect('localhost', 'root', '', 'project') or die("Connection failed");
$sql = "select c_value from currency where CharCode='{$input1}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$val1 = $row['c_value'];
$sql = "select c_value from currency where CharCode='{$input2}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$val2 = $row['c_value'];

$output = ($val1 / $val2);
mysqli_close($conn);
echo $output;

?>