<?php
@session_start(); 
@ob_start();
require('config.php');

$videocontrol = $connection->prepare("select * from videos where id=?");
$videocontrol->execute(array($_GET["v"]));          
if($videocontrol->rowCount() == 0){
  header('Location: videoerror.php');
}
else{
$find = $connection->prepare("select * from videos where id=?;");
$find->execute(array($_GET["v"]));
$result5 = $find->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <title><?php echo $result5["videoname"]; ?></title>
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
<?php
$videoid = $_GET['v'];

$find = $connection->prepare("select * from videos where id=?;");
$find->execute(array($_GET["v"]));
$result6 = $find->fetch();

$oldview = $result6["videoviews"];
$newview = 1 + $oldview;

$updateviews = $connection->prepare("UPDATE videos SET videoviews=? WHERE id=?");
$updateviews->execute(array($newview,$videoid));

?>

<?php require('navbar.php'); 
?>

<?php

$find = $connection->prepare("select * from videos where id=?;");
$find->execute(array($_GET["v"]));
$result = $find->fetch();

$find = $connection->prepare("select * from users where id=?;");
$find->execute(array($result["videoowner"]));
$result1 = $find->fetch();

$find = $connection->prepare("select * from users where id=?;");
$find->execute(array(@$_SESSION['id']));
$acc = $find->fetch();
 ?>

<div class="container">

<div class="ui two column centered grid">

  <div class="black column">
  <div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="<?php echo $result["videosrc"]; ?>"></iframe>
  </div>
  </div>
</div>

<div class="ui two column centered grid">
  <div class="black column">
  <font size=4px color=white><b><?php echo $result["videoname"]; ?></b></font>
  <?php if($result["videoowner"] == @$_SESSION['id']) : ?>
  <form action="" method="post">
        <input type=hidden name=uid value="<?php echo $_SESSION['id']; ?>">
        <input type=hidden name=vid value="<?php echo $result["id"]; ?>">
        <button id="deletevideo" name="deletevideo" style="border: none; background-color: inherit; cursor: pointer; ">
        <font color=white><?php echo $lang['delete']; ?></font></button><?php
        if ( isset($_POST['deletevideo']) ){
          $uid = $_POST['uid'];
          $vid = $_POST['vid'];

          if($uid != $result["videoowner"]){}
          else{
            if($uid != $_SESSION['id']){}
            else{
              if($vid != $result["id"]){}
              else{
                $videodelete = $connection->prepare("DELETE FROM videos WHERE id=?");
                $videodeletework = $videodelete->execute(array("$videoid"));
        
                $videosrc = $result['videothumbnail'];
                $videothumbnail = $result['videosrc'];

                $videomessagedelete = $connection->prepare("DELETE FROM comments WHERE videoid=?");
                $videomessagedeletework = $videomessagedelete->execute(array("$videoid"));
        
                if($videodelete){
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/" ."$videosrc");
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/" . "$videothumbnail");
        
                    header('Location: ../index.php');
                  }else{
                }                
              }
            }
          }
        }
        ?>
  </form>
  <?php endif; ?><br>
  <?php echo $lang['views']; ?>: <?php echo $result["videoviews"]; ?><br><br>
  <hr><br>
  <img class="ui middle aligned image" width=32px height=32px src="<?php echo $result1["avatar"]; ?>">
  <span><font color=white size=2px><?php echo $result1["username"]; ?> • </font><font size=2px color=white><?php echo timeConvert($result["videouploaddate"]); ?></font></span><br><br>
  <font size=2px color=white><?php echo $result["videodesc"]; ?></font><br><br>
  <font size=2px color=lightgrey><?php echo $lang['videocategory']; ?>: <a href=#><?php echo $result["videocategory"]; ?></a></font><br><br>
  </div>
</div>

<?php

$statement = $connection->prepare("select * from comments where videoid=?;");
$statement->execute(array($videoid));
$final = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<div class="ui two column centered grid">
<div style="background-color:#252525;" class="column">
<?php
if(!isset($_SESSION["id"])){?>
  <div class="ui horizontal divider">
    <font color=White><?php echo $lang['loginforcomment']; ?></font>
  </div>
  <?php
  }
?>
</div>
</div>

<?php
if(isset($_SESSION["id"])){?>

<div class="ui two column centered grid">
<div style="background-color:#252525;" class="column">
<div class="ui comments">
  <div class="comment">
    <a class="avatar">
      <img src="<?php echo $acc["avatar"]; ?>">
    </a>
    <div class="content">
      <form action="" method="post" class="ui reply form form-inline">
        <div>
        <div class="row">
        <input id="comment" name=comment required></input>
        </div>
        </div>
        <div class="ui buttons right aligned right floated left aligned">
        <button type="reset" class="ui secondary button"><?php echo $lang['cancel']; ?></button>
        <div class="or grey"></div>
        <button type="submit" name=makecomment id=makecomment class="ui secondary button"><?php echo $lang['send']; ?></button>
        </div>

  <?php if ( isset($_POST['makecomment']) ){
	$comment = htmlspecialchars($_POST['comment']);
	$accountid = $_SESSION['id'];
	$date = date("Y-m-d H:i:s");

	$insertcomment = $connection->prepare("insert into comments set accountid=?,videoid=?,comment=?,date=?");
	$insertcomment->execute(array($accountid,$videoid,$comment,$date));
	
	if($insertcomment){
    header("refresh:0;"); 
	}else{
	
	}
  } ?>

      </form>
    </div>
  </div>
</div>
</div>
</div>
<?php
  }
  ?>
  
<?php foreach($final as $result): ?>
<?php
$find = $connection->prepare("select * from users where id=?;");
$find->execute(array($result->accountid));
$result3 = $find->fetch();
?>

<div class="ui two column centered grid">
  <div style="background-color:#252525;" class="column">
  <div class="ui comments">
  <div class="comment">
    <a class="avatar">
      <img src="<?php echo $result3["avatar"]; ?>">
    </a>
    <div class="content">
      <a class="author"><font color=white><?php echo $result3["username"]; ?></font></a>
      <div class="metadata">
        <div class="date"><font color=white><?php echo timeConvert($result->date); ?></font></div>
      </div>
      <div class="text">
      <font color=white><?php echo $result->comment ?> </font>
      </div>
      <div class="actions">
      <?php if($result->accountid == @$_SESSION['id']) : ?>
      <form action="" method="post">
        <input type=hidden name=uid value="<?php echo $_SESSION['id']; ?>">
        <input type=hidden name=mid value="<?php echo $result->id; ?>">
        <button id="deletemessage" name="deletemessage" style="border: none; background-color: inherit; cursor: pointer; ">
        <font color=white><?php echo $lang['delete']; ?></font></button><?php
        if ( isset($_POST['deletemessage']) ){
        $uid = $_POST['uid'];
        $mid = $_POST['mid'];

        if($uid != $result->accountid){
        }else{
          if($result->id != $mid){
          }else{
            if($_SESSION["id"] != $result->accountid){
            }else{
              $messagedelete = $connection->prepare("DELETE FROM comments WHERE id=?");
              $work = $messagedelete->execute(array("$mid"));
              if($messagedelete){
                header("Refresh:0");
                }else{
              }
            }
          }
        }
      }?>
      </form>
      <?php endif; ?>
      </div>
    </div>
  </div>
</div>
  </div>
</div>

<?php endforeach; ?>


</div>

</body>
</html>
<?php
@ob_end_flush();
}
?>