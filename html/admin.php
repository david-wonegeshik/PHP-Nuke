<?php

/************************************************************************/
/* PHP-NUKE: Advanced Content Management System                         */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)         */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

require_once("mainfile.php");
get_lang(admin);

function create_first($name, $url, $email, $pwd, $user) {
    global $prefix, $dbi, $user_prefix;
    $first = sql_num_rows(sql_query("select * from ".$prefix."_authors", $dbi),$dbi);
    if ($first == 0) {
	$pwd = md5($pwd);
	$the_adm = "God";
	$result = sql_query("insert into ".$prefix."_authors values ('$name', '$the_adm', '$url', '$email', '$pwd', 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1, '')", $dbi);
	if ($user == 1) {
	    $user_regdate = date("M d, Y");
	    $user_avatar = "blank.gif";
	    $commentlimit = 4096;
	    $result = sql_query("insert into ".$user_prefix."_users values (NULL,'','$name','$email','','$url','$user_avatar','$user_regdate','','','','','','0','','','','','$pwd',10,'','0','0','0','','0','','$Default_Theme','$commentlimit','0','0','0','0','0','1')", $dbi);
	}
	login();
    }
}

$the_first = sql_num_rows(sql_query("select * from ".$prefix."_authors", $dbi), $dbi);
if ($the_first == 0) {
    if (!$name) {
    include("header.php");
    title("$sitename: "._ADMINISTRATION."");
    OpenTable();
    echo "<center><b>"._NOADMINYET."</b></center><br><br>"
	."<form action=\"admin.php\" method=\"post\">"
	."<table border=\"0\">"
	."<tr><td><b>"._NICKNAME.":</b></td><td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"25\"></td></tr>"
	."<tr><td><b>"._HOMEPAGE.":</b></td><td><input type=\"text\" name=\"url\" size=\"30\" maxlength=\"255\" value=\"http://\"></td></tr>"
	."<tr><td><b>"._EMAIL.":</b></td><td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"255\"></td></tr>"
	."<tr><td><b>"._PASSWORD.":</b></td><td><input type=\"password\" name=\"pwd\" size=\"11\" maxlength=\"10\"></td></tr>"
	."<tr><td colspan=\"2\">"._CREATEUSERDATA."  <input type=\"radio\" name=\"user\" value=\"1\" checked>"._YES."&nbsp;&nbsp;<input type=\"radio\" name=\"user\" value=\"0\">"._NO."</td></tr>"
	."<tr><td><input type=\"hidden\" name=\"fop\" value=\"create_first\">"
	."<input type=\"submit\" value=\""._SUBMIT."\">"
	."</td></tr></table></form>";
    CloseTable();
    include("footer.php");
    }
    switch($fop) {
	case "create_first":
	create_first($name, $url, $email, $pwd, $user);
	break;
    }
    die();
}

require("auth.php");

if(!isset($op)) { $op = "adminMain"; }
$pagetitle = "- "._ADMINMENU."";

/*********************************************************/
/* Login Function                                        */
/*********************************************************/

function login() {
    include ("header.php");
    OpenTable();
    echo "<center><font class=\"title\"><b>"._ADMINLOGIN."</b></font></center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<form action=\"admin.php\" method=\"post\">"
        ."<table border=\"0\">"
	."<tr><td>"._ADMINID."</td>"
	."<td><input type=\"text\" NAME=\"aid\" SIZE=\"20\" MAXLENGTH=\"20\"></td></tr>"
	."<tr><td>"._PASSWORD."</td>"
	."<td><input type=\"password\" NAME=\"pwd\" SIZE=\"20\" MAXLENGTH=\"18\"></td></tr>"
	."<tr><td>"
	."<input type=\"hidden\" NAME=\"op\" value=\"login\">"
	."<input type=\"submit\" VALUE=\""._LOGIN."\">"
	."</td></tr></table>"
	."</form>";
    CloseTable();
    include ("footer.php");
}

function deleteNotice($id, $table, $op_back) {
    global $dbi;
    sql_query("delete from $table WHERE id = $id", $dbi);
    Header("Location: admin.php?op=$op_back");
}

/*********************************************************/
/* Administration Menu Function                          */
/*********************************************************/

function adminmenu($url, $title, $image) {
    global $counter, $admingraphic;
    if ($admingraphic == 1) {
	$img = "<img src=\"images/admin/$image\" border=\"0\" alt=\"\"></a><br>";
	$close = "";
    } else {
	$image = "";
	$close = "</a>";
    }
    echo "<td align=\"center\"><font class=\"content\"><a href=\"$url\">$img<b>$title</b>$close</font></td>";
    if ($counter == 5) {
	echo "</tr><tr>";
	$counter = 0;
    } else {
	$counter++;
    }
}

function GraphicAdmin() {
    global $aid, $admingraphic, $language, $admin, $banners, $prefix, $dbi;
    $result = sql_query("SELECT qid FROM ".$prefix."_queue", $dbi);
    $newsubs = sql_num_rows($result, $dbi);
    $result = sql_query("select radminarticle,radmintopic,radminuser,radminsurvey,radminsection,radminlink,radminephem,radminfaq,radmindownload,radminreviews,radminnewsletter,radminforum,radmincontent,radminency,radminsuper from ".$prefix."_authors where aid='$aid'", $dbi);
    list($radminarticle,$radmintopic,$radminuser,$radminsurvey,$radminsection,$radminlink,$radminephem,$radminfaq,$radmindownload,$radminreviews,$radminnewsletter,$radminforum,$radmincontent,$radminency,$radminsuper) = sql_fetch_array($result, $dbi);
    OpenTable();
    echo "<center><b><a class=\"storycat\" href=\"admin.php\">"._ADMINMENU."</a></b>";
    if ($radminsuper==1) {
        echo"&nbsp;&nbsp;&nbsp;<b><a class=\"storycat\" href=\"admin.php?op=BannersAdmin\">"._BANNERSADMIN."</a></b>";
    }
    echo "<br><br>";
    echo"<table border=\"0\" width=\"100%\" cellspacing=\"1\"><tr>";
    $linksdir = dir("admin/links");
    while($func=$linksdir->read()) {
        if(substr($func, 0, 6) == "links.") {
    	    $menulist .= "$func ";
	}
    }
    closedir($linksdir->handle);
    $menulist = explode(" ", $menulist);
    sort($menulist);
    for ($i=0; $i < sizeof($menulist); $i++) {
	if($menulist[$i]!="") {
	    $counter = 0;
	    include($linksdir->path."/$menulist[$i]");
	}
    }
    adminmenu("admin.php?op=logout", ""._ADMINLOGOUT."", "exit.gif");
    echo"</tr></table></center>";
    CloseTable();
    echo "<br>";
}

/*********************************************************/
/* Administration Main Function                          */
/*********************************************************/

function adminMain() {
    global $language, $admin, $aid, $prefix, $file, $dbi, $sitename;
    include ("header.php");
    $dummy = 0;
    GraphicAdmin();
    $result2 = sql_query("select radminarticle, radminsuper, admlanguage from ".$prefix."_authors where aid='$aid'", $dbi);
    list($radminarticle, $radminsuper, $admlanguage) = sql_fetch_row($result2, $dbi);
    if ($admlanguage != "" ) {
	$queryalang = "WHERE alanguage='$admlanguage' ";
    } else {
	$queryalang = "";
    }
    $main_m = sql_query("select main_module from ".$prefix."_main", $dbi);
    list($main_module) = sql_fetch_row($main_m, $dbi);
    OpenTable();
    echo "<center><b>$sitename: "._DEFHOMEMODULE."</b><br><br>"
	.""._MODULEINHOME." <b>$main_module</b><br>[ <a href=\"admin.php?op=modules\">"._CHANGE."</a> ]</center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    $result = sql_query("SELECT username FROM ".$prefix."_session where guest=1", $dbi);
    $guest_online_num = sql_num_rows($result, $dbi);
    $result = sql_query("SELECT username FROM ".$prefix."_session where guest=0", $dbi);
    $member_online_num = sql_num_rows($result, $dbi);
    $who_online_num = $guest_online_num + $member_online_num;
    $who_online = "<center><font class=\"option\">"._WHOSONLINE."</font><br><br><font class=\"content\">"._CURRENTLY." $guest_online_num "._GUESTS." $member_online_num "._MEMBERS."<br>";
    echo "<center>$who_online</center>";
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><b>"._AUTOMATEDARTICLES."</b></center><br>";
    $count = 0;
    $result = sql_query("select anid, aid, title, time, alanguage from ".$prefix."_autonews $queryalang order by time ASC", $dbi);
    while(list($anid, $said, $title, $time, $alanguage) = sql_fetch_row($result, $dbi)) {
	if ($alanguage == "") {
	    $alanguage = ""._ALL."";
	}
	if ($anid != "") {
	    if ($count == 0) {
		echo "<table border=\"1\" width=\"100%\">";
		$count = 1;
	    }
	    $time = ereg_replace(" ", "@", $time);
	    if (($radminarticle==1) OR ($radminsuper==1)) {
		if (($radminarticle==1) AND ($aid == $said) OR ($radminsuper==1)) {
    		    echo "<tr><td nowrap>&nbsp;(<a href=\"admin.php?op=autoEdit&amp;anid=$anid\">"._EDIT."</a>-<a href=\"admin.php?op=autoDelete&amp;anid=$anid\">"._DELETE."</a>)&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
		} else {
		    echo "<tr><td>&nbsp;("._NOFUNCTIONS.")&nbsp;</td><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
		}
	    } else {
		echo "<tr><td width=\"100%\">&nbsp;$title&nbsp;</td><td align=\"center\">&nbsp;$alanguage&nbsp;</td><td nowrap>&nbsp;$time&nbsp;</td></tr>"; /* Multilingual Code : added column to display language */
	    }
	}
    }
    if (($anid == "") AND ($count == 0)) {
	echo "<center><i>"._NOAUTOARTICLES."</i></center>";
    }
    if ($count == 1) {
        echo "</table>";
    }
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><b>"._LAST." 20 "._ARTICLES."</b></center><br>";
    $result = sql_query("select sid, aid, title, time, topic, informant, alanguage from ".$prefix."_stories $queryalang order by time desc limit 0,20", $dbi);
    echo "<center><table border=\"1\" width=\"100%\" bgcolor=\"$bgcolor1\">";
    while(list($sid, $said, $title, $time, $topic, $informant, $alanguage) = sql_fetch_row($result, $dbi)) {
	$ta = sql_query("select topicname from ".$prefix."_topics where topicid=$topic", $dbi);
	list($topicname) = sql_fetch_row($ta, $dbi);
	if ($alanguage == "") {
	    $alanguage = ""._ALL."";
	}
	formatTimestamp($time);
	echo "<tr><td align=\"right\"><b>$sid</b>"
	    ."</td><td align=\"left\" width=\"100%\"><a href=\"modules.php?name=News&file=article&sid=$sid\">$title</a>"
	    ."</td><td align=\"center\">$alanguage"
	    ."</td><td align=\"right\">$topicname";
	if (($radminarticle==1) OR ($radminsuper==1)) {
	    if (($radminarticle==1) AND ($aid == $said) OR ($radminsuper==1)) {
		echo "</td><td align=\"right\" nowrap>(<a href=\"admin.php?op=EditStory&sid=$sid\">"._EDIT."</a>-<a href=\"admin.php?op=RemoveStory&sid=$sid\">"._DELETE."</a>)"
		    ."</td></tr>";
	    } else {
		echo "</td><td align=\"right\" nowrap><font class=\"content\"><i>("._NOFUNCTIONS.")</i></font>"
		    ."</td></tr>";
	    }
	} else {
	    echo "</td></tr>";
	}
    }
    echo "</table>";
    if (($radminarticle==1) OR ($radminsuper==1)) {
	echo "<center>"
	    ."<form action=\"admin.php\" method=\"post\">"
	    .""._STORYID.": <input type=\"text\" NAME=\"sid\" SIZE=\"10\">"
	    ."<select name=\"op\">"
	    ."<option value=\"EditStory\" SELECTED>"._EDIT."</option>"
	    ."<option value=\"RemoveStory\">"._DELETE."</option>"
	    ."</select>"
	    ."<input type=\"submit\" value=\""._GO."\">"
	    ."</form></center>";
    }
    CloseTable();
    $result = sql_query("SELECT pollID, pollTitle FROM ".$prefix."_poll_desc WHERE artid='0' ORDER BY pollID DESC limit 1", $dbi);
    $object = sql_fetch_object($result, $dbi);
    $pollID = $object->pollID;
    $pollTitle = $object->pollTitle;
    echo "<br>";
    OpenTable();
    echo "<center><b>"._CURRENTPOLL.":</b> $pollTitle [ <a href=\"admin.php?op=polledit&pollID=$pollID\">"._EDIT."</a> | <a href=\"admin.php?op=create\">"._ADD."</a> ]</center>";
    CloseTable();
    include ("footer.php");
}

if($admintest) {

    switch($op) {

	case "deleteNotice":
	deleteNotice($id, $table, $op_back);
	break;

	case "GraphicAdmin":
        GraphicAdmin();
        break;

	case "adminMain":
	adminMain();
	break;

	case "logout":
	setcookie("admin");
	include("header.php");
	OpenTable();
	echo "<center><font class=\"title\"><b>"._YOUARELOGGEDOUT."</b></font></center>";
	CloseTable();
	include("footer.php");
	break;

	case "login";
	unset($op);

	default:
	$casedir = dir("admin/case");
	while($func=$casedir->read()) {
	    if(substr($func, 0, 5) == "case.") {
		include($casedir->path."/$func");
	    }
	}
	closedir($casedir->handle);
	break;

	}

} else {

    login();

}

?>