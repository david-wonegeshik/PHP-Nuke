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
define("_LOGIN","P�ihl�en�");
define("_WRITES","p�e");
define("_POSTEDON","Posted on");
define("_NICKNAME","P�ezd�vka");
define("_PASSWORD","Heslo");
define("_WELCOMETO","V�tejte na");
define("_EDIT","Upravit");
define("_DELETE","Smazat");
define("_POSTEDBY","Poslal");
define("_READS","�ten���");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Zp�t</a> ]");
define("_COMMENTS","koment��e");
define("_PASTARTICLES","Minul� �l�nky");
define("_OLDERARTICLES","Star�� �l�nky");
define("_BY","podle");
define("_ON","v");
define("_LOGOUT","Odhl�sit");
define("_WAITINGCONT","A tohle �ek�");
define("_SUBMISSIONS","P��sp�vky");
define("_WREVIEWS","Recenze");
define("_WLINKS","Odkazy");
define("_EPHEMERIDS","Ud�losti");
define("_ONEDAY","Den jako ka�d� jin�...");
define("_ASREGISTERED","Je�t� nem�te sv�j ��et? M��ete si jej <a href=\"modules.php?name=Your_Account\">vytvo�it zde</a>. Jako registrovan� u�ivatel z�sk�te �adu v�hod. Nap��klad pos�l�n� koment��u pod jm�nem, nastaven� koment���, mana�er t�mat atd.");
define("_MENUFOR","Menu pro");
define("_NOBIGSTORY","Dosud nen� �l�nek dne.");
define("_BIGSTORY","Nej�ten�j�� �l�nek dnes je:");
define("_SURVEY","Anketa");
define("_POLLS","Ankety");
define("_PCOMMENTS","Koment���");
define("_RESULTS","V�sledky");
define("_HREADMORE","v�ce...");
define("_CURRENTLY","Pr�v� je");
define("_GUESTS","n�v�t�vn�k(�) a");
define("_MEMBERS","u�ivatel(�) online.");
define("_YOUARELOGGED","Jste p�ihl�en jako");
define("_YOUHAVE","M�te");
define("_PRIVATEMSG","osobn�ch zpr�v.");
define("_YOUAREANON","Jste anonymn� u�ivatel. M��ete se zdarma registrovat kliknut�m <a href=\"modules.php?name=Your_Account\">zde</a>");
define("_NOTE","Pozn�mka:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Zaznamenali jsme");
define("_PAGESVIEWS","p��stup� od");
define("_TOPIC","T�ma");
define("_UDOWNLOADS","Sta�en�");
define("_VOTE","Hlasovat");
define("_VOTES","Hlas�");
define("_MVIEWADMIN","Zobrazit: Pouze administr�tor�m");
define("_MVIEWUSERS","Zobrazit: Pouze p�ihl�en�m u�ivatel�m");
define("_MVIEWANON","Zobrazit: Pouze anonym�m");
define("_MVIEWALL","Zobrazit: V�em n�v�t�vn�k�m");
define("_EXPIRELESSHOUR","Konec zobrazov�n�: m�n� ne� 1 hodina");
define("_EXPIREIN","Konec zobrazov�n� za");
define("_HTTPREFERERS","Odkud p�i�li");
define("_UNLIMITED","Neomezeno");
define("_HOURS","hodin(a/y)");
define("_RSSPROBLEM","Moment�ln� je probl�m se zpr�vami z tohoto webu");
define("_SELECTLANGUAGE","Vyberte si jazyk");
define("_SELECTGUILANG","Vyberte si jazykov� rozhran�:");
define("_NONE","Nen�");
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