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
define("_SEARCH","Leita");
define("_LOGIN","Innskráning");
define("_WRITES","skrifar");
define("_POSTEDON","Sent inn");
define("_NICKNAME","Notandanafn");
define("_PASSWORD","Lykilorð");
define("_WELCOMETO","Velkomin(n) á");
define("_EDIT","Breyta");
define("_DELETE","Eyða");
define("_POSTEDBY","Sent inn af");
define("_READS","sinnum lesin");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Til baka</a> ]");
define("_COMMENTS","athugasemdir");
define("_PASTARTICLES","Fyrri greinar");
define("_OLDERARTICLES","Eldri greinar");
define("_BY","frá");
define("_ON","þann");
define("_LOGOUT","Skrá þig út");
define("_WAITINGCONT","Efni í biðröð");
define("_SUBMISSIONS","Fréttir");
define("_WREVIEWS","Umsagnir í bið");
define("_WLINKS","Veftenglar í bið");
define("_EPHEMERIDS","Dagbókarbrot");
define("_ONEDAY","Þessi dagur í sögunni...");
define("_ASREGISTERED","Ertu ekki enn með aðgang? Þú getur <a href=\"modules.php?name=Your_Account\">skráð þig inn</a>. Sem skráður notandi getur þú til dæmis breytt útliti síðunnar og sent inn fréttir og athugasemdir undir þínu nafni.");
define("_MENUFOR","Valmynd fyrir");
define("_NOBIGSTORY","Frétt dagsins er ekki enn búin að sjá dagsins ljós.");
define("_BIGSTORY","Mest lesna fréttin í dag er:");
define("_SURVEY","Könnunin");
define("_POLLS","Kannanir");
define("_PCOMMENTS","Athugasemdir:");
define("_RESULTS","Niðurstöður");
define("_HREADMORE","lesa meira...");
define("_CURRENTLY","Í augnablikinu eru");
define("_GUESTS","gestir og");
define("_MEMBERS","skráðir notendur tengdir.");
define("_YOUARELOGGED","Þú ert skráður inn sem");
define("_YOUHAVE","Þú átt inni");
define("_PRIVATEMSG","skilaboð.");
define("_YOUAREANON","Þú er ekki skráð(ur).  Þú getur skráð þig ókeypis með því að smella <a href=\"modules.php?name=Your_Account\">hérna</a>");
define("_NOTE","Ath:");
define("_ADMIN","Kerfisstjórn:");
define("_WERECEIVED","Hjá okkur hafa verið skoðaðar");
define("_PAGESVIEWS","síður síðan í");
define("_TOPIC","Efnisflokkur");
define("_UDOWNLOADS","Skráasvæði");
define("_VOTE","Kjósa");
define("_VOTES","Atkvæði");
define("_MVIEWADMIN","Sýn: Aðeins kerfisstjórar");
define("_MVIEWUSERS","Sýn: Aðeins skráðir notendur");
define("_MVIEWANON","Sýn: Aðeins óskráðir notendur");
define("_MVIEWALL","Sýn: Allir gestir");
define("_EXPIRELESSHOUR","Rennur út eftir minna en eina klukkustund");
define("_EXPIREIN","Rennur út eftir");
define("_HTTPREFERERS","HTTP Tilvísanir");
define("_UNLIMITED","Ótakmarkað");
define("_HOURS","klukkustundir");
define("_RSSPROBLEM","Í augnablikinu virðist vera vandamál við að sækja fyrirsagnir frá þessari síðu");
define("_SELECTLANGUAGE","Veldu tungumál");
define("_SELECTGUILANG","Veldu tungumál síðunnar:");
define("_NONE","Enginn");
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
#define("_DATESTRING","%A, %B %d @ %T %Z");
#define("_DATESTRING2","%A, %B %d");
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