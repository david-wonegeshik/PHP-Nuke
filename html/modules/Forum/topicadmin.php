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

if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

$index = 0;

include("modules/".$module_name."/bbconfig.php");
include("modules/".$module_name."/functions.php");
include("modules/".$module_name."/auth.php");
include("header.php");
title("$sitename: "._FORUMS."");
OpenTable();

$pagetype = "topicadmin";

include("modules/".$module_name."/page_header.php");

if (isset($user))
{
$user = base64_decode($user);
$user = explode(":", $user);
        $mod_data = get_userdata_from_id($user[0], $db);
} else {
        $mod_data = get_userdata_from_id($userdata[uid], $db);
}

if(!is_moderator($forum, $mod_data[uid], $db) && $mod_data[user_level] <= 2)
        error_die("You are not the moderator of this forum therefore you cannot perform this function.$mod_data[uid], $mod_data[user_level]");
#        error_die("You are not the moderator of this forum therefore you cannot perform this function.");

if($submit || ($user_logged_in==1 && $mode=='viewip')) {
                if (!$system) {
                        $md_pass = crypt($password,substr($userdata[pass],0,2));
                } else {
                         $md_pass = $password;
                }
   if( $user_logged_in != 1 && ($mod_data[pass] != $md_pass) )
     error_die("Error - You did not enter the correct password, please go back and try again.");

   switch($mode) {
    case 'del':
      // Update the users's post count, this might be slow on big topics but it makes other parts of the
      // forum faster so we win out in the long run.
      $sql = "SELECT poster_id, post_id FROM ".$prefix."_posts WHERE topic_id = '$topic'";
      if(!$r = mysql_query($sql))
                        die("Error - Could not query the posts database!");
      while($row = mysql_fetch_array($r)) {
                         if($row[poster_id] != 1) {
                            $sql = "UPDATE ".$user_prefix."_users SET user_posts = user_posts - 1 WHERE uid = '$row[poster_id]'";
                            @mysql_query($sql);
                         }
      }

                // Get the post ID's we have to remove.
                $sql = "SELECT post_id FROM ".$prefix."_posts WHERE topic_id = '$topic'";
                if(!$r = mysql_query($sql))
                        die("Error - Could not query the posts database!");
      while($row = mysql_fetch_array($r))
      {
                        $posts_to_remove[] = $row["post_id"];
                }

      $sql = "DELETE FROM ".$prefix."_posts WHERE topic_id = '$topic'";
      if(!$result = mysql_query($sql))
                        die("Error - Could not remove posts from the database!");
      $sql = "DELETE FROM ".$prefix."_bbtopics WHERE topic_id = '$topic'";
      if(!$result = mysql_query($sql))
                        die("Error - Could not remove posts from the database!");
                $sql = "DELETE FROM ".$prefix."_posts_text WHERE ";
                for($x = 0; $x < count($posts_to_remove); $x++)
                {
                        if($set)
                        {
                                $sql .= " OR ";
                        }
                        $sql .= "post_id = ".$posts_to_remove[$x];
                        $set = TRUE;
                }

                if(!mysql_query($sql))
                {
                        die("Error - Could not remove post texts!");
                }
                sync($db, $forum, 'forum');

      echo "The topic has been removed from the database. Click <a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum\">here</a> to return to the forum, or <a href=\"modules.php?op=modload&name=".$module_name."&file=index\">here</a> to return to the forum index.";
      break;
    case 'move':
      $sql = "UPDATE ".$prefix."_bbtopics SET forum_id = '$newforum' WHERE topic_id = '$topic'";
      if(!$r = mysql_query($sql))
                        die("Error - Could not move selected topic to selected forum. Please go back and try again.");
      $sql = "UPDATE ".$prefix."_posts SET forum_id = '$newforum' WHERE topic_id = '$topic'";
      if(!$r = mysql_query($sql))
                        die("Error - Could not move selected topic to selected forum. Please go back and try again.");
                sync($db, $newforum, 'forum');
                sync($db, $forum, 'forum');

      echo "The topic has been moved. Click <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$newforum\">here</a> to view the updated topic. Or click <a href=\"modules.php?op=modload&name=".$module_name."&file=index\">here</a> to return to the forum index";
      break;
    case 'lock':
      $sql = "UPDATE ".$prefix."_bbtopics SET topic_status = 1 WHERE topic_id = '$topic'";
      if(!$r = mysql_query($sql))
                        die("Error - Could not lock the selected topic. Please go back and try again.");
      echo "The topic has been locked. Click <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum\">here</a> to view, or <a href=\"modules.php?op=modload&name=".$module_name."&file=index\">here</a> to return to the forum index.";
      break;
    case 'unlock':
      $sql = "UPDATE ".$prefix."_bbtopics SET topic_status = '0' WHERE topic_id = '$topic'";
      if(!$r = mysql_query($sql))
        die("Error - Could not unlock the selected topic. Please go back and try again.");
      echo "The topic has been unlocked. Click <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum\">here</a> to view, or <a href=\"modules.php?op=modload&name=".$module_name."&file=index\">here</a> to return to the forum index.";
      break;
    case 'viewip':
      $sql = "SELECT u.uname, p.poster_ip FROM ".$prefix."_users u, ".$prefix."_posts p WHERE p.post_id = '$post' AND u.uid = p.poster_id";
      if(!$r = mysql_query($sql))
        die("Error - Could not query the database. <BR>Error: mysql_error()");
      if(!$m = mysql_fetch_array($r))
        die("Error - No such user or post in the database.");
      $poster_host = gethostbyaddr($m[poster_ip]);
?>
<TABLE BORDER="0" CELLPADDING="1" CELLSPACEING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="95%"><TR><TD BGCOLOR="<?php echo $table_bgcolor?>">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACEING="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
        <TD COLSPAN="2" ALIGN="CENTER">Users IP and Account information</TD>
</TR>
<TR BGCOLOR="<?php echo $color2?>" ALIGN="LEFT">
        <TD>User IP:</TD>
        <TD><?php echo $m[poster_ip] . " ( $poster_host )"?></TD>
</TR>
<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
        <TD COLSPAN="2" ALIGN="CENTER">Usernames of users that posted from this IP + post counts</TD>
</TR>
<?php
        $sql = "SELECT uid, uname, count(*) as postcount FROM ".$prefix."_posts p, ".$prefix."_users u WHERE poster_ip='".$m[poster_ip]."' && p.poster_id = u.uid GROUP BY uid";
        if(!$r = mysql_query($sql))
        {
                echo "<TR><TD COLSPAN=\"2\">Error - Could not query the database. <BR>Error: mysql_error()</TD></TR></TABLE>";
                exit();
        }

        while ($row = mysql_fetch_array($r)){
                print "<TR BGCOLOR=\"$color2\" ALIGN=\"LEFT\">\n";
                print "        <TD><A HREF=\"modules.php?name=Your_Account&amp;op=userinfo&uname=".$row[uname]."\">".$row[uname]."</A></TD>\n";
                print "        <TD>".$row[postcount]." posts</TD>\n";
                print "</TR>\n";
        }
?>

</TABLE></TD></TR></TABLE>
<?php
                break;

        }
}
else {  // No submit
?>
<FORM ACTION="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=topicadmin" METHOD="POST">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="95%"><TR><TD  BGCOLOR="<?php echo $table_bgcolor?>">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $color1?>" ALIGN="LEFT">
<?php
        switch($mode) {
                case 'del':
?>
        <TD COLSPAN=2><B>Read This:</b>Once you press the delete button at the bottom of this form the topic you have selected, and all its related posts, will be <b>permanently</b> removed.</TD>
<?php
                break;
                case 'move':
?>
        <TD COLSPAN=2><B>Read This:</b>Once you press the move button at the bottom of this form the topic you have selected, and its related posts, will be moved to the forum you have selected.</TD>
<?php
                break;
                case 'lock':
?>
        <TD COLSPAN=2><B>Read This:</b>Once you press the lock button at the bottom of this form the topic you have selected will be locked. You may unlock it at a later time if you like.</TD>
<?php
                break;
                case 'unlock':
?>
        <TD COLSPAN=2><B>Read This:</b>Once you press the unlock button at the bottom of this form the topic you have selected will be unlocked. You may lock it again at a later time if you like.</TD>
<?php
                break;
                case 'viewip':
?>
        <TD COLSPAN=2><B>Read This:</b>View this users IP address.</TD>
<?php
                break;
        }
?>
</TR>
<?php
        if (!$user_logged_in)
        {
?>
<TR>
        <TD BGCOLOR="<?php echo $color1?>">Username:</TD>
        <TD BGCOLOR="<?php echo $color2?>"><INPUT TYPE="TEXT" NAME="user" SIZE="25" MAXLENGTH="40" VALUE="<?php echo $userdata[username]?>"></TD>
</TR>
<TR>
        <TD BGCOLOR="<?php echo $color1?>">Password:</TD>
        <TD BGCOLOR="<?php echo $color2?>"><INPUT TYPE="PASSWORD" NAME="passwd" SIZE="25" MAXLENGTH="25"></TD>
</TR>
<?php
        }
        if($mode == 'move') {
?>
<TR>
        <TD BGCOLOR="<?php echo $color1?>">Move Topic To:</TD>
        <TD BGCOLOR="<?php echo $color2?>"><SELECT NAME="newforum" SIZE="0">
<?php
        $sql = "SELECT forum_id, forum_name FROM ".$prefix."_forums WHERE forum_id != '$forum' ORDER BY forum_id";
        if($result = mysql_query($sql)) {
                if($myrow = mysql_fetch_array($result)) {
                        do {
                                echo "<OPTION VALUE=\"$myrow[forum_id]\">$myrow[forum_name]</OPTION>\n";
                        } while($myrow = mysql_fetch_array($result));
                }
                else {
                        echo "<OPTION VALUE=\"-1\">No Forums in DB</OPTION>\n";
                }
        }
        else {
                echo "<OPTION VALUE=\"-1\">Database Error</OPTION>\n";
        }
?>
        </SELECT></TD>
</TR>
<?php
        }
?>
<TR BGCOLOR="<?php echo $color1?>">
        <TD COLSPAN="2" ALIGN="CENTER">
<?php
        switch($mode) {
                case 'del':
?>
                <INPUT TYPE="HIDDEN" NAME="mode" VALUE="del">
                <INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Delete Topic">
<?php
                break;
                case 'move':
?>
                <INPUT TYPE="HIDDEN" NAME="mode" VALUE="move">
                <INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Move Topic">
<?php
                break;
                case 'lock':
?>
                <INPUT TYPE="HIDDEN" NAME="mode" VALUE="lock">
                <INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Lock Topic">
<?php
                break;
                case 'unlock':
?>
                <INPUT TYPE="HIDDEN" NAME="mode" VALUE="unlock">
                <INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="Unlock Topic">
<?php
                break;
                case 'viewip':
?>
                <INPUT TYPE="HIDDEN" NAME="mode" VALUE="viewip">
                <INPUT TYPE="HIDDEN" NAME="post" VALUE="<?php echo $post?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="View IP">
<?php
                break;
        }
?>
</TD></TR>
</FORM>
</TABLE></TD></TR></TABLE></TD></TR></TABLE>
<?php
}
CloseTable();
include('footer.php');
?>