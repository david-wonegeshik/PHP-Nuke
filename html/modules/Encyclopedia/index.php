<?php

######################################################################
# PHP-NUKE: Web Portal System
# ===========================
#
# Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)
# http://phpnuke.org
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

function encysearch($eid) {
    global $module_name;
    echo "<center><form action=\"modules.php?name=$module_name&file=search\" method=\"post\">"
	."<input type=\"text\" size=\"20\" name=\"query\">&nbsp;&nbsp;"
	."<input type=\"hidden\" name=\"eid\" value=\"$eid\">"
	."<input type=\"submit\" value=\""._SEARCH."\">"
	."</form>"
	."</center>";
}

function alpha($eid) {
    global $module_name, $prefix, $dbi;
    echo "<center>"._ENCYSELECTLETTER."</center><br><br>";
    $alphabet = array ("A","B","C","D","E","F","G","H","I","J","K","L","M",
                       "N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $num = count($alphabet) - 1;
    echo "<center>[ ";
    $counter = 0;
    while (list(, $ltr) = each($alphabet)) {
	$result = sql_query("select * from ".$prefix."_encyclopedia_text where eid='$eid' AND UPPER(title) LIKE '$ltr%'", $dbi);
	if (sql_num_rows($result) > 0) {
	    echo "<a href=\"modules.php?name=$module_name&op=terms&eid=$eid&ltr=$ltr\">$ltr</a>";
	} else {
	    echo "$ltr";
	}
        if ( $counter == round($num/2) ) {
            echo " ]\n<br>\n[ ";
        } elseif ( $counter != $num ) {
            echo "&nbsp;|&nbsp;\n";
        }
        $counter++;
    }
    echo " ]</center><br><br>\n\n\n";
    encysearch($eid);
    echo "<center>"._GOBACK."</center>";
}

function list_content($eid) {
    global $module_name, $prefix, $sitename, $dbi;
    $result = sql_query("select title, description from ".$prefix."_encyclopedia where eid='$eid'", $dbi);
    list($title, $description) = sql_fetch_row($result, $dbi);
    include("header.php");
    title("$title");
    OpenTable();
    echo "<center><b>$title</b></center><br>"
	."<p align=\"justify\">$description</p>";
    CloseTable();
    echo "<br>";
    OpenTable();
    alpha($eid);
    CloseTable();
    echo "<br>";
    OpenTable();
    echo "<center><font class=\"tiny\">"._COPYRIGHT."</font></center>";
    CloseTable();
    include("footer.php");
}

function terms($eid, $ltr) {
    global $module_name, $prefix, $sitename, $dbi, $admin;
    $result = sql_query("select active from ".$prefix."_encyclopedia where eid='$eid'", $dbi);
    list($active) = sql_fetch_row($result, $dbi);
    $result = sql_query("select title from ".$prefix."_encyclopedia where eid='$eid'", $dbi);
    list($title) = sql_fetch_row($result, $dbi);
    include("header.php");
    title("$title");
    OpenTable();
    if (($active == 1) OR (is_admin($admin))) {
	if (($active != 1) AND (is_admin($admin))) {
	    echo "<center>"._YOURADMINENCY."</center><br><br>";
	}
	echo "<center>Please select one term from the following list:</center><br><br>"
	    ."<table border=\"0\" align=\"center\">";
	$result = sql_query("select tid, title from ".$prefix."_encyclopedia_text WHERE UPPER(title) LIKE '$ltr%' AND eid='$eid'", $dbi);
	if (sql_num_rows($result, $dbi) == 0) {
	    echo "<center><i>"._NOCONTENTFORLETTER." $ltr.</i></center>";
	}
	while(list($tid, $title) = sql_fetch_row($result, $dbi)) {
	    echo "<tr><td><a href=\"modules.php?name=$module_name&op=content&tid=$tid\">$title</a></td></tr>";
	}
	echo "</table><br><br>";
	alpha($eid);
    } else {
	echo "<center>"._ENCYNOTACTIVE."<br><br>"
	    .""._GOBACK."</center>";
    }
    CloseTable();
    include("footer.php");
}

function content($tid, $ltr, $page=0, $query="") {
    global $prefix, $dbi, $sitename, $admin, $module_name;
    include("header.php");
    OpenTable();
    $result = sql_query("SELECT * from ".$prefix."_encyclopedia_text where tid='$tid'", $dbi);
    $ency = sql_fetch_array($result, $dbi);
    $result = sql_query("select active from ".$prefix."_encyclopedia where eid='$ency[eid]'", $dbi);
    list($active) = sql_fetch_row($result, $dbi);
    if (($active == 1) OR ($active == 0 AND is_admin($admin))) {
	sql_query("update ".$prefix."_encyclopedia_text set counter=counter+1 where tid='$tid'", $dbi);
	$result = sql_query("SELECT title from ".$prefix."_encyclopedia where eid='$ency[eid]'", $dbi);
	list($enc_title) = sql_fetch_row($result, $dbi);
	echo "<font class=\"title\">$ency[title]</font><br><br><br>";
	$contentpages = explode( "<!--pagebreak-->", $ency[text] );
	$pageno = count($contentpages);
	if ( $page=="" || $page < 1 )
	    $page = 1;
	if ( $page > $pageno )
	    $page = $pageno;
	$arrayelement = (int)$page;
	$arrayelement --;
	if ($pageno > 1) {
	    echo ""._PAGE.": $page/$pageno<br>";
	}
	if (isset($query)) {
	    $contentpages[$arrayelement] = eregi_replace($query,"<b>$query</b>",$contentpages[$arrayelement]);
	    $fromsearch = "&query=$query";
	} else {
	    $fromsearch = "";
	}
	echo "<p align=\"justify\">".nl2br($contentpages[$arrayelement])."</p>";
	if($page >= $pageno) {
	    $next_page = "";
	} else {
	    $next_pagenumber = $page + 1;
	    if ($page != 1) {
		$next_page .= "- ";
	    }
	    $next_page .= "<a href=\"modules.php?name=$module_name&op=content&tid=$tid&page=$next_pagenumber$fromsearch\">"._NEXT." ($next_pagenumber/$pageno)</a> <a href=\"modules.php?name=$module_name&op=content&tid=$tid&page=$next_pagenumber\"><img src=\"images/download/right.gif\" border=\"0\" alt=\""._NEXT."\"></a>";
	}
	if($page <= 1) {
	    $previous_page = "";
	} else {
	    $previous_pagenumber = $page - 1;
	    $previous_page = "<a href=\"modules.php?name=$module_name&op=content&tid=$tid&page=$previous_pagenumber$fromsearch\"><img src=\"images/download/left.gif\" border=\"0\" alt=\""._PREVIOUS."\"></a> <a href=\"modules.php?name=$module_name&op=content&tid=$tid&page=$previous_pagenumber$fromsearch\">"._PREVIOUS." ($previous_pagenumber/$pageno)</a>";
	}
	echo "<br><br><br><center>$previous_page $next_page<br><br>"
	    .""._GOBACK."</center><br>";
	if (is_admin($admin)) {
	    echo "<p align=\"right\">[ <a href=\"admin.php?op=encyclopedia_text_edit&tid=$ency[tid]\">"._EDIT."</a> ]</p>";
	}
	echo "<p align=\"right\"><a href=\"modules.php?name=$module_name&op=list_content&eid=$ency[eid]\">$enc_title</a></p>";
	if ($page == $pageno) {
	    echo "<p align=\"right\">Copyright &copy; by $sitename - ($ency[counter] Reads)</font></p>";
	}
    } else {
	echo "Sorry, This page isn't active...";
    }
    CloseTable();
    include("footer.php");
}

function list_themes() {
    global $prefix, $dbi, $sitename, $admin, $multilingual, $module_name;
    include("header.php");
    title("$sitename: "._ENCYCLOPEDIA."");
    OpenTable();
    echo "<center><font class=\"content\">"._AVAILABLEENCYLIST." $sitename:</center><br><br>";
    $result = sql_query("SELECT eid, title, description, elanguage from ".$prefix."_encyclopedia WHERE active='1'", $dbi);
    echo "<blockquote>";
    while(list($eid, $title, $description, $elanguage) = sql_fetch_row($result, $dbi)) {
	if ($multilingual == 1) {
	    $the_lang = "<img src=\"images/language/flag-$elanguage.png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
	} else {
	    $the_lang = "";
	}
        if ($subtitle != "") {
	    $subtitle = "<br>($description)<br><br>";
	} else {
    	    $subtitle = "";
	}
	if (is_admin($admin)) {
	    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br>$description<br>[ <a href=\"admin.php?op=encyclopedia_edit&eid=$eid\">"._EDIT."</a> | <a href=\"admin.php?op=encyclopedia_change_status&eid=$eid&active=1\">"._DEACTIVATE."</a> | <a href=\"admin.php?op=encyclopedia_delete&eid=$eid\">"._DELETE."</a> ]<br><br>";
	} else {
	    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=list_content&amp;eid=$eid\">$title</a><br> $description<br><br>";
	}
    }
    echo "</blockquote>";
    if (is_admin($admin)) {
	$result = sql_query("SELECT eid, title, description, elanguage from ".$prefix."_encyclopedia WHERE active='0'", $dbi);
	echo "<br><br><center><b>"._YOURADMININACTIVELIST."</b></center><br><br>";
	echo "<blockquote>";
	while(list($eid, $title, $description, $elanguage) = sql_fetch_row($result, $dbi)) {
	    if ($multilingual == 1) {
		$the_lang = "<img src=\"images/language/flag-$elanguage.png\" hspace=\"3\" border=\"0\" height=\"10\" width=\"20\">";
	    } else {
		$the_lang = "";
	    }
    	    if ($subtitle != "") {
	        $subtitle = " ($subtitle) ";
	    } else {
    	        $subtitle = " ";
	    }
	    echo "<strong><big>&middot;</big></strong> $the_lang <a href=\"modules.php?name=$module_name&amp;op=content&amp;eid=$eid\">$title</a><br>$description<br>[ <a href=\"admin.php?op=encyclopedia_edit&eid=$eid\">"._EDIT."</a> | <a href=\"admin.php?op=encyclopedia_change_status&eid=$eid&active=0\">"._ACTIVATE."</a> | <a href=\"admin.php?op=encyclopedia_delete&eid=$eid\">"._DELETE."</a> ]<br><br>";
	}
	echo "</blockquote>";
    }
    CloseTable();
    include("footer.php");
}

switch($op) {

    case "content":
    content($tid, $ltr, $page, $query);
    break;

    case "list_content":
    list_content($eid);
    break;

    case "terms":
    terms($eid, $ltr);
    break;

    case "search":
    search($query, $eid);
    break;

    default:
    list_themes();
    break;

}

?>