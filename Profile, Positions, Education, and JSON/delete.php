<?php
require_once "pdo.php";
session_start();


if(isset($_POST['cancel'])){
    $_SESSION["regis"]=false;
    header('Location: index.php');
    return;
}

if ( isset($_POST['delete']) && isset($_POST['profile_id']) ) {
$sql = "DELETE FROM profile WHERE profile_id = :zip";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':zip' => $_POST['profile_id']));
$_SESSION['success'] = 'Record deleted';
header( 'Location: index.php' ) ;
return;
}
$stmt = $pdo->prepare("SELECT first_name,last_name ,profile_id FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
$_SESSION['error'] = 'Bad value for user_id';
header( 'Location: index.php' ) ;
return;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>DIEGO ANTONIO ROMERO PALACIOS 828dbe8e</title>
<?php require_once "head.php"; ?>
</head>
<body>
<div class="container">
<h1>Deleteing Profile</h1>
<p>
First Name: <?= htmlentities($row['first_name']) ?></p>
<p>
Last Name: <?= htmlentities($row['last_name']) ?></p>

<form method="post"><input type="hidden" name="profile_id" value="<?= $row['profile_id'] ?>">
<input type="submit" value="Delete" name="delete">
<input type="submit" value="Cancel" name="cancel">
</form>
</div>
</body>
</html>
