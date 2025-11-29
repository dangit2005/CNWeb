<?php

$file = "65HTTT_Danh_sach_diem_danh.csv";

$data = [];

if (($handle = fopen($file, "r")) !== FALSE) {

    while (($row = fgetcsv($handle)) !== FALSE) {
        $data[] = $row;
    }

    fclose($handle);
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Danh sách tài khoản</title>

<style>

table {
    margin:auto;
    border-collapse: collapse;
    width:70%;
}

th,td {
    border:1px solid black;
    padding:8px;
    text-align:center;
}

th{
    background:#ececec;
}

</style>
</head>
<body>

<h2 style="text-align:center">
    📋 DANH SÁCH TÀI KHOẢN TỪ FILE CSV
</h2>

<table>

<?php

foreach ($data as $i => $row) {

    if ($i == 0) {
        echo "<tr>";
        foreach ($row as $head) {
            echo "<th>$head</th>";
        }
        echo "</tr>";
    } else {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>$cell</td>";
        }
        echo "</tr>";
    }
}

?>

</table>

</body>
</html>
