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


define("_CHARSET","ISO-8859-2");
define("_SEARCH","Keres�s");
define("_LOGIN","Bel�p�s");
define("_WRITES","Szerz�:");
define("_POSTEDON","Ideje:");
define("_NICKNAME","Felhaszn�l�n�v");
define("_PASSWORD","Jelsz�");
define("_WELCOMETO","�dv�z�l a");
define("_EDIT","Szerkeszt�s");
define("_DELETE","T�rl�s");
define("_POSTEDBY","�rta:");
define("_READS","olvas�s");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Vissza</a> ]");
define("_COMMENTS","hozz�sz�l�s");
define("_PASTARTICLES","El�z� cikkek");
define("_OLDERARTICLES","R�gebbi cikkek");
define("_BY","Szerz�:");
define("_ON","Ideje:");
define("_LOGOUT","Kil�p�s");
define("_WAITINGCONT","J�v�hagy�sra v�r� tartalom");
define("_SUBMISSIONS","J�v�hagy�sra v�r� tartalom");
define("_WREVIEWS","J�v�hagy�sra v�r� ismertet�k");
define("_WLINKS","J�v�hagy�sra v�r� linkek");
define("_EPHEMERIDS","�vfordul�k");
define("_ONEDAY","�vfordul�k");
define("_ASREGISTERED","M�g nem regisztr�ltad magad? <a href=\"modules.php?name=Your_Account\">Itt megteheted</a>. A regisztr�lt felhaszn�l�k sz�mos el�nnyel rendelkeznek: diz�jnv�lt�s, hozz�sz�l�sok be�ll�t�sa, �s hozz�sz�l�sok saj�t n�v alatt.");
define("_MENUFOR","Szem�lyes men�:");
define("_NOBIGSTORY","A mai napnak m�g nincs \"nagy sztorija\".");
define("_BIGSTORY","A legolvasottabb cikk ma:");
define("_SURVEY","Szavaz�g�p");
define("_POLLS","Szavaz�sok");
define("_PCOMMENTS","Hozz�sz�l�sok:");
define("_RESULTS","Eredm�nyek");
define("_HREADMORE","tov�bb...");
define("_CURRENTLY","Jelenleg,");
define("_GUESTS","vend�g �s");
define("_MEMBERS","regisztr�lt felhaszn�l� olvas benn�nket.");
define("_YOUARELOGGED","Szia,");
define("_YOUHAVE","");
define("_PRIVATEMSG","szem�lyes �zeneted van.");
define("_YOUAREANON","Jelenleg n�vtelen l�togat� vagy. Ingyenesen regisztr�lhatod magad, <a href=\"modules.php?name=Your_Account\">ide</a> kattintva");
define("_NOTE","Megjegyz�s:");
define("_ADMIN","Adminisztr�ci�:");
define("_WERECEIVED","�sszesen");
define("_PAGESVIEWS","tal�latot kaptunk az oldal ind�t�sa �ta:");
define("_TOPIC","T�ma");
define("_UDOWNLOADS","Sz�ml�l�");
define("_VOTE","szavazat");
define("_VOTES","szavazat");
define("_MVIEWADMIN","Csak adminisztr�toroknak");
define("_MVIEWUSERS","Csak regisztr�lt tagoknak");
define("_MVIEWANON","Csak n�vtelen l�togat�knak");
define("_MVIEWALL","Minden l�togat�nak");
define("_EXPIRELESSHOUR","Lej�rat: kevesebb, mint egy �ra");
define("_EXPIREIN","Lej�rat ideje:");
define("_HTTPREFERERS","HTTP utal�sok");
define("_UNLIMITED","Korl�tlan");
define("_HOURS","�ra");
define("_RSSPROBLEM","Jelenleg nem m�k�dik a site tartalomszolg�ltat�sa");
define("_SELECTLANGUAGE","V�lassz nyelvet");
define("_SELECTGUILANG","V�lassz nyelvet:");
define("_NONE","Semmi");
define("_BLOCKPROBLEM","<center>There is a problem right now with this block.</center>");
define("_BLOCKPROBLEM2","<center>There isn't content right now for this block.</center>");
define("_MODULENOTACTIVE","Sorry, this Module isn't active!");
define("_NOACTIVEMODULES","Inactive Modules");
define("_FORADMINTESTS","(for Admin tests)");
define("_BBFORUMS","Forums");
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
define("_DATESTRING","%B %d, %A, %T");
define("_DATESTRING2","%B %d, %A");
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