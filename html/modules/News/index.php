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

$index = 1;
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function theindex($new_topic=0) {
    global $dbi, $storyhome, $topicname, $topicimage, $topictext, $datetime, $user, $cookie, $nukeurl, $prefix, $multilingual, $currentlang, $articlecomm, $sitename;
    if ($multilingual == 1) {
	$querylang = "AND (alanguage='$currentlang' OR alanguage='')";
    } else {
	$querylang = "";
    }
    include("header.php");
    automated_news();
    if (isset($cookie[3])) {
	$storynum = $cookie[3];
    } else {
	$storynum = $storyhome;
    }
    if ($new_topic == 0) {
	$qdb = "WHERE (ihome='0' OR catid='0')";
	$home_msg = "";
    } else {
	$qdb = "WHERE topic='$new_topic'";
	$res = sql_query("select topictext from ".$prefix."_topics where topicid='$new_topic'", $dbi);
	list($topic_title) = sql_fetch_row($res, $dbi);
	OpenTable();
	if (sql_num_rows($res, $dbi) == 0) {
	    echo "<center><font class=\"title\">$sitename</font><br><br>"._NOINFO4TOPIC."<br><br>[ <a href=\"modules.php?name=News\">"._GOTONEWSINDEX."</a> | <a href=\"modules.php?name=Topics\">"._SELECTNEWTOPIC."</a> ]</center>";
	} else {
	    echo "<center><font class=\"title\">$sitename: $topic_title</font><br><br>"
		."<form action=\"modules.php?name=Search\" method=\"post\">"
		."<input type=\"hidden\" name=\"topic\" value=\"$new_topic\">"
		.""._SEARCHONTOPIC.": <input type=\"name\" name=\"query\" size=\"30\">&nbsp;&nbsp;"
		."<input type=\"submit\" value=\""._SEARCH."\">"
		."</form>"
		."[ <a href=\"index.php\">"._GOTOHOME."</a> | <a href=\"modules.php?name=Topics\">"._SELECTNEWTOPIC."</a> ]</center>";
	}
	CloseTable();
	echo "<br>";
    }
    $result = sql_query("SELECT sid, catid, aid, title, time, hometext, bodytext, comments, counter, topic, informant, notes, acomm, score, ratings FROM ".$prefix."_stories $qdb $querylang ORDER BY sid DESC limit $storynum", $dbi);
    while (list($s_sid, $catid, $aid, $title, $time, $hometext, $bodytext, $comments, $counter, $topic, $informant, $notes, $acomm, $score, $ratings) = sql_fetch_row($result, $dbi)) {
	if ($catid > 0) {
	    list($cattitle) = sql_fetch_row(sql_query("select title from ".$prefix."_stories_cat where catid='$catid'", $dbi), $dbi);
	}
	getTopics($s_sid);
	formatTimestamp($time);
	$subject = stripslashes($subject);
	$hometext = stripslashes($hometext);
	$notes = stripslashes($notes);
	$introcount = strlen($hometext);
	$fullcount = strlen($bodytext);
	$totalcount = $introcount + $fullcount;
	$c_count = $comments;
	$r_options = "";
        if (isset($cookie[4])) { $r_options .= "&amp;mode=$cookie[4]"; }
        if (isset($cookie[5])) { $r_options .= "&amp;order=$cookie[5]"; }
        if (isset($cookie[6])) { $r_options .= "&amp;thold=$cookie[6]"; }
	if (is_user($user)) {
	    $the_icons = " | <a href=\"modules.php?name=News&amp;file=print&amp;sid=$s_sid\"><img src=\"images/print.gif\" border=\"0\" Alt=\""._PRINTER."\" width=\"16\" height=\"11\"></a>&nbsp;&nbsp;<a href=\"modules.php?name=News&amp;file=friend&amp;op=FriendSend&amp;sid=$s_sid\"><img src=\"images/friend.gif\" border=\"0\" Alt=\""._FRIEND."\" width=\"16\" height=\"11\"></a>";
	} else {
	    $the_icons = "";
	}
	$story_link = "<a href=\"modules.php?name=News&amp;file=article&amp;sid=$s_sid$r_options\">";
	$morelink = "(";
	if (($fullcount > 0) OR ($c_count > 0)) {
	    $morelink .= "$story_link<b>"._READMORE."</b></a> | ";
	} else {
	    $morelink .= "";
	}
	if ($fullcount > 0) { $morelink .= "$totalcount "._BYTESMORE." | "; }
	if ($articlecomm == 1 AND $acomm == 0) {
	    if ($c_count == 0) { $morelink .= "$story_link"._COMMENTSQ."</a>"; } elseif ($c_count == 1) { $morelink .= "$story_link$c_count "._COMMENT."</a>"; } elseif ($c_count > 1) { $morelink .= "$story_link$c_count "._COMMENTS."</a>"; }
	}
	if ($fullcount == 0 AND $acomm == 1) {
	    $morelink .= "$story_link<b>"._READMORE."</b></a>";
	    if (!is_user($user)) {
		$morelink .= " | ";
	    }
	}
	$morelink .= "$the_icons";
	$sid = $s_sid;
	if ($catid != 0) {
	    $resultm = sql_query("select title from ".$prefix."_stories_cat where catid='$catid'", $dbi);
	    list($title1) = sql_fetch_row($resultm, $dbi);
	    $title = "<a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\"><font class=\"storycat\">$title1</font></a>: $title";
	    $morelink .= " | <a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\">$title1</a>";
	}
	if ($score != 0) {
	    $rated = substr($score / $ratings, 0, 4);
	} else {
	    $rated = 0;
	}
	$morelink .= " | "._SCORE." $rated";
	$morelink .= ")";
	$morelink = str_replace(" |  | ", " | ", $morelink);
	themeindex($aid, $informant, $datetime, $title, $counter, $topic, $hometext, $notes, $morelink, $topicname, $topicimage, $topictext);
    }
    include("footer.php");
}

function rate_article($sid, $score) {
    global $prefix, $dbi, $ratecookie, $sitename, $r_options;
    if ($score) {
	if (isset($ratecookie)) {
	    $rcookie = base64_decode($ratecookie);
	    $r_cookie = explode(":", $rcookie);
	}
	for ($i=0; $i < sizeof($r_cookie); $i++) {
	    if ($r_cookie[$i] == $sid) {
		$a = 1;
	    }
	}
	if ($a == 1) {
	    Header("Location: modules.php?name=News&op=rate_complete&sid=$sid&rated=1");
	} else {
	    $result = sql_query("update ".$prefix."_stories set score=score+$score, ratings=ratings+1 where sid='$sid'", $dbi);
	    $info = base64_encode("$rcookie$sid:");
	    setcookie("ratecookie","$info",time()+3600);
	    Header("Location: modules.php?name=News&op=rate_complete&sid=$sid$r_options");
	}
    } else {
	include("header.php");
	title("$sitename: "._ARTICLERATING."");
	OpenTable();
	echo "<center>"._DIDNTRATE."<br><br>"
	    .""._GOBACK."</center>";
	CloseTable();
	include("footer.php");
    }
}

function rate_complete($sid, $rated=0) {
    global $sitename, $r_options;
    include("header.php");
    title("$sitename: "._ARTICLERATING."");
    OpenTable();
    if ($rated == 0) {
	echo "<center>"._THANKSVOTEARTICLE."<br><br>"
	    ."[ <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">"._BACKTOARTICLEPAGE."</a> ]</center>";
    } elseif ($rated == 1) {
	echo "<center>"._ALREADYVOTEDARTICLE."<br><br>"
	    ."[ <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid$r_options\">"._BACKTOARTICLEPAGE."</a> ]</center>";
    }
    CloseTable();
    include("footer.php");
}

switch ($op) {

    default:
    theindex($new_topic);
    break;

    case "rate_article":
    rate_article($sid, $score);
    break;

    case "rate_complete":
    rate_complete($sid, $rated);
    break;

}

?>