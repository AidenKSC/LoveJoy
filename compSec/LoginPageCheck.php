<?php
session_start();

//Server and db connection
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

//values come from user, through webform
$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] :'';
$email = htmlspecialchars($email);

$password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] :'';
$password= htmlspecialchars($password);

$secQuestion = isset($_POST['txtSecQuestion']) ? $_POST['txtSecQuestion'] :'';
$secQuestion = htmlspecialchars($secQuestion);

//query
$userQuery = "SELECT * FROM SystemUser";
$userResult = $conn->query($userQuery);

$SECRET_KEY = "0x38FB3209EFCEa5b70962855aA6d4d5f5F02eAFd2";
$VERIFY_URL = "https://hcaptcha.com/siteverify";
$token = $_POST["h-captcha-response"];
$data = [  "secret"=> $SECRET_KEY, 
            "response"=> $token ];

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $VERIFY_URL);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($curl);
            $responseData = json_decode($response);
            
            if($responseData->success)
            {
                //flag variable
                $userFound = 0;

                echo "<table border='1'>";
                
                    if($userResult -> num_rows > 0)
                    {
                        while ($userRow = $userResult -> fetch_assoc())
                        {
                            if($userRow['Email'] == $email)
                            {
                                $userFound = 1;

                                $hash = $userRow['Password'];
                                        
                                        if( password_verify($password, $hash))
                                        {       
                                            if ($userRow['secQuestion'] == $secQuestion)
                                            {   
                                                
                                                $_SESSION['loggedIn'] = true;
                                                $_SESSION['Email']= $email;
                                        
                                                    echo "Greetings ";
                                                    echo "<br/> Welcome to LoveJoy";  
                                                    echo "<br/>To Request an evaluation, Click <a href= 'RequestPage.php'>here</a?>";

                                                    echo "<br/>";
                                                    echo "<br/>";
                                                                                
                                                    echo "<form action='LogoutPage.php' method='POST'>";

                                                    echo "<input type='submit' value='Logout'>";

                                                    echo "</form>";
                                                                
                                            }
                                            else
                                            {
                                                echo "Wrong answer to security question";

                                                echo "<br/>";
                                                echo "<br/>";

                                                echo "<form action='index.php' method='POST'>";
                                                echo "<input type='submit' value='Go back'>";
                                                echo "</form>";
                                            }       
                                        }
                                        else
                                        {
                                            echo "Wrong Password";

                                            echo "<br/>";
                                            echo "<br/>";

                                            echo "<form action='index.php' method='POST'>";
                                            echo "<input type='submit' value='Go back'>";
                                            echo "</form>";                                             
                                        }
                            } 
                            
                        }
                            echo "</table>";   

                            if ($userFound == 0)
                            {
                                echo "This user does not exist";
                                
                                echo "<br/>";
                                echo "<br/>";
                                echo "<form action='index.php' method='POST'>";
                                echo "<input type='submit' value='Go back'>";
                                echo "</form>";
                            }
                    }

            }
            else 
            {
                echo 'Captcha failed, please try again.';
                echo "<br/>";
                echo "<br/>";
                echo "<form action='index.php' method='POST'>";
                echo "<input type='submit' value='Go back'>";
                echo "</form>";
            }

?>