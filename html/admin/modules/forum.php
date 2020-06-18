<?php

######################################################################
# PHP-NUKE: Web Portal System
# ===========================
#
# Copyright (c) 2002 by Francisco Burzi (fbc@mandrakesoft.com)
# http://phpnuke.org
#
# Based on phpBB Forum
# ====================
# Copyright (c) 2001 by The phpBB Group
# http://www.phpbb.com
#
# Integration based on PHPBB Forum Addon 1.4.0
# ============================================
# Copyright (c) 2001 by Richard Tirtadji and Roberto Buonanno
# http://nukeaddon.com
#
# This program is free software. You can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License.
######################################################################

if (!eregi("admin.php", $PHP_SELF)) { die ("Access Denied"); }
$result = sql_query("select radminforum, radminsuper from ".$prefix."_authors where aid='$aid'", $dbi);
list($radminforum, $radminsuper) = sql_fetch_row($result, $dbi);
if (($radminforum==1) OR ($radminsuper==1)) {

/*********************************************************/
/* PHPBB Forum Admin Function                            */
/*********************************************************/

function ForumMainMenu() {
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
    echo "<center><font class=\"content\"><b>"._BBSELECTACTION."</b></font><br><br>"
	."[ <a href=\"admin.php?op=ForumAdmin\">"._FORUMMANAGER."</a> | "
	."<a href=\"admin.php?op=RankForumAdmin\">"._FORUMRANKS."</a> | "
	."<a href=\"admin.php?op=ForumConfigAdmin\">"._FORUMCONFIG."</a> | "
	."<a href=\"admin.php?op=ForumManager\">"._BBAFORUMICONS."</a> | "
	."<a href=\"admin.php?op=ForumCensorAdmin\">"._BBAFORUMCEN."</a> | "
	."<a href=\"admin.php?op=ForumBanAdmin\">"._BBAFORUMBAN."</a> ]</center>";
    CloseTable();
    include("footer.php");
}

function ForumAdmin() {
    global $admin, $bgcolor2, $bgcolor2, $textcolor2, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
        echo "
    <center><font size=\"4\"><b>"._BBAFCAT."</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <center><table border=\"1\" width=\"100%\"><tr>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAORDER."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBACAT."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBANOOFF."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAORDER."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFUNC."</b></td></tr>";

    $result = mysql_query("select cat_id, cat_order, cat_title from ".$prefix."_catagories order by cat_order");
    while(list($cat_id, $cat_order, $cat_title) = mysql_fetch_row($result)) {
    $gets = mysql_query("select count(*) as total from ".$prefix."_forums where cat_id=$cat_id");
        $numbers= mysql_fetch_array($gets);
        $cat_title = stripslashes($cat_title);
    echo "
        <td align=\"center\">$cat_order</td>
        <td align=\"center\">$cat_title</td>
        <td align=\"center\">$numbers[total]</td>
        <td align=\"center\"><a href=\"admin.php?op=ForumCatOrder&cat_id=$cat_id&cat_order=$cat_order&lastid=$lastid&changes=up\"><img src=\"images/up.gif\" border=\"0\" alt=\""._BBAAUP."\"></a>&nbsp;<a href=\"admin.php?op=ForumCatOrder&cat_id=$cat_id&cat_order=$cat_order&lastid=$lastid&changes=down\"><img src=\"images/down.gif\" border=\"0\" alt=\""._BBAADOWN."\"></a></td>
        <td align=\"center\">[ <a href=\"admin.php?op=ForumGo&cat_id=$cat_id&ctg=$cat_title\">"._BBAEDITF."</a> | <a href=\"admin.php?op=ForumCatEdit&cat_id=$cat_id\">"._BBAEDIT."</a> | <a href=\"admin.php?op=ForumCatDel&cat_id=$cat_id&ok=0\">"._BBADELETE."</a> ]</td><tr>";
    $lastid = $cat_id;
    }
    echo "</form></td></tr></table>
    <br><br>
    </center><font size=\"4\"><b>"._BBAADDCAT."</b><br><br>
    <font size=\"2\">
    <form action=\"admin.php\" method=\"post\">
    <table border=\"0\" width=\"100%\"><tr><td>
    "._BBACAT." </td><td><input type=\"text\" name=\"catagories\" size=\"31\"></td></tr><tr><td>
    </td></tr></table>
    <input type=\"hidden\" name=\"op\" value=\"ForumCatAdd\">
    <input type=\"submit\" value=\""._BBAADD."\">
    </form>
    </td></tr></table></td></tr></table>";
    include("footer.php");
}

function ForumCatOrder($cat_id,$cat_order,$lastid,$changes) {
global $prefix, $dbi;

if($changes=="up") {
         if($cat_order != "1") {
            $order = $cat_order - 1;
            $sql1 = "UPDATE ".$prefix."_catagories SET cat_order = $order WHERE cat_id = '$cat_id'";
                    if(!$r = mysql_query($sql1)) {
                              die("Error connecting to the database<BR>".mysql_error($db));
                              }
                    $sql2 = "UPDATE ".$prefix."_catagories SET cat_order = $cat_order WHERE cat_id = '$lastid'";
                    if(!$r = mysql_query($sql2)) {
                              die("Error connecting to the database<BR>".mysql_error($db));
                              }
                    Header("Location: admin.php?op=ForumAdmin");
                } else {
                    include ("header.php");
                        echo "<center>"._BBACATHIGHEST."<br><a href=\"admin.php?op=ForumAdmin\">"._BBABACKTOFORUM."</a></center>";
                    include ("footer.php");
            }
} else {
         $sql = "SELECT cat_order FROM ".$prefix."_catagories ORDER BY cat_order DESC LIMIT 1";
                if(!$r  = mysql_query($sql)) {
                        die("Error quering the database");
                           }
                 list($last_number) = mysql_fetch_array($r);
                 if($last_number != $cat_order) {
                    $order = $cat_order + 1;
                    $sql = "UPDATE ".$prefix."_catagories SET cat_order = $cat_order WHERE cat_order = $order";
                    if(!$r  = mysql_query($sql)) {
                              die("Error quering the database");
                              }
                    $sql = "UPDATE ".$prefix."_catagories SET cat_order = $order where cat_id = $cat_id";
                    if(!$r  = mysql_query($sql)) {
                              die("Error quering the database");
                              }
                    Header("Location: admin.php?op=ForumAdmin");
                } else {
                    include ("header.php");
                        echo "<center>"._BBACATLOWEST."<br><a href=\"admin.php?op=ForumAdmin\">"._BBABACKTOFORUM."</a></center>";
                    include ("footer.php");
            }
}
}

function ForumGo($cat_id,$ctg) {
    global $user_prefix, $bgcolor2, $textcolor2, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAFLISTED." $ctg</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <center><table border=\"1\" width=\"100%\"><tr>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFNAME."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFDESC."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFMOD."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFACC."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBATYPE."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFUNC."</b></td></tr>";

    $result = mysql_query("select forum_id, forum_name, forum_desc, forum_access, forum_moderator, forum_type from ".$prefix."_forums where cat_id='$cat_id'");
    while(list($forum_id, $forum_name, $forum_desc, $forum_access, $forum_moderator, $forum_type) = mysql_fetch_row($result)) {

        echo "<tr>
        <td align=\"center\">$forum_name</td>
        <td align=\"center\">$forum_desc</td>
        <td align=\"center\">";

# Multi Moderator
$count = 0;
        $sql = mysql_query ("SELECT u.uid, u.uname FROM ".$user_prefix."_users u, ".$prefix."_forum_mods f WHERE f.forum_id = '$forum_id' and f.user_id = u.uid");
        while(list($mod_id, $xmod_names) = mysql_fetch_array($sql)) {
                if($count > 0)
                        echo ", ";
                         echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=".trim($xmod_names)."\">".trim($xmod_names)."</a>";
                         $count++;
                      }
        echo "</td>";
        switch($forum_access) {
        case (2):
        echo "<td align=\"center\">"._BBAANONPOST."</td>";
        break;
        case (1):
        echo "<td align=\"center\">"._BBAREGUSER."</td>";
        break;
        case (3):
        echo "<td align=\"center\">"._BBAMODADMIN."</td>";
        break;
        }
        if ($forum_type==0) {
        echo "<td align=\"center\">"._BBAPUBLIC."</td>";
        }
        else {
        echo "<td align=\"center\">"._BBAPRIVATE."<br>";
        echo "<a href=\"admin.php?op=PrivForumUser&forum_id=$forum_id\">"._BBAPRIVSET."</a></td>";
        }
        echo "
        <td align=\"center\"><a href=\"admin.php?op=ForumGoEdit&forum_id=$forum_id\">"._BBAEDIT."</a> | <a href=\"admin.php?op=ForumGoDel&forum_id=$forum_id&ok=0\">"._BBADELETE."</a></td></tr>";
    }
    echo "</form></td></tr></table>
    <br><br>
    </center><font size=\"4\"><b>"._BBAADDMOREF." $ctg</b><br><br>
    <font size=\"2\">
    <form action=\"admin.php\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBAFNAME.": </td><td><input type=\"text\" name=\"forum_name\" size=\"31\"></td></tr>
    <tr><td>"._BBAFDESC.": </td><td><textarea name=\"forum_desc\" cols=\"60\" rows=\"5\"></textarea></td></tr>

    <tr><td>"._BBAFMOD.": </td>

    <td><input type=\"text\" name=\"moderator\" size=\"20\">
    </td>";
    echo "<tr><td>"._BBAACCLEV.": </td>
    <td><SELECT NAME=\"forum_access\">
                <OPTION VALUE=\"2\">"._BBAANONPOST."</OPTION>
                <OPTION VALUE=\"1\">"._BBAREGUSER."</OPTION>
                <OPTION VALUE=\"3\">"._BBAMODADMIN."</OPTION>
        </SELECT>
    </td></tr>
    <tr><td>"._BBATYPE.": </td>
    <td><SELECT NAME=\"forum_type\">
                <OPTION VALUE=\"0\">"._BBAPUBLIC."</OPTION>
                <OPTION VALUE=\"1\">"._BBAPRIVATE."</OPTION>
        </SELECT>
    </td></tr>
    </table>
    <input type=\"hidden\" name=\"cat_id\" value=\"$cat_id\">
    <input type=\"hidden\" name=\"op\" value=\"ForumGoAdd\">
    <input type=\"submit\" value=\""._BBAADD."\">
    </form>
    </td></tr></table></td></tr></table>";
    include("footer.php");
}

function ForumGoEdit($forum_id) {
    global $user_prefix, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    $result = mysql_query("select forum_id, forum_name, forum_desc, forum_access, cat_id, forum_type from ".$prefix."_forums where forum_id='$forum_id'");
    list($forum_id, $forum_name, $forum_desc, $forum_access, $cat_id_1, $forum_type) = mysql_fetch_row($result);
    $forum_name = stripslashes($forum_name);
    $forum_desc = stripslashes($forum_desc);
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAEDIT." $forum_name</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <input type=\"hidden\" name=\"forum_id\" value=\"$forum_id\">
    <table border=\"0\" width=\"100%\"><tr><td>
    <tr><td>"._BBAFNAME.": </td><td><input type=\"text\" name=\"forum_name\" size=\"31\" value=\"$forum_name\"></td></tr>
    <tr><td>"._BBAFDESC.": </td><td><textarea name=\"forum_desc\" cols=\"60\" rows=\"5\">$forum_desc</textarea></td></tr>
    <tr><TD>"._BBACURMOD.":</td><td>";

    $sql = "SELECT u.uname, u.uid FROM ".$user_prefix."_users u, ".$prefix."_forum_mods f WHERE f.forum_id = '$forum_id' AND u.uid = f.user_id";
    if(!$r = mysql_query($sql)) {
	die("Error connecting to the database.");
    }
    if($row = mysql_fetch_array($r)) {
	do {
    	    echo "$row[uname] (<input type=\"checkbox\" name=\"rem_mods[]\" value=\"$row[uid]\"> "._BBAREMOVE.")<BR>";
            $current_mods[] = $row[uid];
        } while($row = mysql_fetch_array($r));
    } else {
	echo ""._BBANOMOD."\n";
    }
    echo "</td><tr><tr><td>"._BBAAMOD.":</td><td><input type=\"text\" name=\"moderator\" size=\"20\"></td></tr>
    <tr><td>"._BBAACCLEV.": </td>
    <td><SELECT NAME=\"forum_access\">";
    if ($forum_access == 2) {
        echo "<OPTION VALUE=\"2\" selected>"._BBAANONPOST."</OPTION>"
	    ."<OPTION VALUE=\"1\">"._BBAREGUSER."</OPTION>"
    	    ."<OPTION VALUE=\"3\">"._BBAMODADMIN."</OPTION>";
    }
    if ($forum_access == 1) {
	echo "<OPTION VALUE=\"2\">"._BBAANONPOST."</OPTION>"
    	    ."<OPTION VALUE=\"1\" selected>"._BBAREGUSER."</OPTION>"
	    ."<OPTION VALUE=\"3\">"._BBAMODADMIN."</OPTION>";
    }
    if ($forum_access == 3) {
        echo "<OPTION VALUE=\"2\">"._BBAANONPOST."</OPTION>"
	    ."<OPTION VALUE=\"1\">"._BBAREGUSER."</OPTION>"
    	    ."<OPTION VALUE=\"3\" selected>"._BBAMODADMIN."</OPTION>";
    }
    echo "</SELECT>
    </td></tr>
    <tr><td>"._BBACHGCAT.": </td>
    <td><SELECT NAME=\"cat_id\">";
    $result = mysql_query("select cat_id, cat_title from ".$prefix."_catagories");
    while(list($cat_id, $cat_title) = mysql_fetch_row($result)) {
        if ($cat_id == $cat_id_1) {
    echo "<OPTION VALUE=\"$cat_id\" selected>$cat_title</OPTION>";
    } else {
    echo "<OPTION VALUE=\"$cat_id\">$cat_title</OPTION>";
    }
    }
    echo "
    </SELECT>
    </td></tr>
    <tr><td>"._BBATYPE.": </td>
    <td><SELECT NAME=\"forum_type\">";
    if ($forum_type == 0) {
        echo "<OPTION VALUE=\"0\" selected>"._BBAPUBLIC."</OPTION>"; }
    if ($forum_type == 1) {
        echo "<OPTION VALUE=\"1\" selected>"._BBAPRIVATE."</OPTION>"; }
        echo "
                <OPTION VALUE=\"0\">"._BBAPUBLIC."</OPTION>
                <OPTION VALUE=\"1\">"._BBAPRIVATE."</OPTION>
        </SELECT>
    </td></tr>
    </table>
    <input type=\"hidden\" name=\"op\" value=\"ForumGoSave\">
    <input type=\"submit\" value=\""._BBASAVECHANGES."\">
    </form>

    </td></tr></table></td></tr></table>";
    include("footer.php");
}

function ForumCatEdit($cat_id) {
    global $admin, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    $result = mysql_query("select cat_id, cat_title from ".$prefix."_catagories where cat_id='$cat_id'");
    list($cat_id, $cat_title) = mysql_fetch_row($result);
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAEDITCAT."</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <input type=\"hidden\" name=\"cat_id\" value=\"$cat_id\">
    <table border=\"0\" width=\"100%\"><tr><td>
    "._BBACAT.": </td><td><input type=\"text\" name=\"cat_title\" size=\"31\" value=\"$cat_title\"></td></tr><tr><td>
    </td></tr></table>
    <input type=\"hidden\" name=\"op\" value=\"ForumCatSave\">
    <input type=\"submit\" value=\""._BBASAVECHANGES."\">
    </form>
    </td></tr></table></td></tr></table>";
    include("footer.php");
}


function ForumCatSave($cat_id, $cat_title) {
    global $prefix, $dbi;
    $cat_title = addslashes($cat_title);
    mysql_query("update ".$prefix."_catagories set cat_title='$cat_title' where cat_id='$cat_id'");
    Header("Location: admin.php?op=ForumAdmin");
}

function ForumGoSave($forum_id, $forum_name, $forum_desc, $forum_access, $moderator, $rem_mods, $cat_id, $forum_type) {
    global $prefix, $dbi, $user_prefix;
    $forum_name = addslashes($forum_name);
    $forum_desc = addslashes($forum_desc);
    $result = mysql_query("select uid from ".$user_prefix."_users where uname='$moderator'");
    list($uid) = mysql_fetch_row($result);
    if ($uid == '') {
	include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
	echo "<center>"._USERNOTINDB."<br><br>"._GOBACK."</center>";
	CloseTable();
	include("footer.php");
	die();
    }
    $sql = "UPDATE ".$prefix."_forums SET forum_name = '$forum_name', forum_desc = '$forum_desc', forum_type = '$forum_type', cat_id = '$cat_id', forum_access = '$forum_access' WHERE forum_id = '$forum_id'";
    if(!$r = mysql_query($sql)) {
	die("Error - could not update the database, please go back and try again.");
    }
    $count = 0;
    if(isset($moderator)) {
	$result = mysql_query("SELECT uid FROM ".$user_prefix."_users WHERE uname='$moderator'");
	list($uid) = mysql_fetch_row($result);
	$result = mysql_query("UPDATE ".$user_prefix."_users SET user_level = 2 WHERE uid='$uid'");
	$result = mysql_query("INSERT INTO ".$prefix."_forum_mods (forum_id, user_id) VALUES ('$forum_id', '$uid')");
    }
    if(!isset($moderator)) {
	$current_mods = "SELECT count(*) AS total FROM ".$prefix."_forum_mods WHERE forum_id = '$forum_id'";
        $r = @mysql_query($current_mods);
        list($total) = mysql_fetch_array($r);
    } else {
	$total = count($moderator) + 1;
    }
    if(isset($rem_mods) && $total > 1) {
	while(list($null, $uid) = each($rem_mods)) {
    	    $rem_query = "DELETE FROM ".$prefix."_forum_mods WHERE forum_id = '$forum_id' AND user_id = '$uid'";
            if(!mysql_query($rem_query)) {
        	die("Error removing moderators for forum!<BR>".mysql_error()."<BR>$rem_query");
	    }
        }
    } else {
	if (isset($rem_mods)) {
    	    $mod_not_removed = 1;
	}
    }
    Header("Location: admin.php?op=ForumGoEdit&forum_id=$forum_id");
}

function ForumCatAdd($catagories) {
    global $prefix, $dbi;
    $result = mysql_query("SELECT max(cat_order) AS highest FROM ".$prefix."_catagories");
    list($highest) = mysql_fetch_array($result);
    if (!$highest) {
	$highest=1;
    } else {
        $highest= $highest+1;
    }
    $catagories = addslashes($catagories);
    mysql_query("insert into ".$prefix."_catagories values (NULL, '$catagories', '$highest')");
    Header("Location: admin.php?op=ForumAdmin");
}

function ForumGoAdd($forum_name, $forum_desc, $forum_access, $moderator, $cat_id, $forum_type) {
    global $user_prefix, $prefix, $dbi;
    if($forum_name == '' || $forum_desc == '' || $moderator == '') {
	echo "$forum_name - $forum_desc - $moderator<br>";
	die("You did not fill out all the parts of the form.<br>Did you assign at least one moderator? Please go back and correct the form.");
    }
    $result = mysql_query("select uid from ".$user_prefix."_users where uname='$moderator'");
    list($uid) = mysql_fetch_row($result);
    if ($uid == '') {
	include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
	echo "<center>"._USERNOTINDB."<br><br>"._GOBACK."</center>";
	CloseTable();
	include("footer.php");
	die();
    }
    $forum_desc = str_replace("\n", "<BR>", $forum_desc);
    $forum_desc = addslashes($forum_desc);
    $forum_name = addslashes($forum_name);
    $thesql = "INSERT INTO ".$prefix."_forums (forum_name, forum_desc, forum_access, cat_id, forum_type) VALUES ('$forum_name', '$forum_desc', '$forum_access', '$cat_id', '$forum_type')";
    if(!$result = mysql_query($thesql)) {
	die("An Error Occurred<HR>Could not contact the database. Please check your config file.<BR>".mysql_error()."<BR>$thesql");
    }
    $forum = mysql_insert_id();
    $result = mysql_query("SELECT uid FROM ".$user_prefix."_users WHERE uname='$moderator'");
    list($uid) = mysql_fetch_row($result);
    $result = mysql_query("UPDATE ".$user_prefix."_users SET user_level = 2 WHERE uid='$uid'");
    $result = mysql_query("INSERT INTO ".$prefix."_forum_mods (forum_id, user_id) VALUES ('$forum', '$uid')");
    Header("Location: admin.php?op=ForumGo&cat_id=$cat_id");
}

function ForumCatDel($cat_id, $ok=0) {
        global $prefix, $dbi;
    if($ok==1) {
        $result = mysql_query("select forum_id from ".$prefix."_forums where cat_id='$cat_id'");
        while(list($forum_id) = mysql_fetch_row($result)) {
        mysql_query("delete from ".$prefix."_forumtopics where forum_id=$forum_id");
        }
        mysql_query("delete from ".$prefix."_forums where cat_id=$cat_id");
        mysql_query("delete from ".$prefix."_catagories where cat_id=$cat_id");
        Header("Location: admin.php?op=ForumAdmin");
    } else {
        include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
        echo "<center><br>";
        echo "<font size=3 color=Red>";
        echo "<b>"._BBDELCAT."</b><br><br><font color=Black>";
    }
        echo "[ <a href=\"admin.php?op=ForumCatDel&cat_id=$cat_id&ok=1\">"._YES."</a> | <a href=\"admin.php?op=ForumAdmin\">"._NO."</a> ]<br><br>";
        echo "</TD></TR></TABLE></TD></TR></TABLE>";
        include("footer.php");
}

function ForumGoDel($forum_id, $ok=0) {
        global $prefix, $dbi;
    if($ok==1) {

              $sql = "SELECT post_id FROM ".$prefix."_posts WHERE forum_id = $forum_id";
                    if(!$r = mysql_query($sql))
                           die("Error could not delete the posts in this forum ".mysql_error()." $sql");
                        if ($r[post_id]) {
                         $sql = "DELETE FROM ".$prefix."_posts_text WHERE ";
                         $looped = FALSE;
                         while($ids = mysql_fetch_array($r))
                         {
                                 if($looped == TRUE)
                                 {
                                         $sql .= " OR ";
                         }
                                 $sql .= "post_id = ".$ids[post_id]." ";
                                 $looped = TRUE;
                         }
                        if(!$r = mysql_query($sql))
                           die("Error could not delete the posts in this forum ".mysql_error()." $sql");
                    }
                         $sql = "DELETE FROM ".$prefix."_posts WHERE forum_id = '$forum_id'";
                         if(!$r = mysql_query($sql))
                           die("Error could not delete the posts in this forum");

                         $sql = "DELETE FROM ".$prefix."_bbtopics WHERE forum_id = '$forum_id'";
                         if(!$r = mysql_query($sql))
                           die("Error could not delete the topics in this forum");

                         $sql = "DELETE FROM ".$prefix."_forums WHERE forum_id = '$forum_id'";
                         if(!$r = mysql_query($sql))
                           die("Error could not delete the forum");

                         $sql = "DELETE FROM ".$prefix."_forum_mods WHERE forum_id = '$forum_id'";
                         if(!$r = mysql_query($sql))
                           die("Error could not delete the forum");



/*        mysql_query("delete from ".$prefix."_bbtopics where forum_id=$forum_id");
        mysql_query("delete from ".$prefix."_forums where forum_id=$forum_id");*/
        Header("Location: admin.php?op=ForumAdmin");
    } else {
        include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
        echo "<center><br>";
        echo "<font size=3 color=Red>";
        echo "<b>"._BBDELFORUM."</b><br><br><font color=Black>";
    }
        echo "[ <a href=\"admin.php?op=ForumGoDel&forum_id=$forum_id&ok=1\">"._YES."</a> | <a href=\"admin.php?op=ForumAdmin\">"._NO."</a> ]<br><br>";
        CloseTable();
        include("footer.php");
}

function PrivForumUser($forum_id) {
    global $user_prefix, $prefix, $bgcolor2, $textcolor2, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();

        #PHPBB original snippet
        $sql = "SELECT forum_name FROM ".$prefix."_forums WHERE (forum_id = $forum_id)";
        if ((!$result = mysql_query($sql)) || ($forum == -1)) {
                die("Couldn't find forum.\n");
        }
        $forum_name = "";
        if ($row = mysql_fetch_array($result)) {
                $forum_name = $row[forum_name];
        }
?>

<center><font size="4"><b><? echo""._BBAEDITPRIVF."";?></b> <?php echo $forum_name?></font></center><br>

<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
<FORM ACTION="admin.php" METHOD="POST">
<tr>
<td bgcolor="<?php echo $bgcolor2?>" align="center" width="40%">
<font size="3" face="arial"><b>Users Without Access:</b></font>
</TD>
<TD bgcolor="<?php echo $bgcolor2?>" align="center" width="20%">&nbsp;</TD>
<TD bgcolor="<?php echo $bgcolor2?>" align="center">
<font size="3" face="arial"><b>Users With Access:</b></font>
</TD>
</TR>

<TR>
<TD VALIGN="TOP" bgcolor="<?php echo $bgcolor3?>" align="center" width="40%">
<font size="3" face="arial">
<SELECT NAME="userids[]" SIZE="10" MULTIPLE>
<?php
                        $sql = "SELECT u.uid FROM ".$user_prefix."_users u, ".$prefix."_forum_access f WHERE (u.uid = f.user_id) AND (f.forum_id = $forum_id)";
                        if (!$result = mysql_query($sql))
                        {
                                die("Error getting current user list.\n");
                        }

                        $current_users = Array();

                        while ($row = mysql_fetch_array($result))
                        {
                                $current_users[] = $row[uid];
                        }

                        $sql = "SELECT uid, uname FROM ".$user_prefix."_users WHERE (uid != 1) AND (user_level != -1) ";
                        while(list($null, $curr_userid) = each($current_users))
                        {
                                 $sql .= "AND (uid != $curr_userid) ";
              }
              $sql .= "ORDER BY uname ASC";

              if (!$result = mysql_query($sql))
              {
                      die("Error getting user list from db.".mysql_error()." $sql\n");
              }
              while ($row = mysql_fetch_array($result))
              {
?>
             <OPTION VALUE="<?php echo $row[uid] ?>"> <?php echo $row[uname] ?> </OPTION>
<?php
              }
?>
</SELECT>
</TD>
<TD bgcolor="<?php echo $bgcolor3?>" align="center">
<font size="3" face="arial">
                                                        <INPUT TYPE="HIDDEN" NAME="op" VALUE="PrivAddUser">
                                                        <INPUT TYPE="HIDDEN" NAME="forum_id" VALUE="<?php echo $forum_id ?>">
                                                        <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Add Users -->">
                                                        <br><br>
                                                        <b><A HREF="admin.php?op=PrivClearUser&forum_id=<?php echo $forum_id ?>">Clear all users</A></b>
                                                        </font>
</TD>
<TD VALIGN="TOP" bgcolor="<?php echo $bgcolor3?>" align="center">
<?php
                        $sql = "SELECT u.uname, u.uid, f.can_post FROM ".$user_prefix."_users u, ".$prefix."_forum_access f WHERE (u.uid = f.user_id) AND (f.forum_id = $forum_id) ORDER BY u.uid ASC";
                        if (!$result = mysql_query($sql))
                        {
                                die ("Error getting userlist from DB.\n");
                        }
?>
<TABLE BORDER="0" CELLPADDING="10" CELLSPACING="0">

<?php
                        while ($row = mysql_fetch_array($result))
                        {
                                $post_text = ($row[can_post]) ? "can" : "can't";
                                $post_text .= " post";

                                $post_toggle_link = "<A HREF=\"admin.php?op=PrivPostRevForum&forum_id=$forum_id&userid=$row[uid]&do=";
                                if ($row[can_post])
                                {
                                        $post_toggle_link .= "1\">revoke posting</A>";
                                }
                                else
                                {
                                        $post_toggle_link .= "2\">grant posting</A>";
                                }

                                $remove_link = "<A HREF=\"admin.php?op=PrivDelUser&forum_id=$forum_id&userid=$row[uid]\">remove</A>";
?>
<TR>
<TD>
<font size="3" face="arial"><b><?php echo $row[uname]?></b></font>
</TD>
<TD>
<font size="3" face="arial"><?php echo $post_text ?></font>
</TD>
<TD><font size="3" face="arial"><?php echo $post_toggle_link ?></font>
</TD>
<TD>
<font size="3" face="arial"><?php echo $remove_link ?></font>
</TD>
<TR>
<?php
                        }
?>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>
</table>
<?
    CloseTable();
    include("footer.php");
}

function PrivAddUser($userids, $forum_id) {
    global $prefix, $dbi;
if ($userids) {
        while(list($null, $curr_userid) = each($userids)) {
                $sql = "INSERT INTO ".$prefix."_forum_access (forum_id, user_id, can_post) VALUES ($forum_id, $curr_userid, 0)";
                if (!$result = mysql_query($sql)) {
                        die("Error inserting to DB.\n");
                }
        }

}
Header("Location: admin.php?op=PrivForumUser&forum_id=$forum_id");
}

function PrivClearUser($forum_id) {
    global $prefix, $dbi;
        $sql = "DELETE FROM ".$prefix."_forum_access WHERE (forum_id = $forum_id)";
        if (!$result = mysql_query($sql))
                {
                        die("Error deleting from database.\n");
                }
Header("Location: admin.php?op=PrivForumUser&forum_id=$forum_id");
}


function PrivPostRevForum($forum_id,$userid,$do) {
    global $prefix, $dbi;
if ($do == 2) {
        $sql = "UPDATE ".$prefix."_forum_access SET can_post=1 WHERE (forum_id = $forum_id) AND (user_id = $userid)";
        if (!$result = mysql_query($sql))
                {
                        die("Error updating database.\n");
                }
} else {
        $sql = "UPDATE ".$prefix."_forum_access SET can_post=0 WHERE (forum_id = $forum_id) AND (user_id = $userid)";
        if (!$result = mysql_query($sql))
                {
                        die("Error updating database.\n");
                }
}
Header("Location: admin.php?op=PrivForumUser&forum_id=$forum_id");
}


function PrivDelUser($forum_id,$userid) {
    global $prefix, $dbi;
        $sql = "DELETE FROM ".$prefix."_forum_access WHERE (forum_id = $forum_id) AND (user_id = $userid)";
        if (!$result = mysql_query($sql))
                {
                        die("Error deleting from database.\n");
                }
Header("Location: admin.php?op=PrivForumUser&forum_id=$forum_id");
}

function ForumBanAdmin() {
    global $user_prefix, $bgcolor2, $textcolor2, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
        echo "
    <center><font size=\"4\"><b>"._BBAFBANIP."</b></font></center>
    <center><table border=\"1\" width=\"100%\"><tr>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBABANIP."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBADURATION."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFUNC."</b></td></tr>";
    $result = mysql_query("SELECT ban_id, ban_ip, ban_start, ban_end, ban_time_type FROM ".$prefix."_banlist WHERE ban_ip");
    while(list($ban_id, $ban_ip, $ban_start, $ban_end, $ban_time_type) = mysql_fetch_row($result)) {
      if($ban_end == 0) {
              $dur = "Parmanent";
      }
      else {
      switch($ban_time_type) {
          case 1:
            $dur = ($ban_end - $ban_start);
            $dur = "".$dur." Seconds";
            break;
          case 2:
            $dur = ($ban_end - $ban_start) / 60;
            $dur = "".$dur." Minutes";
            break;
          case 3:
            $dur = ($ban_end - $ban_start) / 3600;
            $dur = "".$dur." Hours";
            break;
          case 4:
            $dur = ($ban_end - $ban_start) / 86400;
            $dur = "".$dur." Days";
            break;
          case 5:
            $dur = ($ban_end - $ban_start) / 31536000;
            $dur = "".$dur." Years";
            break;
         }
        }
    echo "
        <td align=\"center\">$ban_ip</td>
        <td align=\"center\">$dur</td>
        <td align=\"center\">[ <a href=\"admin.php?op=BanEdit&ban_id=$ban_id&banby=1\">"._BBAEDIT."</a> | <a href=\"admin.php?op=BanDel&ban_id=$ban_id&ok=0\">"._BBADELETE."</a> ]</td><tr>";
    }
    echo "</td></tr></table>
    <br><br>";

        echo "
    <center><font size=\"4\"><b>"._BBAFBANUID."</b></font></center>
    <center><table border=\"1\" width=\"100%\"><tr>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBABANUID."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBADURATION."</b></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFUNC."</b></td></tr>";
    $result = mysql_query("SELECT ban_id, ban_userid, ban_start, ban_end, ban_time_type FROM ".$prefix."_banlist WHERE ban_userid");
    while(list($ban_id, $ban_userid, $ban_start, $ban_end, $ban_time_type) = mysql_fetch_row($result)) {
            $result = mysql_query("SELECT uname FROM ".$user_prefix."_users WHERE uid='$ban_userid'");
            list($uname) = mysql_fetch_row($result);
      if($ban_end == 0) {
              $dur = "Parmanent";
      }
      else {
      switch($ban_time_type) {
          case 1:
            $dur = ($ban_end - $ban_start);
            $dur = "".$dur." Seconds";
            break;
          case 2:
            $dur = ($ban_end - $ban_start) / 60;
            $dur = "".$dur." Minutes";
            break;
          case 3:
            $dur = ($ban_end - $ban_start) / 3600;
            $dur = "".$dur." Hours";
            break;
          case 4:
            $dur = ($ban_end - $ban_start) / 86400;
            $dur = "".$dur." Days";
            break;
          case 5:
            $dur = ($ban_end - $ban_start) / 31536000;
            $dur = "".$dur." Years";
            break;
         }
        }
    echo "
        <td align=\"center\">$uname</td>
        <td align=\"center\">$dur</td>
        <td align=\"center\">[ <a href=\"admin.php?op=BanEdit&ban_id=$ban_id&banby=2\">"._BBAEDIT."</a> | <a href=\"admin.php?op=BanDel&ban_id=$ban_id&ok=0\">"._BBADELETE."</a> ]</td><tr>";
    }
    echo "</td></tr></table>
    <br><br>


    </center><font size=\"4\"><b>"._BBAADDBAN."</b><br><br>
    <font size=\"2\">
    <form action=\"admin.php\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBAIPUNAME.": </td><td><input type=\"text\" name=\"ipusername\" size=\"20\">&nbsp;
    <SELECT name=\"banby\">
    <OPTION value=\"1\">IP address</OPTION>
    <OPTION value=\"2\">Username</OPTION>
    </SELECT>
    </td></tr>
    <tr><td>"._BBADURATION.": </td><td><input type=\"text\" name=\"duration\" size=\"20\">&nbsp;
    <SELECT name=\"durtype\">
    <OPTION value=\"1\">Seconds</OPTION>
    <OPTION value=\"2\">Minutes</OPTION>
        <OPTION value=\"3\">Hours</OPTION>
        <OPTION value=\"4\">Days</OPTION>
        <OPTION value=\"5\">Years</OPTION>
    </SELECT>
    </td></tr>
    <tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._BBAADD."\"></td></tr></table>
    <input type=\"hidden\" name=\"op\" value=\"BanAdd\">
    </form>";
        CloseTable();
    include("footer.php");
}

function BanAdd($ipusername, $banby, $duration, $durtype) {
    global $prefix, $dbi, $user_prefix;
    $starttime = mktime (date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
    switch($durtype) {
            case 1:
                        $type = 1;
                break;
               case 2:
                         $type = 60;
                 break;
               case 3:
                         $type = 3600;
                 break;
               case 4:
                         $type = 86400;
                 break;
               case 5:
                         $type = 31536000;
                 break;
      }
    if(!isset($duration))
        $duration = 0;
    if($duration != 0)
        $endtime = $starttime + ($duration * $type);
    else
        $endtime = 0;

    if($banby == 1) {
        $sql = "INSERT INTO ".$prefix."_banlist (ban_ip, ban_start, ban_end, ban_time_type) VALUES ('$ipusername', '$starttime', '$endtime', '$durtype')";
         if(!$r = mysql_query($sql)) {
           die ("<center>Error. Could not add ban!<br><a href=\"admin.php?op=ForumBanAdmin\">back to Admin</a></center>");
           }
      Header("Location: admin.php?op=ForumBanAdmin");
     } else {
                $result = mysql_query("SELECT uid FROM ".$user_prefix."_users WHERE uname='$ipusername'");
                list($uid) = mysql_fetch_array($result);
                        if($uid) {
                            $sql = "INSERT INTO ".$prefix."_banlist (ban_userid, ban_start, ban_end, ban_time_type) VALUES ('$uid', '$starttime', '$endtime', '$durtype')";
                                    if(!$r = mysql_query($sql)) {
                                              die ("<center>Error. Could not add ban!<br><a href=\"admin.php?op=ForumBanAdmin\">back to Admin</a></center>");
                                                   }
                                      Header("Location: admin.php?op=ForumBanAdmin");
                        } else  {
                          die ("<center>Error. No username in your database!<br><a href=\"admin.php?op=ForumBanAdmin\">back to Admin</a></center>");
                      }
         }
}

function BanEdit($ban_id,$banby) {
    global $user_prefix, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    if ($banby=="2") {
            $result = mysql_query("SELECT ban_id, ban_userid, ban_start, ban_end, ban_time_type FROM ".$prefix."_banlist WHERE ban_id='$ban_id'");
            list($ban_id, $ban_userid, $ban_start, $ban_end, $ban_time_type) = mysql_fetch_row($result);
            $result = mysql_query("SELECT uname FROM ".$user_prefix."_users WHERE uid='$ban_userid'");
            list($uname) = mysql_fetch_row($result);
        } else {
            $result = mysql_query("SELECT ban_id, ban_ip, ban_start, ban_end, ban_time_type FROM ".$prefix."_banlist WHERE ban_id='$ban_id'");
            list($ban_id, $ban_userid, $ban_start, $ban_end, $ban_time_type) = mysql_fetch_row($result);
        }
    if($ban_end == 0) {
              $timetext = "Permanent";
      }
      else {
      switch($ban_time_type) {
          case 1:
            $dur = ($ban_end - $ban_start);
            $timetext = "Seconds";
            $select = " SELECTED";
            break;
          case 2:
            $dur = ($ban_end - $ban_start) / 60;
            $timetext = "Minutes";
            $select = " SELECTED";
            break;
          case 3:
            $dur = ($ban_end - $ban_start) / 3600;
            $timetext = "Hours";
            $select = " SELECTED";
            break;
          case 4:
            $dur = ($ban_end - $ban_start) / 86400;
            $timetext = "Days";
            $select = " SELECTED";
            break;
          case 5:
            $dur = ($ban_end - $ban_start) / 31536000;
            $timetext = "Years";
            $select = " SELECTED";
            break;
         }
    }
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAEDITCAT."</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <input type=\"hidden\" name=\"ban_id\" value=\"$ban_id\">
    <table border=\"0\" width=\"100%\">
        <tr><td>"._BBAIPUNAME.": </td><td>";
    if ($banby == 2) {
            echo "<input type=\"text\" name=\"ipusername\" size=\"20\" value=\"$uname\">";
        } else {
            echo "<input type=\"text\" name=\"ipusername\" size=\"20\" value=\"$ban_userid\">";
    }
        echo "</td></tr><tr><td>"._BBATYPE."</td>";
        if ($banby== 2) {
            echo "<td>Username</td>";
    } else {
            echo "<td>IP/'s</td>";
    }
    echo "</tr><tr><td>"._BBADURATION.": </td><td>";
    if ($ban_end == 0) {
            echo "$timetext";
        } else {
            echo "<input type=\"text\" name=\"duration\" size=\"20\" value=\"$dur\">
            <SELECT name=\"durtype\">
            <OPTION value=\"$ban_time_type\" SELECTED>$timetext</OPTION>
            <OPTION value=\"1\">Seconds</OPTION>
            <OPTION value=\"2\">Minutes</OPTION>
                <OPTION value=\"3\">Hours</OPTION>
                <OPTION value=\"4\">Days</OPTION>
                <OPTION value=\"5\">Years</OPTION>
            </SELECT>";
        }
    echo "</td></tr>
    <tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._BBASAVECHANGES."\"></td></tr>
    </table>
        <input type=\"hidden\" name=\"banby\" value=\"$banby\">
    <input type=\"hidden\" name=\"op\" value=\"BanSave\">
    </form>";
        CloseTable();
    include("footer.php");
}


function BanSave($ban_id, $ipusername, $durtype, $duration, $banby) {
    global $prefix, $dbi, $user_prefix;
    $starttime = mktime (date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
    switch($durtype) {
            case 1:
                        $type = 1;
                break;
               case 2:
                         $type = 60;
                 break;
               case 3:
                         $type = 3600;
                 break;
               case 4:
                         $type = 86400;
                 break;
               case 5:
                         $type = 31536000;
                 break;
      }
    if(!isset($duration))
        $duration = 0;
    if($duration != 0)
        $endtime = $starttime + ($duration * $type);
    else
        $endtime = 0;

    if($banby == 1) {
        $sql = "UPDATE ".$prefix."_banlist SET ban_ip='$ipusername', ban_start='$starttime', ban_end='$end_time', ban_time_type='$durtype' WHERE ban_id='$ban_id'";
         if(!$r = mysql_query($sql)) {
           die ("<center>Error. Could not add ban!<br><a href=\"admin.php?op=ForumBanAdmin\">back to Admin</a></center>");
           }
      Header("Location: admin.php?op=ForumBanAdmin");
     } else {
                $result = mysql_query("SELECT uid FROM ".$user_prefix."_users WHERE uname='$ipusername'");
                list($uid) = mysql_fetch_array($result);
                        if($uid) {
                                $sql = "UPDATE ".$prefix."_banlist SET ban_userid='$ipusername', ban_start='$starttime', ban_end='$end_time', ban_time_type='$durtype' WHERE ban_id='$ban_id'";
                                    if(!$r = mysql_query($sql)) {
                                              die ("<center>Error. Could not add ban!<br><a href=\"admin.php?op=ForumBanAdmin\">back to Admin</a></center>");
                                                   }
                                      Header("Location: admin.php?op=ForumBanAdmin");
                        } else  {
                          die ("<center>Error. No username in your database!<br><a href=\"admin.php?op=ForumBanAdmin\">back to Admin</a></center>");
                      }
         }


}

function BanDel($ban_id, $ok) {
        global $prefix, $dbi;
    if($ok==1) {
        mysql_query("delete from ".$prefix."_banlist where ban_id=$ban_id");
        Header("Location: admin.php?op=ForumBanAdmin");
    } else {
        include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
        echo "<center><br>";
        echo "<font size=3 color=Red>";
        echo "<b>"._BBAWARNBAN."</b><br><br><font color=Black>";
    }
        echo "[ <a href=\"admin.php?op=BanDel&ban_id=$ban_id&ok=1\">"._BBAYES."</a> | <a href=\"admin.php?op=ForumBanAdmin\">"._BBANO."</a> ]<br><br>";
        echo "</TD></TR></TABLE></TD></TR></TABLE>";
        include("footer.php");
}

function ForumCensorAdmin() {
    global $admin, $bgcolor2, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAWCS."</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <center><table border=\"1\" width=\"100%\"><tr>
	<td bgcolor=\"$bgcolor2\"><center>"._BBAWORD."</td>
	<td bgcolor=\"$bgcolor2\"><center>"._BBAREPLACEMENT."</td>
	<td bgcolor=\"$bgcolor2\"><center>"._BBAFUNC."</td></tr>";
    $result = mysql_query("SELECT word_id, word, replacement from ".$prefix."_words order by word_id");
    while(list($word_id, $word, $replacement) = mysql_fetch_row($result)) {
	$word = stripslashes($word);
	$replacement = stripslashes($replacement);
    	echo "
	<td align=\"center\">$word</td>
	<td align=\"center\">$replacement</td>
	<td align=\"center\"><a href=\"admin.php?op=WordForumEdit&word_id=$word_id\">"._BBAEDIT."</a> | <a href=\"admin.php?op=WordForumDel&word_id=$word_id&ok=0\">"._BBADELETE."</a></td><tr>";
    }
    echo "</form></td></tr></table>";
    echo"
    <br><br>
    </center><font size=\"4\"><b>"._BBAADDCENCOR."</b><br><br>
    <font size=\"2\">
    <form action=\"admin.php\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBAWORD.": </td><td><input type=\"text\" name=\"word\" size=\"20\"></td></tr>
    <tr><td>"._BBAREPLACEMENT.": </td><td><input type=\"text\" name=\"replacement\" size=\"20\"></td></tr>
    <tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._BBAADD."\"></td></tr></table>
    <input type=\"hidden\" name=\"op\" value=\"WordForumAdd\">
    </form>";
    CloseTable();
    include("footer.php");
}

function WordForumAdd($word, $replacement) {
    global $prefix, $dbi;
    $word = addslashes($word);
    $replacement = addslashes($replacement);
	mysql_query("INSERT INTO ".$prefix."_words (word, replacement) VALUES ('$word', '$replacement')");
    Header("Location: admin.php?op=ForumCensorAdmin");
}

function WordForumEdit($word_id) {
    global $prefix;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    $result = mysql_query("SELECT word_id, word, replacement FROM ".$prefix."_words WHERE word_id='$word_id'");
    list($word_id, $word, $replacement) = mysql_fetch_row($result);
	$word=stripslashes($word);
	$replacement=stripslashes($replacement);
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAEDITWORD."</b></font></center>
    <form name=\"bbaranks\" action=\"admin.php\" method=\"post\">
    <input type=\"hidden\" name=\"word_id\" value=\"$word_id\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBAWORD.": </td><td><input type=\"text\" name=\"word\" size=\"31\" value=\"$word\"></td></tr>
    <tr><td>"._BBAREPLACEMENT.": </td><td><input type=\"text\" name=\"replacement\" size=\"31\" value=\"$replacement\"></td></tr>
    <tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._BBASAVECHANGES."\"></td></tr>
    <input type=\"hidden\" name=\"op\" value=\"WordForumSave\">
    </table>
    </form>";
    CloseTable();
    include("footer.php");
}

function WordForumSave($word_id, $word, $replacement) {
    global $prefix, $dbi;
    $word = addslashes($word);
    $replacement = addslashes($replacement);
    mysql_query("UPDATE ".$prefix."_words SET word='$word', replacement='$replacement'WHERE word_id='$word_id'");
    Header("Location: admin.php?op=ForumCensorAdmin");
}

function WordForumDel($word_id, $ok) {
    global $prefix, $dbi;
    if($ok==1) {
	mysql_query("DELETE FROM ".$prefix."_words WHERE word_id=$word_id");
	Header("Location: admin.php?op=ForumCensorAdmin");
    } else {
	include("header.php");
	GraphicAdmin();
	title(""._FORUMSADMIN."");
	OpenTable();
	echo "<center><br>";
	echo "<b>"._BBACENCORWARN."</b><br><br>";
    }
	echo "[ <a href=\"admin.php?op=WordForumDel&word_id=$word_id&ok=1\">"._BBAYES."</a> | <a href=\"admin.php?op=ForumCensorAdmin\">"._BBANO."</a> ]<br><br>";
	CloseTable();
	include("footer.php");	
}

function ForumConfigAdmin() {
    global $prefix, $admin, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
    $result = mysql_query("select allow_html, allow_bbcode, allow_sig, posts_per_page, hot_threshold, topics_per_page, email_sig, email_from from ".$prefix."_config");
    list($allow_html,$allow_bbcode,$allow_sig,$posts_per_page,$hot_threshold,$topics_per_page,$email_sig,$email_from) = mysql_fetch_row($result);
                   $email_from = stripslashes($email_from);
                   $email_sig = stripslashes($email_sig);
    echo "
    <center><font size=\"4\"><b>"._FORUMCONFIG."</b></center><br><br>
    <font size=\"2\">
    <form action=\"admin.php\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBEMAILFROM." </td><td><INPUT TYPE=\"TEXT\" NAME=\"email_from\" SIZE=\"30\" MAXLENGTH=\"100\" VALUE=\"$email_from\"></td></tr>
    <tr><td colspan=\"2\"><small><i>"._BBEMAILEXPL."</i></small></td></tr>
    <tr><td>"._BBMAILSIG." </td><td><TEXTAREA NAME=\"email_sig\" ROWS=\"5\" COLS=\"20\">$email_sig</TEXTAREA></td></tr>
        <tr><td colspan=\"2\"><small><i>"._BBSIGEXPL."</i></small></td></tr>
    <tr><td>"._HTMLALLOW." </td><td>";
    if ($allow_html==1) {
    ?>
    <INPUT TYPE="RADIO" NAME="allow_html" VALUE="1" CHECKED> <?php echo _YES; ?> <INPUT TYPE="RADIO" NAME="allow_html" VALUE="0" > <?php echo _NO; ?>
    <?php
    } else {
    ?>
    <INPUT TYPE="RADIO" NAME="allow_html" VALUE="1"> <?php echo _YES; ?> <INPUT TYPE="RADIO" NAME="allow_html" VALUE="0" CHECKED> <?php echo _NO; ?>
    <?php
    }
    echo"</td></tr>
    <tr><td>
    "._BBCODEALLOW." </td><td>";
    if ($allow_bbcode==1) {
    ?>
    <INPUT TYPE="RADIO" NAME="allow_bbcode" VALUE="1" CHECKED> <?php echo _YES; ?> <INPUT TYPE="RADIO" NAME="allow_bbcode" VALUE="0" > <?php echo _NO; ?>
    <?php
    } else {
    ?>
    <INPUT TYPE="RADIO" NAME="allow_bbcode" VALUE="1"> <?php echo _YES; ?> <INPUT TYPE="RADIO" NAME="allow_bbcode" VALUE="0" CHECKED> <?php echo _NO; ?>
    <?php
    }
    echo"</td></tr>
    <tr><td>
    "._BBALLOWSIG." </td><td>";
    if ($allow_sig==1) {
    ?>
    <INPUT TYPE="RADIO" NAME="allow_sig" VALUE="1" CHECKED> <?php echo _YES; ?> <INPUT TYPE="RADIO" NAME="allow_sig" VALUE="0" > <?php echo _NO; ?>
    <?php
    } else {
    ?>
    <INPUT TYPE="RADIO" NAME="allow_sig" VALUE="1"> <?php echo _YES; ?> <INPUT TYPE="RADIO" NAME="allow_sig" VALUE="0" CHECKED> <?php echo _NO; ?>
    <?php
    }
    echo "</td></tr>
    <tr><td>"._BBHOT." </td><td><input type=\"text\" name=\"hot_threshold\" size=\"4\" value=\"$hot_threshold\"></td></tr>
    <tr><td>"._BBPPP." </td><td><input type=\"text\" name=\"posts_per_page\" size=\"4\" value=\"$posts_per_page\"></td></tr>
    <tr><td colspan=\"2\"><small><i>"._BBPPPEXPL."</i></small></td></tr><tr><td>
    "._BBTOPPF." </td><td><input type=\"text\" name=\"topics_per_page\" size=\"4\" value=\"$topics_per_page\"></td></tr>
    <tr><td colspan=\"2\"><small><i>"._BBTOPPFEXP."</i></small></td></tr>
    <tr><td></td></tr></table>
    <input type=\"hidden\" name=\"op\" value=\"ForumConfigChange\">
    <input type=\"submit\" value=\""._SAVECHANGES."\">
    </form>";
    CloseTable();
    include("footer.php");
}

function ForumConfigChange($allow_html,$allow_bbcode,$allow_sig,$posts_per_page,$hot_threshold,$topics_per_page,$email_sig,$email_from) {
global $prefix, $dbi;
$email_from = addslashes($email_from);
$email_sig = addslashes($email_sig);
        mysql_query("UPDATE ".$prefix."_config SET allow_html='$allow_html', allow_bbcode='$allow_bbcode', allow_sig='$allow_sig', selected='1', posts_per_page='$posts_per_page', hot_threshold='$hot_threshold', topics_per_page='$topics_per_page', email_sig='$email_sig', email_from='$email_from'");
    Header("Location: admin.php?op=ForumConfigAdmin");
}

function JavaScriptAdmin() {
    echo "<SCRIPT type=\"text/javascript\">\n";
    echo "<!--\n\n";
    echo "function showsmilies() {\n";
    echo "if (!document.images)\n";
    echo "return\n";
    echo "document.images.smilies.src=\n";
    echo "'images/forum/smilies/' + document.TheAdmin.smile_url.options[document.TheAdmin.smile_url.selectedIndex].value\n";
    echo "}\n\n";
    echo "//-->\n";
    echo "</SCRIPT>\n";
}

function ForumManagerAdmin() {
    global $admin, $bgcolor2, $textcolor2, $prefix, $dbi;
    include ("header.php");
        JavaScriptAdmin();
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
    echo"
    <center><font size=\"4\"><b>"._BBAFSMILIES."</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <center><table border=\"1\" width=\"100%\"><tr>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBACODE."</b></font></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAEMO."</b></font></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAICONS."</b></font></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAACTIVE."</b></font></td>
        <td bgcolor=\"$bgcolor2\"><font color=\"$textcolor2\"><center><b>"._BBAFUNC."</b></font></td></tr>";
    $result = mysql_query("SELECT id,code,smile_url,emotion,active FROM ".$prefix."_smiles");
    while(list($id,$code,$smile_url,$emotion,$active) = mysql_fetch_row($result)) {
        $emotion = stripslashes($emotion);
    echo "
        <td align=\"center\">$code</td>
        <td align=\"center\">$emotion</td>
        <td align=\"center\"><IMG SRC=\"images/forum/smilies/$smile_url\"></td>";
        if (!$active=="1") {
        echo"<td align=\"center\">"._BBANO."</td>"; }
        else { echo"<td align=\"center\">"._BBAYES."</td>"; }
        echo"<td align=\"center\">[  <a href=\"admin.php?op=ForumSmiliesEdit&id=$id\">"._BBAEDIT."</a> | <a href=\"admin.php?op=ForumSmiliesDel&id=$id&ok=0\">"._BBADELETE."</a> ]</td><tr>";
    }
    echo "</form></table>";
    echo "<br><br>
    </center><font size=\"4\"><b>"._BBAADDSMILIES."</b></font></center><br><br>
    <font size=\"2\">
    <form action=\"admin.php\" name=\"TheAdmin\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBACODE.": </td><td><input type=\"text\" name=\"code\" size=\"10\"></td></tr>
    <tr><td>"._BBAEMO.": </td><td><input type=\"text\" name=\"emotion\" size=\"31\"></td></tr>
    <tr><td>"._BBAICONS.": </td><td><select name=\"smile_url\" onChange=\"showsmilies()\">";
                $direktori = "images/forum/smilies";
                $handle=opendir($direktori);
                while ($file = readdir($handle))
                        {
                        $filelist[] = $file;
                }
                asort($filelist);
                while (list ($key, $file) = each ($filelist))
                {
                ereg(".gif|.jpg",$file);
                if ($file == "." || $file == ".." || $file == "index.html") $a=1;
                else {
                        echo "<option value=\"$file\">$file</option>";
                        }
                }

        echo"
        </select>&nbsp;&nbsp;<img src=\"images/forum/smilies/blank.gif\" name=\"smilies\">
        </td></tr>
    <tr><td>"._ACTIVE.": </td><td><input type=\"checkbox\" name=\"active\" value=\"1\"></td></tr>
    <tr><td><input type=\"submit\" value=\""._BBAADD."\"></td></tr>
    <input type=\"hidden\" name=\"op\" value=\"ForumSmiliesAdd\">
    </form>
    </table>";
    CloseTable();
    include("footer.php");
}

function ForumSmiliesEdit($id) {
    global $admin, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    $result = mysql_query("SELECT id,code,smile_url,emotion,active FROM ".$prefix."_smiles WHERE id='$id'");
    list($id,$code,$smile_url,$emotion,$active) = mysql_fetch_row($result);
        $emotion = stripslashes($emotion);
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._BBAEDITSMILIES."</b></font></center>
    <form action=\"admin.php\" name=\"TheAdmin\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBACODE.": </td><td><input type=\"text\" name=\"code\" size=\"4\" value=\"$code\"></td></tr>
    <tr><td>"._BBAEMO.": </td><td><input type=\"text\" name=\"emotion\" size=\"31\" value=\"$emotion\"></td></tr>
    <tr><td>"._BBAICONS.": </td><td><select name=\"smile_url\" onChange=\"showsmilies()\">";

                $direktori = "images/forum/smilies";
                $handle=opendir($direktori);
                while ($file = readdir($handle))
                        {
                        $filelist[] = $file;
                }
                asort($filelist);
                while (list ($key, $file) = each ($filelist))
                {
                ereg(".gif|.jpg",$file);
                if ($file == "." || $file == ".." || $file == "index.html") $a=1;
                else {
                        if ($smile_url==$file) {
                        echo "<option value=\"$file\" selected>$file</option>"; }
                        else {
                        echo "<option value=\"$file\">$file</option>"; }
                        }
                }

        echo"
        </select>&nbsp;&nbsp;<img src=\"images/forum/smilies/$smile_url\" name=\"smilies\">
        </td></tr>";
        if ($active==1) {
    echo"<tr><td>"._BBAACT.": </td><td><input type=\"checkbox\" name=\"active\" value=\"1\" checked></td></tr>"; }
    else {
    echo"<tr><td>"._BBAACT.": </td><td><input type=\"checkbox\" name=\"active\" value=\"1\"></td></tr>"; }
    echo"<tr><td><input type=\"submit\" value=\""._BBAADD."\"></td></tr>
    <input type=\"hidden\" name=\"id\" value=\"$id\">
    <input type=\"hidden\" name=\"op\" value=\"ForumSmiliesSave\">
    </form>
    </table>";
    CloseTable();
    include("footer.php");
}

function ForumSmiliesSave($id,$code,$smile_url,$emotion,$active) {
        global $prefix, $dbi;
        $emotion = addslashes($emotion);
    mysql_query("update ".$prefix."_smiles set id='$id',code='$code',smile_url='$smile_url',emotion='$emotion',active='$active' where id='$id'");
    Header("Location: admin.php?op=ForumManager");
}

function ForumSmiliesAdd($code,$smile_url,$emotion,$active) {
        global $prefix, $dbi;
        $emotion = addslashes($emotion);
    mysql_query("insert into ".$prefix."_smiles values (NULL,'$code','$smile_url','$emotion','$active')");
    Header("Location: admin.php?op=ForumManager");
}

function ForumSmiliesDel($id,$ok) {
        global $prefix, $dbi;
    if($ok==1) {
        mysql_query("delete from ".$prefix."_smiles where id=$id");
        Header("Location: admin.php?op=ForumManager");
    } else {
        include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
        echo "<center><br>";
        echo "<b>"._BBAWARNING."</b><br><br>";
    }
        echo "[ <a href=\"admin.php?op=ForumSmiliesDel&id=$id&ok=1\">"._BBAYES."</a> | <a href=\"admin.php?op=ForumManager\">"._BBANO."</a> ]<br><br>";
        echo "</TD></TR></TABLE></TD></TR></TABLE>";
    CloseTable();
        include("footer.php");
}

function JavaAvatar() {
?>
<SCRIPT type="text/javascript">
    <!--
    function showimage() {
    if (!document.images)
    return
    document.images.bbarankimage.src=
    'images/forum/special/' + document.bbaranks.image.options[document.bbaranks.image.selectedIndex].value
    }
    //-->
    </SCRIPT>
<?
}

function RankForumAdmin() {
    global $admin, $bgcolor2, $prefix, $dbi;
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    OpenTable();
    echo "
    <center><font size=\"4\"><b>"._FORUMRANK."</b></font></center>
    <form action=\"admin.php\" method=\"post\">
    <center><table border=\"1\" width=\"100%\"><tr>
        <td bgcolor=\"$bgcolor2\"><center>"._BBRANKTITLE."</td>
        <td bgcolor=\"$bgcolor2\"><center>"._BBRANKMINP."</td>
        <td bgcolor=\"$bgcolor2\"><center>"._BBRANKMAXP."</td>
        <td bgcolor=\"$bgcolor2\"><center>"._BBRANKSPEC."</td>
        <td bgcolor=\"$bgcolor2\"><center>"._BBRANKIMM."</td>
        <td>&nbsp</td></tr>";
    $result = mysql_query("select rank_id, rank_title, rank_min, rank_max, rank_special, rank_image from ".$prefix."_ranks order by rank_id");
    while(list($rank_id, $rank_title, $rank_min, $rank_max, $rank_special, $rank_image) = mysql_fetch_row($result)) {
        $rank_title = stripslashes($rank_title);
            echo "
        <td align=\"center\">$rank_title</td>
        <td align=\"center\">$rank_min</td>
        <td align=\"center\">$rank_max</td>";
        if ($rank_special ==1) {
        echo"
        <td align=\"center\">on</td>";}
        else {
        echo"
        <td align=\"center\">off</td>";}
        echo"
        <td align=\"center\"><img src=\"images/forum/special/$rank_image\"</td>
        <td align=\"center\"><a href=\"admin.php?op=RankForumEdit&rank_id=$rank_id\">"._EDIT."</a> | <a href=\"admin.php?op=RankForumDel&rank_id=$rank_id&ok=0\">"._DELETE."</a></td><tr>";
    }
    echo "</form></td></tr></table>";

JavaAvatar();

    echo"
    <br><br>
    </center><font size=\"4\"><b>"._BBRANKADD."</b><br><br>
    <font size=\"2\">
    <form name=\"bbaranks\" action=\"admin.php\" method=\"post\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBRANKTITLE." </td><td><input type=\"text\" name=\"rank_title\" size=\"31\"></td></tr>
    <tr><td>"._BBRANKMINP." </td><td><input type=\"text\" name=\"rank_min\" size=\"3\" maxsize=\"3\"></td></tr>
    <tr><td>"._BBRANKMAXP." </td><td><input type=\"text\" name=\"rank_max\" size=\"3\" maxsize=\"3\"></td></tr>
    <tr><td>"._BBRANKSPEC." </td><td><input type=\"checkbox\" name=\"rank_special\" value=\"1\"></td></tr>
    <tr><td>"._BBRANKIMM." </td>
        <td><select name=\"image\" onChange=\"showimage()\">\n";
        $direktori = "images/forum/special";
        $handle=opendir($direktori);
        while ($file = readdir($handle)) {
            $filelist[] = $file;
        }
        asort($filelist);
        while (list ($key, $file) = each ($filelist)) {
            ereg(".gif|.jpg",$file);
            if ($file == "." || $file == ".." || $file == "index.html") {
                $a=1;
            } else {
                echo "<option value=\"$file\">$file</option>\n";
                }
        }
        echo "
        </select></td></tr>
    <tr><td>&nbsp;</td><td><img src=\"images/forum/special/blank.gif\" name=\"bbarankimage\" alt=\"\"></td></tr>
    <tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._ADD."\"></td></tr></table>
    <input type=\"hidden\" name=\"op\" value=\"RankForumAdd\">
    </form>";
    CloseTable();
    include("footer.php");
}

function RankForumAdd($rank_title,$rank_min,$rank_max,$rank_special,$image) {
    global $prefix,$dbi;
    $rank_title = addslashes($rank_title);
    if ($rank_special == 1) {
    mysql_query("insert into ".$prefix."_ranks values (NULL, '$rank_title', '-1' ,'-1' ,'$rank_special','$image')");
        } else {
        mysql_query("INSERT INTO ".$prefix."_ranks (rank_title, rank_min, rank_max, rank_special, rank_image) VALUES ('$rank_title', '$rank_min', '$rank_max', '0', '$image')");
    }
    Header("Location: admin.php?op=RankForumAdmin");
}

function RankForumEdit($rank_id) {
    global $admin, $prefix, $dbi;
    
    include ("header.php");
    GraphicAdmin();
    title(""._FORUMSADMIN."");
    $result = mysql_query("select rank_title, rank_min, rank_max, rank_special, rank_image from ".$prefix."_ranks where rank_id='$rank_id'");
    list($rank_title, $rank_min, $rank_max, $rank_special, $rank_image) = mysql_fetch_row($result);
    OpenTable();
JavaAvatar();
    echo "
    <center><font size=\"4\"><b>"._BBRANKEDIT."</b></font></center>
    <form name=\"bbaranks\" action=\"admin.php\" method=\"post\">
    <input type=\"hidden\" name=\"rank_id\" value=\"$rank_id\">
    <table border=\"0\" width=\"100%\">
    <tr><td>"._BBRANKTITLE." </td><td><input type=\"text\" name=\"rank_title\" size=\"31\" value=\"$rank_title\"></td></tr>";
    if ($rank_special == 1) {
    echo "<tr><td>"._BBRANKSPEC." </td><td>"._ACTIVE."</td></tr>
    <input type=\"hidden\" name=\"rank_min\" value=\"$rank_min\">
    <input type=hidden name=\"rank_max\" value=\"$rank_max\">
    <input type=hidden name=\"rank_special\" value=\"$rank_special\">";
    } else {
    echo "<tr><td>"._BBRANKMINP." </td><td><input type=\"text\" name=\"rank_min\" size=\"3\" value=\"$rank_min\"></td></tr>
    <tr><td>"._BBRANKMAXP." </td><td><input type=\"text\" name=\"rank_max\" size=\"3\" value=\"$rank_max\"></td></tr>
    <tr><td>"._BBRANKSPEC." </td><td><input type=\"checkbox\" name=\"rank_special\" value=\"1\"></td></tr>";
    }
        echo"
    <tr><td>"._IMAGES." </td>
        <td><select name=\"image\" onChange=\"showimage()\">\n";
        $direktori = "images/forum/special";
        $handle=opendir($direktori);
        while ($file = readdir($handle)) {
            $filelist[] = $file;
        }
        asort($filelist);
        while (list ($key, $file) = each ($filelist)) {
            ereg(".gif|.jpg",$file);
            if ($file == "." || $file == ".." || $file == "index.html") {
                $a=1;
            } else {
                    if ($file == $rank_image) {
                echo "<option value=\"$file\" selected>$file</option>\n";
                } else {
                echo "<option value=\"$file\">$file</option>\n";
                }
                }
        }
        echo "
        </select></td></tr>
    <tr><td>&nbsp;</td><td><img src=\"images/forum/special/$rank_image\" name=\"bbarankimage\" alt=\"\"></td></tr>
    <tr><td>&nbsp;</td><td><input type=\"submit\" value=\""._SAVE."\"></td></tr>
    <input type=\"hidden\" name=\"op\" value=\"RankForumSave\">
    </table>
    </form>";
    CloseTable();
    include("footer.php");
}

function RankForumSave($rank_id, $rank_title, $rank_min, $rank_max, $rank_special, $image) {
    global $prefix, $dbi;
    $rank_title = addslashes($rank_title);
    mysql_query("update ".$prefix."_ranks set rank_title='$rank_title',rank_min='$rank_min',rank_max='$rank_max',rank_special='$rank_special', rank_image='$image' where rank_id='$rank_id'");
    Header("Location: admin.php?op=RankForumAdmin");
}

function RankForumDel($rank_id, $ok=0) {
    global $prefix, $dbi;
    if($ok==1) {
        mysql_query("delete from ".$prefix."_ranks where rank_id=$rank_id");
        Header("Location: admin.php?op=ForumAdmin");
    } else {
        include("header.php");
        GraphicAdmin();
	title(""._FORUMSADMIN."");
        OpenTable();
        echo "<center><br>";
        echo "<b>"._BBRANKDEL."</b><br><br>";
    }
        echo "[ <a href=\"admin.php?op=RankForumDel&rank_id=$rank_id&ok=1\">"._YES."</a> | <a href=\"admin.php?op=RankForumAdmin\">"._NO."</a> ]<br><br>";
        CloseTable();
        include("footer.php");
}

switch ($op) {

    case "ForumMainMenu":
    ForumMainMenu();
    break;

    case "PrivDelUser":
    PrivDelUser($forum_id,$userid);
    break;

    case "PrivPostRevForum":
    PrivPostRevForum($forum_id,$userid,$do);
    break;

    case "PrivClearUser":
    PrivClearUser($forum_id);
    break;

    case "PrivAddUser":
    PrivAddUser($userids, $forum_id);
    break;

    case "PrivForumUser":
    PrivForumUser($forum_id);
    break;

    case "ForumCatOrder":
    ForumCatOrder($cat_id,$cat_order,$lastid,$changes);
    break;

    case "ForumGoAdd":
    ForumGoAdd($forum_name, $forum_desc, $forum_access, $moderator, $cat_id, $forum_type);
    break;

    case "ForumGoSave":
    ForumGoSave($forum_id, $forum_name, $forum_desc, $forum_access, $moderator, $rem_mods, $cat_id, $forum_type);
    break;

    case "ForumCatDel":
    ForumCatDel($cat_id, $ok);
    break;

    case "ForumGoDel":
    ForumGoDel($forum_id, $ok);
    break;
			
    case "ForumCatSave":
    ForumCatSave($cat_id, $cat_title);
    break;

    case "ForumCatEdit":
    ForumCatEdit($cat_id);
    break;

    case "ForumGoEdit":
    ForumGoEdit($forum_id);
    break;
			
    case "ForumGo":
    ForumGo($cat_id,$ctg);
    break;

    case "ForumCatAdd":
    ForumCatAdd($catagories);
    break;

    case "ForumAdmin":
    ForumAdmin();
    break;

    case "BanSave":
    BanSave($ban_id, $ipusername, $durtype, $duration, $banby);
    break;

    case "BanEdit":
    BanEdit($ban_id,$banby);
    break;

    case "BanDel":
    BanDel($ban_id,$ok);
    break;

    case "BanAdd":
    BanAdd($ipusername, $banby, $duration, $durtype);
    break;

    case "ForumBanAdmin":
    ForumBanAdmin();
    break;

    case "WordForumDel":
    WordForumDel($word_id, $ok);
    break;

    case "WordForumSave":
    WordForumSave($word_id, $word, $replacement);
    break;

    case "WordForumEdit":
    WordForumEdit($word_id);
    break;

    case "WordForumAdd":
    WordForumAdd($word, $replacement);
    break;

    case "ForumCensorAdmin":
    ForumCensorAdmin();
    break;

    case "ForumConfigAdmin":
    ForumConfigAdmin();
    break;

    case "ForumConfigChange":
    ForumConfigChange($allow_html,$allow_bbcode,$allow_sig,$posts_per_page,$hot_threshold,$topics_per_page,$email_sig,$email_from);
    break;

    case "ForumManager":
    ForumManagerAdmin();
    break;
		
    case "ForumSmiliesEdit":
    ForumSmiliesEdit($id);
    break;

    case "ForumSmiliesSave":
    ForumSmiliesSave($id,$code,$smile_url,$emotion,$active);
    break;

    case "ForumSmiliesAdd":
    ForumSmiliesAdd($code,$smile_url,$emotion,$active);
    break;

    case "ForumSmiliesDel":
    ForumSmiliesDel($id,$ok);
    break;

    case "RankForumAdmin":
    RankForumAdmin();
    break;
		
    case "RankForumEdit":
    RankForumEdit($rank_id);
    break;

    case "RankForumDel":
    RankForumDel($rank_id, $ok);
    break;

    case "RankForumAdd":
    RankForumAdd($rank_title,$rank_min,$rank_max,$rank_special,$image);
    break;			

    case "RankForumSave":
    RankForumSave($rank_id, $rank_title, $rank_min, $rank_max, $rank_special, $image);
    break;

}

} else {
    echo "Access Denied";
}

?>