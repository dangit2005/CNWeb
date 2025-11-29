<?php

$file = "quiz.txt";
$lines = file($file);

$quiz = [];
$q = [];

foreach ($lines as $line) {
    $line = trim($line);

    if ($line == "") {
        $quiz[] = $q;
        $q = [];
        continue;
    }

    if (strstr($line, "ANSWER")) {
        $q["answer"] = trim(str_replace("ANSWER:", "", $line));
    }
    else if (preg_match("/^[A-D]\./", $line)) {
        $q["options"][] = $line;
    }
    else {
        $q["question"] = $line;
    }
}

if (!empty($q)) $quiz[] = $q;

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Quiz</title>
<style>
body {font-family: Arial;}
.quiz {width:800px; margin:auto;}
.box {
    background:#f2f2f2;
    padding:15px;
    margin-bottom:15px;
}
</style>
</head>
<body>

<h1 style="text-align:center">📝 BÀI THI TRẮC NGHIỆM</h1>

<form method="post">
<div class="quiz">

<?php foreach ($quiz as $i => $q): ?>
<div class="box">

<h3>Câu <?= $i+1 ?>: <?= $q['question'] ?></h3>

<?php foreach ($q["options"] as $op): ?>

<label>
<input type="radio" name="ans[<?= $i ?>]" value="<?= $op[0] ?>">
<?= $op ?>
</label><br>

<?php endforeach; ?>

</div>
<?php endforeach; ?>

<button>NỘP BÀI</button>
</div>
</form>

<?php

if ($_POST) {

    $score = 0;

    foreach ($quiz as $i => $q){
        if(isset($_POST['ans'][$i]) && $_POST['ans'][$i] == $q['answer']){
            $score++;
        }
    }

    echo "<h2 style='text-align:center'>
            KẾT QUẢ: $score / ".count($quiz)."
          </h2>";
}

?>

</body>
</html>
