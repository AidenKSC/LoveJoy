<?php

echo "<form action='LoginPageCheck.php' method='POST'>";

echo "Email: ";
echo "<input name='txtEmail' type='text' />";

echo "<br />";

echo "<br /> Password: " ;
echo "<input name='txtPassword' type='password' />";

echo "<br />";
echo "<br />";

echo "Security Question: " ;

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


echo "<div class='h-captcha' data-sitekey='639755e8-ab09-4bf6-a5a9-54e4171416d2'></div>";
echo "<script src='https://hcaptcha.com/1/api.js' async defer></script>";

echo "<br />";
echo "<br />";

echo "<br /> <input type='submit' value='Login'>";

echo "<br />";
echo "<br />";

echo "Not registrered yet ? Click <a href= 'RegistrationPage.php'>HERE</a?>";

echo "<br />";
echo "<br />";

echo "<a href= 'AdminLogin.php'>Admin Login</a?>";

echo "<br />";
echo "<br />";

echo "<a href= 'forgotPassword.php'>Reset Password</a?>";

echo "</form>";

?>
