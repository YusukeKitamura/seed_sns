<?php 
  session_start();
  require('dbconnect.php');

  if (isset($_SESSION['member_id'])) {
  	$del_id = $_REQUEST['tweet_id'];

  	//投稿を検査する
  	$sql = sprintf('SELECT * FROM `tweets` WHERE tweet_id=%d',
    mysqli_real_escape_string($db, $del_id));
    $record = mysqli_query($db, $sql) or die(mysqli_error($db));
    $table = mysqli_fetch_assoc($record);
    
    if ($table['member_id'] == $_SESSION['member_id']) {
	  	$sql = sprintf('DELETE FROM `tweets` WHERE tweet_id=%d',
	    mysqli_real_escape_string($db, $del_id));
	    mysqli_query($db, $sql) or die(mysqli_error($db));
    }
  }

  header('Location: index.php');
  exit();
 ?>
