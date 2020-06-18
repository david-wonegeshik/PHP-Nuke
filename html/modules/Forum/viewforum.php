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

$pagetitle = $l_viewforum;
$pagetype = "viewforum";

if($forum == -1)
  header("Location: $url_phpbb");

include("header.php");
title("$sitename: "._FORUMS."");
OpenTable();

$sql = "SELECT f.forum_type, f.forum_name FROM ".$prefix."_forums f WHERE forum_id = '$forum'";
if(!$result = mysql_query($sql))
        error_die("<font size=+1>An Error Occured</font><hr>Could not connect to the forums database.");
if(!$myrow = mysql_fetch_array($result))
        error_die("Error - The forum you selected does not exist. Please go back and try again.");
$forum_name = own_stripslashes($myrow[forum_name]);

// Note: page_header is included later on, because this page might need to send a cookie.

if(($myrow[forum_type] == 1) && !$user_logged_in && !$logging_in)
{
        require("modules/".$module_name."/page_header.php");
?>
<FORM ACTION="modules.php?name=Your_Account" METHOD="POST">
        <TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>">
                <TR>
                        <TD BGCOLOR="<?php echo $table_bgcolor?>">
                                <TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
                                        <TR BGCOLOR="<?php echo $bgcolor1?>" ALIGN="LEFT">
                                                <TD ALIGN="CENTER"><?php echo ""._BBPRIVATE."";?></TD>
                                        </TR>
                                        <TR BGCOLOR="<?php echo $bgcolor2?>" ALIGN="LEFT">
                                                <TD ALIGN="CENTER">
                                                        <TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0">
                                                          <TR>
                                                            <TD>
                                                              <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
                                                              <b><? echo ""._BBUSERNAME."";?>: &nbsp;</b></font></TD><TD><INPUT TYPE="TEXT" NAME="uname" SIZE="25" MAXLENGTH="40" VALUE="<?php echo $userdata[username]?>">
                                                            </TD>
                                                          </TR><TR>
                                                            <TD>
                                                              <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
                                                              <b><? echo ""._BBPASSWORD."";?>: </b></TD><TD><INPUT TYPE="PASSWORD" NAME="pass" SIZE="25" MAXLENGTH="25">
                                                            </TD>
                                                          </TR>
                                                        </TABLE>
                                                </TD>
                                        </TR>
                                        <TR BGCOLOR="<?php echo $bgcolor1?>" ALIGN="LEFT">
                                                <TD ALIGN="CENTER">
                                                        <INPUT TYPE="HIDDEN" NAME="op" VALUE="login">
                                                        <INPUT TYPE="SUBMIT" VALUE="<?php echo ""._BBENTER.""?>">
                                                </TD>
                                        </TR>
                                </TABLE>
                        </TD>
                </TR>
        </TABLE>
</FORM>
<?php
#require('page_tail.php');
exit();
}
else
{
        /* if ($logging_in)
        {
                if ($username == '' || $password == '')
                  {
                          error_die(""._BBUSERPASS." "._BBTRYAGAIN."");
                  }
                if (!check_username($username, $db))
                  {
                          error_die(""._BBNOUSER." "._BBTRYAGAIN."");
                  }
                if (!check_user_pw($username, $password, $db))
                  {
                          error_die(""._BBWRONGPASS." "._BBTRYAGAIN."");
                  }*/

                /* if we get here, user has entered a valid username and password combination. */



                #$sessid = new_session($userdata[user_id], $REMOTE_ADDR, $sesscookietime, $db);

                #set_session_cookie($sessid, $sesscookietime, $sesscookiename, $cookiepath, $cookiedomain, $cookiesecure);

        #}

        require("modules/".$module_name."/page_header.php");

        if ($myrow[forum_type] == 1)
        {
                // To get here, we have a logged-in user. So, check whether that user is allowed to view
                // this private forum.
                if (!check_priv_forum_auth($userdata[uid], $forum, FALSE, $db))
                {
                        error_die(""._BBPRIVATEFORUM." "._BBNOREAD."");
                }

                // Ok, looks like we're good.
        }

?>
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>"><TR><TD  BGCOLOR="<?php echo $bgcolor2?>">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $bgcolor2?>" ALIGN="LEFT">
        <TD WIDTH=2%>&nbsp;</TD>
        <TD><font face="<?php echo $FontFace?>" size="2"><B>&nbsp;<?php echo ""._BBTOPICS."";?></B></font></TD>
        <TD WIDTH=9% ALIGN="CENTER"><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><B><?php echo ""._BBREPLIES."";?></B></font></TD>
        <TD WIDTH=20% ALIGN="CENTER"><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><B>&nbsp;<?php echo ""._BBPOSTER."" ?></B></font></TD>
        <TD WIDTH=8% ALIGN="CENTER"><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><B><?php echo ""._BBVIEWS."";?></B></font></TD>
        <TD WIDTH=15% ALIGN="CENTER"><font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><B><?php echo ""._BBDATE."";?></B></font></TD>
</TR>
<?php
if(!$start) $start = 0;

$sql = "SELECT t.*, u.uname, u2.uname as last_poster, p.post_time FROM ".$prefix."_bbtopics t
        LEFT JOIN ".$prefix."_users u ON t.topic_poster = u.uid
        LEFT JOIN ".$prefix."_posts p ON t.topic_last_post_id = p.post_id
        LEFT JOIN ".$prefix."_users u2 ON p.poster_id = u2.uid
        WHERE t.forum_id = '$forum'
        ORDER BY topic_time DESC LIMIT $start, $topics_per_page";

if(!$result = mysql_query($sql))
        error_die("</table></table><font size=+1>An Error Occured</font><hr>phpBB could not query the topics database.<br>$sql");
$topics_start = $start;

if($myrow = mysql_fetch_array($result)) {
   do {
      echo"<TR>\n";
      $replys = $myrow["topic_replies"];
// Keledan begin
      $last_post[date_time] = strtotime($myrow["post_time"]);
      $last_post_datetime = $last_post[date_time];
      $last_post[user] =  $myrow["last_poster"];
      setlocale("LC_TIME", $locale);
      $last_post[date_time] = strftime(_LOCALDATETIME, $last_post[date_time]);
      $last_post[string] = $last_post[date_time]."<br>"._BBBY." ".$last_post[user];

      $last_post_datetime = $last_post[date_time];
// Keledan end
/*
      list($last_post_date, $last_post_time) = split(" ", $last_post_datetime);
      list($year, $month, $day) = explode("-", $last_post_date);
      list($hour, $min) = explode(":", $last_post_time);
      $last_post_time = mktime($hour, $min, 0, $month, $day, $year);
*/

                 if($replys >= $hot_threshold) {

                         if($last_post_time < $last_visit)
                                 $image = "$imagesdir/hot_folder.gif";
                         else
                                 $image = "$imagesdir/$hot_red_folder.gif";
                 }
                 else {
                         if($last_post_time < $last_visit)
                                 $image = "$imagesdir/folder.gif";
                         else
                                 $image = "$imagesdir/red_folder.gif";
                 }
                 if($myrow[topic_status] == 1)
                         $image = "$imagesdir/lock.gif";

      echo "<TD BGCOLOR=\"$bgcolor1\"><IMG SRC=\"$image\"></TD>\n";

      $topic_title = own_stripslashes($myrow[topic_title]);
                $pagination = '';
                $start = '';
                $topiclink = "modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$myrow[topic_id]&forum=$forum";
                if($replys+1 > $posts_per_page)
                {
                        $pagination .= "&nbsp;&nbsp;&nbsp;<font size=\"$FontSize3\" face=\"$FontFace\" color=\"$textcolor\">(<img src=\"$imagesdir/posticon.gif\">"._BBGOTOPAGE." ";
                        $pagenr = 1;
                        $skippages = 0;
                        for($x = 0; $x < $replys + 1; $x += $posts_per_page)
                        {
                                $lastpage = (($x + $posts_per_page) >= $replys + 1);

                                if($lastpage)
                                {
                                        $start = "&start=$x&$replys";
                                }
                                else
                                {
                                        if ($x != 0)
                                        {
                                                $start = "&start=$x";
                                        }
                                        $start .= "&" . ($x + $posts_per_page - 1);
                                }

                                if($pagenr > 3 && $skippages != 1)
                                {
                                        $pagination .= ", ... ";
                                        $skippages = 1;
                                }

                                if ($skippages != 1 || $lastpage)
                                {
                                        if ($x!=0) $pagination .= ", ";
                                        $pagination .= "<a href=\"$topiclink$start\">$pagenr</a>";
                                }

                                $pagenr++;
                        }
                        $pagination .= ")</font>";
                }

                $topiclink .= "&$replys";

      echo "<TD BGCOLOR=\"$bgcolor1\"><font face=\"$FontFace\" size=\"2\">&nbsp;<a href=\"$topiclink\">$topic_title</a></font>$pagination";

      echo "</TD>\n";
      echo "<TD BGCOLOR=\"$bgcolor1\" ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><font face=\"$FontFace\" size=\"$FontSize2\">$replys</font></TD>\n";
      echo "<TD BGCOLOR=\"$bgcolor1\" ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><font face=\"$FontFace\" size=\"$FontSize2\">$myrow[uname]</font></TD>\n";
      echo "<TD BGCOLOR=\"$bgcolor1\" ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><font face=\"$FontFace\" size=\"$FontSize2\">$myrow[topic_views]</font></TD>\n";
      echo "<TD BGCOLOR=\"$bgcolor1\" ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><font face=\"$FontFace\" size=\"$FontSize1\">$last_post[string]</font></TD></TR>\n";

   } while($myrow = mysql_fetch_array($result));
}
else {
        echo "<TD BGCOLOR=\"$bgcolor1\" colspan =\"6\" ALIGN=\"CENTER\">"._BBNOTOPICS."</TD></TR>\n";
}

?>
<TR ALIGN="LEFT" BGCOLOR="<?php echo $bgcolor1?>">
<TD COLSPAN="7" NOWRAP ><b><?php echo "<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBPMSG."</font>";?></b></TD></TR>
<TR ALIGN="LEFT" BGCOLOR="<?php echo $BgColor3?>">
<TD COLSPAN="7" NOWRAP >&nbsp;<img src="<? echo "$imagesdir";?>/inbox.gif" Alt="<?php echo ""._BBINBOX."\">&nbsp;<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><a href=\"modules..php?name=Private_Messages"."\">";?><?php echo ""._BBINBOX."";?></font></a><br>
<?

if (!is_user($user)) echo "&nbsp;<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBLOGIN."</font></TD></TR>";
else {
getusrinfo($user);
$total_messages = mysql_num_rows(mysql_query("SELECT msg_id FROM ".$prefix."_priv_msgs WHERE to_userid = '$userinfo[0]'"));
$new_messages = mysql_num_rows(mysql_query("SELECT msg_id FROM ".$prefix."_priv_msgs WHERE to_userid = '$userinfo[0]' AND read_msg='0'"));
echo "&nbsp;<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">";
if ($total_messages > 0) {
        if ($new_messages > 0) echo "$new_messages&nbsp;"._BBNEWPMSG." | ";
        else echo ""._BBNONEWPMSG." | ";
echo "$total_messages&nbsp;"._BBTOTALPMSG."</font>";
}
else echo ""._BBEMPTYPMSG.".</font>";
}
?>
</TD></TR>
</TD></TR>

</TABLE></TD></TR></TABLE>
<?
forumsearch();
?>
<TABLE ALIGN="CENTER" BORDER="0" WIDTH="<?php echo $TableWidth?>"><TR><TD VALIGN="TOP">
<font face="<?php echo $FontFace?>" size="<?php echo $FontSize1?>">
<IMG SRC="<?php echo "$imagesdir/red_folder.gif";?>"> = <?php echo ""._BBNEWPOSTS.""; ?> (<IMG SRC="<?php echo "$imagesdir/hot_red_folder.gif";?>"> = <?php echo ""._BBHOTTHRES."";?>)
<BR><IMG SRC="<?php echo "$imagesdir/folder.gif";?>"> = <?php echo ""._BBNONEPOSTS.""; ?> (<IMG SRC="<?php echo "$imagesdir/hot_folder.gif"; ?>"> = <?php echo ""._BBHOTTHRES."";?>)
<BR><IMG SRC="<?php echo "$imagesdir/lock.gif";?>"> = <?php echo ""._BBISLOCKED."";?>
</font></TD>
<TD ALIGN="RIGHT">
<?php
$sql = "SELECT count(*) AS total FROM ".$prefix."_bbtopics WHERE forum_id = '$forum'";
if(!$r = mysql_query($sql))
     error_die("Error could not contact the database!</TABLE></TABLE>");
list($all_topics) = mysql_fetch_array($r);
$count = 1;
$next = $topics_start + $topics_per_page;
$prev = $topics_start - $topics_per_page;
if($all_topics > $topics_per_page) {

    if ($topics_start > 1) {
	echo "<font size=-1>\n<a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum&start=$prev\">"._PREVIOUSPAGE."</a> | ";
    }
    if($next < $all_topics) {
	echo "<font size=-1>\n<a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum&start=$next\">"._NEXTPAGE."</a> | ";
    }
   for($x = 0; $x < $all_topics; $x++) {

      if(!($x % $topics_per_page)) {
         if($x == $topics_start)
           echo "$count\n";
         else
           echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum&start=$x\">$count</a>\n";
         $count++;
         if(!($count % 10)) echo "<BR>";
      }
   }
}
echo "<BR>\n";
make_jumpbox();
?>
</TD>
</TR></TABLE>

<?php
}
CloseTable();
include("footer.php");
?>