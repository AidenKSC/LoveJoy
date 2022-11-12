<?php

session_start();

if(!isset($_SESSION['loggedIn']))
{
    header("Location: AdminLogin.php");
    exit;
}

$mysql_host="krier.uscs.susx.ac.uk";
$mysql_database="G6077_sk727";
$mysql_user="sk727";
$mysql_password="Mysql_493329";

//Create Connection
$connection = mysqli_connect($mysql_host, $mysql_user,$mysql_password, $mysql_database) or die ("could not connect to the server");


  $RequestData= $connection -> query("SELECT * FROM EvaluationRequest");

  while($data = mysqli_fetch_array($RequestData))
  {
  echo "Email: ";
  echo $data['email'];

  echo "<br />";
  echo "<br />";

  echo "Requests: ";
  echo $data['request'];

  echo "<br />";
  echo "<br />";

  echo "Details: ";
  echo $data['detail'];

  echo "<br />";
  echo "<br />";

  echo "Contact Method: ";
  echo $data['contactMethod'];

  echo "<br />";
  echo "<br />";

  $image = $data['image'];
  echo "<img src='image/".$data['image']."'>";

  echo "<br />";
  echo "<br />";
  echo "<br />";
  echo "<br />";

  }  
  
?>

<?php

  echo "<br />";
  echo "<br />";

  echo "<form action='LogoutPage.php' method='POST'>";
  echo "<input type='submit' value='Logout'>";
  echo "</form>";

?>

