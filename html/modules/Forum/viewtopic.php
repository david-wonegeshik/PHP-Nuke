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

header ("Cache-Control: no-cache, must-revalidate");
include("modules/".$module_name."/bbconfig.php");
include("modules/".$module_name."/functions.php");
include("modules/".$module_name."/auth.php");
include("header.php");
title("$sitename: "._FORUMS."");
OpenTable();
$pagetype = "viewtopic";


$sql = "SELECT f.forum_type, f.forum_name FROM ".$prefix."_forums f, ".$prefix."_bbtopics t WHERE (f.forum_id = '$forum') AND (t.topic_id = $topic) AND (t.forum_id = f.forum_id)";
if(!$result = mysql_query($sql))
        error_die("<font size=+1>An Error Occured</font><hr>Could not connect to the forums database.");
if(!$myrow = mysql_fetch_array($result))
        error_die("Error - The forum/topic you selected does not exist. Please go back and try again.");
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
#include ("footer.php");
exit();
}
else
{



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

$sql = "SELECT topic_title, topic_status FROM ".$prefix."_bbtopics WHERE topic_id = '$topic'";

$total = get_total_posts($topic, $db, "topic");
if($total > $posts_per_page) {
   $times = 0;
   for($x = 0; $x < $total; $x += $posts_per_page)
     $times++;
   $pages = $times;
}

if(!$result = mysql_query($sql))
  error_die("<font size=+1>An Error Occured</font><hr>Could not connect to the forums database.");
$myrow = mysql_fetch_array($result);
$topic_subject = own_stripslashes($myrow[topic_title]);
$lock_state = $myrow[topic_status];
include("modules/".$module_name."/page_header.php");

?>
<?php
if($total > $posts_per_page) {
   echo "<TABLE BORDER=\"1\" WIDTH=\"$TableWidth\" ALIGN=\"CENTER\">";
   $times = 1;
   echo "<TR ALIGN=\"LEFT\"><TD><FONT FACE=\"$FontFace\" SIZE=\"$FontSize3\" COLOR=\"$FontColor1\">"._BBGOTOPAGE." ( ";
   $last_page = $start - $posts_per_page;
   if($start > 0) {
     echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&start=$last_page\">"._BBPREVPAGE."</a> ";
   }
   for($x = 0; $x < $total; $x += $posts_per_page) {
      if($times != 1)
        echo " | ";
      if($start && ($start == $x)) {
           echo $times;
      }
      else if($start == 0 && $x == 0) {
         echo "1";
      }
      else {
        echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&mode=viewtopic&topic=$topic&forum=$forum&start=$x\">$times</a>";
      }
      $times++;
   }
   if(($start + $posts_per_page) < $total) {
      $next_page = $start + $posts_per_page;
      echo " <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&start=$next_page\">"._BBNEXTPAGE."</a>";
   }
   echo " ) </FONT></TD></TR></TABLE>\n";
}
?>

<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="<?php echo $TableWidth?>"><TR><TD  BGCOLOR="<?php echo $bgcolor2?>">
<TABLE BORDER="0" CELLPADDING="3" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<?php echo $bgcolor2?>" ALIGN="LEFT">
        <TD WIDTH="20%"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2?>" COLOR="<?php echo $FontColor1?>"><?php echo ""._BBAUTHOR."";?></FONT></TD>
        <TD><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize2 ?>"COLOR="<?php echo $FontColor1?>"><?php echo $topic_subject?></FONT></TD>
</TR>
<?php
if(isset($start)) {
   $sql = "SELECT p.*, image, pt.post_text FROM ".$prefix."_posts p, ".$prefix."_posts_text pt
   WHERE topic_id = '$topic'
   AND p.post_id = pt.post_id
   ORDER BY post_id LIMIT $start, $posts_per_page";
}
else {
   $sql = "SELECT p.*, image, pt.post_text FROM ".$prefix."_posts p, ".$prefix."_posts_text pt
   WHERE topic_id = '$topic'
   AND p.post_id = pt.post_id
   ORDER BY post_id LIMIT $posts_per_page";
}
if(!$result = mysql_query($sql))
  error_die("<font size=+1>An Error Occured</font><hr>Could not connect to the Posts database. $sql");
$myrow = mysql_fetch_array($result);
$row_color = $bgcolor2;
$count = 0;
do {
   setlocale("LC_TIME", $locale);
   if(!($count % 2))
     $row_color = $bgcolor2;
   else
     $row_color = $bgcolor1;

   echo "<TR BGCOLOR=\"$row_color\" ALIGN=\"LEFT\">\n";
   if($myrow[poster_id] != 1) {
           $posterdata = get_userdata_from_id($myrow[poster_id], $db);
        }
   else
     $posterdata = array("user_id" => 1, "uname" => _BBANONYMOUS, "user_posts" => "0", "user_rank" => -1);
   echo "<TD valign=top bgcolor=\"$bgcolor1\"><FONT FACE=\"$FontFace\" COLOR=\"$FontColor1\"><b>$posterdata[uname]</b></FONT>";
   $posts = $posterdata[user_posts];
   if($posterdata[user_id] != 1) {
      if($posterdata[user_rank] != 0)
        $sql = "SELECT rank_title, rank_image FROM ".$prefix."_ranks WHERE rank_id = '$posterdata[user_rank]'";
      else
        $sql = "SELECT rank_title, rank_image  FROM ".$prefix."_ranks WHERE rank_min <= " . $posterdata[user_posts] . " AND rank_max >= " . $posterdata[user_posts] . " AND rank_special = 0";
      if(!$rank_result = mysql_query($sql))
        echo mysql_errno()."".mysql_error();#error_die("Error connecting to the database!");
      list($rank, $rank_image) = mysql_fetch_array($rank_result);
      echo "<BR><FONT FACE=\"$FontFace\" SIZE=\"$FontSize1\" COLOR=\"$FontColor1\"><B>" . own_stripslashes($rank) . "</B></font>";
      if($rank_image != '')
        echo "<BR><IMG SRC=\"$rankimagesdir/$rank_image\" BORDER=\"0\">";
        echo "<BR><BR>";
// Keledan begin... inserts user's avatar
   if ($posterdata[user_avatar] != '')
   echo "<img src=\"images/forum/avatar/$posterdata[user_avatar]\">";
// Keledan end
      echo "<BR><BR><FONT FACE=\"$FontFace\" SIZE=\"$FontSize3\" COLOR=\"$FontColor1\">"._BBJOINED.": ".strftime(_MONTHDATETIME, strtotime($posterdata[user_regdate]))." </FONT>";
      echo "<br><FONT FACE=\"$FontFace\" SIZE=\"$FontSize3\" COLOR=\"$FontColor1\">"._BBPOSTS.": $posts</FONT>";
      if ($posterdata[user_from] != ''){
              $countryname = ereg_replace("_", " ", "$posterdata[user_from]");
                $countryname = ereg_replace(".gif", "", "$countryname");
        echo "<BR><img src=\"images/forum/flags/".$posterdata[user_from]."\" alt=\"".$countryname."\"><br>";
#        echo "<BR><FONT FACE=\"$FontFace\" SIZE=\"$FontSize3\" COLOR=\"$FontColor1\">"._BBLOCATION.": $posterdata[user_from]<br></FONT>";
      }
      echo "</td>";
   }
   else {
      echo "<BR><FONT FACE=\"$FontFace\" SIZE=\"$FontSize3\" COLOR=\"$FontColor1\">"._BBUNREGISTERED."</font></TD>";
   }
   if ($myrow[image] == "") $myrow[image] = "icon1.gif";
   echo "<TD bgcolor=\"$bgcolor1\"><img src=\"$subjecticonsdir/".$myrow[image]."\"> <FONT FACE=\"$FontFace\" SIZE=\"$FontSize1\" COLOR=\"$FontColor1\">"._BBPOSTED.": ".strftime(_LOCALDATETIME, strtotime($myrow[post_time]))."&nbsp;&nbsp;&nbsp";
   echo "<HR noshade size=\"1\"></font>\n";
   $message = own_stripslashes($myrow[post_text]);

   // Before we insert the sig, we have to strip its HTML if HTML is disabled by the admin.
   // We do this _before_ bbencode(), otherwise we'd kill the bbcode's html.
   $sig = $posterdata[user_sig];
   if (!$allow_html)
   {
                $sig = htmlspecialchars($sig);
                $sig = preg_replace("#&lt;br&gt;#is", "<BR>", $sig);
   }

   $message = eregi_replace("\[addsig]$", "<BR>_________________<BR>" . own_stripslashes(bbencode($sig, $allow_html)), $message);

   echo "\n<FONT COLOR=\"$FontColor1\" face=\"$FontFace\">" . $message . "</FONT><BR>";
   echo "\n<HR noshade size=\"1\">";
   if ($posterdata[user_id] != 1)
   {
           echo "&nbsp;&nbsp<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=$posterdata[uname]\"><img src=\"$imagesdir/profile.gif\" border=0 alt=\""._BBPROFILEOF." $posterdata[uname]\"></a>\n";

           if($posterdata["user_viewemail"] != 0)
             echo "&nbsp;&nbsp;<a href=\"mailto:$posterdata[user_email]\"><IMG SRC=\"$imagesdir/email.gif\" BORDER=0 ALT=\""._BBEMAIL." $posterdata[uname]\"></a>\n";

           if($posterdata["url"] != '') {
// Keledan
           $posterdata["url"] = str_replace ("http://", "", $posterdata["url"]);
           $posterdata["url"] = "http://".$posterdata["url"];
           echo "&nbsp;&nbsp;<a href=\"$posterdata[url]\" TARGET=\"_blank\"><IMG SRC=\"$imagesdir/www_icon.gif\" BORDER=0 ALT=\""._BBVIEWSITE." $posterdata[uname]\"></a>\n";
           }
// Keledan End
           if($posterdata["user_icq"] != '')
             echo "&nbsp;&nbsp;<a href=\"http://wwp.icq.com/$posterdata[user_icq]#pager\" target=\"_blank\"><img src=\"http://online.mirabilis.com/scripts/online.dll?icq=$posterdata[user_icq]&img=5\" alt=\""._BBICQSTATUS."\" border=\"0\"></a>&nbsp;&nbsp;<a href=\"http://wwp.icq.com/scripts/search.dll?to=$posterdata[user_icq]\"><img src=\"images/forum/icons/icq_add.gif\" alt=\""._BBICQADD."\" border=\"0\" ></a>";

           if($posterdata["user_aim"] != '')
             echo "&nbsp;&nbsp;<a href=\"aim:goim?screenname=$posterdata[user_aim]&message=Hi+$posterdata[user_aim].+Are+you+there?\"><img src=\"$images_aim\" border=\"0\"></a>";

           if($posterdata["user_yim"] != '')
             echo "&nbsp;&nbsp;<a href=\"http://edit.yahoo.com/config/send_webmesg?.target=$posterdata[user_yim]&.src=pg\"><img src=\"$images_yim\" border=\"0\"></a>";

           if($posterdata["user_msnm"] != '')
             echo "&nbsp;&nbsp;<a href=\"modules.php?name=Your_Account&amp;mode=view&user=$posterdata[uname]\"><img src=\"$images_msnm\" border=\"0\"></a>";

   }
   else
   {
           echo "&nbsp;&nbsp\n";
   }


   echo "&nbsp;&nbsp;<a href=\"modules.php?op=modload&name=".$module_name."&file=editpost&post_id=$myrow[post_id]&topic=$topic&forum=$forum\"><img src=\"$imagesdir/edit.gif\" border=0 alt=\""._BBEDITDELETE."\"></a>\n";

   echo "&nbsp;&nbsp;<a href=\"modules.php?op=modload&name=".$module_name."&file=reply&topic=$topic&forum=$forum&post=$myrow[post_id]&quote=1\"><IMG SRC=\"$imagesdir/quote.gif\" BORDER=\"0\" alt=\""._BBREPLYQUOTE."\"></a>\n";
   if(is_moderator($forum, $userdata["user_id"], $db) || $userdata[user_level] > 2) {
      echo "&nbsp;&nbsp;<a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topicadmin&mode=viewip&post=$myrow[post_id]&forum=$forum\"><IMG SRC=\"$imagesdir/ip_logged.gif\" BORDER=0 ALT=\""._BBVIEWIP."\"></a>\n";
   }
   echo "</TD></TR>";
   $count++;
} while($myrow = mysql_fetch_array($result));
$sql = "UPDATE ".$prefix."_bbtopics SET topic_views = topic_views + 1 WHERE topic_id = '$topic'";
@mysql_query($sql);
?>

</TABLE></TD></TR></TABLE>
<TABLE ALIGN="CENTER" BORDER="0" WIDTH="<?php echo $TableWidth?>">
<?php
if($total > $posts_per_page) {
   $times = 1;
   echo "<TR ALIGN=\"RIGHT\"><TD colspan=2><FONT FACE=\"$FontFace\" SIZE=\"$FontSize3\" COLOR=\"$FontColor1\">"._BBGOTOPAGE." ( ";
   $last_page = $start - $posts_per_page;
   if($start > 0) {
      echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&start=$last_page\">"._BBPREVPAGE."</a> ";
   }
   for($x = 0; $x < $total; $x += $posts_per_page) {
      if($times != 1)
        echo " | ";
      if($start && ($start == $x)) {
         echo $times;
      }
      else if($start == 0 && $x == 0) {
         echo "1";
      }
      else {
         echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&mode=viewtopic&topic=$topic&forum=$forum&start=$x\">$times</a>";
      }
      $times++;
   }
   if(($start + $posts_per_page) < $total) {
      $next_page = $start + $posts_per_page;
      echo " <a href=\"modules.php?op=modload&name=".$module_name."&file=viewtopic&topic=$topic&forum=$forum&start=$next_page\">"._BBNEXTPAGE."</a>";
   }
   echo " ) </FONT></TD></TR>\n";
}
?>
<TR>
        <TD>
                <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=newtopic&forum=<?php echo $forum?>"><IMG SRC="<?php echo "$imagesdir/new_topic-dark.jpg";?>" BORDER="0"></a>&nbsp;&nbsp;
<?php
                if($lock_state != 1) {
?>
                        <a href="modules.php?op=modload&name=<?echo"".$module_name."";?>&file=reply&topic=<?php echo $topic ?>&forum=<?php echo $forum ?>"><IMG SRC="<?php echo "$imagesdir/reply-dark.jpg"; ?>" BORDER="0"></a></TD>
<?php
                }
                else {
?>
                        <IMG SRC="<?php echo "$imagesdir/reply_locked-dark.jpg" ?>" BORDER="0"></TD>
<?php
                }
?>
        </TD>
<TD ALIGN="RIGHT">
<?php
make_jumpbox();
?>
</TR></TABLE>

<?php
echo "<CENTER>";
if($lock_state != 1)
        echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=topicadmin&mode=lock&topic=$topic&forum=$forum\"><IMG SRC=\"$imagesdir/lock_topic.gif\" ALT=\""._BBLOCKTOPIC."\" BORDER=0></a> ";
else
        echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=topicadmin&mode=unlock&topic=$topic&forum=$forum\"><IMG SRC=\"$imagesdir/unlock_topic.gif\" ALT=\""._BBUNLOCKTOPIC."\" BORDER=0></a> ";

echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=topicadmin&mode=move&topic=$topic&forum=$forum\"><IMG SRC=\"$imagesdir/move_topic.gif\" ALT=\""._BBMOVETOPIC."\" BORDER=0></a> ";
echo "<a href=\"modules.php?op=modload&name=".$module_name."&file=topicadmin&mode=del&topic=$topic&forum=$forum\"><IMG SRC=\"$imagesdir/del_topic.gif\" ALT=\""._BBDELTOPIC."\" BORDER=0></a></CENTER>\n";

}
CloseTable();
include ("footer.php");
?>