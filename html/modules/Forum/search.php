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
$pagetype = "other";
 
if(!$submit)
{
echo "<a href=\"modules.php?op=modload&amp;name=".$module_name."&amp;file=index\">"._BBFORUMS."</a> >> "._SEARCH."<br><br>";
?>
<FORM NAME="Search" ACTION="modules.php?op=modload&amp;name=<? echo"".$module_name."";?>&amp;file=search" METHOD="POST">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="100%">
<TR>
	<TD  BGCOLOR="<?php echo "$bgcolor2";?>">
	<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
	<TR bgcolor="<? echo "$bgcolor2"; ?>">
	<td colspan="2"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><?echo""._BBADVSRCH."";?></font></td>
	</tr>
	<TR bgcolor="<? echo "$bgcolor1"; ?>">
	<TD WIDTH="20%" ALIGN="RIGHT">
		<font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><b><?php echo ""._BBSEARCHTERMS.""; ?></b>:&nbsp;
	</TD>
	<TD WIDTH="70%">
		<INPUT TYPE="text" name="term">
	</TD>
	</TR>
	<TR BGCOLOR="<? echo "$bgcolor1"; ?>">
	<TD WIDTH="20%">&nbsp;</TD>
	<TD WIDTH="70%">
		<INPUT TYPE="radio" name="addterms" value="any" CHECKED>
		<font face="<?php echo $FontFace?>" size="<?php echo $FontSize3?>"><?php echo ""._BBSEARCHANY."";?>
	</TD>
	</TR>
	<TR BGCOLOR="<? echo "$bgcolor1"; ?>">
	<TD WIDTH="20%">&nbsp;</TD>
	<TD WIDTH="70%">
		<INPUT TYPE="radio" name="addterms" value="all">
		<font face="<?php echo $FontFace?>" size="<?php echo $FontSize3?>"><?php echo ""._BBSEARCHALL."";?>
	</TD>
	</TR>
	<TR BGCOLOR="<? echo "$bgcolor1"; ?>">
	<TD WIDTH="20%" ALIGN="RIGHT">
		<font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><b><?php echo ""._BBFORUM."";?></b>:&nbsp;
	</TD>
	<TD WIDTH="70%">
		<select name="forum">
		<option value="all"><?php echo ""._BBSEARCHALLFRM."";?></option>
		<?php
			$query = "SELECT forum_name,forum_id FROM ".$prefix."_forums WHERE forum_type != 1";
			if(!$result = mysql_query($query))
			{
				die("<font size=+1>An Error Occured</font><hr>phpBB was unable to query the forums database");
			}
			while($row = @mysql_fetch_array($result))
			{
				echo "<option value=$row[forum_id]>$row[forum_name]</option>";
			}
		?>
		</select>
	</TD>
	</TR>
	<TR BGCOLOR="<? echo "$bgcolor1"; ?>">
	<TD WIDTH="20%" ALIGN="RIGHT">
		<font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><?php echo stripslashes("<b>"._BBAUTHOR."</b>:");
                ?>
	</TD>
	<TD WIDTH="70%">
		<INPUT TYPE="text" name="search_username">
	</TD>
	</TR>
	<TR BGCOLOR="<? echo "$bgcolor1"; ?>">
	<TD WIDTH="20%" ALIGN="RIGHT">
		<font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><b><?php echo ""._BBSORTBY."";?></b>:
	</TD>
	<TD WIDTH="70%">
        <font face="<?php echo $FontFace?>" size="<?php echo $FontSize3?>">
	<?php //All values are the fields used to search the database - a table must be specified for each field ?>
		<INPUT TYPE="radio" name="sortby" value="p.post_time desc" CHECKED><?php echo ""._BBDATE."";?>
		&nbsp;&nbsp;
		<INPUT TYPE="radio" name="sortby" value="t.topic_title"><?php echo ""._BBTOPIC."";?>
		&nbsp;&nbsp;
		<INPUT TYPE="radio" name="sortby" value="f.forum_name"><?php echo ""._BBFORUM."";?>
		&nbsp;&nbsp;
		<INPUT TYPE="radio" name="sortby" value="u.username"><?php echo ""._BBUSERNAME."";?>
		&nbsp;&nbsp;
	</TD>
	</TR> 

<?php 
// 25oct00 dsig -add radio to determine what to search title or text or both..default both 
?> 
   <TR BGCOLOR="<? echo "$bgcolor1"; ?>"> 
   	<TD WIDTH="20%" ALIGN="RIGHT"> 
        <font face="<?php echo $FontFace?>" size="<?php echo $FontSize2?>"><b><?php echo ""._BBSEARCHIN."";?></b>: 
       	</TD> 
        <TD WIDTH="70%"> 
<?php 
/* 
26oct00 dsig added note
//           on default to change default 'checked' item simply move the 'CHECKED' keyword 
//           from one 'radio' to another. 
*/ 
?> 
      <font face="<?php echo $FontFace?>" size="<?php echo $FontSize3?>">
      <INPUT TYPE="radio" name="searchboth" value="both" CHECKED><?php echo ""._BBSUBJECT." & "._BBBODY."";?>
      <INPUT TYPE="radio" name="searchboth" value="title"><?php echo ""._BBSUBJECT."";?>
      <INPUT TYPE="radio" name="searchboth" value="text"><?php echo ""._BBBODY."";?>
      </TD> 
  </TR>      
</TABLE>

	</TD>
</TR>
</TABLE>
<br>
	<CENTER>
	<INPUT TYPE="Submit" Name="submit" Value="<?php echo ""._BBSEARCH."";?>">
	</FORM>
	</CENTER>

<?php
}
else  // Submitting query
{

/**********
 Sept 6.
 $query is the basis of the query
 $addquery is all the additional search fields - necessary because of the WHERE clause in SQL
**********/

$query_count = "SELECT u.uid, f.forum_id, p.topic_id, u.uname, p.post_time, t.topic_title, f.forum_name FROM ".$prefix."_posts p, ".$prefix."_posts_text pt, ".$prefix."_users u, ".$prefix."_forums f, ".$prefix."_bbtopics t ";

if(isset($term) && $term != "")
{
	$terms = split(" ",addslashes($term));				// Get all the words into an array
	$addquery_count .= "(pt.post_text LIKE '%$terms[0]%'";		
	$subquery_count .= "(t.topic_title LIKE '%$terms[0]%'"; 
	
	if($addterms=="any")					// AND/OR relates to the ANY or ALL on Search Page
		$andor = "OR";
	else
		$andor = "AND";
	$size = sizeof($terms);
	for($i=1;$i<$size;$i++) {
		$addquery_count .=" $andor pt.post_text LIKE '%$terms[$i]%'";
		$subquery_count .=" $andor t.topic_title LIKE '%$terms[$i]%'"; 
	}	     
	$addquery_count.=")";
	$subquery_count.=")";
}
if(isset($forum) && $forum!="all")
{
	if(isset($addquery_count)) {
	   $addquery_count .= " AND ";
	   $subquery_count .= " AND ";
	}
	
	$addquery_count .=" p.forum_id=$forum";
	$subquery_count .=" p.forum_id=$forum";
}
if(isset($search_username)&&$search_username!="")
{
	$search_username = addslashes($search_username);
   if(!$result = mysql_query("SELECT count(uid) FROM ".$prefix."_users WHERE uname='$search_username'"))
	{
		error_die("<font size=+1>An Error Occured</font><hr>phpBB was unable to query the forums database");
	}
   $row = @mysql_fetch_array($result);
   if(!$row)
	{
		error_die("That user does not exist.  Please go back and search again.");
	}
   $userid = $row[uid];
   if(isset($addquery)) {
      $addquery_count.=" AND p.poster_id=$userid AND u.uname='$search_username'";
      $subquery_count.=" AND p.poster_id=$userid AND u.uname='$search_username'";
   }
   else {
      $addquery_count.=" p.poster_id=$userid AND u.uname='$search_username'";
      $subquery_count.=" p.poster_id=$userid AND u.uname='$search_username'";
   }
}	
if(isset($addquery_count)) {
   switch ($searchboth) { 
    case "both" : 
      $query_count .= " WHERE ( $subquery_count OR $addquery_count ) AND "; 
      break; 
    case "title" : 
      $query_count .= " WHERE ( $subquery_count ) AND "; 
      break; 
    case "text" : 
      $query_count .= " WHERE ( $addquery_count ) AND "; 
      break; 
   }
}
else
{
     $query_count.=" WHERE ";
}

   $query_count .= " p.post_id = pt.post_id 
						AND p.topic_id = t.topic_id 
						AND p.forum_id = f.forum_id 
						AND p.poster_id = u.uid 
						AND f.forum_type != 1"; 
//  100100 bartvb  Uncomment the following GROUP BY line to show matching topics instead of all matching posts.
//   $query_count .= " GROUP BY t.topic_id";
   $query_count .= " ORDER BY $sortby";



#limit pages shown
if($page) {
$start_limit = ($page-1) * $search_results;
}
else {
$start_limit = 0;
$page = 1;
}

$num = mysql_num_rows(mysql_query($query_count));

if($num > $search_results) {
$pages = $num / $search_results;
$pages = ceil($pages);

if ($page == $pages) {
$to = $pages;
} elseif ($page == $pages-1) {
$to = $page+1;
} elseif ($page == $pages-2) {
$to = $page+2;
} else {
$to = $page+3;
}

if ($page == 1 || $page == 2 || $page == 3) {
$from = 1;
} else {
$from = $page-3;
}



for ($i = $from; $i <= $to; $i++) {
if ($i == $page) {
$x = $i-1;
$y = $i+1;
if ($i == 1) {
$fwd_back_all_down = "";
$fwd_back_down = "";
} else {
$fwd_back_all_down = "&nbsp;&nbsp;<a href=\"modules.php?op=modload&amp;name=$module_name&amp;file=search&amp;sortby=$sortby&amp;page=1&amp;searchboth=$searchboth&amp;search_username=$search_username&amp;term=$term&amp;addterms=$addterms&amp;forum=$forum&amp;submit=$submit\"><<</a>&nbsp;&nbsp;";
$fwd_back_down = "&nbsp;&nbsp;<a href=\"modules.php?op=modload&amp;name=$module_name&amp;file=search&amp;sortby=$sortby&amp;page=$x&amp;searchboth=$searchboth&amp;search_username=$search_username&amp;term=$term&amp;addterms=$addterms&amp;forum=$forum&amp;submit=$submit\"><</a>&nbsp;&nbsp;";
}
$fwd_back .= "&nbsp;&nbsp;<u><b>$i</b></u>&nbsp;&nbsp;";
if ($i >= $to) {
$fwd_back_up = "";
$fwd_back_all_up = "";
} else {
$fwd_back_up = "&nbsp;&nbsp;<a href=\"modules.php?op=modload&amp;name=$module_name&amp;file=search&amp;sortby=$sortby&amp;page=$y&amp;searchboth=$searchboth&amp;search_username=$search_username&amp;term=$term&amp;addterms=$addterms&amp;forum=$forum&amp;submit=$submit\">></a>&nbsp;&nbsp;";
$fwd_back_all_up = "&nbsp;&nbsp;<a href=\"modules.php?op=modload&amp;name=$module_name&amp;file=search&amp;sortby=$sortby&amp;page=$pages&amp;searchboth=$searchboth&amp;search_username=$search_username&amp;term=$term&amp;addterms=$addterms&amp;forum=$forum&amp;submit=$submit\">>></a>&nbsp;&nbsp;";
}
} else {
$fwd_back .= "&nbsp;&nbsp;<a href=\"modules.php?op=modload&amp;name=$module_name&amp;file=search&amp;sortby=$sortby&amp;page=$i&amp;searchboth=$searchboth&amp;search_username=$search_username&amp;term=$term&amp;addterms=$addterms&amp;forum=$forum&amp;submit=$submit\">$i</a>&nbsp;&nbsp;";
}
}
$multipage = "$fwd_back_all_down $fwd_back_down $fwd_back $fwd_back_up $fwd_back_all_up ";
}

$query = "SELECT u.uid,f.forum_id, p.topic_id, u.uname, p.post_time,t.topic_title,f.forum_name 
			 FROM ".$prefix."_posts p, ".$prefix."_posts_text pt, ".$prefix."_users u, ".$prefix."_forums f,".$prefix."_bbtopics t";

if(isset($term) && $term != "")
{
	$terms = split(" ",addslashes($term));				// Get all the words into an array
	$addquery .= "(pt.post_text LIKE '%$terms[0]%'";		
	$subquery .= "(t.topic_title LIKE '%$terms[0]%'"; 
	
	if($addterms=="any")					// AND/OR relates to the ANY or ALL on Search Page
		$andor = "OR";
	else
		$andor = "AND";
	$size = sizeof($terms);
	for($i=1;$i<$size;$i++) {
		$addquery.=" $andor pt.post_text LIKE '%$terms[$i]%'";
		$subquery.=" $andor t.topic_title LIKE '%$terms[$i]%'"; 
	}	     
	$addquery.=")";
	$subquery.=")";
}
if(isset($forum) && $forum!="all")
{
	if(isset($addquery)) {
	   $addquery .= " AND ";
	   $subquery .= " AND ";
	}
	
	$addquery .=" p.forum_id=$forum";
	$subquery .=" p.forum_id=$forum";
}
if(isset($search_username)&&$search_username!="")
{
	$search_username = addslashes($search_username);
   if(!$result = mysql_query("SELECT uid FROM ".$prefix."_users WHERE uname='$search_username'"))
	{
		error_die("<font size=+1>An Error Occured</font><hr>phpBB was unable to query the forums database");
	}
   $row = @mysql_fetch_array($result);
   if(!$row)
	{
		error_die("That user does not exist.  Please go back and search again.");
	}
   $userid = $row[uid];
   if(isset($addquery)) {
      $addquery.=" AND p.poster_id=$userid AND u.uname='$search_username'";
      $subquery.=" AND p.poster_id=$userid AND u.uname='$search_username'";
   }
   else {
      $addquery.=" p.poster_id=$userid AND u.uname='$search_username'";
      $subquery.=" p.poster_id=$userid AND u.uname='$search_username'";
   }
}	
if(isset($addquery)) {
   switch ($searchboth) { 
    case "both" : 
      $query .= " WHERE ( $subquery OR $addquery ) AND "; 
      break; 
    case "title" : 
      $query .= " WHERE ( $subquery ) AND "; 
      break; 
    case "text" : 
      $query .= " WHERE ( $addquery ) AND "; 
      break; 
   }
}
else
{
     $query.=" WHERE ";
}

   $query .= " p.post_id = pt.post_id 
						AND p.topic_id = t.topic_id 
						AND p.forum_id = f.forum_id 
						AND p.poster_id = u.uid 
						AND f.forum_type != 1";
//  100100 bartvb  Uncomment the following GROUP BY line to show matching topics instead of all matching posts.
//   $query .= " GROUP BY t.topic_id";
   $query .= " ORDER BY $sortby";
   $query .= " LIMIT $start_limit, $search_results";

	if(!$result = mysql_query($query))
	{
		die("<font size=+1>An Error Occured</font><hr>phpBB was unable to query the forums database<BR>".mysql_error()."<BR>$query");
	}

	if(!$row = @mysql_fetch_array($result))
	{
		die(""._BBNOMATCHES."");
	}

echo "<a href=\"modules.php?op=modload&amp;name=".$module_name."&amp;file=index\">"._BBFORUMS."</a> >> <a href=\"modules.php?op=modload&amp;name=".$module_name."&amp;file=search\">"._SEARCH."</a> >> "._RESULTS."<br><br>\n";	
echo "<div align=\"center\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize1\" COLOR=\"$FontColor1\">$num "._BBSEARCHCRITERIA."</font><br><br>\n";	
echo "$multipage</div>\n";


?>
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="0" ALIGN="CENTER" VALIGN="TOP" WIDTH="95%"><TR><TD  BGCOLOR="<?php echo "$bgcolor2";?>">
<TABLE BORDER="0" CELLPADDING="1" CELLSPACING="1" WIDTH="100%">
<TR BGCOLOR="<? echo "$bgcolor2"; ?>" ALIGN="LEFT">
        <TD ALIGN="CENTER" WIDTH="30%"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBFORUM."";?></B></font></TD>
        <TD ALIGN="CENTER" WIDTH="30%"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBTOPIC."";?></B></font></TD>
        <TD ALIGN="CENTER" WIDTH="25%"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBAUTHOR."";?></B></font></TD>
        <TD ALIGN="CENTER" WIDTH="15%"><FONT FACE="<?php echo $FontFace?>" SIZE="<?php echo $FontSize1?>" COLOR="<?php echo $FontColor1?>"><B><?php echo ""._BBPOSTED."";?></B></font></TD>
</TR>
<?php
	do {
		echo "<TR BGCOLOR=\"$bgcolor1\">";
		echo "<TD ALIGN=\"CENTER\" WIDTH=\"30%\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><a href=\"modules.php?op=modload&amp;name=".$module_name."&amp;file=viewforum&amp;forum=$row[forum_id]\">". stripslashes($row[forum_name]) . "</a><font></TD>";
		echo "<TD ALIGN=\"CENTER\" WIDTH=\"30%\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><a href=\"modules.php?op=modload&amp;name=".$module_name."&amp;file=viewtopic&amp;topic=$row[topic_id]&amp;forum=$row[forum_id]\">". stripslashes($row[topic_title]) . "</a><font></TD>";
		echo "<TD ALIGN=\"CENTER\" WIDTH=\"25%\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\"><a href=\"modules.php?op=modload&amp;name=".$module_member."&amp;file=index&amp;func=details&amp;uid=$row[uid]\">$row[uname]</a><font></TD>";
		echo "<TD ALIGN=\"CENTER\" WIDTH=\"15%\"><FONT FACE=\"$FontFace\" SIZE=\"$FontSize2\" COLOR=\"$FontColor1\">$row[post_time]<font></TD>";
		echo "</TR>";
	}while($row=@mysql_fetch_array($result));
?>	

</TABLE>
</TR>
</TR>
</TABLE>

<?php
}
echo "<div align=\"center\">$multipage</div>";
CloseTable();
include("footer.php");
?>
