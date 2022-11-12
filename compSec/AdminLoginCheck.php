<?php
session_start();

//Server and db connection
$servername="krier.uscs.susx.ac.uk";
$rootuser="sk727";    
$db="G6077_sk727";   
$rootPassword="Mysql_493329";  

//Create Connection
$conn = new mysqli($servername, $rootuser, $rootPassword, $db);


//values come from user, through webform
$name = $_POST['txtName'];
$name = htmlspecialchars($name);

$password = $_POST['txtPassword'];
$password = htmlspecialchars($password);

//Check connection
if ($conn->connect_error)
{
    die ("Connection failed" .$conn->connect_error);
}

//query
$userQuery = "SELECT * FROM SystemUser";
$userResult = $conn->query($userQuery);

//flag variable
$userFound = 0;

echo "<table border='1'>";
    if($userResult -> num_rows > 0)
    {
        while ($userRow = $userResult -> fetch_assoc())
        {
            if($userRow['Name'] == $name)
            {
                $userFound = 1;

                 $hash = $userRow['Password'];
                        
                        if( password_verify($password, $hash))
                        {       
                            if ($userRow['Permission'] == "Admin")
                            {   
                                
                                $_SESSION['loggedIn'] = true;

                                echo "Greetings"; 
                                echo "<br/> Welcome to LoveJoy";  
                                echo "<br/>To view an evaluation, Click <a href= 'EvaluationList.php'>here</a?>";
                                
                                echo "<form action='LogoutAdmin.php' method='POST'>";
                                echo "<input type='submit' value='Logout'>";
                                echo "</form>";
                               
                            }
                            else
                            {
                                echo "You are not an Admin!";

                                echo"<br/>";
                                echo"<br/>";

                                echo "<form action='AdminLogin.php' method='POST'>";
                                echo "<input type='submit' value='Go back'>";
                                echo "</form>";
                            }       
                        }
                        else
                        {
                        echo "Wrong Password";

                        echo"<br/>";
                        echo"<br/>";

                        echo "<form action='AdminLogin.php' method='POST'>";
                        echo "<input type='submit' value='Go back'>";
                        echo "</form>";
                        }
            }
        } 
            echo "</table>";   

            if ($userFound == 0)
            {
                echo "You are not an Admin!";

                echo"<br/>";
                echo"<br/>";
                
                echo "<form action='AdminLogin.php' method='POST'>";
                echo "<input type='submit' value='Go back'>";
                echo "</form>";
            }
    }
?>