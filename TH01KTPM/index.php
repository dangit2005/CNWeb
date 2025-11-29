<?php
require "data.php";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Loài Hoa Đẹp</title>

    <style>
        body{
            font-family: Arial;
            background:#f3f3f3;
        }
        .container{
            width:900px;
            margin:auto;
        }
        .flower{
            background:white;
            padding:15px;
            margin-bottom:20px;
            border-radius:8px;
            display:flex;
            gap:15px;
        }

        img{
            width:200px;
            height:150px;
            object-fit:cover;
            border-radius:6px;
        }
        h2{
            margin:0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🌸Loài Hoa Xuân Hè Đẹp</h1>

    <?php foreach($flowers as $f): ?>
        <div class="flower">
            <img src="imgs/<?= $f['image'] ?>">
            <div>
                <h2><?= $f['name'] ?></h2>
                <p><?= $f['desc'] ?></p>
            </div>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>
