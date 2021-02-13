<?php
 
function __autoload($class_name) {
    include $class_name . '.php' ;
}
 

echo "<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
  text-align: center;
}
table {
  border-spacing: 5px;
}
</style>";
  
$user = new Register_new ;
$wpis = new Wpis;

$obecny = $_SESSION['user'];
echo "<h1>Informacje uzytkownika $obecny </h1><br/>";
 
if ( $user->_is_logged() ) { 
     $table = $wpis->_read_messages();
     echo "<table><tr><th>Data </th><th> Wpis</th></tr>" ;
     
     foreach ( $table as $key => $record ) {
     
     $substring = explode("&",$key);
     $email = $substring[0];
     $data = date('D Y-m-d H:i:s',$substring[1]);
     if($email == $obecny){
        echo "<tr><td>".$data."</td><td>".$record['nowy_wpis']."</td><tr>";
       }
     }
     echo "</table>" ;
     echo "<p><a href='zad04.php'>Powrot do programu glownego</a></p>";
}
 
?>