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
<div class="row">
<div class="ui inverted segment">
      <div class="ui secondary inverted pointing menu">
        <a href="index.php" class="active item"><i class="tr flag"></i>PlotoriusNetwork</a>
        <a class="item">Trends</a>
        <a class="item">Channels</a>
        <a class="item">Support</a>
        <?php if(isset($_SESSION['id'])) : ?>
        <div class="right item">
        <?php $find = $connection->prepare("select * from users where id=?;");
$find->execute(array($_SESSION['id']));
$result = $find->fetch();
$showusername = $result["username"]; ?>
<img class="ui circular image" width=32px height=32px src="<?php echo $result["avatar"]; ?>"></img>&nbsp;&nbsp; <?php echo "<font color=white>$showusername</font>"; ?>&nbsp;&nbsp;&nbsp;&nbsp;

<div class="ui icon top left pointing dropdown">
  <i class="ellipsis vertical icon"></i>
  <div class="menu">
    <a id="upload" class="item ui inverted button"><i class="upload icon"></i>Upload</a>
    <a id="settings" class="item ui inverted button"><i class="cog icon"></i>Settings</a>
    <a href="/logout.php" class="item"><i class="sign-out icon"></i>Logout</a>
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
          <a id="register" class="ui inverted button"><i class="user icon"></i>Log in & Register</a>
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
        <center>Upload Video</center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post enctype="multipart/form-data" class="ui form">
  <div class="field">
    <label>Video Name</label>
    <input type="text" name="videoname" id="videoname" placeholder="Video Name" required>
  </div>
  <div class="field">
    <label>Video Description</label>
    <input type="text" name="videodescription" id="videodescription" placeholder="Video Description" required>
  </div>
  <div class="field">
    <label>Video Category</label>
    <select class="form-control" name="videocategory" id="videocategory" required>
      <option value="Normal">Normal</option>
      <option value="Game">Game</option>
      <option value="Music">Music</option>
    </select>
  </div>
  <div class="field">
    <label>Video Thumbnail File</label>
    <input type="file" accept="image/*" name="thumbnail" id="thumbnail" required>
  </div>
  <div class="field">
    <label>Video File</label>
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
  Video category must be only Normal,Music or Game.
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 1) : ?>
  <div class="ui negative message">
  <div class="header">
  Thumbnail file size must be less than 5MB.
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 2) : ?>
  <div class="ui negative message">
  <div class="header">
  Thumbnail file type must be PNG,JPG.
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 3) : ?>
  <div class="ui negative message">
  <div class="header">
  Video file size must be less than 500MB.
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 4) : ?>
  <div class="ui negative message">
  <div class="header">
  Video file type must be MP4,AVI,MPG or MOV.
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 5) : ?>
  <div class="ui negative message">
  <div class="header">
  Thumbnail could not load.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>
<?php if(@$uploaderrortype == 6) : ?>
  <div class="ui negative message">
  <div class="header">
  Video file could not load.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>
<?php if(@$uploaderrortype == 7) : ?>
  <div class="ui positive message">
  <div class="header">
  Video uploaded successfully.
  </div>
  </div>
<?php endif; ?>
<?php if(@$uploaderrortype == 8) : ?>
  <div class="ui negative message">
  <div class="header">
    Something went wrong.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>
<div id="loader" style="display:none;"><center><img width=32px height=32px src="/img/loading.gif"></img></center></div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
        <input type="submit" value="Upload" name="upload" id="upload" class="ui green button" onclick="document.getElementById('loader').style.display = 'block' ;"/>
        </form>
    </div>
</div>

<div id="register-modal" class="ui long modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Log in & Register</center>
    </div>
    <div class="image content">
        <div class="description">

<div class="ui equal width grid">
  <div class="equal width row">
  <div class="ui vertical divider"></div>
    <div class="column">
    <form method=post action="" class="ui form">
    <center><b>Login</b></center><br>
  <div class="field">
    <label>Username</label>
    <input type="text" name="username" id="username" placeholder="Username" required>
  </div>
  <div class="field">
    <label>Password</label>
    <input type="password" name="password" id="password" placeholder="Password" required>
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
    This username is not exists.
  </div>
  <p>Please make sure you to use this name.
</p></div>
<?php endif; ?>
<?php if(@$loginerrortype == 2) : ?>
  <div class="ui negative message">
  <div class="header">
    This password is not correct.
  </div>
  <p>Please make sure you to use this password.
</p></div>
<?php endif; ?>
<?php if(@$loginerrortype == 3) : ?>
  <div class="ui negative message">
  <div class="header">
    Your account was banned.
  </div>
  <p>If you think it's wrong contact us.
</p></div>
<?php endif; ?>
<?php if(@$loginerrortype == 4) : ?>
  <div class="ui negative message">
  <div class="header">
    Something went wrong.
  </div>
  <p>Try again later, please.
</p></div>
<?php endif; ?>
  <button class="ui button" id=login name=login type="submit">Login</button>
</form>
    </div>
    <div class="column">
    <form method=post action="" class="ui form">
    <center><b>Register</b></center><br>
  <div class="field">
    <label>Username</label>
    <input type="text" name="username" id=username placeholder="Username" required>
  </div>
  <div class="field">
    <label>Email</label>
    <input type="email" name="email" id="email" placeholder="Email" required>
  </div>
  <div class="field">
    <label>Password</label>
    <input type="password" name="password" id=password placeholder="Password" required>
  </div>
  <div class="field">
    <label>Password Retry</label>
    <input type="password" name="passwordretry" id=passwordretry placeholder="Password Retry" required>
  </div>
  <div class="field">
    <div class="ui checkbox">
      <input type="checkbox" tabindex="0" required>
      <label>I agree to the Terms and Conditions</label>
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
    This username is already exists.
  </div>
  <p>Please use different username.
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 2) : ?>
  <div class="ui negative message">
  <div class="header">
    This email is already exists.
  </div>
  <p>Please use different email.
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 3) : ?>
  <div class="ui negative message">
  <div class="header">
    This passwords aren't same.
  </div>
  <p>Please be sure write correct.
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 4) : ?>
  <div class="ui positive message">
  <div class="header">
  Your user registration was successful.
  </div>
  <p>You may now log-in with the username you have chosen</p>
</p></div>
<?php endif; ?>
<?php if(@$registererrortype == 5) : ?>
  <div class="ui negative message">
  <div class="header">
    Something went wrong.
  </div>
  <p>Try again later, please.
</p></div>
<?php endif; ?>
  <button class="ui button" id=register name=register type="submit">Register</button>
</form>
</div>
  </div>
</div>

        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
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

<div id="settings-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Settings</center>
    </div>
    <div class="image content">
        <div class="description">

    <button id="profileinformation" class="fluid ui black basic labeled icon button">
      <i class="info icon"></i>
      Profile Informations
    </button><br>

<div class="ui two column centered grid">
    <div class="four column centered row">
    <div class="column">
    <button id="usernamechange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      Change Username
     </button>
    </div>
    <div class="column">
    <button id="emailchange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      Change Email
     </button>
    </div>
  </div>
  <div class="four column centered row">
    <div class="column">
    <button id="passwordchange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      Change Password
     </button>
    </div>
    <div class="column">
    <button id="avatarchange" class="ui blue basic labeled icon button">
      <i class="cog icon"></i>
      Change Avatar
     </button>
    </div>
  </div>
</div>

        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
    </div>
</div>

<div id="usernamechange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Change Username</center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label>Old Username</label>
    <input readonly="" placeholder="<?php echo $result["username"]; ?>">
  </div>
  <div class="field">
    <label>New Username</label>
    <input type="text" name="newusername" id=newusername placeholder="New Username" required>
  </div>
  <div class="field">
    <label>Password</label>
    <input type="password" name="password" id=password placeholder="Password" required>

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
    This password is not correct.
  </div>
  <p>Please make sure you to use this password.
</p></div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
    You're already using this username.
  </div>
  <p>Please use different username.
</p></div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  This username is already taken.
  </div>
  <p>Please use different username.
</p></div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "4") : ?>
  <div class="ui positive message">
  <div class="header">
  Changing is successfully.
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeusernameerrortype == "5") : ?>
  <div class="ui negative message">
  <div class="header">
  Something went wrong.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>
  </div>

        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
        <button type=submit id=changeusername name=changeusername class="ui green button">
            Save
        </button>
        </form>
    </div>
</div>

<div id="emailchange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Change Email</center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label>Old Email</label>
    <input readonly="" placeholder="<?php echo $result["email"]; ?>">
  </div>
  <div class="field">
    <label>New Email</label>
    <input type="email" name="newemail" id=newemail placeholder="New Email" required>
  </div>
  <div class="field">
    <label>Password</label>
    <input type="password" name="password" id=password placeholder="Password" required>

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
    This password is not correct.
  </div>
  <p>Please make sure you to use this password.
</p></div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
    You're already using this email.
  </div>
  <p>Please use different email.
</p></div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  This email is already taken.
  </div>
  <p>Please use different email.
</p></div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "4") : ?>
  <div class="ui success message">
  <div class="header">
  Changing is successfully.
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeemailerrortype == "5") : ?>
  <div class="ui negative message">
  <div class="header">
  Something went wrong.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>
  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
        <button type=submit id=changeemail name=changeemail class="ui green button">
            Save
        </button>
        </form>
    </div>
</div>

<div id="passwordchange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Change Password</center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label>Old Password</label>
    <input type="password" name="password" id=password placeholder="Old Password" required>
  </div>
  <div class="field">
    <label>New Password</label>
    <input type="password" name="newpassword" id=newpassword placeholder="New Password" required>
  </div>
  <div class="field">
    <label>New Password (Retry)</label>
    <input type="password" name="newpasswordretry" id="newpasswordretry" placeholder="New Password (Retry)" required>

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
    This password is not correct.
  </div>
  <p>Please make sure you to use this password.
</p></div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
    You're already using this password.
  </div>
  <p>Please use different password.
</p></div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  New passwords aren't same.
  </div>
  <p>Please be sure write correct.
</p></div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "4") : ?>
  <div class="ui positive message">
  <div class="header">
  Changing is successfully.
  </div>
  </div>
<?php endif; ?>
<?php if(@$changepassworderrortype == "5") : ?>
  <div class="ui negative message">
  <div class="header">
  Something went wrong.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>

  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
        <button type=submit id=changepassword name=changepassword class="ui green button">
            Save
        </button>
        </form>
    </div>
</div>

<div id="avatarchange-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Change Avatar</center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post enctype="multipart/form-data" class="ui form">
        <center><b>Old Avatar</b><br><br>
        <img src="<?php echo $result["avatar"]; ?>" width=128px height=128px></img><br><br>
        <b>New Avatar</b><br><br>
        <div class="field">
        <input type="file" name="newavatar" id="newavatar" required>

        <?php
	if ( isset($_POST['changeavatar']) ){
    if ($_FILES["newavatar"]["size"]<1024*1024){
 
      if ($_FILES["newavatar"]["type"]=="image/png"){

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
  Picture size must be less than 1MB
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "2") : ?>
  <div class="ui negative message">
  <div class="header">
  Picture type must be only PNG
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "3") : ?>
  <div class="ui negative message">
  <div class="header">
  Avatar is cannot upload.
  </div>
  </div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "4") : ?>
  <div class="ui negative message">
  <div class="header">
  Something went wrong.
  </div>
  <p>Please, try again later.
</p></div>
<?php endif; ?>
<?php if(@$changeavatarerrortype == "5") : ?>
  <div class="ui positive message">
  <div class="header">
  Changing is successfully.
  </div>
  </div>
<?php endif; ?>

        </div>

        </center>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
        <button type=submit id=changeavatar name=changeavatar class="ui green button">
            Save
        </button>
        </form>
    </div>
</div>

<div id="profileinformation-modal" class="ui modal">
    <i class="close icon"></i>
    <div class="header">
        <center>Profile Informations</center>
    </div>
    <div class="image content">
        <div class="description">
        <form action="" method=post class="ui form">
  <div class="field">
    <label>ID</label>
    <input readonly="" placeholder="<?php echo $result["id"]; ?>">
  </div>
  <div class="field">
    <label>Username</label>
    <input readonly="" placeholder="<?php echo $result["username"]; ?>">
  </div>
  <div class="field">
    <label>Email</label>
    <input readonly="" placeholder="<?php echo $result["email"]; ?>">
  </div>
  <div class="field">
    <label>Reg Date</label>
    <input readonly="" placeholder="<?php echo $result["regdate"]; ?>">
  </div>
  <div class="field">
    <label>Last Login</label>
    <input readonly="" placeholder="<?php echo $result["lastlogin"]; ?>">
  </div>
        </div>
    </div>
    <div class="actions">
        <div class="ui red deny button">
            Cancel
        </div>
        </form>
    </div>
</div>

<?php
@ob_end_flush();
?>