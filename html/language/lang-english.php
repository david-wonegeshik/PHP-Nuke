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
define("_SEARCH","Search");
define("_LOGIN","Login");
define("_WRITES","writes");
define("_POSTEDON","Posted on");
define("_NICKNAME","Nickname");
define("_PASSWORD","Password");
define("_WELCOMETO","Welcome to");
define("_EDIT","Edit");
define("_DELETE","Delete");
define("_POSTEDBY","Posted by");
define("_READS","reads");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Go Back</a> ]");
define("_COMMENTS","comments");
define("_PASTARTICLES","Past Articles");
define("_OLDERARTICLES","Older Articles");
define("_BY","by");
define("_ON","on");
define("_LOGOUT","Logout");
define("_WAITINGCONT","Waiting Content");
define("_SUBMISSIONS","Submissions");
define("_WREVIEWS","Waiting Reviews");
define("_WLINKS","Waiting Links");
define("_EPHEMERIDS","Ephemerids");
define("_ONEDAY","One Day like Today...");
define("_ASREGISTERED","Don't have an account yet? You can <a href=\"modules.php?name=Your_Account\">create one</a>. As registered user you have some advantages like theme manager, comments configuration and post comments with your name.");
define("_MENUFOR","Menu for");
define("_NOBIGSTORY","There isn't a Biggest Story for Today, yet.");
define("_BIGSTORY","Today's most read Story is:");
define("_SURVEY","Survey");
define("_POLLS","Polls");
define("_PCOMMENTS","Comments:");
define("_RESULTS","Results");
define("_HREADMORE","read more...");
define("_CURRENTLY","There are currently,");
define("_GUESTS","guest(s) and");
define("_MEMBERS","member(s) that are online.");
define("_YOUARELOGGED","You are logged as");
define("_YOUHAVE","You have");
define("_PRIVATEMSG","private message(s).");
define("_YOUAREANON","You are Anonymous user. You can register for free by clicking <a href=\"modules.php?name=Your_Account\">here</a>");
define("_NOTE","Note:");
define("_ADMIN","Admin:");
define("_WERECEIVED","We received");
define("_PAGESVIEWS","page views since");
define("_TOPIC","Topic");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Vote");
define("_VOTES","Votes");
define("_MVIEWADMIN","View: Administrators Only");
define("_MVIEWUSERS","View: Registered Users Only");
define("_MVIEWANON","View: Anonymous Users Only");
define("_MVIEWALL","View: All Visitors");
define("_EXPIRELESSHOUR","Expiration: Less than 1 hour");
define("_EXPIREIN","Expiration in");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Unlimited");
define("_HOURS","Hours");
define("_RSSPROBLEM","Currently there is a problem with headlines from this site");
define("_SELECTLANGUAGE","Select Language");
define("_SELECTGUILANG","Select Interface Language:");
define("_NONE","None");
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