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
define("_SEARCH","Søg");
define("_LOGIN"," Log ind ");
define("_WRITES","skriver");
define("_POSTEDON","Postet");
define("_NICKNAME","Brugernavn");
define("_PASSWORD","Kodeord");
define("_WELCOMETO","Velkommen til");
define("_EDIT","Redigér");
define("_DELETE","Slet");
define("_POSTEDBY","Postet af");
define("_READS","hits");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Tilbage</a> ]");
define("_COMMENTS","kommentarer");
define("_PASTARTICLES","Tidligere artikler");
define("_OLDERARTICLES","Ældre artikler");
define("_BY","af");
define("_ON","Dato:");
define("_LOGOUT","Log ud");
define("_WAITINGCONT","Bidrag");
define("_SUBMISSIONS","Artikler");
define("_WREVIEWS","Anmeldelser");
define("_WLINKS","Links");
define("_EPHEMERIDS","Begivenhedssystemet");
define("_ONEDAY","På en dag som i dag...");
define("_ASREGISTERED","Er du endnu ikke oprettet som bruger? Du kan gratis <a href=\"modules.php?name=Your_Account\">oprette</a> en brugerkonto. Som bruger kan du ændre udseende på websitet, ændre opsætning, skrive kommentarer i dit eget navn og modtage vores nyhedsbrev.");
define("_MENUFOR","Menu for");
define("_NOBIGSTORY","Der er endnu ikke nogen Dagens artikel.");
define("_BIGSTORY","Dagens mest læste artikel er:");
define("_SURVEY","Afstemning");
define("_POLLS","Afstemninger");
define("_PCOMMENTS","Kommentarer:");
define("_RESULTS","Resultat");
define("_HREADMORE","læs mere...");
define("_CURRENTLY","Lige nu er der");
define("_GUESTS","gæst(er) og ");
define("_MEMBERS","bruger(e) online.");
define("_YOUARELOGGED","Du er logget ind som");
define("_YOUHAVE","Du har");
define("_PRIVATEMSG","privat(e) besked(er).");
define("_YOUAREANON","Du er ikke oprettet som bruger. Du kan blive bruger ved at klikke <a href=\"modules.php?name=Your_Account\">her</a>");
define("_NOTE","Note:");
define("_ADMIN","Administrator:");
define("_WERECEIVED","Vi har modtaget");
define("_PAGESVIEWS","pagehits siden");
define("_TOPIC","Emne");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Stem");
define("_VOTES","Stemmer");
define("_MVIEWADMIN","Kan kun ses af administratorer");
define("_MVIEWUSERS","Kan kun ses af registrerede brugere");
define("_MVIEWANON","Kan kun ses af anonyme brugere");
define("_MVIEWALL","Kan ses af alle besøgende");
define("_EXPIRELESSHOUR","Udløbstidspunkt: Om mindre end 1 time");
define("_EXPIREIN","Udløber om");
define("_HTTPREFERERS","Hvem linker til sitet");
define("_UNLIMITED","Ubegrænset");
define("_HOURS","Timer");
define("_RSSPROBLEM","Der er i øjeblikket problemer med at modtage overskrifter fra dette website.");
define("_SELECTLANGUAGE","Vælg sprog");
define("_SELECTGUILANG","Vælg sprog:");
define("_NONE","Ingen");
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
define("_DATESTRING","%A, %d. %B kl. %T");
define("_DATESTRING2","%A, %B %d");
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