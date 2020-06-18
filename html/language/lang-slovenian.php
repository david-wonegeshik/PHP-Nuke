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
define("_SEARCH","Iskanje");
define("_LOGIN","Vstop");
define("_WRITES","napisal");
define("_POSTEDON","Poslano");
define("_NICKNAME","Nadimek");
define("_PASSWORD","Zapora");
define("_WELCOMETO","Dobrodo�li na");
define("_EDIT","Zamenjaj");
define("_DELETE","Izbri�i");
define("_POSTEDBY","Napisal je");
define("_READS","Vpra�anja");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Nazaj</a> ]");
define("_COMMENTS","komentarjev");
define("_PASTARTICLES","Prej�nji �lanki");
define("_OLDERARTICLES","Stari �lanki");
define("_BY","od");
define("_ON","-");
define("_LOGOUT","Izhod/odjava");
define("_WAITINGCONT","Vsebina na �akanju");
define("_SUBMISSIONS","Novo poslani �lanki");
define("_WREVIEWS","Recenzije na �akanju");
define("_WLINKS","Povezave na �akanju");
define("_EPHEMERIDS","Neko� davno...");
define("_ONEDAY","Dan kot dana�nji...");
define("_ASREGISTERED","Nimate ra�una? Lahko ga <a href=\"modules.php?name=Your_Account\">odprete brezpla�no</a>. Kot
define("_MENUFOR","Kazalo za");
define("_NOBIGSTORY","Danes ni bilo novih �lankov.");
define("_BIGSTORY","Dana�nji najbolj brani �lanek je:");
define("_SURVEY","Anketa");
define("_POLLS","Ankete");
define("_PCOMMENTS","Komentarji:");
define("_RESULTS","Rezultati");
define("_HREADMORE","preberi ve� o tem...");
define("_CURRENTLY","Trenutno je(so)");
define("_GUESTS","obiskovalec(ov) in");
define("_MEMBERS","�lan(ov) online.");
define("_YOUARELOGGED","Prijavljeni ste kot");
define("_YOUHAVE","Imate");
define("_PRIVATEMSG","zasebno(ih) sporo�il-o.");
define("_YOUAREANON","Vi ste neregistrirani obiskovalec. Lahko se registrirate brezpla�no <a href=\"modules.php?name=Your_Account\">tukaj</a>");
define("_NOTE","Opozorilo:");
define("_ADMIN","Administrator:");
define("_WERECEIVED","Imamo");
define("_PAGESVIEWS","pregledov strani od");
define("_TOPIC","Tema");
define("_UDOWNLOADS","Downloada");
define("_VOTE","Glas");
define("_VOTES","Glasov");
define("_MVIEWADMIN","Vide: samo administratorji");
define("_MVIEWUSERS","Vide: samo �lani");
define("_MVIEWANON","Vide: samo obiskovalci");
define("_MVIEWALL","Vide: vsi");
define("_EXPIRELESSHOUR","Prete�e: v manj kot 1h");
define("_EXPIREIN","Prete�e �ez");
define("_HTTPREFERERS","Od kje prihajajo obiskovalci");
define("_UNLIMITED","Neomejeno");
define("_HOURS","Ur");
define("_RSSPROBLEM","Trenutno obstaja problem z naslovnico(headline) s te strani");
define("_SELECTLANGUAGE","Izberite jezik");
define("_SELECTGUILANG","Izberite jezik uporabni�kega vmesnika:");
define("_NONE","Ni");
define("_BLOCKPROBLEM","<center>Trenutno obstaja problem s tem blokom.</center>");
define("_BLOCKPROBLEM2","<center>Trenutno ta blok nima vsebine.</center>");
define("_MODULENOTACTIVE","Oprostite, ta modul ni aktiven!");
define("_NOACTIVEMODULES","Neaktivni moduli");
define("_FORADMINTESTS","(za Admin teste)");
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
define("_DATESTRING","%d.%m.%Y");
define("_DATESTRING2","%A, %d.%m.");
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