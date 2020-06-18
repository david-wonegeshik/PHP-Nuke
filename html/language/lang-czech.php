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


define("_CHARSET","windows-1250");
define("_SEARCH","Hledat");
define("_LOGIN","Pøihlášení");
define("_WRITES","píše");
define("_POSTEDON","Posted on");
define("_NICKNAME","Pøezdívka");
define("_PASSWORD","Heslo");
define("_WELCOMETO","Vítejte na");
define("_EDIT","Upravit");
define("_DELETE","Smazat");
define("_POSTEDBY","Poslal");
define("_READS","ètenáøù");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Zpìt</a> ]");
define("_COMMENTS","komentáøe");
define("_PASTARTICLES","Minulé èlánky");
define("_OLDERARTICLES","Starší èlánky");
define("_BY","podle");
define("_ON","v");
define("_LOGOUT","Odhlásit");
define("_WAITINGCONT","A tohle èeká");
define("_SUBMISSIONS","Pøíspìvky");
define("_WREVIEWS","Recenze");
define("_WLINKS","Odkazy");
define("_EPHEMERIDS","Události");
define("_ONEDAY","Den jako každý jiný...");
define("_ASREGISTERED","Ještì nemáte svùj úèet? Mùžete si jej <a href=\"modules.php?name=Your_Account\">vytvoøit zde</a>. Jako registrovaný uživatel získáte øadu výhod. Napøíklad posílání komentáøu pod jménem, nastavení komentáøù, manažer témat atd.");
define("_MENUFOR","Menu pro");
define("_NOBIGSTORY","Dosud není èlánek dne.");
define("_BIGSTORY","Nejètenìjší èlánek dnes je:");
define("_SURVEY","Anketa");
define("_POLLS","Ankety");
define("_PCOMMENTS","Komentáøù");
define("_RESULTS","Výsledky");
define("_HREADMORE","více...");
define("_CURRENTLY","Právì je");
define("_GUESTS","návštìvník(ù) a");
define("_MEMBERS","uživatel(ù) online.");
define("_YOUARELOGGED","Jste pøihlášen jako");
define("_YOUHAVE","Máte");
define("_PRIVATEMSG","osobních zpráv.");
define("_YOUAREANON","Jste anonymní uživatel. Mùžete se zdarma registrovat kliknutím <a href=\"modules.php?name=Your_Account\">zde</a>");
define("_NOTE","Poznámka:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Zaznamenali jsme");
define("_PAGESVIEWS","pøístupù od");
define("_TOPIC","Téma");
define("_UDOWNLOADS","Stažení");
define("_VOTE","Hlasovat");
define("_VOTES","Hlasù");
define("_MVIEWADMIN","Zobrazit: Pouze administrátorùm");
define("_MVIEWUSERS","Zobrazit: Pouze pøihlášeným uživatelùm");
define("_MVIEWANON","Zobrazit: Pouze anonymùm");
define("_MVIEWALL","Zobrazit: Všem návštìvníkùm");
define("_EXPIRELESSHOUR","Konec zobrazování: ménì než 1 hodina");
define("_EXPIREIN","Konec zobrazování za");
define("_HTTPREFERERS","Odkud pøišli");
define("_UNLIMITED","Neomezeno");
define("_HOURS","hodin(a/y)");
define("_RSSPROBLEM","Momentálnì je problém se zprávami z tohoto webu");
define("_SELECTLANGUAGE","Vyberte si jazyk");
define("_SELECTGUILANG","Vyberte si jazykové rozhraní:");
define("_NONE","Není");
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
define("_DATESTRING","%A, %d. %B %Y @ %T %Z");
define("_DATESTRING2","%A, %d. %B");
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