<?php

//CONNECTION
$mysql_host="krier.uscs.susx.ac.uk";
$mysql_database="G6077_sk727";
$mysql_user="sk727";
$mysql_password="Mysql_493329";

//Create Connection
$connection = mysqli_connect($mysql_host, $mysql_user,$mysql_password, $mysql_database) or die ("could not connect to the server");

//values come from request page
$email = $_POST['txtEmail'];
$email = htmlspecialchars($email);

$request = $_POST['txtRequest'];
$request = htmlspecialchars($request);

$details = $_POST['txtDetails'];
$details = htmlspecialchars($details);

$contactMethod = $_POST['txtContactMethod'];
$contactMethod = htmlspecialchars($contactMethod);


//SET ERROR OCCURRED TO 0
$errorOccurred = 0;


//check if email is blank
if($email == "")
{
    echo "Email is blank <br/>";
    $errorOccurred = 1;
}

//check if request is blank
if($request == "")
{
    echo "Request is blank <br/>";
    $errorOccurred = 1;
}

//check if detail is blank
if($details == "")
{
    echo "Details is blank <br/>";
    $errorOccurred = 1;
}

//check if detail is blank
if($contactMethod == "Select")
{
    echo "Contact Method not selected <br/>";
    $errorOccurred = 1;
}



//Put image into folder
$msg = ""; 
  
  // If upload button is clicked ...
  if (isset($_POST['submit'])) {
  
    $filename = $_FILES["txtImage"]["name"];
    $tempname = $_FILES["txtImage"]["tmp_name"];    
    $folder = "./image/".$filename;
    
    $connection = mysqli_connect($mysql_host, $mysql_user,$mysql_password, $mysql_database) or die ("could not connect to the server");
       
        // move the uploaded image into the folder:image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully"; 
        }else{
            $msg = "Failed to upload image"; 
      }
  }


//INSERT INTO DATABASE
//Check if email is already registered in the database.
$userResult = $connection ->query("SELECT * FROM EvaluationRequest");

//Check to see if an error has occurred. Then add the details to the database.
if($errorOccurred == 0)
{
    //add all of the contents of the variables to the SystemUser table
    $stmt = $connection->prepare("INSERT INTO EvaluationRequest (email, request, detail, contactMethod, image)
    VALUES (?, ?, ?, ?, ?)");

    $stmt -> bind_param('sssss',$email, $request, $details, $contactMethod, $filename);
    $stmt ->execute();

        //Request is sumbitted
        echo "Request Submitted"; 

        echo"<br/>";
        echo"<br/>";

        echo "<form action='RequestPage.php' method='POST'>";
        echo "<input type='submit' value='Go back'>";
        echo "</form>";

        echo "<form action='LogoutPage.php' method='POST'>";
        echo "<input type='submit' value='Logout'>";
        echo "</form>";
    }
    else
    {
        echo"Submission failed";
    }       


?>