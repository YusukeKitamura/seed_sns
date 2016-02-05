<?php 
  // DB接続準備
  // $dsn = 'mysql:dbname=seed_sns;host=root';
  // $user = 'root';
  // $password = 'mysql';
  // $dbh = new PDO($dsn,$user,$password);
  // $dbh->query('SET NAMES utf8');
  $db = mysqli_connect('localhost', 'root', '', 'seed_sns') or die(mysqli_connect_error());
  mysqli_set_charset($db, 'utf8');
  
 ?>
