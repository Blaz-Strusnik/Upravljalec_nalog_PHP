<?php

if ( session_status() == PHP_SESSION_NONE ) {
    session_start();
  }

  $clearMessage = false;

  $host     = '';
  $db       = '';
  $username = '';
  $password = '';

  mysqli_report(MYSQLI_REPORT_STRICT);
  try {
      $mysqli = new mysqli($host,$username,$password,$db);
      $mysqli -> set_charset("utf8");
      //echo 'connected successfully';
  } catch (Exception $e) {
      echo 'ERROR:'.$e->getMessage();
  }
  

    // Connection
  ?>