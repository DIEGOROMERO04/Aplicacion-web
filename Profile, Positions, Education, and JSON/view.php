<?php
require_once "pdo.php";
require_once "util.php";
session_start();



$stmt = $pdo->prepare("SELECT * FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
$_SESSION['error'] = 'Bad value for user_id';
header( 'Location: index.php' ) ;
return;
}

$f = htmlentities($row['first_name']);
$l = htmlentities($row['last_name']);
$e = htmlentities($row['email']);
$h = htmlentities($row['headline']);
$s = htmlentities($row['summary']);

$positions=loadPos($pdo, $_GET['profile_id']);

$schools=loadEdu($pdo,$_GET['profile_id']);
?>

<!DOCTYPE html>
<html>
<head>
<title>DIEGO ANTONIO ROMERO PALACIOS 828dbe8e</title>
<?php require_once "head.php"; ?>
</head>
<body>
<div class="container">
<h1> Profile information </h1>

<form method="post">
<p>First Name: <? echo ($f) ?>
<p>Last Name: <? echo ($l) ?>
<p>Email: <? echo ($e) ?>
<p>Headline:<br/> <? echo ($h) ?>
<p>Summary:<br/> <? echo ($s) ?></p>
<p>Education</p>
<ul>
    <?php
foreach($schools as $school){
    echo ("<li>");
    echo($school['year'].":".$school['name']);
    echo("</li>");
}
?>
</ul>
<p>Position</p>
<ul>
    <?php
foreach($positions as $position){
    echo ("<li>");
    echo($position['year'].":".$position['description']);
    echo("</li>");
}
?>
</ul>
<a href="index.php">Done</a></p>
</form>
</div>
</body>
</html>