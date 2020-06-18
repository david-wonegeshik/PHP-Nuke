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

echo "<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">";
echo "<center><b>"._BBWELCOMETOFORUMS." $sitename</b><br><br>";
echo _BBFORUMINTRO."<br>";
echo _BBFORUMINTRO2."<br><br>";
setlocale ("LC_TIME", $locale);
echo "<font size=1>"._BBTODAY." ".strftime(_LONGDATETIME)."<br>";
$last_visited = strftime(_LOCALDATETIME, $last_visit);
echo ""._BBLASTVISIT." ".$last_visited."</font><br><br>";

$sql = "SELECT c.* FROM ".$prefix."_catagories c, ".$prefix."_forums f
         WHERE f.cat_id=c.cat_id
         GROUP BY c.cat_id, c.cat_title, c.cat_order
         ORDER BY c.cat_order";
if(!$result = mysql_query($sql))
        error_die("Unable to get categories from database<br>$sql");
$total_categories = mysql_num_rows($result);

?>

<TABLE BORDER="0" WIDTH="100%" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP">
<TR><TD BGCOLOR="<?php echo "$bgcolor2";?>">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<? echo "$bgcolor2"; ?>" ALIGN="LEFT">
        <TD BGCOLOR="<? echo "$bgcolor2"; ?>" ALIGN="CENTER" VALIGN="MIDDLE">&nbsp;</TD>
        <TD><FONT FACE="<? echo "$FontFace";?>" SIZE="<? echo "$FontSize1";?>" COLOR="<? echo "$FontColor1"; ?>"><B><? echo ""._BBFORUM.""; ?></B></font></TD>
        <TD ALIGN="CENTER"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBTYPE.""; ?></B></font></TD>
        <TD ALIGN="CENTER"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBTOPICS.""; ?></B></font></TD>
        <TD ALIGN="CENTER"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBPOSTS."";?></B></font></TD>
        <TD ALIGN="CENTER"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBLASTPOST."";?></B></font></TD>
        <TD ALIGN="CENTER"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBMODERATOR."";?></B></font></TD>
</TR>

<?php
if($total_categories)
{
   if(!$viewcat)
     {
        $viewcat = -1;
     }
   while($cat_row = mysql_fetch_array($result))
     {
        $categories[] = $cat_row;
     }

   $limit_forums = "";
   if($viewcat != -1)
     {
        $limit_forums = "WHERE f.cat_id = $viewcat";
     }
   $sql = "SELECT f.*, u.uname, u.uid, p.post_time
            FROM ".$prefix."_forums f
            LEFT JOIN ".$prefix."_posts p ON p.post_id = f.forum_last_post_id
            LEFT JOIN ".$prefix."_users u ON u.uid = p.poster_id
            $limit_forums
            ORDER BY f.cat_id, f.forum_id";
   if(!$f_res = mysql_query($sql))
     {
        die("Error getting forum data<br>$sql");
     }

   while($forum_data = mysql_fetch_array($f_res))
     {
        $forum_row[] = $forum_data;
     }
for($i = 0; $i < $total_categories; $i++) {
   if($viewcat != -1) {
      if($categories[$i][cat_id] != $viewcat) {
        $title = stripslashes($categories[$i][cat_title]);
        echo "<TR ALIGN=\"LEFT\" VALIGN=\"TOP\"><TD COLSPAN=\"7\" BGCOLOR=\"$bgcolor1\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><B><a href=\"modules.php?op=modload&name=".$module_name."&file=index&viewcat=".$categories[$i]["cat_id"]."\">$title</a></B></FONT></TD></TR>";
        continue;
     }
   }
   $title = stripslashes($categories[$i][cat_title]);
   echo "<TR ALIGN=\"LEFT\" VALIGN=\"TOP\"><TD COLSPAN=\"7\" BGCOLOR=\"$bgcolor1\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><B><a href=\"modules.php?op=modload&name=".$module_name."&file=index&viewcat=".$categories[$i]["cat_id"]."\">$title</a></B></FONT></TD></TR>";
   @reset($forum_row);
   for($x = 0; $x < count($forum_row); $x++)
     {
         unset($last_post);
// Keledan begin - using a local date-time to format $last_post

      if($forum_row[$x]["cat_id"] == $categories[$i]["cat_id"]) {
         if($forum_row[$x]["post_time"])
         {
                 $last_post[date_time] = strtotime($forum_row[$x]["post_time"]);
                 $last_post[user] = $forum_row[$x]["uname"];
         }
         if(empty($last_post[date_time]))
         {
                 $last_post[string] = ""._BBNOPOSTS."";
         }else // formats the last post string according to locale settings in languaga file
         {
         $last_post_time = $last_post[date_time];
         setlocale("LC_TIME", $locale);
         $last_post[date_time] = strftime(_LOCALDATETIME, $last_post[date_time]);
         $last_post[string] = $last_post[date_time]."<br>"._BBBY." ".$last_post[user];
         }
         echo "<TR  ALIGN=\"LEFT\" VALIGN=\"TOP\">";
         if($last_post_time > $last_visit && $last_post[date_time] != ""._BBNOPOSTS."") {
            echo "<TD BGCOLOR=\"$bgcolor1\" ALIGN=\"CENTER\" VALIGN=\"middle\" WIDTH=5%><IMG SRC=\"$imagesdir/red_folder.gif\"></TD>";
         }
// Keledan End

         else {
            echo "<TD BGCOLOR=\"$bgcolor1\" ALIGN=\"CENTER\" VALIGN=\"middle\" WIDTH=5%><IMG SRC=\"$imagesdir/folder.gif\"></TD>";         }
                 $name = stripslashes($forum_row[$x][forum_name]);
                $total_posts = $forum_row[$x]["forum_posts"];
                $total_topics = $forum_row[$x]["forum_topics"];
                $desc = stripslashes($forum_row[$x]["forum_desc"]);
                $forum_access=$forum_row[$x]["forum_access"];
                $forum_type=$forum_row[$x]["forum_type"];

                 echo "<TD BGCOLOR=\"$bgcolor1\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><a href=\"modules.php?op=modload&name=".$module_name."&file=viewforum&forum=".$forum_row[$x]["forum_id"]."&$total_posts\">$name</a></font>\n";
                 echo "<br><FONT FACE=\"$FontFace\" SIZE=\"$FontSize1\" COLOR=\"$FontColor1\">$desc</font></TD>\n";

                if ($forum_type == "1")
                         echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBPROTECT."</font></TD>\n";
                if ($forum_access=="1" && $forum_type == "0")
                         echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBREGUSER."</font></TD>\n";
                if ($forum_access=="2" && $forum_type == "0")
                         echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBFREEFORALL."</font></TD>\n";
                if ($forum_access =="3" && $forum_type=="0")
                         echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBMODERATOR."</font></TD>\n";


                 echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">$total_topics</font></TD>\n";
                 echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">$total_posts</font></TD>\n";
                 echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=15% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize1\" COLOR=\"$FontColor1\">".$last_post[string]."</font></TD>\n";
                 $forum_moderators = get_moderators($forum_row[$x][forum_id], $db);
                 echo "<TD BGCOLOR=\"$bgcolor1\" WIDTH=5% ALIGN=\"CENTER\" VALIGN=\"MIDDLE\" NOWRAP><FONT FACE=\"$FontFace\" SIZE=\"-2\" COLOR=\"$FontColor1\">";
                 $count = 0;

         while(list($null, $mods) = each($forum_moderators)) {
            while(list($mod_id, $mod_name) = each($mods)) {
               if($count > 0)
                 echo ", ";
               if(!($count % 2) && $count != 0)
                 echo "<BR>";
               echo "<a href=\"modules.php?name=Your_Account&amp;op=userinfo&uname=$mod_name\">$mod_name</a>";
               $count++;
            }
         }
         echo "</font></td></tr>\n";
      }
    }
  }
}

?>
<TR ALIGN="LEFT" BGCOLOR="<?php echo $bgcolor1?>">
<TD COLSPAN="7" NOWRAP ><b><?php echo "<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">"._BBPMSG."</font>";?></b></TD></TR>
<TR ALIGN="LEFT" BGCOLOR="<?php echo $BgColor3?>">
<TD COLSPAN="7" NOWRAP >&nbsp;<img src="<? echo "$imagesdir";?>/inbox.gif" Alt="<?php echo ""._BBINBOX."\">&nbsp;<FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><a href=\"modules.php?name=Private_Messages\">";?><?php echo ""._BBINBOX."";?></font></a><br>
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
<TABLE ALIGN="CENTER" BORDER="0" WIDTH="<?php echo $TableWidth?>"><TR><TD>
<FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>">
<IMG SRC="<?php echo "$imagesdir/red_folder.gif"; ?>"> = <?php echo ""._BBNEWPOSTS."";?>.
<BR><IMG SRC="<?php echo "$imagesdir/folder.gif"; ?>"> = <?php echo ""._BBNONEPOSTS."";?>.
</FONT></TD></TR></TABLE>

<?php
CloseTable();
include("footer.php");
?>