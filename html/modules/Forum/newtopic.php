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
$index = 0;

if (!eregi("modules.php", $PHP_SELF)) {
    die ("You can't access this file directly...");
}

require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
get_lang($module_name);

include("modules/".$module_name."/bbconfig.php");
error_reporting (E_ERROR | E_WARNING | E_PARSE);
if($cancel) {
    Header("Location: modules.php?name=$module_name&file=viewforum&forum=$forum");
}

include("modules/".$module_name."/functions.php");
include("modules/".$module_name."/auth.php");
include("header.php");
title("$sitename: "._FORUMS."");
OpenTable();
$pagetype = "newtopic";

$sql = "SELECT forum_name, forum_access, forum_type FROM ".$prefix."_forums WHERE (forum_id = '$forum')";
if(!$result = mysql_query($sql)) {
    error_die("Can't get forum data.");
}
$myrow = mysql_fetch_array($result);
$forum_name = $myrow[forum_name];
$forum_access = $myrow[forum_access];
$forum_type = $myrow[forum_type];
$forum_id = $forum;

if(!does_exists($forum, $db, "forum")) {
    error_die("The forum you are attempting to post to does not exist. Please try again.");
}

if($submit) {
    $subject = strip_tags($subject);
    if(trim($message) == '' || trim($subject) == '') {
	error_die(""._BBEMPTYMSG."");
    }
    if (!$user_logged_in) {
	if($username == '' && $password == '' && $forum_access == 2) {
    	    // Not logged in, and username and password are empty and forum_access is 2 (anon posting allowed)
	    $userdata = array("uid" => 1);
	} else {
            // no valid session, need to check user/pass.
            if($username == '' || $password == '') {
        	error_die(""._BBUSERPASS." "._BBTRYAGAIN."");
            }
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
		error_die(""._BBWRONGPASS." "._BBTRYAGAIN."");
	    }
            if($userdata[user_level] == -1) {
        	error_die(""._BBUSERREMOVED."");
            }
            if($forum_access == 3 && $userdata[user_level] < 2) {
        	error_die(""._BBNOPOST."");
            }
            if(is_banned($userdata[uid], "username", $db)) {
        	error_die(""._BBBANNED."");
            }
        }
	/*
	if($userdata[uid] != 1) {
	    $info = base64_encode("$userdata[uid]:$userdata[uname]:$userdata[pass]:$userdata[storynum]:$userdata[umode]:$userdata[uorder]:$userdata[hold]:$userdata[noscore]:$userdata[ublockon]:$userdata[theme]:$userdata[commentmax]");
    	    setcookie("user","$info",time()+15552000);
	}
	*/
    } else {
	if($forum_access == 3 && $userdata[user_level] < 2) {
    	    error_die(""._BBNOPOST."");
        }
    }

   // Either valid user/pass, or valid session. continue with post.. but first:
   // Check that, if this is a private forum, the current user can post here.

    if ($forum_type == 1) {
	if (!check_priv_forum_auth($userdata[uid], $forum, TRUE, $db)) {
    	    error_die(""._BBPRIVATEFORUM." "._BBNOPOST."");
	}
    }

    $is_html_disabled = false;
    if($allow_html == 0 || isset($html)) {
	$message = htmlspecialchars($message);
        $is_html_disabled = true;
    }

    if($allow_bbcode == 1 && !($HTTP_POST_VARS[bbcode])) {
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
    $subject = strip_tags($subject);
    $subject = censor_string($subject, $db);
    $subject = addslashes($subject);
    $poster_ip = $REMOTE_ADDR;
    $time = date("Y-m-d H:i");

    //to prevent [addsig] from getting in the way, let's put the sig insert down here.

    if($sig && $userdata[uid] != 1) {
	$message .= "\n[addsig]";
    }
    $sql = "INSERT INTO ".$prefix."_bbtopics (topic_title, topic_poster, forum_id, topic_time, topic_notify) VALUES ('$subject', '$userdata[uid]', '$forum', '$time'";
    if(isset($notify) && $userdata[uid] != 1) {
	$sql .= ", '1'";
    } else {
        $sql .= ", '0'";
    }
    $sql .= ")";
    if(!$result = mysql_query($sql)) {
	error_die("Couldn't enter topic in database.");
    }
    $topic_id = mysql_insert_id();
    $sql = "INSERT INTO ".$prefix."_posts (topic_id, image, forum_id, poster_id, post_time, poster_ip) VALUES ('$topic_id', '$image_subject', '$forum', '$userdata[uid]', '$time', '$poster_ip')";
    if(!$result = mysql_query($sql)) {
	error_die("Couldn't enter post in datbase.");
    } else {
        $post_id = mysql_insert_id();
        if($post_id) {
    	    $sql = "INSERT INTO ".$prefix."_posts_text (post_id, post_text) values ($post_id, '$message')";
            if(!$result = mysql_query($sql)) {
        	error_die("Could not enter post text!");
    	    }
            $sql = "UPDATE ".$prefix."_bbtopics SET topic_last_post_id = $post_id WHERE topic_id = '$topic_id'";
            if(!$result = mysql_query($sql)) {
        	error_die("Could not update topics table!");
            }
	}
    }
    if($userdata[uid] != 1) {
	$sql = "UPDATE ".$user_prefix."_users SET user_posts=user_posts+1 WHERE (uid = $userdata[uid])";
        $result = mysql_query($sql);
        if (!$result) {
	    error_die("Couldn't update users post count.");
        }
    }
    $sql = "UPDATE ".$prefix."_forums SET forum_posts = forum_posts+1, forum_topics = forum_topics+1, forum_last_post_id = $post_id WHERE forum_id = '$forum'";
    $result = mysql_query($sql);
    if (!$result) {
	error_die("Couldn't update forums post count.");
    }
    $topic = $topic_id;
    $total_forum = get_total_topics($forum, $db);
    $total_topic = get_total_posts($topic, $db, "topic")-1;
    
    // Subtract 1 because we want the nr of replies, not the nr of posts.

    $forward = 1;
    include("modules/".$module_name."/page_header.php");
    echo "<br><TABLE BORDER=\"0\" CELLPADDING=\"1\" CELLSPACING=\"0\" ALIGN=\"CENTER\" VALIGN=\"TOP\">"
	."<TR><TD  BGCOLOR=\"$table_bgcolor\"><TABLE BORDER=\"0\" CALLPADDING=\"1\" CELLSPACING=\"1\" WIDTH=\"100%\">"
	."<TR BGCOLOR=\"$bgcolor1\" ALIGN=\"LEFT\"><TD><font face=\"Verdana\" size=\"2\"><P>"
	."<P><BR><center>"._BBSTORED."<P>"._BBCLICK." <a href=\"modules.php?op=modload&name=$module_name&file=viewtopic&topic=$topic_id&forum=$forum&$total_topic\">"._BBHERE."</a> "." "._BBORWAIT." "._BBVIEWMSG."<p>"._BBCLICK." <a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=$forum_id&total_forum\">"._BBHERE."</a> "._BBRETURNTOPIC."</center><P></font>";

    // Keledan. Auto return to topic
    
    $total = get_total_posts($topic, $db, "topic");
    if($total > $posts_per_page) {
	$start = floor ($total / $posts_per_page) * $posts_per_page ;
        $page = "modules.php?op=modload&name=$module_name&file=viewtopic&topic=$topic&forum=$forum&start=$start";
    } else {
	$page = "modules.php?op=modload&name=$module_name&file=viewtopic&topic=$topic&forum=$forum";
    }
?>
    <script language="Javascript" type="text/javascript">
    <!--
    function gotoThread() {
    window.location.href="<?php print $page ?>";
    }
    window.setTimeout("gotoThread()", 3000);
    //-->
    </script>
<?php
    echo "</TD></TR></TABLE></TD></TR></TABLE><br>";
} else {
    include("modules/".$module_name."/page_header.php");
?>
        <FORM ACTION="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=newtopic" METHOD="POST" NAME="coolsus">
        <TABLE BORDER="0" CELLPADDING="1" CELLSPACING=0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>"><TR><TD  BGCOLOR="<?php echo $bgcolor2?>">
        <TABLE BORDER="0" CELLPADDING="1" CELLSPACING=1" WIDTH="100%">
        <TR BGCOLOR="<?php echo $bgcolor2?>" ALIGN="LEFT">
        <TD width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBABOUTPOST.""; ?>:</b></TD>
<?php
        if($forum_access == 1) {
?>
    	    <TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBREGUSERS." "._BBINTHISFORUM.""?></TD>
<?php
        } elseif ($forum_access == 2) {
?>
    	    <TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBANONUSERS." "._BBINTHISFORUM."<br>"._BBANONHINT.""?></TD>
<?php
        } elseif ($forum_access == 3) {
?>
    	    <TD><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><?php echo ""._BBMODUSERS." "._BBINTHISFORUM.""?></TD>
<?php
        }
?>
        </TR>
        <TR ALIGN="LEFT">
        <TD  BGCOLOR="<?php echo $bgcolor1?>"  width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBUSERNAME.""?>:<b></font></TD>
        <TD  BGCOLOR="<?php echo $bgcolor1?>"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
<?php
        if ($user_logged_in) {
    	    echo $userdata[uname] . " \n";
    	} else {
            echo "<INPUT TYPE=\"TEXT\" NAME=\"username\" SIZE=\"25\" MAXLENGTH=\"40\" VALUE=\"$userdata[uname]\"> \n";
        }
?>
        </font>
        </TD>
        </TR>
<?php
        if (!$user_logged_in) {
    	    // no session, need a password.
            echo "    <TR ALIGN=\"LEFT\"> \n";
            echo "        <TD BGCOLOR=\"$bgcolor1\" width=\"25%\"><font size=\"$FontSize2\" face=\"$FontFace\"><b>"._BBPASSWORD.":</b></font><BR>";
            echo "        <font size=\"$FontSize3\"><i><a href=\"modules.php?name=Your_Account&amp;op=pass_lost\" target=\"_blank\">"._BBPASSWDLOST."</a></i></font></TD> \n";
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

                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBSUBJECT."";?>:</b></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>"> <INPUT TYPE="TEXT" NAME="subject" SIZE="50" MAXLENGTH="100"></TD>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBBODY.""; ?>:</b><br><br>
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
                ?>
                </font></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>"><TEXTAREA NAME="message" ROWS=10 COLS=45 WRAP="VIRTUAL"></TEXTAREA>
                </TD>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width="25%"><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBADDSMILIES.""; ?>:</b><br><br>
                </font></TD>
                <TD  BGCOLOR="<?php echo $bgcolor1?>"><?php putitems()?>
                </TD>
        </TR>
        <TR ALIGN="LEFT">
                <TD  BGCOLOR="<?php echo $bgcolor1?>" width=25%><font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>"><b><?php echo ""._BBOPTION."";?>:</b></TD>
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
                                <INPUT TYPE="CHECKBOX" NAME="bbcode" <?php echo $b?>><?php echo ""._BBDISABLE." <a href=\"modules.php?op=modload&name=".$module_name."&file=faq#bbcode\" target=\"_blank\"><i>"._BBCODE."</i></a> "._BBONTHISPOST."";?><BR>
                <?php
                        }
                        if($userdata[user_desmile] == 1){
                                $ds = "CHECKED";
                        }
                ?>

                <INPUT TYPE="CHECKBOX" NAME="smile" <?php echo $ds?>><?php echo ""._BBDISABLE." <a href=\"modules.php?op=modload&name=".$module_name."&file=faq#smilies\" target=\"_blank\"><i>"._BBSMILIES."</i></a> "._BBONTHISPOST."";?><BR>
                <?php
                if($allow_sig == 1) {
                        if($userdata[user_attachsig] == 1) {
                                $s = "CHECKED";
                        }
                ?>
                                <INPUT TYPE="CHECKBOX" NAME="sig" <?php echo $s?>><?php echo ""._BBATTACHSIG."";?><BR>
                <?php
                }
                ?>
                <INPUT TYPE="CHECKBOX" NAME="notify"><?php echo ""._BBNOTIFY."";?><BR>
                </TD>
        </TR>
        <TR>
                <TD  BGCOLOR="<?php echo $bgcolor2?>" colspan=2 ALIGN="CENTER">
                <font size="<?php echo $FontSize2?>" face="<?php echo $FontFace?>">
                <INPUT TYPE="HIDDEN" NAME="forum" VALUE="<?php echo $forum?>">
                <INPUT TYPE="SUBMIT" NAME="submit" VALUE="<?php echo ""._BBSUBMIT."";?>">
                &nbsp;<INPUT TYPE="SUBMIT" NAME="cancel" VALUE="<?php echo ""._BBCANCELPOST."";?>">
                </TD>
        </TR>
        </TABLE>
</TD>
</TR>
</TABLE>
</FORM>

<?php
}

CloseTable();
include("footer.php");

?>