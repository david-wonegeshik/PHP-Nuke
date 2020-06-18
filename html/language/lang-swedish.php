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
define("_SEARCH","S�k");
define("_LOGIN","Logga in");
define("_WRITES","skriver");
define("_POSTEDON","Postad");
define("_NICKNAME","Alias");
define("_PASSWORD","L�senord");
define("_WELCOMETO","V�lkommen till");
define("_EDIT","Redigera");
define("_DELETE","Radera");
define("_POSTEDBY","Postad av");
define("_READS","l�sningar");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">G� Tillbaka</a> ]");
define("_COMMENTS","kommentarer");
define("_PASTARTICLES","F�reg�ende Artiklar");
define("_OLDERARTICLES","�ldre Artiklar");
define("_BY","av");
define("_ON"," ");
define("_LOGOUT","Logga ut");
define("_WAITINGCONT","V�ntande Inneh�ll");
define("_SUBMISSIONS","Postningar");
define("_WREVIEWS","Recensioner");
define("_WLINKS","L�nkar");
define("_EPHEMERIDS","Dagens Ord");
define("_ONEDAY","P� en dag som denna...");
define("_ASREGISTERED","Har du inget medlemskap �n? Du kan <a href=\"modules.php?name=Your_Account\">bli medlem</a>. Som registrerad medlem har du lite f�rdelar som en temav�ljare, kommentarsinst�llningar och m�jligheten att skriva kommentarer under ditt eget namn.");
define("_MENUFOR","Meny f�r");
define("_NOBIGSTORY","Det finns inget Het Nyhet f�r Dagen, �nnu.");
define("_BIGSTORY","Dagens mest l�sta Nyhet �r:");
define("_SURVEY","Unders�kning");
define("_POLLS","Unders�kningar");
define("_PCOMMENTS","Kommentarer:");
define("_RESULTS","Resultat");
define("_HREADMORE","l�s mer...");
define("_CURRENTLY","Det finns f�r n�rvarande,");
define("_GUESTS","g�st(er) och");
define("_MEMBERS","medlem(mar) som �r online.");
define("_YOUARELOGGED","Du �r inloggad som");
define("_YOUHAVE","Du har");
define("_PRIVATEMSG","privata meddelanden.");
define("_YOUAREANON","Du �r en anonym bes�kare. Du kan registrera dig gratis genom att fylla i detta <a href=\"modules.php?name=Your_Account\">formul�r</a>");
define("_NOTE","Notera:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Vi har haft");
define("_PAGESVIEWS","sidvisningar sedan");
define("_TOPIC","�mne det ska postas under");
define("_UDOWNLOADS","Nedladdningar");
define("_VOTE","R�sta");
define("_VOTES","R�ster");
define("_MVIEWADMIN","Vy: Endast Administrat�rer");
define("_MVIEWUSERS","Vy: Endast Medlemmar");
define("_MVIEWANON","Vy: Endast Anonyma bes�kare");
define("_MVIEWALL","Vy: Alla Bes�kare");
define("_EXPIRELESSHOUR","F�rfaller inom en timme");
define("_EXPIREIN","F�rfaller om");
define("_HTTPREFERERS","Vilkar l�nkar till oss");
define("_UNLIMITED","Obegr�nsat");
define("_HOURS","Timmar");
define("_RSSPROBLEM","Det �r f�r n�rvarande problem med rubriker fr�n denna webbplats");
define("_SELECTLANGUAGE","V�lj Spr�k");
define("_SELECTGUILANG","V�lj Spr�k f�r gr�nssnitt:");
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
define("_DATESTRING","%A %d %B @ %H:%M");
define("_DATESTRING2","%A, %d %B");
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