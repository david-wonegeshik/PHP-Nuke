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

//$pagetitle = "- "._TOP."";
include("header.php");

if ($multilingual == 1) {
    $queryalang = "WHERE (alanguage='$currentlang' OR alanguage='')"; /* top stories */
    $querya1lang = "WHERE (alanguage='$currentlang' OR alanguage='') AND"; /* top stories */
    $queryslang = "WHERE slanguage='$currentlang' "; /* top section articles */
    $queryplang = "WHERE planguage='$currentlang' "; /* top polls */
    $queryrlang = "WHERE rlanguage='$currentlang' "; /* top reviews */
} else {
    $queryalang = "";
    $querya1lang = "WHERE";
    $queryslang = "";
    $queryplang = "";
    $queryrlang = "";
}

OpenTable();
echo "<center><font class=\"title\"><b>"._TOPWELCOME." $sitename!</b></font></center>";
CloseTable();
echo "<br>\n\n";
OpenTable();

/* Top 10 read stories */

$result = sql_query("select sid, title, counter from ".$prefix."_stories $queryalang order by counter DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
        ."<font class=\"option\"><b>$top "._READSTORIES."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($sid, $title, $counter) = sql_fetch_row($result, $dbi)) {
        if($counter>0) {
    	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a> - ($counter "._READS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 most voted stories */

$result = sql_query("select sid, title, ratings from ".$prefix."_stories $querya1lang score!=0 order by ratings DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
        ."<font class=\"option\"><b>$top "._MOSTVOTEDSTORIES."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($sid, $title, $ratings) = sql_fetch_row($result, $dbi)) {
        if($ratings>0) {
    	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a> - ($ratings "._LVOTES.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 best rated stories */

$result = sql_query("select sid, title, score, ratings from ".$prefix."_stories $querya1lang score!=0 order by ratings+score DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
        ."<font class=\"option\"><b>$top "._BESTRATEDSTORIES."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($sid, $title, $score, $ratings) = sql_fetch_row($result, $dbi)) {
        if($score>0) {
	    $rate = substr($score / $ratings, 0, 4);
    	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a> - ($rate "._POINTS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 commented stories */

$result = sql_query("select sid, title, comments from ".$prefix."_stories $queryalang order by comments DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._COMMENTEDSTORIES."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($sid, $title, $comments) = sql_fetch_row($result, $dbi)) {
	if($comments>0) {
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=News&amp;file=article&amp;sid=$sid\">$title</a> - ($comments "._COMMENTS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 categories */

$result = sql_query("select catid, title, counter from ".$prefix."_stories_cat order by counter DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._ACTIVECAT."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($catid, $title, $counter) = sql_fetch_row($result, $dbi)) {
	if($counter>0) {
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=News&amp;file=categories&amp;op=newindex&amp;catid=$catid\">$title</a> - ($counter "._HITS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 articles in special sections */

$result = sql_query("select artid, secid, title, content, counter from ".$prefix."_seccont $queryslang order by counter DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._READSECTION."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($artid, $secid, $title, $content, $counter) = sql_fetch_row($result, $dbi)) {
        echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Sections&amp;op=viewarticle&amp;artid=$artid\">$title</a> - ($counter "._READS.")<br>\n";
	$lugar++;
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 users submitters */

$result = sql_query("select uname, counter from ".$user_prefix."_users where counter > '0' order by counter DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._NEWSSUBMITTERS."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($uname, $counter) = sql_fetch_row($result, $dbi)) {
	if($counter>0) {
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Your_Account&amp;op=userinfo&amp;uname=$uname\">$uname</a> - ($counter "._NEWSSENT.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 Polls */

$result = sql_query("select * from ".$prefix."_poll_desc $queryplang", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._VOTEDPOLLS."</b></font><br><br><font class=\"content\">\n";
    $lugar = 1;
    $result = sql_query("SELECT pollID, pollTitle, timeStamp, voters FROM ".$prefix."_poll_desc $querylang order by voters DESC limit 0,$top", $dbi);
    $counter = 0;
    while($object = sql_fetch_object($result, $dbi)) {
	$resultArray[$counter] = array($object->pollID, $object->pollTitle, $object->timeStamp, $object->voters);
	$counter++;
    }
    for ($count = 0; $count < count($resultArray); $count++) {
	$id = $resultArray[$count][0];
	$pollTitle = $resultArray[$count][1];
	$voters = $resultArray[$count][3];
	for($i = 0; $i < 12; $i++) {
	    $result = sql_query("SELECT optionCount FROM ".$prefix."_poll_data WHERE (pollID=$id) AND (voteID=$i)", $dbi);
	    $object = sql_fetch_object($result, $dbi);
	    $optionCount = $object->optionCount;
	    $sum = (int)$sum+$optionCount;
	}
	echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Surveys&amp;pollID=$id\">$pollTitle</a> - ($sum "._LVOTES.")<br>\n";
	$lugar++;
	$sum = 0;
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 authors */

$result = sql_query("select aid, counter from ".$prefix."_authors order by counter DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._MOSTACTIVEAUTHORS."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($aid, $counter) = sql_fetch_row($result, $dbi)) {
	if($counter>0) {
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Search&amp;query=&amp;author=$aid\">$aid</a> - ($counter "._NEWSPUBLISHED.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 reviews */

$result = sql_query("select id, title, hits from ".$prefix."_reviews $queryrlang order by hits DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._READREVIEWS."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($id, $title, $hits) = sql_fetch_row($result, $dbi)) {
	if($hits>0) {
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Reviews&amp;op=showcontent&amp;id=$id\">$title</a> - ($hits "._READS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table><br>\n";
}

/* Top 10 downloads */

$result = sql_query("select lid, cid, title, hits from ".$prefix."_downloads_downloads order by hits DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._DOWNLOADEDFILES."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($lid, $cid, $title, $hits) = sql_fetch_row($result, $dbi)) {
	if($hits>0) {
	    $res = sql_query("select title from ".$prefix."_downloads_categories where cid='$cid'", $dbi);
	    list($ctitle) = sql_fetch_row($res, $dbi);
	    $utitle = ereg_replace(" ", "_", $title);
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Downloads&amp;d_op=viewdownloaddetails&amp;lid=$lid&amp;ttitle=$utitle\">$title</a> ("._CATEGORY.": $ctitle) - ($hits "._LDOWNLOADS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table>\n\n";
}

/* Top 10 Pages in Content */

$result = sql_query("select pid, title, counter from ".$prefix."_pages where active='1' order by counter DESC limit 0,$top", $dbi);
if (sql_num_rows($result, $dbi)>0) {
    echo "<table border=\"0\" cellpadding=\"10\" width=\"100%\"><tr><td align=\"left\">\n"
	."<font class=\"option\"><b>$top "._MOSTREADPAGES."</b></font><br><br><font class=\"content\">\n";
    $lugar=1;
    while(list($pid, $title, $counter) = sql_fetch_row($result, $dbi)) {
	if($counter>0) {
	    echo "<strong><big>&middot;</big></strong>&nbsp;$lugar: <a href=\"modules.php?name=Content&amp;pa=showpage&amp;pid=$pid\">$title</a> ($counter "._READS.")<br>\n";
	    $lugar++;
	}
    }
    echo "</font></td></tr></table>\n\n";
}

CloseTable();
include("footer.php");

?>