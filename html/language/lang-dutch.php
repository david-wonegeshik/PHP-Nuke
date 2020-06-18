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
define("_SEARCH","Zoek");
define("_LOGIN","Inloggen");
define("_WRITES","schrijft");
define("_POSTEDON","Geplaatst op");
define("_NICKNAME","Loginnaam");
define("_PASSWORD","Wachtwoord");
define("_WELCOMETO","Welkom op");
define("_EDIT","Bewerken");
define("_DELETE","Verwijder");
define("_POSTEDBY","Geplaatst door");
define("_READS","maal gelezen");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Ga terug</a> ]");
define("_COMMENTS","opmerkingen");
define("_PASTARTICLES","Voorgaande artikelen");
define("_OLDERARTICLES","Oudere artikelen");
define("_BY","door");
define("_ON","op");
define("_LOGOUT","Afmelden");
define("_WAITINGCONT","Wachtende inhoud");
define("_SUBMISSIONS","Ingeleverde stukken");
define("_WREVIEWS","Wachtende reviews");
define("_WLINKS","Wachtende links");
define("_EPHEMERIDS","Ephemerids");
define("_ONEDAY","Een dag zoals vandaag...");
define("_ASREGISTERED","Nog geen lid? U kunt een account <a href=\"modules.php?name=Your_Account\">aanvragen</a>. Als geregistreerde gebruiker krijgt u voordelen zoals de Thema-manager, opmerkingsconfiguratie en kunt u opmerkingen plaatsen onder uw eigen naam.");
define("_MENUFOR","Menu voor");
define("_NOBIGSTORY","Vandaag is er nog geen groot verhaal geplaatst.");
define("_BIGSTORY","Het meest gelezen verhaal van vandaag is:");
define("_SURVEY","Onderzoek");
define("_POLLS","Peilingen");
define("_PCOMMENTS","Opmerkingen:");
define("_RESULTS","Uitslagen");
define("_HREADMORE","Lees Meer...");
define("_CURRENTLY","Er zijn op dit moment,");
define("_GUESTS","gast(en) en");
define("_MEMBERS","lid(leden) die online zijn.");
define("_YOUARELOGGED","U bent ingelogd als");
define("_YOUHAVE","U hebt");
define("_PRIVATEMSG","privé-bericht(en).");
define("_YOUAREANON","U bent een gast. U kunt gratis een account aanvragen door <a href=\"modules.php?name=Your_Account\">hier</a> te klikken");
define("_NOTE","Noot:");
define("_ADMIN","Admin:");
define("_WERECEIVED","We ontvingen");
define("_PAGESVIEWS","paginabezoeken sinds");
define("_TOPIC","Onderwerp");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Stem");
define("_VOTES","Stemmen");
define("_MVIEWADMIN","Beeld: alleen beheerders");
define("_MVIEWUSERS","Beeld: alleen leden");
define("_MVIEWANON","Beeld: alleen niet-leden");
define("_MVIEWALL","Beeld: alle bezoekers");
define("_EXPIRELESSHOUR","Vervalt binnen één uur");
define("_EXPIREIN","Vervalt over");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Ongelimiteerd");
define("_HOURS","Uren");
define("_RSSPROBLEM","Er is een probleem met de koppen van deze site");
define("_SELECTLANGUAGE","Kies taal");
define("_SELECTGUILANG","Kies interface taal:");
define("_NONE","Geen");
define("_BLOCKPROBLEM","<center>Er is een probleem met dit blok.</center>");
define("_BLOCKPROBLEM2","<center>Dit blok heeft geen inhoud.</center>");
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
define("_DATESTRING","%A %d %B @ %T %Z");
define("_DATESTRING2","%A %d %B");
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