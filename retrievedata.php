<?php

$outputTable = '<table>
<thead>
    <tr>
        <th>NumCode</th>
        <th>CharCode</th>
        <th>Name</th>
        <th>Value</th>
        <th>Date</th>
    </tr>
</thead>
<tbody>';

$conn = mysqli_connect('localhost', 'root', '', 'project') or die("Connection failed");
$sql = "select * from currency";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $outputTable .= '
     <tr>
     <td>' . $row['NumCode'] . '</td>
     <td>' . $row['CharCode'] . '</td>
     <td>' . $row['c_name'] . '</td>
     <td>' . $row['c_value'] . '</td>
     <td>' . $row['c_date'] . '</td>
     </tr>';

}
$outputTable .= '</body></table>';
mysqli_close($conn);
echo $outputTable;

?>