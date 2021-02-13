  <!DOCTYPE html>
  
<html>
    <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
   	<title>Zadanie 9 - Lab 10</title>
   	<?php echo $css ; ?>   
   	<script  src="js/baza.js"></script> 
    </head>
    <nav>
      <a href="index.php">Strona główna</a><br>
      <a href="index.php?sub=Info&amp;action=help">Opis serwisu</a><br>
      <a href="index.php?sub=Baza&amp;action=listAll">Zawartosc bazy</a><br>
      <a href="index.php?sub=Baza&amp;action=insertRec">Wprowadzanie danych</a><br>      
      <a href="info/logout_action.php">Wylogowanie z serwisu</a><br>
    </nav>
    <body>   
        <header><?php echo $title; ?></header>
        <section>
          <header><?php echo $header; ?></header>
          <article><?php echo $content; ?></article> 
        </section>
        <footer>Techniki internetowe &copy; 2020</footer> 
    </body>
</html>