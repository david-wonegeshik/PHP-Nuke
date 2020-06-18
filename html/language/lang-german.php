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


define("_CHARSET","ISO-8859-1");
define("_SEARCH","Suchen");
define("_LOGIN","Login");
define("_WRITES","schreibt");
define("_POSTEDON","Geschrieben am");
define("_NICKNAME","<b>Benutzername</b>");
define("_PASSWORD","<b>Passwort</b>");
define("_WELCOMETO","Willkommen bei");
define("_EDIT","&Auml;ndern");
define("_DELETE","L&ouml;schen");
define("_POSTEDBY","Geschrieben von");
define("_READS","mal gelesen");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Zur&uuml;ck</a> ]");
define("_COMMENTS","Kommentare");
define("_PASTARTICLES","Vorige Artikel");
define("_OLDERARTICLES","&Auml;ltere Artikel");
define("_BY","von");
define("_ON","am");
define("_LOGOUT","Abmelden");
define("_WAITINGCONT","Wartende News");
define("_SUBMISSIONS","Artikel");
define("_WREVIEWS","Testberichte");
define("_WLINKS","Links");
define("_EPHEMERIDS","Tagesmotto");
define("_ONEDAY","Ein Tag wie heute...");
define("_ASREGISTERED","<a href=\"modules.php?name=Your_Account\">Kostenlos registrieren!</a>. Gestalte diese Seite mit und passe das Seitenlayout Deinen W&uuml;nschen an");
define("_MENUFOR","Men&uuml; f&uuml;r");
define("_NOBIGSTORY","Heute bisher keine News");
define("_BIGSTORY","Meistgelesene Nachricht heute:");
define("_SURVEY","Umfrage");
define("_POLLS","Umfragen");
define("_PCOMMENTS","Kommentare:");
define("_RESULTS","Ergebnisse");
define("_HREADMORE","mehr...");
define("_CURRENTLY","Zur Zeit sind");
define("_GUESTS","G&auml;ste und");
define("_MEMBERS","Mitglied(er) online.");
define("_YOUARELOGGED","Du bist eingeloggt als");
define("_YOUHAVE","Du hast");
define("_PRIVATEMSG","pers&ouml;nliche Nachricht(en).");
define("_YOUAREANON","Du bist anonymer Benutzer. Du kannst Dich <a href=\"modules.php?name=Your_Account\">hier anmelden</a>");
define("_NOTE","Notiz:");
define("_ADMIN","Administrator:");
define("_WERECEIVED","Wir hatten");
define("_PAGESVIEWS","Seitenzugriffe seit");
define("_TOPIC","Thema");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Abstimmen");
define("_VOTES","Stimmen");
define("_MVIEWADMIN","Ansicht: Nur Admins");
define("_MVIEWUSERS","Ansicht: Nur angemeldete Benutzer");
define("_MVIEWANON","Ansicht: Nur anonyme Benutzer");
define("_MVIEWALL","Ansicht: Alle Besucher");
define("_EXPIRELESSHOUR","Verfall: weniger als 1 Stunde");
define("_EXPIREIN","Verf&auml;llt in");
define("_HTTPREFERERS","HTTP Referer");
define("_UNLIMITED","Unbegrenzt");
define("_HOURS","Stunden");
define("_RSSPROBLEM","Es gibt Probleme mit &Uuml;berschriften auf der Site");
define("_SELECTLANGUAGE","Sprache w&auml;hlen");
define("_SELECTGUILANG","Sprache f&uuml;r das Interface ausw&auml;hlen");
define("_NONE","Keine");
define("_BLOCKPROBLEM","<center>Es besteht ein Problem mit diesem Block.</center>");
define("_BLOCKPROBLEM2","<center>Dieser Block hat derzeit keinen Inhalt.</center>");
define("_MODULENOTACTIVE","Sorry, dieses Modul ist nicht aktiv!");
define("_NOACTIVEMODULES","Inaktive Module");
define("_FORADMINTESTS","(f&uuml;r Admin zum testen)");
define("_BBFORUMS","Forums");
define("_ACCESSDENIED", "Zugriff verweigert");
define("_RESTRICTEDAREA", "Du bist im Begriff einen gesch&uuml;tzten Bereich zu betreten.");
define("_MODULEUSERS", "Es tut uns leid, aber dieser Bereich ist nur unseren <i>Registrierten Benutzern</i> zug&auml;nglich<br><br>Du kannst Dich kostenfrei registrieren, indem Du  <a href=\"modules.php?name=Your_Account&op=new_user\">hier</a> klickst, anschliessend hast Du<br>uneingeschr&auml;nkten Zugriff auf diesen Bereich. Danke.<br><br>");
define("_MODULESADMINS", "Es tut uns leid, aber dieser Bereich ist unseren <i>Administratoren</i> vorbehalten<br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%A, %d.%B. @ %T %Z");
define("_DATESTRING2","%A, %d %B");


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