<?php
session_start();

require_once "pdo.php";
require_once "util.php";

// Demand a GET parameter
//if ( ! isset($_SESSION['email']) || strlen($_SESSION['email']) < 1  ) {
//    die('Not login');
//}

// If the user requested logout go back to index.php
if(isset($_POST['add'])){
    header('Location: add.php');
    return;
}

if(isset($_POST['logout'])){
    header('Location: logout.php');
    return;
}


$stmt = $pdo->query("SELECT * FROM Profile");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$_SESSION["rown"]=$rows;

?>

<!DOCTYPE html>
<html>
<head>
<title>DIEGO ANTONIO ROMERO PALACIOS 828dbe8e</title>
<?php require_once "head.php"; ?>
</head>
<body>
<div class="container">
<h1>Diego Romero's Resume Registry </h1>

<?php

flashMessages();

if ( isset($_SESSION['user_id'])) {
  
    echo('<table border="1">'."\n");
    

echo ('<p><a href="logout.php">Logout</a></p>');

if($_SESSION["rown"] ==false){
//echo("<p>No rows found</p>");
}else{
    echo "<tr>";
    echo("<td>Name</td>");
    echo("<td>Headline</td>");
    echo("<td>Action</td>");
    echo("</tr>");
}
foreach ( $_SESSION["rown"] as $row ) {
echo "<tr><td>";
echo('<a href="view.php?profile_id='.$row['profile_id'].'">'.$row['first_name']." ".$row['last_name'].'</a>');
echo("</td><td>");
echo(htmlentities($row['headline']));
echo("</td><td>");
echo('<a href="edit.php?profile_id='.$row['profile_id'].'">Edit</a> / ');
echo('<a href="delete.php?profile_id='. $row['profile_id'].'">Delete</a>');
echo("\n</form>\n");
echo("</td></tr>\n");
}
echo("</table>");

echo('
<p>
<a href="add.php"> Add New Entry</a>
</p>
');

}else{
    echo('
    <p>
<a href="login.php">Please log in</a>
</p>
');
echo('<table border="1">'."\n");

if($_SESSION["rown"] == false){
    //echo("<p>No rows found</p>");
    }else{
        echo "<tr>";
        echo("<td>Name</td>");
        echo("<td>Headline</td>");
        echo("</tr>");
    }
    foreach ( $_SESSION["rown"] as $row ) {
    echo "<tr><td>";
    echo('<a href="view.php?profile_id='.$row['profile_id'].'">'.$row['first_name']." ".$row['last_name'].'</a>');
    echo("</td><td>");
    echo(htmlentities($row['headline']));
    echo("</td>");
    echo("\n</form>\n");
    //echo("</td></tr>\n");
    }
    echo("</table>");
}
?>
</div>
</body>
</html>
