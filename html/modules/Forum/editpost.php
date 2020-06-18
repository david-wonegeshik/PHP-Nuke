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

$forumpage=1;

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
$pagetitle = "Edit Post";
$pagetype = "index";

if($submit) {
    $sql = "SELECT * FROM ".$prefix."_posts WHERE post_id = '$post_id'";
    if (!$result = sql_query($sql, $dbi)) die($err_db_retrieve_data);
    if (sql_num_rows($result, $dbi) <= 0) die($err_db_retrieve_data);
    $myrow = sql_fetch_array($result, $dbi);
    $poster_id = $myrow[poster_id];
    $forum_id = $myrow[forum_id];
    $topic_id = $myrow[topic_id];
    $this_post_time = $myrow['post_time'];
    list($day, $time) = split(" ", $myrow[post_time]);
    $posterdata = get_userdata_from_id($poster_id, $db);
    $userdata = get_userdata_from_id($poster_id, $db);
    $date = strftime(_MONTHDATETIME);
    $username=$userdata[uname];

    if ($user_logged_in) {
	if($userdata[uid] != $posterdata[uid]) {
    	    if ($userdata[user_level] == 1) {
        	include("modules/".$module_name."/page_header.php");
        	$die = 1;
            } elseif ($userdata[user_level] == 2 && !is_moderator($forum_id, $userdata[uid], $db)) {
        	include("modules/".$module_name."/page_header.php");
        	error_die(""._NOTEDIT."");
            }
        }
    } else {
	$userdata = get_userdata($username, $db);
        if(is_banned($userdata[uid], "username", $db)) {
	    error_die(""._BANNED."");
        }
	$dbpass=$posterdata[pass];
	$non_crypt_pass = $passwd;
  	$old_crypt_pass = crypt($passwd,substr($dbpass,0,2));
	$new_pass = md5($passwd);
	$md_passwd = md5($passwd);
	if (($dbpass == $non_crypt_pass) OR ($dbpass == $old_crypt_pass)) {
	    sql_query("update ".$user_prefix."_users set pass='$new_pass' WHERE uname='$uname'", $dbi);
	    $result = sql_query("select pass from ".$user_prefix."_users where uname='$uname'", $dbi);
	    list($dbpass) = sql_fetch_row($result, $dbi);
	}
	if ($dbpass != $new_pass) {
	    include("modules/".$module_name."/page_header.php");
	    error_die(""._BBWRONGPASS." "._BBTRYAGAIN."");
	}
        if($posterdata[uid] == $userdata[uid]) {
    	    if($md_passwd != $posterdata[pass]) {
        	$die = 1;
            }
	} elseif ($userdata[user_level] == 2 && is_moderator($forum_id, $userdata[uid], $db)) {
    	    if($md_passwd != $userdata[pass]) {
        	$die = 1;
            }
        } elseif ($userdata[user_level] > 2) {
    	    if($md_passwd != $userdata[pass]) {
        	$die = 1;
            }
        } else {
    	    $die = 1;
        }
   }
    if($die == 1) {
	include("modules/".$module_name."/page_header.php");
        error_die(""._PERMDENY."");
    }

    $is_html_disabled = false;
    if ($allow_html == 0 || isset($html)) {
	$message = htmlspecialchars($message);
        $is_html_disabled = true;
    }
    if ($allow_bbcode == 1 && !isset($bbcode)) {
	$message = bbencode($message, $is_html_disabled);
    }
    if (!$smile) {
	$message = smile($message);
    }
    $message = make_clickable($message);
    $message = str_replace("\n", "<BR>", $message);
    $edit_by = ""._BBEDITEDBY."";
    $on_date = ""._BBONDATE."";
    $message = preg_replace("#&lt;font\ size\=-1&gt;\[\ $edit_by(.*?)\ \]&lt;/font&gt;#si", '<font size=-1>[ ' . $edit_by . '\1 ]</font>', $message);
    $message .= "<BR><BR><font size=-1>[ $edit_by $username $on_date $date ]</font>";
    $message = censor_string($message, $db);
    $message = addslashes($message);
    if(!$delete) {
	$forward = 1;
        $topic = $topic_id;
        $forum = $forum_id;
        include("modules/".$module_name."/page_header.php");
        $sql = "UPDATE ".$prefix."_posts_text SET post_text = '$message' WHERE (post_id = '$post_id')";
        if(!$result = sql_query($sql, $dbi)) {
    	    error_die("Unable to update the posting in the database");
	}
        $subject = strip_tags($subject);
        if(isset($subject) && (trim($subject) != '')) {
    	    if(!isset($notify)) {
        	$notify = 0;
            } else {
                $notify = 1;
	    }
            $subject = censor_string($subject, $db);
            $subject = addslashes($subject);
            $sql = "UPDATE ".$prefix."_bbtopics SET topic_title = '$subject', topic_notify = '$notify' WHERE topic_id = '$topic_id'";
            if(!$result = sql_query($sql, $dbi)) {
        	error_die("Unable to update the topic subject in the database");
            }
        }
        echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" cellspacing=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\">";
        echo "<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" cellspacing=\"1\" WIDTH=\"100%\">";
        echo "<TR BGCOLOR=\"$bgcolor1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>";
        echo "<P><BR><center>"._BBSTORED."<ul>"._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic_id&forum=$forum_id\">"._BBHERE."</a> "._BBVIEWMSG."<P>"._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum_id\">"._BBHERE."</a> "._BBRETURNTOPIC."</ul></center><P></font>";
        $total = get_total_posts($topic, $db, "topic");
        if($total > $posts_per_page) {
    	    $start = floor ($total / $posts_per_page) * $posts_per_page ;
            $page = "modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&start=$start";
        } else {
	    $page = "modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum";
	}
?>
        <script language="Javascript" type="text/javascript">
        <!--
        function gotoThread(){
        window.location.href="<?php print "$page" ?>";
        }
        window.setTimeout("gotoThread()", 3000);
        //-->
        </script>
<?php
	echo "</TD></TR></TABLE></TD></TR></TABLE><br>";
    } else {
	$now_hour = date("H");
        $now_min = date("i");
        list($hour, $min) = split(":", $time);
        if (!((($now_hour == $hour && $min_now - 30 < $min) || ($now_hour == $hour +1 && $now_min - 30 > 0)) || ($userdata[user_level] > 2 || is_moderator($forum, $userdata[uid], $db)))) {
    	    include("modules/".$module_name."/page_header.php");
            error_die(""._PERMDENY."");
        }
        include("modules/".$module_name."/page_header.php");
        $last_post_in_thread = get_last_post($topic_id, $db, "time_fix");
        $sql = "DELETE FROM ".$prefix."_posts WHERE post_id = '$post_id'";
        if(!$r = sql_query($sql, $dbi)) {
    	    error_die("Couldn't delete post from database");
        }
        $sql = "DELETE FROM ".$prefix."_posts_text WHERE post_id = '$post_id'";
        if(!$r = sql_query($sql, $dbi)) {
    	    error_die("Couldn't delete post from database");
        } elseif ($last_post_in_thread == $this_post_time) {
    	    $topic_time_fixed = get_last_post($topic_id, $db, "time_fix");
            $sql = "UPDATE ".$prefix."_bbtopics SET topic_time = '$topic_time_fixed' WHERE topic_id = '$topic_id'";
    	    if(!$r = sql_query($sql, $dbi)) {
        	error_die("Couldn't update to previous post time - last post has been removed");
            }
        }
        if(get_total_posts($topic_id, $db, "topic") == 0) {
    	    $sql = "DELETE FROM ".$prefix."_bbtopics WHERE topic_id = '$topic_id'";
            if(!$r = sql_query($sql, $dbi)) {
        	error_die("Couldn't delete topic from database");
	    }
            $topic_removed = TRUE;
        }
        if($posterdata[uid] != 1) {
    	    $sql = "UPDATE ".$user_prefix."_users SET user_posts = user_posts - 1 WHERE uid = $posterdata[uid]";
    	    if(!$r = sql_query($sql, $dbi)) {
    		error_die("Couldn't change user post count.");
            }
        }
        sync($db, $forum, 'forum');
        if(!$topic_removed) {
    	    sync($db, $topic_id, 'topic');
        }
        echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" cellspacing=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\" WIDTH=\"$TableWidth\">";
        echo "<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" cellspacing=\"1\" WIDTH=\"100%\">";
        echo "<TR BGCOLOR=\"$bgcolor1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>";
        echo "<P><BR><center>"._BBDELETED." <ul>"._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum_id\">"._BBHERE."</a> "._BBRETURNTOPIC."<p>"._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=index\">"._BBHERE."</a>"._BBRETURNINDEX."</ul></center><P></font>";
        echo "</TD></TR></TABLE></TD></TR></TABLE><br>";
    }
} else {
    $sql = "SELECT f.forum_type, f.forum_name, t.topic_title FROM ".$prefix."_forums f, ".$prefix."_bbtopics t WHERE (f.forum_id = '$forum') AND (t.topic_id = $topic) AND (t.forum_id = f.forum_id)";
    if(!$result = sql_query($sql, $dbi)) {
	error_die("Couldn't get forum and topic information from the database.");
    }
    if(!$myrow = sql_fetch_array($result, $dbi)) {
	error_die("Error - The forum/topic you selected does not exist. Please go back and try again.");
    }
    if(($myrow[forum_type] == 1) && !$user_logged_in && !$logging_in) {
	require("modules/".$module_name."/page_header.php");
?>
    <FORM ACTION="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=editpost" METHOD="POST">
        <TABLE BORDER="0" CELLPADDING="1" cellspacing="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>">
                <TR>
                        <TD BGCOLOR="<?php echo $table_bgcolor?>">
                                <TABLE BORDER="0" CELLPADDING="1" cellspacing="1" WIDTH="100%">
                                        <TR BGCOLOR="<?php echo $bgcolor1?>" ALIGN="LEFT">
                                                <TD ALIGN="CENTER"><?php echo ""._BBPRIVATE."";?></TD>
                                        </TR>
                                        <TR BGCOLOR="<?php echo $bgcolor2?>" ALIGN="LEFT">
                                                <TD ALIGN="CENTER">
                                                        <TABLE BORDER="0" CELLPADDING="1" cellspacing="0">
                                                          <TR>
                                                            <TD>
                                                              <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
                                                              <b><?php echo ""._BBUSERNAME."";?>: &nbsp;</b></font></TD><TD><INPUT TYPE="TEXT" NAME="username" SIZE="25" MAXLENGTH="40" VALUE="<?php echo $userdata[username]?>">
                                                            </TD>
                                                          </TR><TR>
                                                            <TD>
                                                              <FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $textcolor?>">
                                                              <b><?php echo ""._BBPASSWORD."";?>: </b></TD><TD><INPUT TYPE="PASSWORD" NAME="password" SIZE="25" MAXLENGTH="25">
                                                            </TD>
                                                          </TR>
                                                        </TABLE>
                                                </TD>
                                        </TR>
                                        <TR BGCOLOR="<?php echo $bgcolor1?>" ALIGN="LEFT">
                                                <TD ALIGN="CENTER">
                                                        <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                                                        <INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
                                                        <INPUT TYPE="HIDDEN" NAME="post_id" VALUE="<?php echo $post_id?>">
                                                        <INPUT TYPE="SUBMIT" NAME="logging_in" VALUE="<?php echo ""._BBENTER."";?>">
                                                </TD>
                                        </TR>
                                </TABLE>
                        </TD>
                </TR>
        </TABLE>
</FORM>
<?php
        include("footer.php");
        exit();
        }
        else
        {
                if ($logging_in)
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
                                erroe_die(""._BBWRONGPASS." "._BBTRYAGAIN."");
                        }

                        /* if we get here, user has entered a valid username and password combination. */

                $userdata = get_userdata($username, $db);
                $info = base64_encode("$userdata[uid]:$userdata[uname]:$userdata[pass]:$userdata[storynum]:$userdata[umode]:$userdata[uorder]:$userdata[hold]:$userdata[noscore]:$userdata[ublockon]:$userdata[theme]:$userdata[commentmax]");
                setcookie("user","$info",time()+15552000);
                }

                require("modules/".$module_name."/page_header.php");

                if ($myrow[forum_type] == 1)
                {
                        // To get here, we have a logged-in user. So, check whether that user is allowed to post in
                        // this private forum.

                        if (!check_priv_forum_auth($userdata[uid], $forum, TRUE, $db))
                        {
                                error_die(""._BBPRIVATEFORUM." "._BBNOPOST."");
                        }

                        // Ok, looks like we're good.
                }

        }

   $sql = "SELECT p.*, pt.post_text, u.uname, u.uid, u.user_sig, t.topic_title, t.topic_notify
                           FROM ".$prefix."_posts p, ".$prefix."_users u, ".$prefix."_bbtopics t, ".$prefix."_posts_text pt
                           WHERE (p.post_id = '$post_id')
                           AND pt.post_id = p.post_id
                           AND (p.topic_id = t.topic_id)
                           AND (p.poster_id = u.uid)";

   if(!$result = sql_query($sql, $dbi))
                error_die("Couldn't get user and topic information from the database.<br>$sql");
   $myrow = sql_fetch_array($result, $dbi);
   // Freekin' ugly but I couldn't get it to work right as 1 big if
   //          - James
   if ($user_logged_in) {
      if($userdata[user_level] <= 2) {
         if($userdata[user_level] == 2 && !is_moderator($forum, $userdata[uid], $db)) {
            if($userdata[user_level] < 2 && ($userdata[uid] != $myrow[user_id]))
                         error_die(""._BBNOTEEDIT."");
         }
      }
   }

   $message = $myrow[post_text];
   if(eregi("\[addsig]$", $message))
     $addsig = 1;
   else
     $addsig = 0;
   $message = eregi_replace("\[addsig]$", "\n_________________\n" . $myrow[user_sig], $message);
   $message = str_replace("<BR>", "\n", $message);
   $message = stripslashes($message);
   $message = desmile($message);
   $message = bbdecode($message);
   $message = undo_make_clickable($message);
   $message = undo_htmlspecialchars($message);

   // Special handling for </textarea> tags in the message, which can break the editing form..
   $message = preg_replace('#</textarea>#si', '&lt;/TEXTAREA&gt;', $message);

   list($day, $time) = split(" ", $myrow[post_time]);
?>
<FORM ACTION="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=editpost" METHOD="POST" NAME="coolsus">
<TABLE BORDER="0" CELLPADDING="1" cellspacing="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>"><TR><TD  BGCOLOR="<?php echo $table_bgcolor?>">
<TABLE BORDER="0" CELLPADDING="3" cellspacing="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $bgcolor1?>" ALIGN="LEFT">
        <TD ALIGN="CENTER" COLSPAN="2"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo $pagetitle?></b></TD>
</TR>
<?php
     if(!$user_logged_in) {
?>
<TR>
        <TD BGCOLOR="<?php echo $bgcolor1?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBUSERNAME."";?>:</TD>
        <TD BGCOLOR="<?php echo $bgcolor2?>"><input type="text" name="username" value="<?php echo $userdata[username]?>" size="20"></TD>
</TR>
<?PHP
     }
   else {
?>
        <TD BGCOLOR="<?php echo $bgcolor1?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBUSERNAME."";?></b>:</TD>
        <TD BGCOLOR="<?php echo $bgcolor2?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo $userdata[username]?></TD>
<?php
   }
        if (!$user_logged_in) {
                // ask for a password..
           echo "<TR> \n";
           echo "<TD BGCOLOR=\"$bgcolor1\"><font size=\"$FontSize2\" face=\"$FontFace\">"._BBPASSWORD.":<BR><font size=\"$FontSize3\"><i><a href=\"modules.php?name=Your_Account\" target=\"_blank\">("._BBPASSWDLOST.")</a></i></font></TD>";
           echo "<TD BGCOLOR=\"$bgcolor2\"><INPUT TYPE=\"PASSWORD\" NAME=\"passwd\" SIZE=\"20\" MAXLENGTH=\"25\"></TD> \n";
           echo "</TR> \n";
        }
   $first_post = is_first_post($topic, $post_id, $db);
   if($first_post) {
?>
<TR>
        <TD BGCOLOR="<?php echo $bgcolor1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBSUBJECT."";?>:</b></TD>
        <TD BGCOLOR="<?php echo $bgcolor2?>"><INPUT TYPE="TEXT" NAME="subject"  SIZE="50" MAXLENGTH="100" VALUE="<?php echo stripslashes($myrow[topic_title])?>"></TD>
</TR>
<?php
   }
?>
<TR>
     <TD  BGCOLOR="<?php echo $bgcolor1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBBODY."";?>:</b><br><br>
     <font size=-1>
<?php
     echo ""._BBHTMLIS.": ";
   if($allow_html == 1)
     echo ""._BBON."<BR>\n";
   else
     echo ""._BBOFF."<BR>\n";
   echo ""._BBCODEIS.":";
   if($allow_bbcode == 1)
     echo ""._BBON."<br>\n";
   else
     echo ""._BBOFF."<BR>\n";
?>
     </font></TD>
     <TD BGCOLOR="<?php echo $bgcolor2?>"><TEXTAREA NAME="message" ROWS=10 COLS=45 WRAP="VIRTUAL"><?php echo $message?></TEXTAREA>
     </TD>
</TR>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBADDSMILIES.""; ?>:</b><br><br>
                </font></TD>
                <TD  BGCOLOR="<?php echo $bgcolor2?>"><?php putitems()?>
                </TD>
        </TR>
<TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBOPTION."";?>:</b></TD>
                <TD  BGCOLOR="<?php echo $bgcolor2?>" ><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
                <?php
                        $now_hour = date("H");
                        $now_min = date("i");
                        list($hour, $min) = split(":", $time);
                        if((($now_hour == $hour && $min_now - 30 < $min) || ($now_hour == $hour +1 && $now_min - 30 > 0)) || ($userdata[user_level] > 2 || is_moderator($forum, $userdata[uid], $db))) {
                ?>
                                <INPUT TYPE="CHECKBOX" NAME="delete"><?php echo ""._BBDELETE."";?><BR>
                <?php
                        }

                        if($allow_html == 1) {
                           if($userdata[user_html] == 1) {
                             $h = "CHECKED";
                                }
                                echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"html\" $n>"._BBDISABLE." "._BBHTML." "._BBONTHISPOST."<BR>";
                        }

                        if($allow_bbcode == 1) {
                           if($userdata[user_bbcode] == 1)
                             $b = "CHECKED";
                                echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"bbcode\" $b>"._BBDISABLE." <a href=\"modules.php?op=modload&name=".$module_name."&file=faq#bbcode\" target=\"_blank\"><i>"._BBCODE."</i></a> "._BBONTHISPOST."<BR>";
                        }

                        if($userdata[user_desmile] == 1){
                                $ds = "CHECKED";
                        }
                        echo "<INPUT TYPE=\"CHECKBOX\" NAME=\"smile\" $ds>"._BBDISABLE." <a href=\"modules.php?op=modload&name=".$module_name."&file=faq#smilies\" target=\"_blank\"><i>"._BBSMILIES."</i></a> "._BBONTHISPOST.".<BR>";

                        if($first_post) {
                                if($myrow[topic_notify] == 1){
                              $chk = "CHECKED";
                                }
                                 ?>
                                <INPUT TYPE="CHECKBOX" NAME="notify" <?php echo $chk?>> <?php echo ""._BBNOTIFY."";?>
                                <?php
                        }
                 ?>
            </TD>
        </TR>
<TR>
        <TD  BGCOLOR="<?php echo $bgcolor1?>" colspan="2" ALIGN="CENTER">
<?php if($user_logged_in) {
?>
     <INPUT TYPE="HIDDEN" NAME="username" VALUE="<?php echo $userdata[username]?>">
<?php
}
?>
        <INPUT TYPE="HIDDEN" NAME="post_id" VALUE="<?php echo $post_id?>">
        <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
        <!--<INPUT TYPE="HIDDEN" NAME="topic_id" VALUE="<?php echo $topic?>">
        <INPUT TYPE="HIDDEN" NAME="poster_id" VALUE="<?php echo $myrow[poster_id]?>">-->
        <INPUT TYPE="SUBMIT" NAME="submit" VALUE="<?php echo ""._BBSUBMIT."";?>">
        </TD>
</TR>
</TABLE></TD></TR></TABLE>
<?php
        // Topic review
        echo "<font size=\"$FontSize2\" face=\"$FontFace\">";
        echo "<BR><CENTER>";
        echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum\" target=\"_blank\"><b>"._BBTOPICREVIEW."</b></a>";
        echo "</CENTER><BR>";

}

CloseTable();
include("footer.php");

?>