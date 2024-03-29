<?php

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
         $serialized_data = serialize($this->data);
         $arr = unserialize($serialized_data);
         //echo $arr['pass'];
         $arr['pass'] = md5($arr['pass']);
         //echo $arr['pass'];
         $serialized_data_2 = serialize($arr);
         dba_insert($this->data['email'], $serialized_data_2, $this->dbh) ;
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
         if ( $this->data['pass'] == md5($pass) ) {
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
?>