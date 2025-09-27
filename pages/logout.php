<?php
  session_start();
  session_regenerate_id(true); // إنشاء معرف جلسة جديد وإلغاء القديم
  session_unset();
  session_destroy();
  header("Location: ./login/index.php");
  exit();
  
?>