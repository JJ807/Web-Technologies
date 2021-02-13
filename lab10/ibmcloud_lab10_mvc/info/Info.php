<?php
 
namespace info ;


 
use appl\ { View, Controller } ;


/**
 * Klasa Register
 */
class Register {

  protected $data = array()  ;

  function __construct () { 
  }
     
  function _read () {
     $this->data['fname'] = $_POST['fname'] ;
     $this->data['lname'] = $_POST['lname'] ;
     $this->data['email'] = $_POST['email'] ;
     $this->data['pass']  = $_POST['pass'] ;
  }          

  function _write () {
     echo "Wprowadzone dane (obiektowo) <br/>" ;
     echo "Imię: ". $this->data['fname'] ." <br/>" ;   
     echo "Nazwisko: ". $this->data['lname'] ." <br/>" ;
     echo "E-mail: ". $this->data['email'] ." <br/>" ;
     echo "Hasło: ". $this->data['pass'] ." <br/>" ; 
  }  
}

/**
 * Klasa Register_new
 */
class Register_new extends Register {

  private $dbh;
  private $dbfile = "../sql/datadb.db" ;

  function __construct () {
     parent::__construct() ;  
     session_start() ;
  }
/*
* Wylogowanie uzytkownika do serwisu 
*/

  function _logout() {
     unset($_SESSION); 
     session_destroy();   
     $text =  'Uzytkownik wylogowany ' ;
     return $text ;
  }
/*
*  Zapis danych do bazy
*/

  function _save () {
     $this->dbh = dba_open( $this->dbfile, "c");
     if ( ! dba_exists($this->data['email'], $this->dbh ) ) {
        $serialized_data = serialize($this->data) ;
        dba_insert($this->data['email'],$serialized_data, $this->dbh) ;
        $text = 'Dane zostały zapisane' ;
     } else {          
        $text = 'Dane dla podanego adresu e-mail sa w bazie danych' ;
     }
     dba_close($this->dbh) ;
     return $text;
  }
  
  /*
* Logowanie uzytkownika do serwisu 
*/

  function _login() {
     $email = $_POST['email'] ;
     $pass  = $_POST['pass'] ;
     $access = false ;
     $this->dbh = dba_open( $this->dbfile, "r");   
     if ( dba_exists( $email, $this->dbh ) ) {
        $serialized_data = dba_fetch($email, $this->dbh) ;
        $this->data = unserialize($serialized_data);
        if ( $this->data['pass'] == $pass ) {
           $_SESSION['auth'] = 'OK' ;
           $_SESSION['user'] = $email ;
           $access = true ;
        } 
     }      
     dba_close($this->dbh) ;   
     $text = ( $access ? 'Uzytkownik zalogowany' : ' Uzytkownik nie zalogowany ' ) ;
     return $text ;

  }

/*
* Sprawdzamy czy uzytkownik jest zalogowany 
*/

  function _is_logged() {
     if ( isset ( $_SESSION['auth'] ) ) { 
        $ret = $_SESSION['auth'] == 'OK' ? true : false ;
     } else { $ret = false ; }
     return $ret ;
  }
  
  /*
* Pobranie danych uzytkownika z bazy 
*/

  function _read_user() {
     $email = $_SESSION['user'] ;
     $this->dbh = dba_open( $this->dbfile, "r");   
     if ( dba_exists( $email, $this->dbh ) ) {
        $serialized_data = dba_fetch($email, $this->dbh) ;
        $this->data = unserialize($serialized_data);
     }   
     dba_close($this->dbh) ;   
  }

/*
* Pobranie danych uzytkownikow z bazy 
*/

  function _read_all() {
     $table = array();
     $this->dbh = dba_open( $this->dbfile, "r");   
     $key = dba_firstkey($this->dbh);
     while ($key) {
        $serialized_data = dba_fetch($key, $this->dbh) ;
        $this->data = unserialize($serialized_data);
        $table[$key]['email'] = $this->data['email'];
        $table[$key]['fname'] = $this->data['fname'];
        $table[$key]['lname'] = $this->data['lname'];
        $key = dba_nextkey($this->dbh);
     }    
     dba_close($this->dbh) ;  
     return $table;
  }   
}

 /**
  * Klasa Info 
  */
class Info extends Controller {
 
   protected $layout ;
   protected $model ;
 
   function __construct() {
       // stworzenie nowego widoku z pliku main.tpl
      parent::__construct();

      $user = new Register_new;
      if ( $user->_is_logged() )
      {
        $this->layout = new View('main') ;
      }
      else{
        $this->layout = new View('main2') ;
      }

      $this->layout->css = $this->css ;
      // $this->layout->css = "<link rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\" media=\"screen\" >" ;  
      $this->layout->menu = $this->menu ;
      // $this->layout->menu = file_get_contents ('template/menu.tpl') ;
      $this->layout->title = 'Simple MVC' ;
   }
 
  function index() {
      $this->layout->header  = 'Simple MVC' ;
      $this->layout->content = 'Template - test !' ;
      return $this->layout ;
  }
 
  function help() {
      $this->model = new Model();
      $this->layout->header  = 'Simple MVC' ;
      $this->view = new View('table') ;
      $this->view->data = $this->model->getTable() ;
      $this->layout->content = $this->view ;
      return $this->layout ;
  }
 
  function error( $text ) {
      $this->layout->content = $text ;
      return $this->layout ;       
  }
}
 
?>