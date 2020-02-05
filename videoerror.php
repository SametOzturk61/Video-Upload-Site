<?php
@session_start(); 
@ob_start();
require('config.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <title><?php echo $lang['videoerror']; ?></title>
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>

</head>
<body style="background-color:#1f1f1f;">
<style>
.embed-responsive{position:relative;display:block;width:100%;padding:0;overflow:hidden}.embed-responsive::before{display:block;content:""}.embed-responsive .embed-responsive-item,.embed-responsive embed,.embed-responsive iframe,.embed-responsive object,.embed-responsive video{position:absolute;top:0;bottom:0;left:0;width:100%;height:100%;border:0}.embed-responsive-21by9::before{padding-top:42.857143%}.embed-responsive-16by9::before{padding-top:56.25%}.embed-responsive-4by3::before{padding-top:75%}.embed-responsive-1by1::before{padding-top:100%}
</style>

<?php require('navbar.php'); ?>
<div class="container">

<div class="ui two column centered grid">

  <div class="black column">
<br><br>
  <div class="ui error message">
  <div class="header">
  <?php echo $lang['videoerrortext']; ?>
  </div>
  <ul class="list">
    <li><?php echo $lang['videoerrortextlist']; ?></li>

  </ul>
</div>

  </div>
</div>

<div class="ui two column centered grid">
  <div class="black column">
  <br><br>
  </div>
</div>

</div>

</body>
</html>
<?php
@ob_end_flush();
?>