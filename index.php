<?php
if($_SERVER['REQUEST_URI'] == "/index.php/"){
	header('Location: /index.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plotorius Network | Homepage</title>
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
    <script
    src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
    crossorigin="anonymous"></script>
    <script src="semantic/dist/semantic.min.js"></script>
</head>

<body style="background-color:#1f1f1f;">
<?php
function timeConvert ( $zaman ){
	$zaman =  strtotime($zaman);
	$zaman_farki = time() - $zaman;
	$saniye = $zaman_farki;
	$dakika = round($zaman_farki/60);
	$saat = round($zaman_farki/3600);
	$gun = round($zaman_farki/86400);
	$hafta = round($zaman_farki/604800);
	$ay = round($zaman_farki/2419200);
	$yil = round($zaman_farki/29030400);
	if( $saniye < 60 ){
		if ($saniye == 0){
			return "Shortly before";
		} else {
			return $saniye .' seconds ago';
		}
	} else if ( $dakika < 60 ){
		return $dakika .' minutes ago';
	} else if ( $saat < 24 ){
		return $saat.' hours ago';
	} else if ( $gun < 7 ){
		return $gun .' days ago';
	} else if ( $hafta < 4 ){
		return $hafta.' weeks ago';
	} else if ( $ay < 12 ){
		return $ay .' months ago';
	} else {
		return $yil.' years ago';
	}
}
?>

<?php include('navbar.php'); ?>

<?php

$sql = 'SELECT * FROM videos';
$statement = $connection->prepare($sql);
$statement->execute();
$final = $statement->fetchAll(PDO::FETCH_OBJ);

?>
<div class="ui six doubling stackable cards">
<?php foreach($final as $result): ?>
<?php
$find = $connection->prepare("select * from users where id=?;");
$find->execute(array($result->videoowner));
$result1 = $find->fetch();
?>
<div class="ui card">
<a href=/watch.php?v=<?php echo $result->id; ?>><img class="ui rounded image" width=303px height=203px src="<?php echo $result->videothumbnail; ?>"></a>
<div class="content">
      <div class="header"><?php $bol= substr($result->videoname,0,24); $bol2 = substr($result->videoname,24,60); if(strlen($bol) <= 24){echo "<center>$bol</center>";}else{echo "$bol";} if(strlen($bol2) <= 24){echo "<center>$bol2</center>";} else if(strlen($bol2) > 24){ $bol2new = substr($bol2,24,48); $bol2new .= "..."; echo "<center>" . $bol2new . "</center>";  } ?></div>
      <div class="left floated meta">
        <a><?php echo $result->videocategory; ?></a>
      </div>
	  <div class="right floated meta">
        <a>Views: <?php echo $result->videoviews; ?></a>
      </div>
    </div>
    <div class="extra content">
      <span class="right floated">
      <?php echo timeConvert($result->videouploaddate); ?>
      </span>
	  <font color=black>
        <img class="ui circular image" width=32px height=32px src="<?php echo $result1["avatar"]; ?>"></i>
        <?php echo $result1["username"]; ?><br>
      </font>
    </div>
</div>
<?php endforeach; ?>
</div>
</body>
</html>
<?php
}
?>