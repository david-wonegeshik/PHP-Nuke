<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

if (stristr($REQUEST_URI,"mainfile")) {
    Header("Location: modules.php?name=News&file=article&sid=$sid");
} elseif (!isset($sid) && !isset($tid)) {
    Header("Location: index.php");
}

if ($save AND is_user($user)) {
    cookiedecode($user);
    sql_query("update ".$user_prefix."_users set umode='$mode', uorder='$order', thold='$thold' where uid='$cookie[0]'", $dbi);
    getusrinfo($user);
    $info = base64_encode("$userinfo[uid]:$userinfo[uname]:$userinfo[pass]:$userinfo[storynum]:$userinfo[umode]:$userinfo[uorder]:$userinfo[thold]:$userinfo[noscore]");
    setcookie("user","$info",time()+$cookieusrtime);
}

if ($op == "Reply") {
    Header("Location: modules.php?name=News&file=comments&op=Reply&pid=0&sid=$sid&mode=$mode&order=$order&thold=$thold");
}

$result = sql_query("select catid, aid, time, title, hometext, bodytext, topic, informant, notes, acomm, haspoll, pollID, score, ratings FROM ".$prefix."_stories where sid=$sid", $dbi);
list($catid, $aid, $time, $title, $hometext, $bodytext, $topic, $informant, $notes, $acomm, $haspoll, $pollID, $score, $ratings) = sql_fetch_row($result, $dbi);

if ($aid == "") {
    Header("Location: modules.php?name=News");
}

sql_query("UPDATE ".$prefix."_stories SET counter=counter+1 where sid=$sid", $dbi);

$artpage = 1;
$pagetitle = "- $title";
require("header.php");
$artpage = 0;

formatTimestamp($time);
$title = stripslashes($title);
$hometext = stripslashes($hometext);
$bodytext = stripslashes($bodytext);
$notes = stripslashes($notes);

if ($notes != "") {
    $notes = "<br><br><b>"._NOTE."</b> <i>$notes</i>";
} else {
    $notes = "";
}

if($bodytext == "") {
    $bodytext = "$hometext$notes";
} else {
    $bodytext = "$hometext<br><br>$bodytext$notes";
}

if($informant == "") {
    $informant = $anonymous;
}

getTopics($sid);

if ($catid != 0) {
    $resultx = sql_query("select title from ".$prefix."_stories_cat where catid='$catid'", $dbi);
    list($title1) = sql_fetch_row($resultx, $dbi);
    $title = "<a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
}

echo "<table width=\"100%\" border=\"0\"><tr><td valign=\"top\" width=\"100%\">\n";
themearticle($aid, $informant, $datetime, $title, $bodytext, $topic, $topicname, $topicimage, $topictext);
echo "</td><td>&nbsp;</td><td valign=\"top\">\n";

if ($multilingual == 1) {
    $querylang = "AND (blanguage='$currentlang' OR blanguage='')";
} else {
    $querylang = "";
}

/* Determine if the article has attached a poll */
if ($haspoll == 1) {
    $url = sprintf("modules.php?name=Surveys&amp;op=results&amp;pollID=%d", $pollID);
    $boxContent = "<form action=\"modules.php?name=Surveys\" method=\"post\">";
    $boxContent .= "<input type=\"hidden\" name=\"pollID\" value=\"".$pollID."\">";
    $boxContent .= "<input type=\"hidden\" name=\"forwarder\" value=\"".$url."\">";
    $result = sql_query("SELECT pollTitle, voters FROM ".$prefix."_poll_desc WHERE pollID=$pollID", $dbi);
    list($pollTitle, $voters) = sql_fetch_row($result, $dbi);
    $boxTitle = _ARTICLEPOLL;
    $boxContent .= "<font class=\"content\"><b>$pollTitle</b></font><br><br>\n";
    $boxContent .= "<table border=\"0\" width=\"100%\">";
    for($i = 1; $i <= 12; $i++) {
	$result = sql_query("SELECT pollID, optionText, optionCount, voteID FROM ".$prefix."_poll_data WHERE (pollID=$pollID) AND (voteID=$i)", $dbi);
	$object = sql_fetch_object($result, $dbi);
	if(is_object($object)) {
	    $optionText = $object->optionText;
	    if($optionText != "") {
		$boxContent .= "<tr><td valign=\"top\"><input type=\"radio\" name=\"voteID\" value=\"".$i."\"></td><td width=\"100%\"><font class=\"content\">$optionText</font></td></tr>\n";
	    }
	}
    }
    $boxContent .= "</table><br><center><font class=\"content\"><input type=\"submit\" value=\""._VOTE."\"></font><br>";
    if (is_user($user)) {
        cookiedecode($user);
    }
    for($i = 0; $i < 12; $i++) {
	$result = sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID=$pollID) AND (voteID=$i)", $dbi);
	$object = sql_fetch_object($result, $dbi);
	$optionCount = $object->optionCount;
	$sum = (int)$sum+$optionCount;
    }
    $boxContent .= "<font class=\"content\">[ <a href=\"modules.php?name=Surveys&amp;op=results&amp;pollID=$pollID&amp;mode=$cookie[4]&amp;order=$cookie[5]&amp;thold=$cookie[6]\"><b>"._RESULTS."</b></a> | <a href=\"modules.php?name=Surveys\"><b>"._POLLS."</b></a> ]<br>";

    if ($pollcomm) {
	list($numcom) = sql_fetch_row(sql_query("select count(*) from ".$prefix."_pollcomments where pollID=$pollID", $dbi), $dbi);
	$boxContent .= "<br>"._VOTES.": <b>$sum</b> | "._PCOMMENTS." <b>$numcom</b>\n\n";
    } else {
        $boxContent .= "<br>"._VOTES." <b>$sum</b>\n\n";
    }
    $boxContent .= "</font></center></form>\n\n";
    themesidebox($boxTitle, $boxContent);
}

$result = sql_query("select title, content, active, position from ".$prefix."_blocks where blockfile='block-Login.php' $querylang", $dbi);
list($title, $content, $active, $position) = sql_fetch_row($result, $dbi);
if (($active == 1) AND ($position == "r") AND (!is_user($user))) {
    loginbox();
}

$boxtitle = ""._RELATED."";
$boxstuff = "<font class=\"content\">";

/* This is a list for automatic related links on article internal page */
/* For this I used a multi-dimensional array so we can show the links titles */
/* as we want, doesn't matter the case of the string in the article. You can */
/* add or remove links from this array as you wish to fit your needs */

$relatedarray = array ("gpl" 		=> array ("GPL" 			=> "http://www.gnu.org"),
                       "linux" 		=> array ("Linux.com" 			=> "http://www.linux.com"),
		       "blender"	=> array ("Blender" 			=> "http://www.blender.nl"),
		       "gnu"		=> array ("GNU Project"			=> "http://www.gnu.org"),
		       "gimp"		=> array ("The GIMP"			=> "http://www.gimp.org"),
		       "cnn"		=> array ("CNN.com"			=> "http://www.cnn.com"),
		       "news.com"	=> array ("News.com"			=> "http://www.news.com"),
		       "ibm"		=> array ("IBM"				=> "http://www.ibm.com"),
		       "php"		=> array ("PHP HomePage"		=> "http://www.php.net"),
		       "mandrake"	=> array ("MandrakeSoft"		=> "http://www.mandrakesoft.com"),
		       "redhat"		=> array ("Red Hat"			=> "http://www.redhat.com"),
		       "red hat"	=> array ("Red Hat"			=> "http://www.redhat.com"),
		       "Debian"		=> array ("Debian GNU/Linux"		=> "http://www.debian.org"),
		       "Slackware"	=> array ("Slackware"			=> "http://www.slackware.com"),
		       "freebsd"	=> array ("FreeBSD"			=> "http://www.freebsd.org"),
		       "artist"		=> array ("Linux Artist"		=> "http://www.linuxartist.com"),
		       "games"		=> array ("Linux Games"			=> "http://www.linuxgames.com"),
		       "sourceforge"	=> array ("SourceForge"			=> "http://www.sourceforge.net"),
		       "source forge"	=> array ("SourceForge"			=> "http://www.sourceforge.net"),
		       "palm pilot"	=> array ("Palm Pilot"			=> "http://www.palm.com"),
		       "windows"	=> array ("Microsoft"			=> "http://www.microsoft.com"),
		       "microsoft"	=> array ("Microsoft"			=> "http://www.microsoft.com"),
		       "kernel"		=> array ("Linux Kernel Archives"	=> "http://www.kernel.org"),
		       "opensource"	=> array ("OpenSource"			=> "http://www.opensource.org"),
		       "open source"	=> array ("OpenSource"			=> "http://www.opensource.org"),
		       "nuke"		=> array ("PHP-Nuke"			=> "http://www.phpnuke.org"),
		       "compaq"		=> array ("Compaq"			=> "http://www.compaq.com"),
		       "intel"		=> array ("Intel"			=> "http://www.intel.com"),
		       "mysql"		=> array ("MySQL Database Server"	=> "http://www.mysql.com"),
		       "themes"		=> array ("Themes.org"			=> "http://www.themes.org"),
		       "suse"		=> array ("SuSE"			=> "http://www.suse.com"),
		       "script"		=> array ("HotScripts"			=> "http://www.hotscripts.com"),
		       "transmeta"	=> array ("Transmeta"			=> "http://www.transmeta.com"),
		       "apple"		=> array ("Apple"			=> "http://www.apple.com"),
		       "apache"		=> array ("Apache Web Server"		=> "http://www.apache.org"),
		       "nasa"		=> array ("NASA"			=> "http://www.nasa.gov"),
		       "documentation"	=> array ("Linux Manuals"		=> "http://www.linuxdoc.org"),
		       "manual"		=> array ("Linux Manuals"		=> "http://www.linuxdoc.org"),
		       "howto"		=> array ("Linux Manuals"		=> "http://www.linuxdoc.org"),
		       "rtfm"		=> array ("Linux Manuals"		=> "http://www.linuxdoc.org"),
		       "dell"		=> array ("Dell"			=> "http://www.dell.com"),
		       "google"		=> array ("Google Search Engine"	=> "http://www.google.com"),
		       "translat"	=> array ("Babelfish Translator"	=> "http://babelfish.altavista.com"),
		       "w3"		=> array ("W3 Consortium"		=> "http://www.w3.org"),
		       "css"		=> array ("CSS Standard"		=> "http://www.w3.org/Style/CSS"),
		       " html"		=> array ("HTML Standard"		=> "http://www.w3.org/MarkUp"),
		       "xhmtl"		=> array ("XHTML Standard"		=> "http://www.w3.org/MarkUp"),
		       "rpm"		=> array ("RPM"				=> "http://www.rpm.org"),
		       "3com"		=> array ("3Com"			=> "http://www.3com.com"),
		       "sun microsyste" => array ("Sun Microsystems"		=> "http://www.sun.com"),
		       "staroffice" 	=> array ("Star Office"			=> "http://www.sun.com"),
		       "star office" 	=> array ("Star Office"			=> "http://www.sun.com"),
		       "openoffice" 	=> array ("Open Office"			=> "http://www.openoffice.org"),
		       "open office" 	=> array ("Open Office"			=> "http://www.openoffice.org"),
		       "oracle"		=> array ("Oracle"			=> "http://www.oracle.com"),
		       "informix"	=> array ("Informix"			=> "http://www.informix.com"),
		       "postgre"	=> array ("PostgreSQL"			=> "http://www.postgresql.org"),
		       "mp3"		=> array ("MP3.com"			=> "http://www.mp3.com"),
		       "gnome"		=> array ("GNOME"			=> "http://www.gnome.org"),
		       "kde"		=> array ("KDE"				=> "http://www.kde.org"),
		       "mozilla"	=> array ("Mozilla"			=> "http://www.mozilla.org"),
		       "netscape"	=> array ("Netscape"			=> "http://www.netscape.com"),
		       "corel"		=> array ("Corel"			=> "http://www.corel.com"),
		       " hp"		=> array ("Hewlett Packard"		=> "http://www.hp.com"),
		       "hewlett packar" => array ("Hewlett Packard"		=> "http://www.hp.com"),
		       "caldera"	=> array ("Caldera Systems"		=> "http://www.caldera.com"),
		       "freshmeat"	=> array ("Freshmeat"			=> "http://www.freshmeat.net"),
		       "slashdot"	=> array ("Slashdot"			=> "http://www.slashdot.org"),
		       "spam"		=> array ("Spam Cop"			=> "http://www.spamcop.net"),
		       "aol"		=> array ("America Online"		=> "http://www.aol.com"),
		       "america online"	=> array ("America Online"		=> "http://www.aol.com"),
		       "pov-ray"	=> array ("POV Ray"			=> "http://www.povray.org"),
		       "povray"		=> array ("POV Ray"			=> "http://www.povray.org"),
		       "pov ray"	=> array ("POV Ray"			=> "http://www.povray.org"),
		       "seti"		=> array ("SETI Institute"		=> "http://www.seti.org"),
		       "cnet"		=> array ("C|Net News"			=> "http://www.cnet.com"),
		       "zdnet"		=> array ("ZDNet News"			=> "http://www.zdnet.com"),
		       "napster"	=> array ("Napster"			=> "http://www.napster.com"),
		       "sony"		=> array ("Sony HomePage"		=> "http://www.sony.com"),
		       "xfree"		=> array ("X-Free86 Project"		=> "http://www.xfree.org"),
		       "x-free"		=> array ("X-Free86 Project"		=> "http://www.xfree.org"),
		       "x free"		=> array ("X-Free86 Project"		=> "http://www.xfree.org"),
		       "beos"		=> array ("BeOS"			=> "http://www.beos.com"),
		       "borland"	=> array ("Borland"			=> "http://www.borland.com"),
		       "kylix"		=> array ("Kylix HomePage"		=> "http://www.borland.com/kylix"),
		       "amazon"		=> array ("Amazon.com"			=> "http://www.amazon.com")
		       );

while (list ($key) = each ($relatedarray)) {
    $relarr = eregi($key, $bodytext);
    if ($relarr) {
        list($rep, $val) = each ($relatedarray[$key]);
        $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$val\" target=\"new\">$rep</a><br>\n";
    }
}

/* Multi-dimensional array end here */

$result = sql_query("select name, url from ".$prefix."_related where tid=$topic", $dbi);
while(list($name, $url) = sql_fetch_row($result, $dbi)) {
    $boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"$url\" target=\"new\">$name</a><br>\n";
}

$boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Search&amp;topic=$topic\">"._MOREABOUT." $topictext</a><br>\n";
$boxstuff .= "<strong><big>&middot;</big></strong>&nbsp;<a href=\"modules.php?name=Search&amp;author=$aid\">"._NEWSBY." $aid</a><br>\n";

$boxstuff .= "</font><br><hr noshade width=\"95%\" size=\"1\"><center><font class=\"content\"><b>"._MOSTREAD." $topictext:</b><br>\n";

global $multilingual, $currentlang;
    if ($multilingual == 1) {
	$querylang = "AND (alanguage='$currentlang' OR alanguage='')"; /* the OR is needed to display stories who are posted to ALL languages */
    } else {
	$querylang = "";
    }
$result2 = sql_query("select sid, title from ".$prefix."_stories where topic=$topic $querylang order by counter desc limit 0,1", $dbi);
list($topstory, $ttitle) = sql_fetch_row($result2, $dbi);

$boxstuff .= "<a href=\"modules.php?name=News&file=article&sid=$topstory\">$ttitle</a></font></center><br>\n";
themesidebox($boxtitle, $boxstuff);

if ($ratings != 0) {
    $rate = substr($score / $ratings, 0, 4);
    $r_image = round($rate);
    $the_image = "<br><br><img src=\"images/articles/stars-$r_image.gif\" border=\"1\"></center><br>";
} else {
    $rate = 0;
    $the_image = "</center><br>";
}
$ratetitle = ""._RATEARTICLE."";
$ratecontent = "<center>"._AVERAGESCORE.": <b>$rate</b><br>"._VOTES.": <b>$ratings</b>$the_image";
$ratecontent .= "<form action=\"modules.php?name=News\" method=\"post\"><center>"._RATETHISARTICLE."</center><br>";
$ratecontent .= "<input type=\"hidden\" name=\"sid\" value=\"$sid\">";
$ratecontent .= "<input type=\"hidden\" name=\"op\" value=\"rate_article\">";
$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"1\"> <img src=\"images/articles/stars-1.gif\" border=\"0\" alt=\""._BAD."\"><br>";
$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"2\"> <img src=\"images/articles/stars-2.gif\" border=\"0\" alt=\""._REGULAR."\"><br>";
$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"3\"> <img src=\"images/articles/stars-3.gif\" border=\"0\" alt=\""._GOOD."\"><br>";
$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"4\"> <img src=\"images/articles/stars-4.gif\" border=\"0\" alt=\""._VERYGOOD."\"><br>";
$ratecontent .= "<input type=\"radio\" name=\"score\" value=\"5\"> <img src=\"images/articles/stars-5.gif\" border=\"0\" alt=\""._EXCELLENT."\"><br><br>";
$ratecontent .= "<center><input type=\"submit\" value=\""._CASTMYVOTE."\"></center></form><br>";
themesidebox($ratetitle, $ratecontent);

$optiontitle = ""._OPTIONS."";
$optionbox .= "<br><img src=\"images/print.gif\" border=\"0\" Alt=\""._PRINTER."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a href=\"modules.php?name=News&amp;file=print&amp;sid=$sid\">"._PRINTER."</a><br><br>";
$optionbox .= "<img src=\"images/friend.gif\" border=\"0\" Alt=\""._FRIEND."\" width=\"16\" height=\"11\">&nbsp;&nbsp;<a href=\"modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=$sid\">"._FRIEND."</a>\n";
if (is_admin($admin)) {
    $optionbox .= "<center><br><b>"._ADMIN."</b><br>[ <a href=\"admin.php?op=adminStory\">"._ADD."</a> | <a href=\"admin.php?op=EditStory&sid=$sid\">"._EDIT."</a> | <a href=\"admin.php?op=RemoveStory&sid=$sid\">"._DELETE."</a> ]</center>";
}
themesidebox($optiontitle, $optionbox);

echo "</td></tr></table>\n";
cookiedecode($user);
if ((($mode != "nocomments") OR ($acomm == 0)) AND ($articlecomm == 1)) {
    include("modules/News/comments.php");
}
include ("footer.php");
?>