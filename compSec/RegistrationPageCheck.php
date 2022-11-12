<?php

//Server and db connection
$mysql_host="krier.uscs.susx.ac.uk";
$mysql_database="G6077_sk727";
$mysql_user="sk727";
$mysql_password="Mysql_493329";

//Create Connection
$connection = mysqli_connect($mysql_host, $mysql_user,$mysql_password, $mysql_database) or die ("could not connect to the server");

//Copy all data from the registration page into variables
$email = $_POST['txtEmail'];
$email = htmlspecialchars($email);

$name = $_POST['txtName'];
$name = htmlspecialchars($name);

$password1 = $_POST['txtPassword1'];
$password1 = htmlspecialchars($password1);

$password2 = $_POST['txtPassword2'];
$password2 = htmlspecialchars($password2);

$phoneNo = $_POST['txtNumber'];
$phoneNo = htmlspecialchars($phoneNo);

$secQuestion = $_POST['txtSecQuestion'];
$secQuestion = htmlspecialchars($secQuestion);


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
                // //Create variable to indicate if an error has occurred or not, 0 = false, 1 = true.
                $errorOccurred = 0;

                // //Make sure that all text boxes aren't blank
                if($email == "")
                {
                    echo "Email is blank <br/>";
                    $errorOccurred = 1;
                }

                if($name == "")
                {
                    echo "Name is blank <br/>";
                    $errorOccurred = 1;
                }

                if($phoneNo== "")
                {
                    echo "Telephone is blank <br/>";
                    $errorOccurred = 1;
                }

                if($secQuestion== "")
                {
                    echo "Security Question is blank <br/>";
                    $errorOccurred = 1;
                }

                if($password1 == "" OR $password2 == "")
                {
                    echo " Password Empty, please check it again. <br/>";
                    $errorOccurred = 1;
                }

                //Validate Password Strength
                $uppercase = preg_match('@[A-Z]@', $password1);
                $lowercase = preg_match('@[a-z]@', $password1);
                $passwordNumber    = preg_match('@[0-9]@', $password1);
                $specialChars = preg_match('@[^\w]@', $password1);

                if(!$uppercase || !$lowercase || !$passwordNumber || !$specialChars || strlen($password1) < 6)
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


                //Check if email is already registered in the database.
                $userResult = $connection ->query("SELECT * FROM SystemUser");

                //Loop through from the first to the last record
                While($userRow = mysqli_fetch_array($userResult))
                {
                    //Check to see if the current user's email matches the one from the user
                    if ($userRow['Email'] == $email)
                    {
                        echo "This email has already been used! <br/>";
                        $errorOccurred = 1;
                    }

                    if ($userRow['Name'] == $name)
                    {
                        echo "This name has already been used! <br/>";
                        $errorOccurred = 1;
                    }
                }

                //Check to make sure that email address contains an @
                if(strpos ($email, "@") == false )
                {
                    echo "This email is not valid <br/>";
                    $errorOccurred = 1;
                }

                //Check to see if passwords match
                if($password1 != $password2)
                {
                    echo "The passwords are different <br/>";
                    $errorOccurred = 1;
                }

                //Check to see if an error has occurred. Then add the details to the database.
                if($errorOccurred == 0)
                {   
                        
                    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
                        
                    $stmt = $connection->prepare("INSERT INTO SystemUser (Email, Password,Name, phoneNo, secQuestion)
                    VALUES (? , ? , ? , ? , ? )");
                    $stmt -> bind_param('sssss', $email,$hashed_password,$name,$phoneNo,$secQuestion);
                    $stmt -> execute();

                    echo "Hello ".$name . "<br/>";
                    echo "Thank you for registering with LoveJoy <br/>";
                    echo " Login <a href= 'index.php'> HERE </a?>"." ";
                    
                    $stmt->close();
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
