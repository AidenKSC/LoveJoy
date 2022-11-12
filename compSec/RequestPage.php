<?php 
session_start();

if(!isset($_SESSION['loggedIn']))
{
    header("Location: index.php");
    exit;
}

echo "<form action='RequestPageCheck.php' method='POST' enctype= 'multipart/form-data'>";

echo "Email: ";
echo"<input name='txtEmail' type='text' />";

echo "<br />";
echo "<br />";

echo "Request: ";
echo"<input name='txtRequest' type='text' />";

echo "<br />";
echo "<br />";

echo" Details: ";

echo"<br/>";

echo" <textarea name='txtDetails' rows= '20 ' cols= '50'></textarea>";

echo"<br/>";
echo"<br/>";

echo"   Contact method : "; 
echo"    <Select name= 'txtContactMethod'>";
echo"<option value='Select'>Select</option> ";     
echo"<option value='Email'>Email</option>";       
echo"<option value='Telephone'>Telephone</option>  ";    
echo"</Select>";  

echo"<br/>";
echo"<br/>";
   
echo"<input type='file' name = 'txtImage'>"; 

echo"<br/>";
echo"<br/>";

echo"<input type='submit' value='Submit' name = 'submit'>  " ;

echo"<br/>";
echo"<br/>";
echo"<br/>";
echo"<br/>";

echo "</form>";  

echo "<form action='LogoutPage.php' method='POST'>";
echo "<input type='submit' value='Logout'>";
echo "</form>";


?>
