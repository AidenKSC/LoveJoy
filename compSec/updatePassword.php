<?php

//Server and db connection
$servername="krier.uscs.susx.ac.uk";
$rootuser="sk727";  
$db="G6077_sk727";    
$rootPassword="Mysql_493329";

//Create Connection
$connection = new mysqli($servername, $rootuser, $rootPassword, $db);

//Check connection
if ($connection->connect_error)
{
    die ("Connection failed" .$conn->connect_error);
}

//Set errorOccurred to 0
$errorOccurred = 0;


$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] :'';
$email = htmlspecialchars($email);

$password1 = isset($_POST['txtPassword1']) ? $_POST['txtPassword1'] :'';
$password1 = htmlspecialchars($password1);

$password2 = isset($_POST['txtPassword2']) ? $_POST['txtPassword2'] :'';
$password2 = htmlspecialchars($password2);


//Check to see if passwords match
if($password1 != $password2)
{
    echo "The passwords are different <br/>";
    $errorOccurred = 1;
}


//Validate Password strength
$uppercase = preg_match('@[A-Z]@', $password1);
$lowercase = preg_match('@[a-z]@', $password1);
$passwordNumber    = preg_match('@[0-9]@', $password1);
$specialCharacters = preg_match('@[^\w]@', $password1);

if(!$uppercase || !$lowercase || !$passwordNumber || !$specialCharacters || strlen($password1) < 6)
 {
    echo 'Password should be at least 6 characters in length and should include at least one upper case letter, one number, and one special character.';
    $errorOccurred = 1;
}
if ( strlen($password1) < 8) 
{
    echo "Weak Password Strength <br/>";
}
 if( strlen($password1) < 10 )
{
    echo "Average Password Strength <br/>";
}
if( strlen($password1) < 12 )
{
    echo "Strong Password Strength <br/>";
}
if( strlen($password1) > 12)
{
    echo "Password is too long!";
    $errorOccurred = 1;
}



//query
$userQuery = "SELECT * FROM SystemUser";
$userResult = $connection->query($userQuery);
$userFound = 0;

echo "<table border='1'>";
    if($userResult -> num_rows > 0)
    {
        while ($userRow = $userResult -> fetch_assoc())
        {
            if($userRow['Email'] == $email)
            {
                $userFound = 1;

                if($errorOccurred == 0)
                {

                    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                    
                    //Update new pasword into database
                    $stmt = $connection->prepare("UPDATE SystemUser SET Password = ? WHERE Email = '$email'");
                    $stmt -> bind_param('s', $hashed_password);
                    $stmt -> execute();

                     //Tell the user the password has now benn changed
                    echo "<br/> Your password has now been reset <br/>";

                    echo"<br/>";
                    echo"<br/>";

                    echo "<form action='index.php' method='POST'>";
                    echo "<input type='submit' value='Login now'>";
                    echo "</form>";

                    }        
                }           
            }
        } 
            echo "</table>";   

            if ($userFound == 0)
            {
                echo "This user does not exist";

                echo "<form action='setNewPassword.php' method='POST'>";
                echo "<input type='submit' value='Go back'>";
                echo "</form>";
            }


?>