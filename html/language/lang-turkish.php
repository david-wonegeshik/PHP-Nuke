<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please sent to me (fbc@mandrakesoft.com)    */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/


define("_CHARSET","windows-1254");
define("_SEARCH","Ara");
define("_LOGIN","Giriþ");
define("_WRITES","bildirdi:");
define("_POSTEDON","Tarih:");
define("_NICKNAME","Nickname");
define("_PASSWORD","Þifre");
define("_WELCOMETO","Hoþgeldiniz:");
define("_EDIT","Düzenle");
define("_DELETE","Sil");
define("_POSTEDBY","Gönderen:");
define("_READS","okuma");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Geri Dön</a> ]");
define("_COMMENTS","yorum");
define("_PASTARTICLES","Geçmiþ Haberler");
define("_OLDERARTICLES","Eski Haberler");
define("_BY","Gönderen:");
define("_ON","Tarih:");
define("_LOGOUT","Çýkýþ");
define("_WAITINGCONT","Bekleyen Ýçerik");
define("_SUBMISSIONS","Haber");
define("_WREVIEWS","Ýzlenim");
define("_WLINKS","Baðlantý");
define("_EPHEMERIDS","Geçiciler");
define("_ONEDAY","Tarihte Bu Gün...");
define("_ASREGISTERED","Hala hesabýnýz yok mu? Hemen <a href=\"modules.php?name=Your_Account&op=new_user\">açabilirsiniz</a>. Kayýtlý bir kullanýcý olarak tema yönetici, yorum ayarlarý ve isminizle yorum gönderme gibi avantajlara sahip olacaksýnýz.");
define("_MENUFOR","Menü:");
define("_NOBIGSTORY","Bu gün için henüz önemli bir haber yok.");
define("_BIGSTORY","Günün en çok okunan haberi:");
define("_SURVEY","Anket");
define("_POLLS","Anketler");
define("_PCOMMENTS","Yorum:");
define("_RESULTS","Sonuçlar");
define("_HREADMORE","devamý...");
define("_CURRENTLY","Þu an sitede,");
define("_GUESTS","ziyaretçi ve");
define("_MEMBERS","üye bulunuyor.");
define("_YOUARELOGGED","Selam");
define("_YOUHAVE","Yeni");
define("_PRIVATEMSG","özel mesaj.");
define("_YOUAREANON","Kayýtlý deðilsiniz. <a href=\"modules.php?name=Your_Account&op=new_user\">Buraya</a> týklayarak ücretsiz kayýt olabilirsiniz.");
define("_NOTE","Not:");
define("_ADMIN","Yönetici:");
define("_WERECEIVED","Þu ana kadar");
define("_PAGESVIEWS","sayfa izlenimi aldýk. Baþlangýç:");
define("_TOPIC","Konu");
define("_UDOWNLOADS","Ýndirme");
define("_VOTE","Oy Ver");
define("_VOTES","Toplam Oy");
define("_MVIEWADMIN","Ýzle: Sadece Yöneticiler");
define("_MVIEWUSERS","Ýzle: Sadece Kayýtlý Kullanýcýlar");
define("_MVIEWANON","Ýzle: Sadece Anonim Kullanýcýlar");
define("_MVIEWALL","Ýzle: Tüm Ziyaretçiler");
define("_EXPIRELESSHOUR","Ýmha: 1 saat içinde");
define("_EXPIREIN","Ýmha:");
define("_HTTPREFERERS","HTTP Önerenler");
define("_UNLIMITED","Limitsiz");
define("_HOURS","Saat");
define("_RSSPROBLEM","Þu an bu sitenin baþlýklarýnda problem var");
define("_SELECTLANGUAGE","Dil Seçin");
define("_SELECTGUILANG","Arabirim Dilini Seçin:");
define("_NONE","Yok");
define("_BLOCKPROBLEM","<center>Þu an bu blokta bir sorun var.</center>");
define("_BLOCKPROBLEM2","<center>Þu an bu bloðun içeriði yok.</center>");
define("_MODULENOTACTIVE","Üsgünüm, bu modül aktif deðil!");
define("_NOACTIVEMODULES","Pasif Modüller");
define("_FORADMINTESTS","(Yönetici tesleri için)");
define("_BBFORUMS","Forumlarý");
define("_ACCESSDENIED", "Access Denied");
define("_RESTRICTEDAREA", "You are trying to access to a restricted area.");
define("_MODULEUSERS", "We are Sorry but this section of our site is for <i>Registered Users Only</i><br><br>You can register for free by clicking <a href=\"modules.php?name=Your_Account&op=new_user\">here</a>, then you can<br>access to this section without restrictions. Thanks.<br><br>");
define("_MODULESADMINS", "We are Sorry but this section of our site is for <i>Administrators Only</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%e.%m.20%y Saat: %H:%M");
define("_DATESTRING2","%e.%m.%y");
define("_DATE","Date");
define("_HOUR","Hour");
define("_UMONTH","Month");
define("_YEAR","Year");
define("_JANUARY","January");
define("_FEBRUARY","February");
define("_MARCH","March");
define("_APRIL","April");
define("_MAY","May");
define("_JUNE","June");
define("_JULY","July");
define("_AUGUST","August");
define("_SEPTEMBER","September");
define("_OCTOBER","October");
define("_NOVEMBER","November");
define("_DECEMBER","December");

/*****************************************************/
/* Function to translate Datestrings                 */
/*****************************************************/

function translate($phrase) {
    switch($phrase) {
	case "xdatestring":	$tmp = "%A, %B %d @ %T %Z"; break;
	case "linksdatestring":	$tmp = "%d-%b-%Y"; break;
	case "xdatestring2":	$tmp = "%A, %B %d"; break;
	default:		$tmp = "$phrase"; break;
    }
    return $tmp;
}

?>