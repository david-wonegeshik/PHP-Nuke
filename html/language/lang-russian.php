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


define("_CHARSET","windows-1251");
define("_SEARCH","�����");
define("_LOGIN","�����");
define("_WRITES","�������");
define("_POSTEDON","��������");
define("_NICKNAME","���");
define("_PASSWORD","������");
define("_WELCOMETO","����� ����������");
define("_EDIT","�������������");
define("_DELETE","�������");
define("_POSTEDBY","��������: ");
define("_READS","��������");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">�����</a> ]");
define("_COMMENTS","�����������");
define("_PASTARTICLES","��������� ������");
define("_OLDERARTICLES","������ ������");
define("_BY","��");
define("_ON","��");
define("_LOGOUT","�����");
define("_WAITINGCONT","Waiting Content");
define("_SUBMISSIONS","��������");
define("_WREVIEWS","��������� ������");
define("_WLINKS","�����");
define("_EPHEMERIDS","Ephemerids");
define("_ONEDAY","������ ����, ��� �������...");
define("_ASREGISTERED","�� ������������������? �� ������ ������� ��� ����� <a href=\"user.php\">�����</a>. ����� �� �����������������, �� �������� ������ ������ � ���������� ������, ������� �������� ��� ������� ��� �� ������ ������� � �.�.");
define("_MENUFOR","���� ���");
define("_NOBIGSTORY","������� ����� ������ ��� �� ����.");
define("_BIGSTORY","������� ����� �������� ������:");
define("_SURVEY","�����");
define("_POLLS","������ ������");
define("_PCOMMENTS","�����������:");
define("_RESULTS","����������");
define("_HREADMORE","�����...");
define("_CURRENTLY","������ � ����,");
define("_GUESTS","�����(��) �");
define("_MEMBERS","������������(��).");
define("_YOUARELOGGED","�� ����� ���");
define("_YOUHAVE","� ��� ����");
define("_PRIVATEMSG","���������(���) ���������(��).");
define("_YOUAREANON","�� ��������� ������������. �� ������ ������������������ ����� <a href=\"user.php\">�����</a>");
define("_NOTE","������:");
define("_ADMIN","�������������:");
define("_WERECEIVED","�� ��������");
define("_PAGESVIEWS","���������� ����� ������� ��");
define("_TOPIC","����");
define("_UDOWNLOADS","Downloads");
define("_VOTE","�����");
define("_VOTES","������");
define("_MVIEWADMIN","�������������: ������ ������");
define("_MVIEWUSERS","�������������: ������ ������������������ ������������");
define("_MVIEWANON","�������������: ������ ��������� ������������");
define("_MVIEWALL","�������������: ��� ����������");
define("_EXPIRELESSHOUR","Expiration: Less than 1 hour");
define("_EXPIREIN","Expiration in");
define("_HTTPREFERERS","��������");
define("_HOURS","����");
define("_RSSPROBLEM","�������� � �����������");
define("_SELECTLANGUAGE","�������� ����");
define("_SELECTGUILANG","�������� ���� ����������:");
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