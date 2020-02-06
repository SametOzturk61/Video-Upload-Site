<?php
 if($_SERVER['REQUEST_URI'] == '/lang/tr.php'){
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
?>
<?php
$lang = array(
"flag" => "<i class='tr flag'></i>",
"trends" => "Trendler",
"channels" => "Kanallar",
"support" => "Destek",
"upload" => "Yükle",
"cancel" => "İptal",
"save" => "Kaydet",
"send" => "Gönder",
"login" => "Giriş Yap",
"register" => "Kayıt Ol",
"username" => "Kullanıcı Adı",
"email" => "Email",
"password" => "Şifre",
"language" => "Dil",
"regdate" => "Kayıt Tarihi",
"lastlogin" => "Son Giriş",
"passwordretry" => "Şifre (Tekrar)",
"settings" => "Ayarlar",
"logout" => "Çıkış",
"iagreetermsandconditions" => "Şartlar ve koşulları kabul ediyorum.",
"login&register" => "Giriş Yap & Kayıt Ol",

"uploadvideo" => "Video Yükle",
"videoname" => "Video Adı",
"videodescription" => "Video Açıklaması",
"videocategory" => "Video Kategorisi",
"videothumbnailfile" => "Video Thumbnail Dosyası",
"videofile" => "Video Dosyası",

"changeusername" => "Kullanıcı Adını Değiştir",
"changeemail" => "Emaili Değiştir",
"changeavatar" => "Avatar Resmini Değiştir",
"changepassword" => "Şifreni Değiştir",
"changelanguage" => "Dili Değiştir",
"profileinformations" => "Profil Bilgileri",

"newusername" => "Yeni Kullanıcı Adı",
"oldusername" => "Eski Kullanıcı Adı",

"newemail" => "Yeni Email",
"oldemail" => "Eski Email",

"newpassword" => "Yeni Şifre",
"newpasswordretry" => "Yeni Şifre (Tekrar)",
"oldpassword" => "Eski Şifre",

"newavatar" => "Yeni Avatar Resmi",
"oldavatar" => "Eski Avatar Resmi",

"yourlanguage" => "Şu an ki dilin",
"newlanguage" => "Yeni dilin",

"uploaderrortype1" => "Thumbnail dosyasının boyutu 5MB'dan küçük olmalıdır.",
"uploaderrortype2" => "Thumbnail dosyasının tipi sadece PNG veya JPG olmalıdır.",
"uploaderrortype3" => "Video dosyasının boyutu 500MB'dan küçük olmalıdır.",
"uploaderrortype4" => "Video dosyasının tipi sadece MP4,AVI,MPG veya MOV olmalıdır.",
"uploaderrortype5" => "Thumbnail dosyası yüklenemedi.",
"uploaderrortype5-1" => "Lütfen, daha sonra tekrar deneyin.",
"uploaderrortype6" => "Video dosyası yüklenemedi.",
"uploaderrortype6-1" => "Lütfen, daha sonra tekrar deneyin.",
"uploaderrortype7" => "Video başarılı bir şekilde yüklendi.",
"uploaderrortype8" => "Birşey ters gitti.",
"uploaderrortype8-1" => "Lütfen, daha sonra tekrar deneyin..",
"uploaderrortype9" => "Video kategorisi sadece Normal,Music veya Game olmalıdır.",

"loginerrortype1" => "Böyle bir kullanıcı adı yok.",
"loginerrortype1-1" => "Lütfen bu kullanıcı adını kullandığından emin ol.",
"loginerrortype2" => "Şifre doğru değil.",
"loginerrortype2-1" => "Lütfen bu şifreyi kullandığından emin ol.",
"loginerrortype3" => "Hesabın banlanmış.",
"loginerrortype3-1" => "Eğer birşeylerin yanlış olduğu düşünüyorsan, bizimle iletişime geç.",
"loginerrortype4" => "Birşey ters gitti.",
"loginerrortype4-1" => "Lütfen, daha sonra tekrar deneyin.",

"registererrortype1" => "Bu kullanıcı adı zaten var.",
"registererrortype1-1" => "Lütfen farklı bir kullanıcı adı kullan.",
"registererrortype2" => "Bu email zaten var.",
"registererrortype2-1" => "Lütfen farklı bir email kullan.",
"registererrortype3" => "Şifreler uyuşmuyor.",
"registererrortype3-1" => "Doğru yazdığınızdan emin olun.",
"registererrortype4" => "Kayıt olma işlemi başarıyla gerçekleşti.",
"registererrortype4-1" => "Seçmiş olduğunuz kullanıcı adıyla giriş yapabilirsiniz.",
"registererrortype5" => "Birşey ters gitti.",
"registererrortype5-1" => "Lütfen, daha sonra tekrar deneyin.",

"changeusernameerrortype1" => "Bu şifre doğru değil.",
"changeusernameerrortype1-1" => "Bu şifreyi kullandığınızdan emin olun.",
"changeusernameerrortype2" => "Zaten bu kullanıcı adını kullanıyorsun.",
"changeusernameerrortype2-1" => "Lütfen farklı bir kullanıcı adı kullan.",
"changeusernameerrortype3" => "Bu kullanıcı adı zaten alınmış.",
"changeusernameerrortype3-1" => "Lütfen farklı bir kullanıcı adı kullan.",
"changeusernameerrortype4" => "Başarıyla değiştirildi.",
"changeusernameerrortype5" => "Birşey ters gitti.",
"changeusernameerrortype5-1" => "Lütfen, daha sonra tekrar deneyin.",

"changeemailerrortype1" => "Bu şifre doğru değil.",
"changeemailerrortype1-1" => "Bu şifreyi kullandığınızdan emin olun.",
"changeemailerrortype2" => "Zaten bu emaili kullanıyorsun.",
"changeemailerrortype2-1" => "Lütfen farklı bir email kullan.",
"changeemailerrortype3" => "Bu email zaten alınmış.",
"changeemailerrortype3-1" => "Lütfen farklı bir email kullan.",
"changeemailerrortype4" => "Başarıyla değiştirildi.",
"changeemailerrortype5" => "Birşey ters gitti.",
"changeemailerrortype5-1" => "Lütfen, daha sonra tekrar deneyin.",

"changepassworderrortype1" => "Bu şifre doğru değil.",
"changepassworderrortype1-1" => "Bu şifreyi kullandığınızdan emin olun.",
"changepassworderrortype2" => "Zaten bu şifreyi kullanıyorsun.",
"changepassworderrortype2-1" => "Lütfen farklı bir şifre kullan.",
"changepassworderrortype3" => "Yeni şifreler uyuşmuyor.",
"changepassworderrortype3-1" => "Lütfen, doğru yazdığından emin ol.",
"changepassworderrortype4" => "Başarıyla değiştirildi.",
"changepassworderrortype5" => "Birşey ters gitti.",
"changepassworderrortype5-1" => "Lütfen, daha sonra tekrar deneyin.",

"changeavatarerrortype1" => "Fotoğraf boyutu 1MB'dan fazla olamaz.",
"changeavatarerrortype2" => "Fotoğraf tipi sadece PNG veya JPG olabilir.",
"changeavatarerrortype3" => "Avatar fotoğrafı yüklenemedi.",
"changeavatarerrortype4" => "Birşey ters gitti.",
"changeavatarerrortype4-1" => "Lütfen, daha sonra tekrar deneyin.",
"changeavatarerrortype5" => "Başarıyla değiştirildi.",

"changelanguageerrortype1" => "Lütfen, kullanılabilir bir dil seç.",
"changelanguageerrortype2" => "Zaten bu dili kullanıyorsun.",
"changelanguageerrortype2-1" => "Lütfen farklı bir dil seçiniz.",
"changelanguageerrortype3" => "Başarıyla değiştirildi.",
"changelanguageerrortype3-1" => "Sayfanız yeniden yüklenecek.",
"changelanguageerrortype4" => "Birşey ters gitti.",
"changelanguageerrortype4-1" => "Lütfen, daha sonra tekrar deneyin.",

"videoerror" => "Video Hatası",
"videoerrortext" => "İsteğinizle alakalı bir hata oluştu.",
"videoerrortextlist" => "Lütfen linki doğru yazdığınızdan emin olun.",

"shortlybefore" => "Kısa süre önce",
"secondsago" => "saniye önce",
"minutesago" => "dakika önce",
"hoursago" => "saat önce",
"daysago" => "gün önce",
"weeksago" => "hafta önce",
"monthsago" => "ay önce",
"yearsago" => "yıl önce",

"views" => "Görüntüleme",
"delete" => "Sil",
"loginforcomment" => "Yorum yapmak için giriş yap.",
);
?>