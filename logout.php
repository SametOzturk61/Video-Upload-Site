<?php
session_start();
if(!isset($_SESSION["username"])){
   echo "<script>javascript:history.go(-1)</script>";
  }else{
?>
<?php
ob_start();
session_unset();
session_destroy();
echo "<script>javascript:history.go(-1)</script>";
ob_end_flush();
exit;
?>
<?php
}
?>