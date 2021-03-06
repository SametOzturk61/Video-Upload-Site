<?php
 if($_SERVER['REQUEST_URI'] == '/lang/en.php'){
  echo "<script>javascript:history.go(-1)</script>";
}
?>
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
<?php
$lang = array(
"flag" => "<i class='us flag'></i>",
"trends" => "Trends",
"channels" => "Channels",
"support" => "Support",
"upload" => "Upload",
"cancel" => "Cancel",
"save" => "Save",
"send" => "Send",
"login" => "Login",
"register" => "Register",
"username" => "Username",
"email" => "Email",
"password" => "Password",
"language" => "Language",
"regdate" => "Reg Date",
"lastlogin" => "Last Login",
"passwordretry" => "Password Retry",
"settings" => "Settings",
"logout" => "Logout",
"iagreetermsandconditions" => "I agree to the Terms and Conditions",
"login&register" => "Log in & Register",

"uploadvideo" => "Upload Video",
"videoname" => "Video Name",
"videodescription" => "Video Description",
"videocategory" => "Video Category",
"videothumbnailfile" => "Video Thumbnail File",
"videofile" => "Video File",

"changeusername" => "Change Username",
"changeemail" => "Change Email",
"changeavatar" => "Change Avatar",
"changepassword" => "Change Password",
"changelanguage" => "Change Language",
"profileinformations" => "Profile Informations",

"newusername" => "New Username",
"oldusername" => "Old Username",

"newemail" => "New Email",
"oldemail" => "Old Email",

"newpassword" => "New Password",
"newpasswordretry" => "New Password (Retry)",
"oldpassword" => "Old Password",

"newavatar" => "New Avatar",
"oldavatar" => "Old Avatar",

"yourlanguage" => "Your Language",
"newlanguage" => "New Language",

"uploaderrortype1" => "Thumbnail file size must be less than 5MB.",
"uploaderrortype2" => "Thumbnail file type must be PNG,JPG.",
"uploaderrortype3" => "Video file size must be less than 500MB.",
"uploaderrortype4" => "Video file type must be MP4,AVI,MPG or MOV.",
"uploaderrortype5" => "Thumbnail could not load.",
"uploaderrortype5-1" => "Please, try again later.",
"uploaderrortype6" => "Video file could not load.",
"uploaderrortype6-1" => "Please, try again later.",
"uploaderrortype7" => "Video uploaded successfully.",
"uploaderrortype8" => "Something went wrong.",
"uploaderrortype8-1" => "Please, try again later.",
"uploaderrortype9" => "Video category must be only Normal,Music or Game.",

"loginerrortype1" => "This username is not exists.",
"loginerrortype1-1" => "Please make sure you to use this name.",
"loginerrortype2" => "This password is not correct.",
"loginerrortype2-1" => "Please make sure you to use this password.",
"loginerrortype3" => "Your account was banned.",
"loginerrortype3-1" => "If you think it's wrong contact us.",
"loginerrortype4" => "Something went wrong.",
"loginerrortype4-1" => "Try again later, please.",

"registererrortype1" => "This username is already exists.",
"registererrortype1-1" => "Please use different username.",
"registererrortype2" => "This email is already exists.",
"registererrortype2-1" => "Please use different email.",
"registererrortype3" => "This passwords aren't same.",
"registererrortype3-1" => "Please be sure write correct.",
"registererrortype4" => "Your user registration was successful.",
"registererrortype4-1" => "You may now log-in with the username you have chosen.",
"registererrortype5" => "Something went wrong.",
"registererrortype5-1" => "Try again later, please.",

"changeusernameerrortype1" => "This password is not correct.",
"changeusernameerrortype1-1" => "Please make sure you to use this password.",
"changeusernameerrortype2" => "You're already using this username.",
"changeusernameerrortype2-1" => "Please use different username.",
"changeusernameerrortype3" => "This username is already taken.",
"changeusernameerrortype3-1" => "Please use different username.",
"changeusernameerrortype4" => "Changing is successfully.",
"changeusernameerrortype5" => "Something went wrong.",
"changeusernameerrortype5-1" => "Try again later, please.",

"changeemailerrortype1" => "This password is not correct.",
"changeemailerrortype1-1" => "Please make sure you to use this password.",
"changeemailerrortype2" => "You're already using this email.",
"changeemailerrortype2-1" => "Please use different email.",
"changeemailerrortype3" => "This email is already taken.",
"changeemailerrortype3-1" => "Please use different email.",
"changeemailerrortype4" => "Changing is successfully.",
"changeemailerrortype5" => "Something went wrong.",
"changeemailerrortype5-1" => "Try again later, please.",

"changepassworderrortype1" => "This password is not correct.",
"changepassworderrortype1-1" => "Please make sure you to use this password.",
"changepassworderrortype2" => "You're already using this password.",
"changepassworderrortype2-1" => "Please use different password.",
"changepassworderrortype3" => "New passwords aren't same.",
"changepassworderrortype3-1" => "Please be sure write correct.",
"changepassworderrortype4" => "Changing is successfully.",
"changepassworderrortype5" => "Something went wrong.",
"changepassworderrortype5-1" => "Try again later, please.",

"changeavatarerrortype1" => "Picture size must be less than 1MB.",
"changeavatarerrortype2" => "Picture type must be only PNG,JPG.",
"changeavatarerrortype3" => "Avatar is cannot upload.",
"changeavatarerrortype4" => "Something went wrong.",
"changeavatarerrortype4-1" => "Try again later, please.",
"changeavatarerrortype5" => "Changing is successfully.",

"changelanguageerrortype1" => "Please, select available language.",
"changelanguageerrortype2" => "You're already using this language.",
"changelanguageerrortype2-1" => "Please select different language.",
"changelanguageerrortype3" => "Changing is successfully.",
"changelanguageerrortype3-1" => "Your page will be refresh.",
"changelanguageerrortype4" => "Something went wrong.",
"changelanguageerrortype4-1" => "Please try again later.",

"videoerror" => "Video Error",
"videoerrortext" => "There were some errors with your request.",
"videoerrortextlist" => "Be sure you write correct link.",

"shortlybefore" => "Shortly before",
"secondsago" => "seconds ago",
"minutesago" => "minutes ago",
"hoursago" => "hours ago",
"daysago" => "days ago",
"weeksago" => "weeks ago",
"monthsago" => "months ago",
"yearsago" => "years ago",

"views" => "Views",
"delete" => "Delete",
"loginforcomment" => "Login for make comment",
);
?>