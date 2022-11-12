<?php

echo "<form action='RegistrationPageCheck.php' method='POST'>";

echo "<h1> Registration Page: </h1>";

echo "<pre>";

echo "Email: ";
echo    "<input name='txtEmail' type='text' />";

echo "<br />";
echo "<br />";

echo "Name: ";
echo    "<input name='txtName' type='text' />";

echo "<br />";
echo "<br />";

echo "Password: ";
echo    "<input name='txtPassword1' type='password' />"; 

echo "<br />";
echo "<br />";

echo "Enter Password Again: ";
echo    "<input name='txtPassword2' type='password' />";

echo "<br />";
echo "<br />";

echo "Contact Telephone Number: ";
echo    "<input name='txtNumber' type='text' />";

echo "<br />";
echo "<br />";

echo"Security Questions: "; 

echo "<br />";
echo "<br />";

echo"<Select name= 'SecQuestion'>";
echo"<option value='Select'>Select</option> ";     
echo"<option value='food'>What is your favourite food?</option>";       
echo"<option value='pet'>What was your first pet's name?</option>";
echo"<option value='pet'>What's your favourite colour?</option>";     
echo"</Select>";

echo "<br />";
echo "<br />";

echo "<input name='txtSecQuestion' type='text' />";

echo "<br />";
echo "<br />";
echo "<br />";

echo "<div class='h-captcha' data-sitekey='639755e8-ab09-4bf6-a5a9-54e4171416d2'></div>";
echo "<script src='https://hcaptcha.com/1/api.js' async defer></script>";

echo "</pre>";

echo "<br/> <input type='submit' value='Register' >";
echo "</form>";


echo "<form action='index.php' method='POST'>";
echo "<input type='submit' value='Go back'>";
echo "</form>";

?>