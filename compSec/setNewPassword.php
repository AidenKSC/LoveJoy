<?php

echo "<form action='updatePassword.php' method='POST'>";

echo "Enter Email: ";

echo "<input name='txtEmail' type='text' />";

echo "<br />";
echo "<br />";

echo "Enter New Password: ";
echo    "<input name='txtPassword1' type='password' />";

echo "<br />";
echo "<br />";

echo "Enter New Password again: ";
echo    "<input name='txtPassword2' type='password' />"; 

echo "<br />";
echo "<br />";

echo "<br /> <input type='submit' value='Reset Password'>";

echo "</form>";


?>