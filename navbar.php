<?php
 if($_SERVER['REQUEST_URI'] == '/navbar.php'){
  echo "<script>javascript:history.go(-1)</script>";
}
?>
<?php require('/config.php'); 
@session_start(); 
@ob_start();
?>
<?php
      $find = $connection->prepare("select * from users where id=?;");
      $find->execute(array(@$_SESSION['id']));
      $result = $find->fetch();
?>
        <?php
        if(isset($_SESSION["id"])){
          $currentlang = $result["language"];
          $languagefile="lang/";
          include('/' . $languagefile . $currentlang . '.php');
          
          }else{
          include('/lang/en.php');
          }
          ?>
<?php
if($result["language"] == "tr"){

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
		  return "kısa süre önce";
		} else {
		  return $saniye .' saniye önce';
		}
	  } else if ( $dakika < 60 ){
		return $dakika .' dakika önce';
	  } else if ( $saat < 24 ){
		return $saat.' saat önce';
	  } else if ( $gun < 7 ){
		return $gun .' gün önce';
	  } else if ( $hafta < 4 ){
		return $hafta.' hafta önce';
	  } else if ( $ay < 12 ){
		return $ay .' ay önce';
	  } else {
		return $yil.' yıl önce';
	  }
	}
  
  }
  if($result["language"] == "en"){
  
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
  
  }
  
  ?>
  
<div class="row">
<div class="ui inverted segment">
      <div class="ui secondary inverted pointing menu">
        <a href="index.php" class="active item"><?php echo $lang['flag']; ?>PlotoriusNetwork</a>
        <a class="item"><?php echo $lang['trends']; ?></a>
        <a class="item"><?php echo $lang['channels']; ?></a>
        <a class="item"><?php echo $lang['support']; ?></a>
        <?php if(isset($_SESSION['id'])) : ?>
        <div class="right item">
        <?php $find = $connection->prepare("select * from users where id=?;");
$find->execute(array($_SESSION['id']));
$result = $find->fetch();
$showusername = $result["username"]; 

?>
<img class="ui circular image" width=32px height=32px src="<?php echo $result["avatar"]; ?>"></img>&nbsp;&nbsp; <?php echo "<font color=white>$showusername</font>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;

<div class="ui icon top left pointing dropdown">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <a id="upload" class="item ui inverted button"><i class="upload icon"></i><?php echo $lang['upload']; ?></a>
    <a id="settings" class="item ui inverted button"><i class="cog icon"></i><?php echo $lang['settings']; ?></a>
    <a href="/logout.php" class="item"><i class="sign-out icon"></i><?php echo $lang['logout']; ?></a>
  </div>
</div>

       </div>        
<script>
        $('.ui.dropdown')
  .dropdown()
;
</script>
        <?php endif; ?>
        <?php if(!isset($_SESSION['id'])) : ?>
        <div class="right item">
          <a id="register" class="ui inverted button"><i class="user icon"></i><?php echo $lang['login&register']; ?></a>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

<script>
            $(document).ready(function(){
                $('#register').click(function(){
                    $('#register-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#upload').click(function(){
                    $('#upload-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<div id="upload-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['uploadvideo']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post enctype="multipart/form-data" class="ui form">
  <div class="field">
    <label><?php echo $lang['videoname']; ?></label>
    <input type="text" name="videoname" id="videoname" placeholder="<?php echo $lang['videoname']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['videodescription']; ?></label>
    <input type="text" name="videodescription" id="videodescription" placeholder="<?php echo $lang['videodescription']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['videocategory']; ?></label>
    <select class="ui fluid dropdown" name="videocategory" id="videocategory" required>
      <option value="Normal">Normal</option>
      <option value="Game">Game</option>
      <option value="Music">Music</option>
    </select>
  </div>
  <div class="field">
    <label><?php echo $lang['videothumbnailfile']; ?></label>
    <input type="file" accept="image/*" name="thumbnail" id="thumbnail" required>
  </div>
  <div class="field">
    <label><?php echo $lang['videofile']; ?></label>
    <input type="file" accept="video/*" name="videofile" id="videofile" required>
  </div>
  <div class="field">

    <?php
	if ( isset($_POST['upload']) ){
        $videoname     = htmlspecialchars($_POST["videoname"]);
        $videodesc     = htmlspecialchars($_POST["videodescription"]);
        $videocategory = htmlspecialchars($_POST["videocategory"]);
        $videoowner    = $_SESSION['id'];
      if($videocategory != "Normal" && $videocategory != "Game" && $videocategory != "Music"){
        $uploaderrortype = 9;?>
        <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
        <?php
      }else{
        if ($_FILES["thumbnail"]["size"]>5120*5120){
           
            $uploaderrortype = 1;?>
            <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
            <?php
        }else{
            if ($_FILES["thumbnail"]["type"]!="image/png" && $_FILES["thumbnail"]["type"]!="image/jpeg"){
               
                $uploaderrortype = 2;?>
                <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                <?php
            }else{
                if($_FILES["videofile"]["size"]>512000*512000){
                    
                    $uploaderrortype = 3;?>
                    <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                    <?php
                }else{
                    if($_FILES["videofile"]["type"]!="video/mp4" && $_FILES["videofile"]["type"]!="video/avi" && $_FILES["videofile"]["type"]!="video/mpg" && $_FILES["videofile"]["type"]!="video/mov"){
                        
                        $uploaderrortype = 4;?>
                        <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                        <?php
                    }else{
                        // Random function
                        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                        .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                        .'0123456789!');
                        shuffle($seed);
                        $random = '';
                        foreach (array_rand($seed, 30) as $k) $random .= $seed[$k];
                        ///////////////////////////////////////////////////////////
                        $thumbnailfilename   =    $_FILES["thumbnail"]["name"];
                        $thumbnailextension=substr($thumbnailfilename,-4,4);
                        $videofilename   =    $_FILES["videofile"]["name"];
                        $videoextension=substr($videofilename,-4,4);

                        $destination_path = getcwd();

                        $mysqlthumbnailsrc = "/img/thumbnail/".$random.$thumbnailextension;
                        $filethumbnailsrc = $destination_path . ".." . $mysqlthumbnailsrc;

                        $mysqlvideosrc = "/videos/".$random.$videoextension;
                        $filevideosrc = $destination_path . ".." . $mysqlvideosrc;

                        $uploadthumbnail = move_uploaded_file($_FILES["thumbnail"]["tmp_name"],$filethumbnailsrc);

                        if(!$uploadthumbnail){
                            
                            $uploaderrortype = 5;?>
                            <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                            <?php       
                        }else{
                            $uploadvideo = move_uploaded_file($_FILES["videofile"]["tmp_name"],$filevideosrc);
                        }if(!$uploadvideo){
                            
                            $uploaderrortype = 6;?>
                            <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                            <?php
                        }else{
                            $date = date("Y-m-d H:i:s");
                            $uploaded = $connection->prepare("INSERT INTO videos SET id=:id,videoname=:videoname,videodesc=:videodesc,videocategory=:videocategory,videothumbnail=:videothumbnail,videosrc=:videosrc,videouploaddate=:videouploaddate,videoowner=:videoowner");
                            $uploaded->execute(array(':id'=> $random,':videoname'=> $videoname,':videodesc'=>$videodesc,':videocategory'=>$videocategory,':videothumbnail'=>$mysqlthumbnailsrc,':videosrc'=>$mysqlvideosrc,':videouploaddate'=>$date,':videoowner'=>$_SESSION['id']));

                            if($uploaded){
                                
                                $uploaderrortype = 7; ?>
                                <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                                <?php
                            }else{
                                
                                $uploaderrortype = 8;?>
                                <script type="text/javascript"> $('#upload-modal').modal('show'); </script>
                                <?php
                            }
                        }
                    }
                }
            }
        }
      }     
}
?>
  </div>
        </div>
    </div>
<?php if(@$uploaderrortype == 0) : ?>

<?php endif; ?>
<?php if(@$uploaderrortype == 9) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype9']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 1) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype1']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 2) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype2']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 3) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype3']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 4) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype4']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 5) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype5']; ?>
  </div>
  <p><?php echo $lang['uploaderrortype5-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$uploaderrortype == 6) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype6']; ?>
  </div>
  <p><?php echo $lang['uploaderrortype6-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$uploaderrortype == 7) : ?>
  <div class="ui positive message">
  <div class="header">
  <?php echo $lang['uploaderrortype7']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 8) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['uploaderrortype8']; ?>
  </div>
  <p><?php echo $lang['uploaderrortype8-1']; ?>
</p></div>
<?php endif; ?>
<div id="loader" style="display:none;"><center><img width=32px height=32px src="/img/loading.gif"></img></center></div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        <input type="submit" value="<?php echo $lang['upload']; ?>" name="upload" id="upload" class="ui green button" onclick="document.getElementById('loader').style.display = 'block' ;"/>
        </form>
    </div>
</div>

<div id="register-modal" class="ui long modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['login&register']; ?></center>
    </div>
    <div class="image content">
        <div class="description">

<div class="ui equal width grid">
  <div class="equal width row">
  <div class="ui vertical divider"></div>
    <div class="column">
    <form method=post action="" class="ui form">
    <center><b><?php echo $lang['login']; ?></b></center><br>
  <div class="field">
    <label><?php echo $lang['username']; ?></label>
    <input type="text" name="username" id="username" placeholder="<?php echo $lang['username']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['password']; ?></label>
    <input type="password" name="password" id="password" placeholder="<?php echo $lang['password']; ?>" required>
  </div>
  
  <?php
	if ( isset($_POST['login']) ){
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $namecontrol = $connection->prepare("select * from users where username=?");
        $namecontrol->execute(array($username));          
        if($namecontrol->rowCount() == 0){
            $loginerrortype = 1;?>
            <script type="text/javascript"> $('#register-modal').modal('show'); </script>
            <?php
            }else{
                $passwordcontrol = $connection->prepare("select * from users where password=?");
                $passwordcontrol->execute(array(md5($password)));
                if($passwordcontrol->rowCount() == 0){
                    $loginerrortype = 2;?>
                    <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                    <?php
                    }else{
                            
                            $_SESSION['username'] = $username;
                            $find = $connection->prepare("select * from users where username=?;");
                            $find->execute(array($_SESSION['username']));
                            $result = $find->fetch();

                            $_SESSION['id'] = $result["id"];

                            if($result["ban"] == 1){
                              $loginerrortype = 3;?>
                              <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                              <?php
                            }else{

                            $date = date("Y-m-d H:i:s");
                            $updatelastlogin = $connection->prepare("UPDATE users SET lastlogin=? WHERE id=?");
                            $updatelastlogin->execute(array($date,$_SESSION['id']));   
   
                            if($updatelastlogin){
                            $loginerrortype = 0;
                            header("refresh:0;");                     
                            }else{
                            $loginerrortype = 4;?>
                            <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                            <?php
                        }
                    }
                }
            }
        }    
?>
<?php if(@$loginerrortype == 0) : ?>

<?php endif; ?>
<?php if(@$loginerrortype == 1) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['loginerrortype1']; ?>
  </div>
  <p><?php echo $lang['loginerrortype1-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$loginerrortype == 2) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['loginerrortype2']; ?>
  </div>
  <p><?php echo $lang['loginerrortype2-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$loginerrortype == 3) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['loginerrortype3']; ?>
  </div>
  <p><?php echo $lang['loginerrortype3-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$loginerrortype == 4) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['loginerrortype4']; ?>
  </div>
  <p><?php echo $lang['loginerrortype4-1']; ?>
</p></div>
<?php endif; ?>
  <button class="ui button" id=login name=login type="submit"><?php echo $lang['login']; ?></button>
</form>
    </div>
    <div class="column">
    <form method=post action="" class="ui form">
    <center><b><?php echo $lang['register']; ?></b></center><br>
  <div class="field">
    <label><?php echo $lang['username']; ?></label>
    <input type="text" name="username" id=username placeholder="<?php echo $lang['username']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['email']; ?></label>
    <input type="email" name="email" id="email" placeholder="<?php echo $lang['email']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['password']; ?></label>
    <input type="password" name="password" id=password placeholder="<?php echo $lang['password']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['passwordretry']; ?></label>
    <input type="password" name="passwordretry" id=passwordretry placeholder="<?php echo $lang['passwordretry']; ?>" required>
  </div>
  <div class="field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="0" required>
      <label><?php echo $lang['iagreetermsandconditions']; ?></label>
    </div>
  </div>
  <?php
	if ( isset($_POST['register']) ){
        $username = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);
        $passwordretry = htmlspecialchars($_POST["passwordretry"]);

        $namecontrol = $connection->prepare("select * from users where username=?");
        $namecontrol->execute(array($username));          
        if($namecontrol->rowCount() > 0){
          $registererrortype = 1;?>
          <script type="text/javascript"> $('#register-modal').modal('show'); </script>
          <?php
            }else{
                $emailcontrol = $connection->prepare("select * from users where email=?");
                $emailcontrol->execute(array($email));
                if($emailcontrol->rowCount() > 0){
                  $registererrortype = 2;?>
                  <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                  <?php
                    }else{
                        if($password != $password){
                          $registererrortype = 3;?>
                          <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                          <?php
                        }else{
                            $date = date("Y-m-d H:i:s");
                            $register = $connection->prepare("insert into users set username=?,email=?,password=?,regdate=?");
                            $register->execute(array($username,$email,md5($password),$date));

                            if($register){
                              $registererrortype = 4;?>
                              <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                              <?php
                                  }else{
                                    $registererrortype = 5;?>
                                    <script type="text/javascript"> $('#register-modal').modal('show'); </script>
                                    <?php
                            } 
                        }
                    }
            }
	}
?>
<?php if(@$registererrortype == 0) : ?>

<?php endif; ?>
<?php if(@$registererrortype == 1) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['registererrortype1']; ?>
  </div>
  <p><?php echo $lang['registererrortype1-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 2) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['registererrortype2']; ?>
  </div>
  <p><?php echo $lang['registererrortype2-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 3) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['registererrortype3']; ?>
  </div>
  <p><?php echo $lang['registererrortype3-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 4) : ?>
  <div class="ui positive message">
  <div class="header">
  <?php echo $lang['registererrortype4']; ?>
  </div>
  <p><?php echo $lang['registererrortype4-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 5) : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['registererrortype5']; ?>
  </div>
  <p><?php echo $lang['registererrortype5-1']; ?>
</p></div>
<?php endif; ?>
  <button class="ui button" id=register name=register type="submit"><?php echo $lang['register']; ?></button>
</form>
</div>
  </div>
</div>

        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
    </div>
</div>

<script>
            $(document).ready(function(){
                $('#settings').click(function(){
                    $('#settings-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#usernamechange').click(function(){
                    $('#usernamechange-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#passwordchange').click(function(){
                    $('#passwordchange-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#emailchange').click(function(){
                    $('#emailchange-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#avatarchange').click(function(){
                    $('#avatarchange-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#profileinformation').click(function(){
                    $('#profileinformation-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<script>
            $(document).ready(function(){
                $('#changelanguage').click(function(){
                    $('#changelanguage-modal')
  .modal({
    blurring: true
  })
  .modal('show')
;
                });
            });
</script>

<div id="settings-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['settings']; ?></center>
    </div>
    <div class="image content">
        <div class="description">

<div class="ui two column grid">
  <div class="four column row">
    <div class="column">
     <button id="usernamechange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      <?php echo $lang['changeusername']; ?>
     </button>
    </div>
    <div class="column">
     <button id="emailchange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      <?php echo $lang['changeemail']; ?>
     </button>
    </div>
    <div class="column">
     <button id="passwordchange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      <?php echo $lang['changepassword']; ?>
     </button>
    </div>
  </div>
  <div class="four column row">
    <div class="column">
     <button id="avatarchange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      <?php echo $lang['changeavatar']; ?>
     </button>
    </div>
    <div class="column">
     <button id="profileinformation" class="ui blue basic labeled icon button">
      <i class="info icon"></i>
      <?php echo $lang['profileinformations']; ?>
     </button>
    </div>
    <div class="column">
     <button id="changelanguage" class="ui blue basic labeled icon button">
      <i class="language icon"></i>
      <?php echo $lang['changelanguage']; ?>
     </button>
    </div>
  </div>
</div>

        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
    </div>
</div>

<div id="usernamechange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['changeusername']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label><?php echo $lang['oldusername']; ?></label>
    <input readonly="" placeholder="<?php echo $result["username"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['newusername']; ?></label>
    <input type="text" name="newusername" id=newusername placeholder="<?php echo $lang['newusername']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['password']; ?></label>
    <input type="password" name="password" id=password placeholder="<?php echo $lang['password']; ?>" required>

    <?php
	if ( isset($_POST['changeusername']) ){
        $oldusername = htmlspecialchars($result["username"]);
        $newusername = htmlspecialchars($_POST['newusername']);
        $password = htmlspecialchars($_POST['password']);

        if(md5($password) != $result["password"]){
            $changeusernameerrortype = "1";
            ?>
            <script type="text/javascript"> $('#usernamechange-modal').modal('show'); </script>
            <?php
        }else{      
        if($oldusername == $newusername){
            $changeusernameerrortype = "2";
            ?>
            <script type="text/javascript"> $('#usernamechange-modal').modal('show'); </script>
            <?php
        }else{
            $namecontrol = $connection->prepare("select * from users where username=?");
            $namecontrol->execute(array($newusername));          
            if($namecontrol->rowCount() > 0){
                $changeusernameerrortype = "3";
                ?>
                <script type="text/javascript"> $('#usernamechange-modal').modal('show'); </script>
                <?php
            }else{
                $updateusername = $connection->prepare("UPDATE users SET username=? WHERE id=?");
                $updateusername->execute(array($newusername,$_SESSION['id']));

                if($updateusername){
                    header("Refresh:2");
                    $changeusernameerrortype = "4";
                    ?>
                    <script type="text/javascript"> $('#usernamechange-modal').modal('show'); </script>
                    <?php
                }else{
                    $changeusernameerrortype = "5";
                    ?>
                    <script type="text/javascript"> $('#usernamechange-modal').modal('show'); </script>
                    <?php
                }
            }
        }
    }
}  
?>

<?php if(@$changeusernameerrortype == "0") : ?>
<?php endif; ?>
  <?php if(@$changeusernameerrortype == "1") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeusernameerrortype1']; ?>
  </div>
  <p><?php echo $lang['changeusernameerrortype1-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeusernameerrortype2']; ?>
  </div>
  <p><?php echo $lang['changeusernameerrortype2-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeusernameerrortype3']; ?>
  </div>
  <p><?php echo $lang['changeusernameerrortype3-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "4") : ?>
  <div class="ui positive message">
  <div class="header">
  <?php echo $lang['changeusernameerrortype4']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "5") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeusernameerrortype5']; ?>
  </div>
  <p><?php echo $lang['changeusernameerrortype5-1']; ?>
</p></div>
<?php endif; ?>
  </div>

        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        <button type=submit id=changeusername name=changeusername class="ui green button">
        <?php echo $lang['save']; ?>
        </button>
        </form>
    </div>
</div>

<div id="emailchange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['changeemail']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label><?php echo $lang['oldemail']; ?></label>
    <input readonly="" placeholder="<?php echo $result["email"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['newemail']; ?></label>
    <input type="email" name="newemail" id=newemail placeholder="<?php echo $lang['newemail']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['password']; ?></label>
    <input type="password" name="password" id=password placeholder="<?php echo $lang['password']; ?>" required>

    <?php
	if ( isset($_POST['changeemail']) ){
        $oldemail = htmlspecialchars($result["email"]);
        $newemail = htmlspecialchars($_POST['newemail']);
        $password = htmlspecialchars($_POST['password']);

        if(md5($password) != $result["password"]){
            $changeemailerrortype = 1;?>
            <script type="text/javascript"> $('#emailchange-modal').modal('show'); </script>
            <?php
        }else{      
        if($oldemail == $newemail){
            $changeemailerrortype = 2;?>
            <script type="text/javascript"> $('#emailchange-modal').modal('show'); </script>
            <?php
        }else{
            $emailcontrol = $connection->prepare("select * from users where email=?");
            $emailcontrol->execute(array($newemail));          
            if($emailcontrol->rowCount() > 0){
                $changeemailerrortype = 3;?>
                <script type="text/javascript"> $('#emailchange-modal').modal('show'); </script>
                <?php
            }else{
                $updateemail = $connection->prepare("UPDATE users SET email=? WHERE id=?");
                $updateemail->execute(array($newemail,$_SESSION['id']));

                if($updateemail){
                    $changeemailerrortype = 4;?>
                    <script type="text/javascript"> $('#emailchange-modal').modal('show'); </script>
                    <?php
                    header("Refresh:2");
                }else{
                    $changeemailerrortype = 5;?>
                    <script type="text/javascript"> $('#emailchange-modal').modal('show'); </script>
                    <?php
                }
            }
        }
    }
}
?>
<?php if(@$changeemailerrortype == "0") : ?>
<?php endif; ?>
  <?php if(@$changeemailerrortype == "1") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeemailerrortype1']; ?>
  </div>
  <p><?php echo $lang['changeemailerrortype1-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeemailerrortype2']; ?>
  </div>
  <p><?php echo $lang['changeemailerrortype2-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeemailerrortype3']; ?>
  </div>
  <p><?php echo $lang['changeemailerrortype3-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "4") : ?>
  <div class="ui success message">
  <div class="header">
  <?php echo $lang['changeemailerrortype4']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "5") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeemailerrortype5']; ?>
  </div>
  <p><?php echo $lang['changeemailerrortype5-1']; ?>
</p></div>
<?php endif; ?>
  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        <button type=submit id=changeemail name=changeemail class="ui green button">
        <?php echo $lang['save']; ?>
        </button>
        </form>
    </div>
</div>

<div id="passwordchange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['changepassword']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label><?php echo $lang['oldpassword']; ?></label>
    <input type="password" name="password" id=password placeholder="<?php echo $lang['oldpassword']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['newpassword']; ?></label>
    <input type="password" name="newpassword" id=newpassword placeholder="<?php echo $lang['newpassword']; ?>" required>
  </div>
  <div class="field">
    <label><?php echo $lang['newpasswordretry']; ?></label>
    <input type="password" name="newpasswordretry" id="newpasswordretry" placeholder="<?php echo $lang['newpasswordretry']; ?>" required>

    <?php
	if ( isset($_POST['changepassword']) ){
        $oldpassword = htmlspecialchars($_POST['password']);
        $newpassword = htmlspecialchars($_POST['newpassword']);
        $newpasswordretry = htmlspecialchars($_POST['newpasswordretry']);

        if(md5($oldpassword) != $result["password"]){
            $changepassworderrortype = 1;?>
            <script type="text/javascript"> $('#passwordchange-modal').modal('show'); </script>
            <?php
        }else{      
        if($newpassword == $oldpassword){
            $changepassworderrortype = 2;?>
            <script type="text/javascript"> $('#passwordchange-modal').modal('show'); </script>
            <?php
        }else{
            if($newpassword != $newpasswordretry){
                $changepassworderrortype = 3;?>
                <script type="text/javascript"> $('#passwordchange-modal').modal('show'); </script>
                <?php
            }else{
                $updatepassword = $connection->prepare("UPDATE users SET password=? WHERE id=?");
                $updatepassword->execute(array(md5($newpassword),$_SESSION['id']));

                if($updatepassword){
                    $changepassworderrortype = 4;?>
                    <script type="text/javascript"> $('#passwordchange-modal').modal('show'); </script>
                    <?php
                    header("refresh:2;url=logout.php");
                }else{
                    $changepassworderrortype = 5;?>
                    <script type="text/javascript"> $('#passwordchange-modal').modal('show'); </script>
                    <?php
                }
            }
        }
    }
}

?>

<?php if(@$changepassworderrortype == "0") : ?>
<?php endif; ?>
  <?php if(@$changepassworderrortype == "1") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changepassworderrortype1']; ?>
  </div>
  <p><?php echo $lang['changepassworderrortype1-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changepassworderrortype2']; ?>
  </div>
  <p><?php echo $lang['changepassworderrortype2-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changepassworderrortype3']; ?>
  </div>
  <p><?php echo $lang['changepassworderrortype3-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "4") : ?>
  <div class="ui positive message">
  <div class="header">
  <?php echo $lang['changepassworderrortype4']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "5") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changepassworderrortype5']; ?> 
  </div>
  <p><?php echo $lang['changepassworderrortype5-1']; ?>
</p></div>
<?php endif; ?>

  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        <button type=submit id=changepassword name=changepassword class="ui green button">
        <?php echo $lang['save']; ?>
        </button>
        </form>
    </div>
</div>

<div id="avatarchange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['changeavatar']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post enctype="multipart/form-data" class="ui form">
        <center><b><?php echo $lang['oldavatar']; ?></b><br><br>
        <img src="<?php echo $result["avatar"]; ?>" width=128px height=128px></img><br><br>
        <b><?php echo $lang['newavatar']; ?></b><br><br>
        <div class="field">
        <input type="file" name="newavatar" id="newavatar" required>

        <?php
	if ( isset($_POST['changeavatar']) ){
    if ($_FILES["newavatar"]["size"]<1024*1024){
 
      if ($_FILES["newavatar"]["type"]=="image/png" || $_FILES["newavatar"]["type"]=="image/jpeg"){

          $dosya_adi   =    $_FILES["newavatar"]["name"];

          $uzanti=substr($dosya_adi,-4,4);

$seed = str_split('abcdefghijklmnopqrstuvwxyz'
.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
.'0123456789!');
shuffle($seed);
$random = '';
foreach (array_rand($seed, 30) as $k) $random .= $seed[$k];

          $destination_path = getcwd();
          $mysql_ad="/img/avatar/".$random.$uzanti;
          $yeni_ad=$destination_path . ".." . $mysql_ad;

          if (move_uploaded_file($_FILES["newavatar"]["tmp_name"],$yeni_ad)){

          $mysqldosyasi =$destination_path . ".." . $result["avatar"];

          if("/img/avatar/default.png" == $result['avatar']){

          }else{
          unlink($mysqldosyasi); 
          }

          $sorgu = $connection->prepare("UPDATE users SET avatar=:resim WHERE id=:id");

          $sorgu->execute(array(':resim'=> $mysql_ad,':id'=>$_SESSION['id']));

          if ($sorgu){
            header("refresh:1;url=index.php");
            $changeavatarerrortype = 5;?>
            <script type="text/javascript"> $('#avatarchange-modal').modal('show'); </script>
            <?php
          }else{
            $changeavatarerrortype = 4;?>
            <script type="text/javascript"> $('#avatarchange-modal').modal('show'); </script>
            <?php
          }
      }else{
        $changeavatarerrortype = 3;?>
        <script type="text/javascript"> $('#avatarchange-modal').modal('show'); </script>
        <?php
      }
  }else{
    $changeavatarerrortype = 2;?>
    <script type="text/javascript"> $('#avatarchange-modal').modal('show'); </script>
    <?php
  }
  }else{          
    $changeavatarerrortype = 1;?>
    <script type="text/javascript"> $('#avatarchange-modal').modal('show'); </script>
    <?php
  }
}          

?>

<?php if(@$changeavatarerrortype == "0") : ?>
<?php endif; ?>
  <?php if(@$changeavatarerrortype == "1") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeavatarerrortype1']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeavatarerrortype2']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeavatarerrortype3']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "4") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changeavatarerrortype4']; ?>
  </div>
  <p><?php echo $lang['changeavatarerrortype4-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "5") : ?>
  <div class="ui positive message">
  <div class="header">
  <?php echo $lang['changeavatarerrortype5']; ?>
  </div>
  </div>
<?php endif; ?>

        </div>

        </center>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        <button type=submit id=changeavatar name=changeavatar class="ui green button">
        <?php echo $lang['save']; ?>
        </button>
        </form>
    </div>
</div>

<div id="profileinformation-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['profileinformations']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label>ID</label>
    <input readonly="" placeholder="<?php echo $result["id"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['username']; ?></label>
    <input readonly="" placeholder="<?php echo $result["username"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['email']; ?></label>
    <input readonly="" placeholder="<?php echo $result["email"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['language']; ?></label>
    <input readonly="" placeholder="<?php echo $result["language"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['regdate']; ?></label>
    <input readonly="" placeholder="<?php echo $result["regdate"]; ?>">
  </div>
  <div class="field">
    <label><?php echo $lang['lastlogin']; ?></label>
    <input readonly="" placeholder="<?php echo $result["lastlogin"]; ?>">
  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        </form>
    </div>
</div>

<div id="changelanguage-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center><?php echo $lang['changelanguage']; ?></center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label><?php echo $lang['yourlanguage']; ?></label>
    <input readonly="" placeholder="<?php echo $result["language"]; ?>">
  </div>
    <div class="field">
     <label><?php echo $lang['newlanguage']; ?></label>
      <select name="newlanguage" id="newlanguage" class="ui fluid dropdown">
        <option value="en">English</option>
        <option value="tr">Türkçe</option>
      </select>

    <?php
	if ( isset($_POST['changelanguage']) ){
        $oldlanguage = $result["language"];
        $newlanguage = htmlspecialchars($_POST['newlanguage']);

        if($newlanguage != "en" && $newlanguage != "tr"){
          $changelanguageerrortype = 1;?>
          <script type="text/javascript"> $('#changelanguage-modal').modal('show'); </script>
          <?php         
        }else{

        if($oldlanguage == $newlanguage){
          $changelanguageerrortype = 2;?>
          <script type="text/javascript"> $('#changelanguage-modal').modal('show'); </script>
          <?php

        }else{

          $updatelanguage = $connection->prepare("UPDATE users SET language=? WHERE id=?");
          $updatelanguage->execute(array($newlanguage,$_SESSION['id']));

          if($updatelanguage){
            header("refresh:2;url=index.php");
            $changelanguageerrortype = 3;?>
            <script type="text/javascript"> $('#changelanguage-modal').modal('show'); </script>
            <?php   

          }else{

            $changelanguageerrortype = 4;?>
            <script type="text/javascript"> $('#changelanguage-modal').modal('show'); </script>
            <?php  
          }
        }
      }
    }

?>

<?php if(@$changelanguageerrortype == "0") : ?>
<?php endif; ?>
  <?php if(@$changelanguageerrortype == "1") : ?>
  <div class="ui negative message">
  <div class="header">
    <?php echo $lang['changelanguageerrortype1']; ?>
  </div>
  </div>
<?php endif; ?>
<?php if(@$changelanguageerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changelanguageerrortype2']; ?>
  </div>
  <p><?php echo $lang['changelanguageerrortype2-1']; ?>
</p></div>
<?php endif; ?>
<?php if(@$changelanguageerrortype == "3") : ?>
  <div class="ui positive message">
  <div class="header">
  <?php echo $lang['changelanguageerrortype3']; ?>
  </div>
  <p><?php echo $lang['changelanguageerrortype3-1']; ?>
  </p></div>
<?php endif; ?>
<?php if(@$changelanguageerrortype == "4") : ?>
  <div class="ui negative message">
  <div class="header">
  <?php echo $lang['changelanguageerrortype4']; ?>
  </div>
  <p><?php echo $lang['changelanguageerrortype4-1']; ?>
</p></div>
<?php endif; ?>

  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
        <?php echo $lang['cancel']; ?>
        </div>
        <button type=submit id=changelanguage name=changelanguage class="ui green button">
        <?php echo $lang['save']; ?>
        </button>
        </form>
    </div>
</div>

<?php
@ob_end_flush();
?>