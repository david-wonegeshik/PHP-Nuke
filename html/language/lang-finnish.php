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
define("_SEARCH","Hae");
define("_LOGIN","Kirjaudu sisään");
define("_WRITES","kirjoitti:");
define("_POSTEDON","Kirjoitettu");
define("_NICKNAME","Käyttäjätunnus");
define("_PASSWORD","Salasana");
define("_WELCOMETO","Tervetuloa");
define("_EDIT","Muokkaa");
define("_DELETE","Poista");
define("_POSTEDBY","Hyväksyi:");
define("_READS","kertaa luettu");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Takaisin</a> ]");
define("_COMMENTS","kommentit"); 
define("_PASTARTICLES","Vanhat artikkelit"); 
define("_OLDERARTICLES","Vanhemmat artikkelit"); 
define("_BY","Kuka:");
define("_ON","Milloin:");
define("_LOGOUT","Kirjaudu ulos");
define("_WAITINGCONT","Odottava sisältö");
define("_SUBMISSIONS","Uutisia");
define("_WREVIEWS","Arvostelut");
define("_WLINKS","Linkkejä");
define("_EPHEMERIDS","Historiassa");
define("_ONEDAY","Päivä kuin tämä...");
define("_ASREGISTERED","Ole hyvä ja <a href=\"user.php?op=new_user\">rekisteröidy</a>.");
define("_MENUFOR","Valikko");
define("_NOBIGSTORY","Päivälle ei ole vielä luetuinta uutista.");
define("_BIGSTORY","Päivän luetuin artikkeli:");
define("_SURVEY","Äänestys");
define("_POLLS","Kyselyt");
define("_PCOMMENTS","Kommentit:");
define("_RESULTS","Tulokset");
define("_HREADMORE","Lue lisää...");
define("_CURRENTLY","Sivustolla on parhaillaan,");
define("_GUESTS","vierasta ja");
define("_MEMBERS","jäsentä Online.");
define("_YOUARELOGGED","Olet kirjautunut:");
define("_YOUHAVE","Sinulla on");
define("_PRIVATEMSG","yksityisviestiä.");
define("_YOUAREANON","Olet anonyymi. Rekisteröidy <a href=\"user.php?new_user\">jäseneksi</a>");
define("_NOTE","Viesti:");
define("_ADMIN","Ylläpitäjä:");
define("_WERECEIVED","Sivulatauksia");
define("_PAGESVIEWS","sitten");
define("_TOPIC","Kanava");
define("_UDOWNLOADS","tiedostoa");
define("_VOTE","Äänestä");
define("_VOTES","Äänet");
define("_MVIEWADMIN","Näytetään: Vain ylläpitäjille");
define("_MVIEWUSERS","Näytetään: Vain rekisteröityneille");
define("_MVIEWANON","Näytetään: Vain Anonyymeille");
define("_MVIEWALL","Näytetään: Kaikille");
define("_EXPIRELESSHOUR","Voimassa: Alle tunti");
define("_EXPIREIN","voimassa");
define("_HTTPREFERERS","Linkitykset Sivuillemme");
define("_UNLIMITED","rajoittamaton");
define("_HOURS","Tuntia");
define("_RSSPROBLEM","Otsikoiden kanssa on ongelmaa tällä hetkellä");
define("_SELECTLANGUAGE","Valitse kieli");
define("_SELECTGUILANG","Valitse näkymän kieli:");
define("_NONE","None");
define("_BLOCKPROBLEM","<center>There is a problem right now with this block.</center>");
define("_BLOCKPROBLEM2","<center>There isn't content right now for this block.</center>");
define("_MODULENOTACTIVE","Sorry, this Module isn't active!");
define("_NOACTIVEMODULES","Inactive Modules");
define("_FORADMINTESTS","(for Admin tests)");
define("_BBFORUMS","Forums");
define("_ACCESSDENIED", "Access Denied");
define("_RESTRICTEDAREA", "You are trying to access to a restricted area.");
define("_MODULEUSERS", "We are Sorry but this section of our site is for <i>Registered Users Only</i><br><br>You can register for free by clicking <a href=\"user.php?op=new_user\">here</a>, then you can<br>access to this section without restrictions. Thanks.<br><br>");
define("_MODULESADMINS", "We are Sorry but this section of our site is for <i>Administrators Only</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%A, %B %d @ %T %Z");
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