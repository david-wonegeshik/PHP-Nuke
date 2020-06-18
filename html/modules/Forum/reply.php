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
if(isset($cancel) && $cancel) {
    header("Location: modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum");
}

include("modules/".$module_name."/functions.php");
include("modules/".$module_name."/auth.php");
include("header.php");
title("$sitename: "._FORUMS."");
OpenTable();
$pagetype = "reply";

if ($post_id)
{
        // We have a post id, so include that in the checks..
        $sql = "SELECT f.forum_type, f.forum_name, f.forum_access ";
        $sql .= "FROM ".$prefix."_forums f, ".$prefix."_bbtopics t, ".$prefix."_posts p ";
        $sql .= "WHERE (f.forum_id = '$forum') AND (t.topic_id = $topic) AND (p.post_id = $post_id) AND (t.forum_id = f.forum_id) AND (p.forum_id = f.forum_id) AND (p.topic_id = t.topic_id)";
}
else
{
        // No post id, just check forum and topic.
        $sql = "SELECT f.forum_type, f.forum_name, f.forum_access ";
        $sql .= "FROM ".$prefix."_forums f, ".$prefix."_bbtopics t ";
        $sql .= "WHERE (f.forum_id = '$forum') AND (t.topic_id = $topic) AND (t.forum_id = f.forum_id)";
}


if(!$result = mysql_query($sql)) {
        error_die("Could not connect to the forums database.");
}
if (!$myrow = mysql_fetch_array($result))
{
        error_die("The forum/topic you selected does not exist.");
}

$forum_name = $myrow[forum_name];
$forum_access = $myrow[forum_access];
$forum_type = $myrow[forum_type];
$forum_id = $forum;

if(is_locked($topic, $db)) {
        error_die (""._BBNOPOSTLOCK."");
}

if(!does_exists($forum, $db, "forum") || !does_exists($topic, $db, "topic")) {
        error_die("The forum or topic you are attempting to post to does not exist. Please try again.");
}

if($submit) {
   if(trim($message) == '') {
      error_die(""._BBEMPTYMSG."");
   }
   if (!$user_logged_in) {
      if($username == '' && $password == '' && $forum_access == 2) {
         // Not logged in, and username and password are empty and forum_access is 2 (anon posting allowed)
         $userdata = array("uid" => 1);
      }
      else if($username == '' || $password == '') {
         // no valid session, need to check user/pass.
         include("modules/".$module_name."/page_header.php");
         error_die(""._BBUSERPASS."");
      }

      if($userdata[user_level] == -1) {
         include("modules/".$module_name."/page_header.php");
         error_die(""._BBUSERREMOVED."");
      }
      if($userdata[uid] != 1) {
        $userdata = get_userdata($username, $db);
	$dbpass=$userdata[pass];
	$non_crypt_pass = $password;
  	$old_crypt_pass = crypt($password,substr($dbpass,0,2));
	$new_pass = md5($password);
	if (($dbpass == $non_crypt_pass) OR ($dbpass == $old_crypt_pass)) {
	    sql_query("update ".$user_prefix."_users set pass='$new_pass' WHERE uname='$uname'", $dbi);
	    $result = sql_query("select pass from ".$user_prefix."_users where uname='$uname'", $dbi);
	    list($dbpass) = sql_fetch_row($result, $dbi);
	}
	if ($dbpass != $new_pass) {
	    include("modules/".$module_name."/page_header.php");
	    error_die(""._BBWRONGPASS." "._BBTRYAGAIN."");
	}

      }
      if($forum_access == 3 && $userdata[user_level] < 2) {
         include("modules/".$module_name."/page_header.php");
         error_die(""._BBNOPOST."");
      }
      if(is_banned($userdata[uid], "username", $db)) {
         include("modules/".$module_name."/page_header.php");
         error_die(""._BBBANNED."");
      }
   }
   else {
      if($forum_access == 3 && $userdata[user_level] < 2) {
         include("modules/".$module_name."/page_header.php");
         error_die(""._BBNOPOST."");
      }
   }
   // Either valid user/pass, or valid session. continue with post.. but first:
   // Check that, if this is a private forum, the current user can post here.

   if ($forum_type == 1)
     {
           if (!check_priv_forum_auth($userdata[uid], $forum, TRUE, $db))
           {
              include("modules/".$module_name."/page_header.php");
              error_die(""._BBPRIVATEFORUM." "._NOPOST."");
           }
        }

   $poster_ip = $REMOTE_ADDR;

   $is_html_disabled = false;
   if($allow_html == 0 || isset($html)) {
      $message = htmlspecialchars($message);
      $is_html_disabled = true;

      if (isset($quote) && $quote)
      {
              $edit_by = ""._EDITEDBY.""; /*get_syslang_string($sys_lang, "l_editedby");*/

                   // If it's been edited more than once, there might be old "edited by" strings with
                   // escaped HTML code in them. We want to fix this up right here:
                   $message = preg_replace("#&lt;font\ size\=-1&gt;\[\ $edit_by(.*?)\ \]&lt;/font&gt;#si", '<font size=-1>[ ' . $edit_by . '\1 ]</font>', $message);
      }
   }
   if($allow_bbcode == 1 && !isset($bbcode)) {
      $message = bbencode($message, $is_html_disabled);
   }

        // MUST do make_clickable() and smile() before changing \n into <br>.
   $message = make_clickable($message);
   if(!$smile) {
      $message = smile($message);
   }

        $message = str_replace("\n", "<BR>", $message);
   $message = censor_string($message, $db);
   $message = addslashes($message);
   $time = date("Y-m-d H:i");

   //to prevent [addsig] from getting in the way, let's put the sig insert down here.
   if($sig && $userdata[uid] != 1) {
      $message .= "\n[addsig]";
   }

   $sql = "INSERT INTO ".$prefix."_posts (topic_id, image, forum_id, poster_id, post_time, poster_ip) VALUES ('$topic', '$image_subject', '$forum', '$userdata[uid]','$time', '$poster_ip')";
   if(!$result = mysql_query($sql)) {
      error_die("Error - Could not enter data into the database. Please go back and try again");
   }
   $this_post = mysql_insert_id();
   if($this_post)
   {
           $sql = "INSERT INTO ".$prefix."_posts_text (post_id, post_text) VALUES ($this_post, '$message')";
           if(!$result = mysql_query($sql))
           {
                   error_die("Could not enter post text!<br>Reason:".mysql_error());
           }
   }

   $sql = "UPDATE ".$prefix."_bbtopics SET topic_replies = topic_replies+1, topic_last_post_id = $this_post, topic_time = '$time' WHERE topic_id = '$topic'";
   if(!$result = mysql_query($sql)) {
      error_die("Error - Could not enter data into the database. Please go back and try again");
   }
   if($userdata["uid"] != 1) {
      $sql = "UPDATE ".$user_prefix."_users SET user_posts=user_posts+1 WHERE (uid = $userdata[uid])";
      $result = mysql_query($sql);
      if (!$result) {
         error_die("Error updating user post count.");
      }
   }
   $sql = "UPDATE ".$prefix."_forums SET forum_posts = forum_posts+1, forum_last_post_id = '$this_post' WHERE forum_id = '$forum'";
   $result = mysql_query($sql);
   if (!$result) {
      error_die("Error updating forums post count.");
   }
   $sql = "SELECT t.topic_notify, u.femail, u.uname, u.uid FROM ".$prefix."_bbtopics t, ".$prefix."_users u WHERE t.topic_id = '$topic' AND t.topic_poster = u.uid";
   if(!$result = mysql_query($sql)) {
                error_die("Couldn't get topic and user information from database.");
   }
   $m = mysql_fetch_array($result);
   if($m[topic_notify] == 1 && $m[uid] != $userdata[uid]) {
      // We have to get the mail body and subject line in the board default language!
      $subject = ""._BBNOTIFYSUBJ.""; #get_syslang_string($sys_lang, "l_notifysubj");
      $message = ""._BBNOTIFYBODY.""; #get_syslang_string($sys_lang, "l_notifybody");
      eval("\$message =\"$message\";");
      mail($m[femail], $subject, $message, "From: $email_from\r\nX-Mailer: phpBB $phpbbversion");
   }


   $total_forum = get_total_topics($forum, $db);
   $total_topic = get_total_posts($topic, $db, "topic")-1;
   // Subtract 1 because we want the nr of replies, not the nr of posts.

   $forward = 1;
   include("modules/".$module_name."/page_header.php");

   echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACEING=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\">";
   echo "<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" CELLSPACEING=\"1\" WIDTH=\"100%\">";
   echo "<TR BGCOLOR=\"$bgcolor1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>";
   echo "<P><BR><center>"._BBSTORED."<ul>"._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&$total_topic\">"._BBHERE."</a> "." "._BBORWAIT." "._BBVIEWMSG."<P>";
   echo ""._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum&$total_forum\">"._BBHERE."</a> "._BBRETURNTOPIC."</ul></center><P></font>";
   // Keledan. Auto return to topic
        $total = get_total_posts($topic, $db, "topic");
        if($total > $posts_per_page) {
           $start = floor ($total / $posts_per_page) * $posts_per_page ;
           $page = "modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&start=$start";
        } else $page = "modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum";
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
// Keledan end
   echo "</TD></TR></TABLE></TD></TR></TABLE><br>";

} else {
        // Private forum logic here.

        if(($forum_type == 1) && !$user_logged_in && !$logging_in)
        {
include("modules/".$module_name."/page_header.php");

        ?>
        <FORM ACTION="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=reply" METHOD="POST">
                <TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $tablewidth?>">
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
                                                                      <b><?php echo ""._BBUSERNAME."";?>: &nbsp;</b></font></TD><TD><INPUT TYPE="TEXT" NAME="username" SIZE="25" MAXLENGTH="40" VALUE="<?php echo $userdata[uname]?>">
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
                                                                <INPUT TYPE="HIDDEN" NAME="post" VALUE="<?php echo $post?>">
                                                                <INPUT TYPE="HIDDEN" NAME="quote" VALUE="<?php echo $quote?>">
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
                  error_die(""._BBUSERPASS."");
               }
             if (!check_username($username, $db))
               {
                  error_die(""._BBNOUSER."");
               }
             if (!check_user_pw($username, $password, $db))
               {
                  error_die(""._BBWRONGPASS."");
               }

             /* if we get here, user has entered a valid username and password combination. */
             $userdata = get_userdata($username, $db);
                $info = base64_encode("$userdata[uid]:$userdata[uname]:$userdata[pass]:$userdata[storynum]:$userdata[umode]:$userdata[uorder]:$userdata[hold]:$userdata[noscore]:$userdata[ublockon]:$userdata[theme]:$userdata[commentmax]");
                setcookie("user","$info",time()+15552000);
#             $sessid = new_session($userdata[user_id], $REMOTE_ADDR, $sesscookietime, $db);
#             set_session_cookie($sessid, $sesscookietime, $sesscookiename, $cookiepath, $cookiedomain, $cookiesecure);
          }
include("modules/".$module_name."/page_header.php");


        if ($forum_type == 1)
          {
             // To get here, we have a logged-in user. So, check whether that user is allowed to view
             // this private forum.
             if (!check_priv_forum_auth($userdata[uid], $forum, TRUE, $db))
               {
                  error_die(""._BBPRIVATEFORUM." "._BBNOPOST."");
               }

             // Ok, looks like we're good.
          }

     }

?>
        <FORM ACTION="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=reply" METHOD="POST" NAME="coolsus">
        <TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>"><TR><TD  BGCOLOR="<?php echo $bgcolor2?>">
        <TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
        <TR BGCOLOR="<?php echo $bgcolor2?>" ALIGN="LEFT">
                <TD width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBABOUTPOST."";?>:</b></TD>
<?php
     if($forum_access == 1) {
?>
                        <TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBREGUSERS." "._BBINTHISFORUM.""?></TD>
<?php
     }
   else if($forum_access == 2) {
?>
                                <TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBANONUSERS." "._BBINTHISFORUM."<br>"._BBANONHINT.""?></TD>
<?php
   }
   else if($forum_access == 3) {
?>
                                <TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBMODUSERS." "._BBINTHISFORUM.""?></TD>
<?php
   }
?>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>"  width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBUSERNAME."";?>:<b></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">

<?PHP
     if ($user_logged_in) {
        echo $userdata[uname] . " \n";
     } else {
        echo "<INPUT TYPE=\"TEXT\" NAME=\"username\" SIZE=\"25\" MAXLENGTH=\"40\" VALUE=\"$userdata[uname]\"> \n";
     }
?>

                </TD>
        </TR>

<?PHP
        if (!$user_logged_in) {
                // no session, need a password.
                echo "    <TR ALIGN=\"LEFT\"> \n";
                echo "    <TD BGCOLOR=\"$bgcolor1\" width=25%>";
                echo "        <font size=\"$FontSize2\" face=\"$FontFace\"><b>"._BBPASSWORD.":</b></font><BR><font size=\"$FontSize3\"><i><a href=\"modules.php?name=Your_Account&amp;op=pass_lost\" target=\"_blank\">"._BBPASSWDLOST."</a></i></font></TD> \n";
                echo "        <TD BGCOLOR=\"$bgcolor1\"><INPUT TYPE=\"PASSWORD\" NAME=\"password\" SIZE=\"25\" MAXLENGTH=\"25\"></TD> \n";
                echo "    </TR> \n";
        }
?>

        <TR ALIGN="LEFT">

                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBMSGICON."";?>:</b></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>">
       <?php
// Keledan, usual smilies subject choose
                $handle=opendir("$subjecticonsdir");
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
                        echo "<input type=\"radio\" value=\"$file\" name=\"image_subject\">&nbsp;";
                        echo "<IMG SRC=\"images/forum/subject/$file\" BORDER=0>&nbsp;";
                        $count++;
                        }
                if ($count == "8") { echo "<br>"; $count = 1; }

                }
?>
                </TD>
        </TR>

        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBBODY."";?>:</b><br><br>
                <?php
                echo ""._BBHTMLIS.": ";
                if($allow_html == 1)
                        echo ""._BBON."<BR>\n";
                else
                        echo ""._BBOFF."<BR>\n";
                echo ""._BBCODEIS.": ";
                if($allow_bbcode == 1)
                        echo ""._BBON."<br>\n";
                else
                        echo ""._BBOFF."<BR>\n";

                if($quote) {
                        $sql = "SELECT pt.post_text, p.post_time, u.uname FROM ".$prefix."_posts p, ".$prefix."_users u, ".$prefix."_posts_text pt WHERE p.post_id = '$post' AND p.poster_id = u.uid AND pt.post_id = p.post_id";
                        if($r = mysql_query($sql)) {
                                $m = mysql_fetch_array($r);
                                $text = desmile($m[post_text]);
                                $text = str_replace("<BR>", "\n", $text);
                                $text = stripslashes($text);
                                $text = bbdecode($text);
                                $text = undo_make_clickable($text);
                                $text = str_replace("[addsig]", "", $text);
                                $reply = ""._BBQUOTEMSG1." $m[post_time], $m[uname] "._BBQUOTEMSG2.":\n$text\n"._BBQUOTEMSG3."";
                        }
                        else {
                                error_die("Error Contacting database. Please try again.\n<br>$sql");
                        }
                }
                ?>
                </font></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>">
                        <TEXTAREA NAME="message" ROWS="10" COLS="45" WRAP="VIRTUAL"><?php echo $reply?></TEXTAREA>
                </TD>
        </TR>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBADDSMILIES.""; ?>:</b><br><br>
                </font></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>"><?php putitems()?>
                </TD>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBOPTION.""; ?>:</b></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>" ><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
                <?php
                        if($allow_html == 1) {
                           if($userdata[user_html] == 1)
                             $h = "CHECKED";

                ?>
                                <INPUT TYPE="CHECKBOX" NAME="html" <?php echo $h?>><?php echo ""._BBDISABLE." "._BBHTML." "._BBONTHISPOST."";?><BR>
                <?php
                        }
                ?>
                <?php
                        if($allow_bbcode == 1) {
                           if($userdata[user_bbcode] == 1)
                             $b = "CHECKED";
                ?>
                                <INPUT TYPE="CHECKBOX" NAME="bbcode" <?php echo $b?>><?php echo ""._BBDISABLE." <a href=\"modules.php?op=modload&name=".$module_name."&file=faq#bbcode\" target=\"_blank\"><i>"._BBCODE."</i></a> "._BBONTHISPOST."<BR>";
                        }
                        if($userdata[user_desmile] == 1)
                           $ds = "CHECKED";
                ?>

                <INPUT TYPE="CHECKBOX" NAME="smile" <?php echo $ds?>><?php echo ""._BBDISABLE." <a href=\"modules.php?op=modload&name=".$module_name."&file=faq#smilies\" target=\"_blank\"><i>"._BBSMILIES."</i></a> "._BBONTHISPOST."<BR>";
                        if($allow_sig == 1) {
                                if($userdata[user_attachsig] == 1)
                                        $s = "CHECKED";
                ?>
                                <INPUT TYPE="CHECKBOX" NAME="sig" <?php echo $s?>><?php echo ""._BBATTACHSIG."";?><BR>
                <?php
                        }
                ?>
                </TD>
        </TR>
        <TR>
                <TD  BGCOLOR="<?php echo $bgcolor2?>" colspan=2 ALIGN="CENTER">
                <font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="HIDDEN" NAME="topic" VALUE="<?php echo $topic?>">
                <INPUT TYPE="HIDDEN" NAME="quote" VALUE="<?php echo $quote?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="<?php echo ""._BBSUBMIT.""; ?>">
                &nbsp;<INPUT TYPE="SUBMIT" NAME="cancel" VALUE="<?php echo ""._BBCANCELPOST."";?>">
                </TD>
        </TR>
        </TABLE></TD></TR></TABLE>
        </FORM>
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