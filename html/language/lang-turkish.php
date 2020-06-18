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
define("_LOGIN","Giri�");
define("_WRITES","bildirdi:");
define("_POSTEDON","Tarih:");
define("_NICKNAME","Nickname");
define("_PASSWORD","�ifre");
define("_WELCOMETO","Ho�geldiniz:");
define("_EDIT","D�zenle");
define("_DELETE","Sil");
define("_POSTEDBY","G�nderen:");
define("_READS","okuma");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Geri D�n</a> ]");
define("_COMMENTS","yorum");
define("_PASTARTICLES","Ge�mi� Haberler");
define("_OLDERARTICLES","Eski Haberler");
define("_BY","G�nderen:");
define("_ON","Tarih:");
define("_LOGOUT","��k��");
define("_WAITINGCONT","Bekleyen ��erik");
define("_SUBMISSIONS","Haber");
define("_WREVIEWS","�zlenim");
define("_WLINKS","Ba�lant�");
define("_EPHEMERIDS","Ge�iciler");
define("_ONEDAY","Tarihte Bu G�n...");
define("_ASREGISTERED","Hala hesab�n�z yok mu? Hemen <a href=\"modules.php?name=Your_Account&op=new_user\">a�abilirsiniz</a>. Kay�tl� bir kullan�c� olarak tema y�netici, yorum ayarlar� ve isminizle yorum g�nderme gibi avantajlara sahip olacaks�n�z.");
define("_MENUFOR","Men�:");
define("_NOBIGSTORY","Bu g�n i�in hen�z �nemli bir haber yok.");
define("_BIGSTORY","G�n�n en �ok okunan haberi:");
define("_SURVEY","Anket");
define("_POLLS","Anketler");
define("_PCOMMENTS","Yorum:");
define("_RESULTS","Sonu�lar");
define("_HREADMORE","devam�...");
define("_CURRENTLY","�u an sitede,");
define("_GUESTS","ziyaret�i ve");
define("_MEMBERS","�ye bulunuyor.");
define("_YOUARELOGGED","Selam");
define("_YOUHAVE","Yeni");
define("_PRIVATEMSG","�zel mesaj.");
define("_YOUAREANON","Kay�tl� de�ilsiniz. <a href=\"modules.php?name=Your_Account&op=new_user\">Buraya</a> t�klayarak �cretsiz kay�t olabilirsiniz.");
define("_NOTE","Not:");
define("_ADMIN","Y�netici:");
define("_WERECEIVED","�u ana kadar");
define("_PAGESVIEWS","sayfa izlenimi ald�k. Ba�lang��:");
define("_TOPIC","Konu");
define("_UDOWNLOADS","�ndirme");
define("_VOTE","Oy Ver");
define("_VOTES","Toplam Oy");
define("_MVIEWADMIN","�zle: Sadece Y�neticiler");
define("_MVIEWUSERS","�zle: Sadece Kay�tl� Kullan�c�lar");
define("_MVIEWANON","�zle: Sadece Anonim Kullan�c�lar");
define("_MVIEWALL","�zle: T�m Ziyaret�iler");
define("_EXPIRELESSHOUR","�mha: 1 saat i�inde");
define("_EXPIREIN","�mha:");
define("_HTTPREFERERS","HTTP �nerenler");
define("_UNLIMITED","Limitsiz");
define("_HOURS","Saat");
define("_RSSPROBLEM","�u an bu sitenin ba�l�klar�nda problem var");
define("_SELECTLANGUAGE","Dil Se�in");
define("_SELECTGUILANG","Arabirim Dilini Se�in:");
define("_NONE","Yok");
define("_BLOCKPROBLEM","<center>�u an bu blokta bir sorun var.</center>");
define("_BLOCKPROBLEM2","<center>�u an bu blo�un i�eri�i yok.</center>");
define("_MODULENOTACTIVE","�sg�n�m, bu mod�l aktif de�il!");
define("_NOACTIVEMODULES","Pasif Mod�ller");
define("_FORADMINTESTS","(Y�netici tesleri i�in)");
define("_BBFORUMS","Forumlar�");
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