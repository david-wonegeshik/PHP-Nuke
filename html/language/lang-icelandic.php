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
define("_LOGIN","Innskr�ning");
define("_WRITES","skrifar");
define("_POSTEDON","Sent inn");
define("_NICKNAME","Notandanafn");
define("_PASSWORD","Lykilor�");
define("_WELCOMETO","Velkomin(n) �");
define("_EDIT","Breyta");
define("_DELETE","Ey�a");
define("_POSTEDBY","Sent inn af");
define("_READS","sinnum lesin");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Til baka</a> ]");
define("_COMMENTS","athugasemdir");
define("_PASTARTICLES","Fyrri greinar");
define("_OLDERARTICLES","Eldri greinar");
define("_BY","fr�");
define("_ON","�ann");
define("_LOGOUT","Skr� �ig �t");
define("_WAITINGCONT","Efni � bi�r��");
define("_SUBMISSIONS","Fr�ttir");
define("_WREVIEWS","Umsagnir � bi�");
define("_WLINKS","Veftenglar � bi�");
define("_EPHEMERIDS","Dagb�karbrot");
define("_ONEDAY","�essi dagur � s�gunni...");
define("_ASREGISTERED","Ertu ekki enn me� a�gang? �� getur <a href=\"modules.php?name=Your_Account\">skr�� �ig inn</a>. Sem skr��ur notandi getur �� til d�mis breytt �tliti s��unnar og sent inn fr�ttir og athugasemdir undir ��nu nafni.");
define("_MENUFOR","Valmynd fyrir");
define("_NOBIGSTORY","Fr�tt dagsins er ekki enn b�in a� sj� dagsins lj�s.");
define("_BIGSTORY","Mest lesna fr�ttin � dag er:");
define("_SURVEY","K�nnunin");
define("_POLLS","Kannanir");
define("_PCOMMENTS","Athugasemdir:");
define("_RESULTS","Ni�urst��ur");
define("_HREADMORE","lesa meira...");
define("_CURRENTLY","� augnablikinu eru");
define("_GUESTS","gestir og");
define("_MEMBERS","skr��ir notendur tengdir.");
define("_YOUARELOGGED","�� ert skr��ur inn sem");
define("_YOUHAVE","�� �tt inni");
define("_PRIVATEMSG","skilabo�.");
define("_YOUAREANON","�� er ekki skr��(ur).  �� getur skr�� �ig �keypis me� �v� a� smella <a href=\"modules.php?name=Your_Account\">h�rna</a>");
define("_NOTE","Ath:");
define("_ADMIN","Kerfisstj�rn:");
define("_WERECEIVED","Hj� okkur hafa veri� sko�a�ar");
define("_PAGESVIEWS","s��ur s��an �");
define("_TOPIC","Efnisflokkur");
define("_UDOWNLOADS","Skr�asv��i");
define("_VOTE","Kj�sa");
define("_VOTES","Atkv��i");
define("_MVIEWADMIN","S�n: A�eins kerfisstj�rar");
define("_MVIEWUSERS","S�n: A�eins skr��ir notendur");
define("_MVIEWANON","S�n: A�eins �skr��ir notendur");
define("_MVIEWALL","S�n: Allir gestir");
define("_EXPIRELESSHOUR","Rennur �t eftir minna en eina klukkustund");
define("_EXPIREIN","Rennur �t eftir");
define("_HTTPREFERERS","HTTP Tilv�sanir");
define("_UNLIMITED","�takmarka�");
define("_HOURS","klukkustundir");
define("_RSSPROBLEM","� augnablikinu vir�ist vera vandam�l vi� a� s�kja fyrirsagnir fr� �essari s��u");
define("_SELECTLANGUAGE","Veldu tungum�l");
define("_SELECTGUILANG","Veldu tungum�l s��unnar:");
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