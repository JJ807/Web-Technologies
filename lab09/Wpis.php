<?php
 
class Wpis implements NoteInterface {
 
   protected $data = array()  ;
   private $dbh;
   private $dbfile = "files/notes.db" ;
   
   //fk autoload
   function __autoload($class_name) {
    include $class_name . '.php' ;
    }
   
   
   function __construct () { 
        session_start() ; 
   }
       
   function _post () {
      $this->data['nowy_wpis'] = $_POST['nowy_wpis'] ;
   }          
   
   /*Odczyt danych przeslanych z formularza*/
   function _read () {
      echo "Wpis: ". $this->data['nowy_wpis'] ." <br/>"; 
   }  
   
   /*Zapis do pliku*/
   function _save_messages() {
      
      $email = $_SESSION['user']; 
      echo "Twoj email: $email <br/><br/>";
      $this->dbh = dba_open( $this->dbfile, "c");
      $serialized_data = serialize($this->data);
      dba_insert($email."&".$_SERVER['REQUEST_TIME'], $serialized_data, $this->dbh);
      $text = 'Dane zostały zapisane' ;
      dba_close($this->dbh) ;
      return $text;
    
   }
   
   /*Odczyt listy wpisow z pliku*/
   function _read_messages() {
      $table = array();
      $this->dbh = dba_open( $this->dbfile, "r");   
      $key = dba_firstkey($this->dbh);
      while ($key) {
         $serialized_data = dba_fetch($key, $this->dbh) ;
         $this->data = unserialize($serialized_data);
         $table[$key]['nowy_wpis'] = $this->data['nowy_wpis'];
         $key = dba_nextkey($this->dbh);
      }    
      dba_close($this->dbh) ;  
      return $table;   
   }
}
?>