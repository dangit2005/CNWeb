<?php
require "data.php";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Hoa</title>

    <style>
        table{
            border-collapse:collapse;
            width:90%;
            margin:auto;
        }
        th,td{
            border:1px solid black;
            padding:8px;
            text-align:center;
        }
        img{
            width:100px;
        }
        .btn-container {
            text-align: center;
            margin: 20px 0;
        }
        .btn-add {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-add:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h1 style="text-align:center">🌺 QUẢN LÝ DANH SÁCH HOA</h1>

<div class="btn-container">
    <button class="btn-add">➕ Thêm hoa</button>
</div>

<table>
    <tr>
        <th>STT</th>
        <th>TÊN HOA</th>
        <th>MÔ TẢ</th>
        <th>ẢNH</th>
        <th>HÀNH ĐỘNG</th>
    </tr>

    <?php foreach($flowers as $i => $f): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><?= $f['name'] ?></td>
            <td><?= $f['desc'] ?></td>
            <td>
                <img src="imgs/<?= $f['image'] ?>">
            </td>
            <td>
                <button>Sửa</button>
                <button>Xoá</button>
            </td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
