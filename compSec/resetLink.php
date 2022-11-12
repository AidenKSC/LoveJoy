<?php

$servername="krier.uscs.susx.ac.uk";
$rootuser="sk727"; 
$db="G6077_sk727";   
$rootPassword="Mysql_493329";

//Create Connection
$conn = new mysqli($servername, $rootuser, $rootPassword, $db);

//Check connection
if ($conn->connect_error)
{
    die ("Connection failed" .$conn->connect_error);
}
      
$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] :'';
$email = htmlspecialchars($email);


$headers = 'MIME-Version: 1.0' . '\r\n';
$headers .= 'Content-type:text/html; charset=UTF-8' . '\r\n';


$msg = ' Copy this link into your browser                   https://lovejoysk727.000webhostapp.com/setNewPassword.php';

$msg = wordwrap($msg,70);


$userQuery = "SELECT * FROM SystemUser";
$userResult = $conn->query($userQuery);
$userFound = 0;


        echo "<table border='1'>";
            if($userResult -> num_rows > 0)
            {
                while ($userRow = $userResult -> fetch_assoc())
                {
                    if($userRow['Email'] == $email)
                    {
                        $userFound = 1;

                        mail($email,"Password Reset",$msg,$headers);   

                        echo"email sent"; 

                        echo"<br/>";
                        echo"<br/>";

                        echo "<form action='index.php' method='POST'>";
                        echo "<input type='submit' value='Login now'>";
                        echo "</form>";                 
                    }
                } 
                echo "</table>";   

                if ($userFound == 0)
                {
                    echo "This email does not exist within our database";

                    echo"<br/>";
                    echo"<br/>";

                    echo "<form action='forgotPassword.php' method='POST'>";
                    echo "<input type='submit' value='Go back'>";
                    echo "</form>";
                }

            }
?>
