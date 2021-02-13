<?php
 
function __autoload($class_name) {
    include $class_name . '.php' ;
}

$user = new Register_new;
if ($user->_is_logged())
{ 
$wpis = new Wpis ;
$wpis->_post();
$wpis->_read();
echo $wpis->_save_messages();
echo "<p><a href='zad04.php'>Powrot do programu glownego</a></p>";
}             
?>