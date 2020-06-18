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


define("_CHARSET","BIG5");
define("_SEARCH","�����j�M");
define("_LOGIN","�n�J");
define("_WRITES","�g��");
define("_POSTEDON","�o���");
define("_NICKNAME","�n�J�W��");
define("_PASSWORD","�K�X");
define("_WELCOMETO","�w���");
define("_EDIT","�s��");
define("_DELETE","�R��");
define("_POSTEDBY","�K�X�̬�");
define("_READS","�\Ū");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">�^��W�@��</a> ]");
define("_COMMENTS","�N��");
define("_PASTARTICLES","�H�e���峹");
define("_OLDERARTICLES","���ª��峹");
define("_BY","��");
define("_ON","��");
define("_LOGOUT","�n�X");
define("_WAITINGCONT","���e���ݤ�");
define("_SUBMISSIONS","�뻼");
define("_WREVIEWS","�@�~���׵��ݤ�");
define("_WLINKS","�쵲���ݤ�");
define("_EPHEMERIDS","�{�ɤ��i");
define("_ONEDAY","���v�W������...");
define("_ASREGISTERED","�٨S���b���ܡH<a href=\"modules.php?name=Your_Account\">�Ыإ߱b��</a>�C�������U���ϥΪ̥i�H�ɨ��G���D�D�޲z�A�������պA�վ�Ψ�W�o����׵��\��C");
define("_MENUFOR","����");
define("_NOBIGSTORY","����|�L�j�Ƶo��");
define("_BIGSTORY","�����I�\�v�̰������ɡG");
define("_SURVEY","�벼");
define("_POLLS","�벼�@��");
define("_PCOMMENTS","���סG");
define("_RESULTS","���G");
define("_HREADMORE","�\Ū�ԲӤ��e...");
define("_CURRENTLY","�ثe��");
define("_GUESTS","��ӻ��M");
define("_MEMBERS","�|���b�u�W");
define("_YOUARELOGGED","�z���n�J������");
define("_YOUHAVE","�z��");
define("_PRIVATEMSG","�Өp�H�T��");
define("_YOUAREANON","�z���ΦW�ϥΤ�, �Ш�<a href=\"modules.php?name=Your_Account\">�K�O���U</a>");
define("_NOTE","���G");
define("_ADMIN","�޲z");
define("_WERECEIVED","�����@��");
define("_PAGESVIEWS","���s���C�_�l����G");
define("_TOPIC","�s�D�D�D");
define("_UDOWNLOADS","�U���귽");
define("_VOTE","�벼");
define("_VOTES","�벼");
define("_MVIEWADMIN","�d�ݡG�u���޲z����ݨ�");
define("_MVIEWUSERS","�d�ݡG�u�����U�ϥΪ̯�ݨ�");
define("_MVIEWANON","�d�ݡG�u���ΦW�ϥΪ̯�ݨ�");
define("_MVIEWALL","�d�ݡG�Ҧ��X��");
define("_EXPIRELESSHOUR","�����G�p��@�p��");
define("_EXPIREIN","������");
define("_HTTPREFERERS","HTTP �ӷ�");
define("_UNLIMITED","�L��");
define("_HOURS","�p��");
define("_RSSPROBLEM","�ثe�Ӻ����s�D���D���ǰ��D");
define("_SELECTLANGUAGE","��ܻy��");
define("_SELECTGUILANG","��ܻy���G");
define("_NONE","�L");
define("_BLOCKPROBLEM","<center>�o�Ӱ϶��o�Ͱ��D�C</center>");
define("_BLOCKPROBLEM2","<center>�o�Ӱ϶��{�b�S�����e.</center>");
define("_MODULENOTACTIVE","�藍�_, �o�ӼҲըS���Ұ�!");
define("_NOACTIVEMODULES","���ҰʼҲ�");
define("_FORADMINTESTS","(�޲z�̴��ե�)");
define("_BBFORUMS","�Q�װϺ޲z");
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