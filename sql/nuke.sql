# MySQL dump 8.14
#
# Host: localhost    Database: nuke
#--------------------------------------------------------
# Server version	3.23.41

#
# Table structure for table 'nuke_access'
#

CREATE TABLE nuke_access (
  access_id int(10) NOT NULL auto_increment,
  access_title varchar(20) default NULL,
  PRIMARY KEY  (access_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_access'
#

INSERT INTO nuke_access VALUES (-1,'Deleted');
INSERT INTO nuke_access VALUES (1,'User');
INSERT INTO nuke_access VALUES (2,'Moderator');
INSERT INTO nuke_access VALUES (3,'Super Moderator');
INSERT INTO nuke_access VALUES (4,'Administrator');

#
# Table structure for table 'nuke_authors'
#

CREATE TABLE nuke_authors (
  aid varchar(25) NOT NULL default '',
  name varchar(50) default NULL,
  url varchar(255) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  pwd varchar(40) default NULL,
  counter int(11) NOT NULL default '0',
  radminarticle tinyint(2) NOT NULL default '0',
  radmintopic tinyint(2) NOT NULL default '0',
  radminuser tinyint(2) NOT NULL default '0',
  radminsurvey tinyint(2) NOT NULL default '0',
  radminsection tinyint(2) NOT NULL default '0',
  radminlink tinyint(2) NOT NULL default '0',
  radminephem tinyint(2) NOT NULL default '0',
  radminfaq tinyint(2) NOT NULL default '0',
  radmindownload tinyint(2) NOT NULL default '0',
  radminreviews tinyint(2) NOT NULL default '0',
  radminnewsletter tinyint(2) NOT NULL default '0',
  radminforum tinyint(2) NOT NULL default '0',
  radmincontent tinyint(2) NOT NULL default '0',
  radminency tinyint(2) NOT NULL default '0',
  radminsuper tinyint(2) NOT NULL default '1',
  admlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (aid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_authors'
#


#
# Table structure for table 'nuke_autonews'
#

CREATE TABLE nuke_autonews (
  anid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(80) NOT NULL default '',
  time varchar(19) NOT NULL default '',
  hometext text NOT NULL,
  bodytext text NOT NULL,
  topic int(3) NOT NULL default '1',
  informant varchar(20) NOT NULL default '',
  notes text NOT NULL,
  ihome int(1) NOT NULL default '0',
  alanguage varchar(30) NOT NULL default '',
  acomm int(1) NOT NULL default '0',
  PRIMARY KEY  (anid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_autonews'
#


#
# Table structure for table 'nuke_banlist'
#

CREATE TABLE nuke_banlist (
  ban_id int(10) NOT NULL auto_increment,
  ban_userid int(10) default NULL,
  ban_ip varchar(16) default NULL,
  ban_start int(32) default NULL,
  ban_end int(50) default NULL,
  ban_time_type int(10) default NULL,
  PRIMARY KEY  (ban_id),
  KEY ban_id (ban_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_banlist'
#


#
# Table structure for table 'nuke_banner'
#

CREATE TABLE nuke_banner (
  bid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  imptotal int(11) NOT NULL default '0',
  impmade int(11) NOT NULL default '0',
  clicks int(11) NOT NULL default '0',
  imageurl varchar(100) NOT NULL default '',
  clickurl varchar(200) NOT NULL default '',
  date datetime default NULL,
  PRIMARY KEY  (bid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_banner'
#


#
# Table structure for table 'nuke_bannerclient'
#

CREATE TABLE nuke_bannerclient (
  cid int(11) NOT NULL auto_increment,
  name varchar(60) NOT NULL default '',
  contact varchar(60) NOT NULL default '',
  email varchar(60) NOT NULL default '',
  login varchar(10) NOT NULL default '',
  passwd varchar(10) NOT NULL default '',
  extrainfo text NOT NULL,
  PRIMARY KEY  (cid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_bannerclient'
#


#
# Table structure for table 'nuke_bannerfinish'
#

CREATE TABLE nuke_bannerfinish (
  bid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  impressions int(11) NOT NULL default '0',
  clicks int(11) NOT NULL default '0',
  datestart datetime default NULL,
  dateend datetime default NULL,
  PRIMARY KEY  (bid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_bannerfinish'
#


#
# Table structure for table 'nuke_bbtopics'
#

CREATE TABLE nuke_bbtopics (
  topic_id int(10) NOT NULL auto_increment,
  topic_title varchar(100) default NULL,
  topic_poster int(10) default NULL,
  topic_time varchar(20) default NULL,
  topic_views int(10) NOT NULL default '0',
  topic_replies int(10) NOT NULL default '0',
  topic_last_post_id int(10) NOT NULL default '0',
  forum_id int(10) NOT NULL default '0',
  topic_status int(10) NOT NULL default '0',
  topic_notify int(2) default '0',
  PRIMARY KEY  (topic_id),
  KEY topic_id (topic_id),
  KEY forum_id (forum_id),
  KEY topic_last_post_id (topic_last_post_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_bbtopics'
#


#
# Table structure for table 'nuke_blocks'
#

CREATE TABLE nuke_blocks (
  bid int(10) NOT NULL auto_increment,
  bkey varchar(15) NOT NULL default '',
  title varchar(60) NOT NULL default '',
  content text NOT NULL,
  url varchar(200) NOT NULL default '',
  position char(1) NOT NULL default '',
  weight int(10) NOT NULL default '1',
  active int(1) NOT NULL default '1',
  refresh int(10) NOT NULL default '0',
  time varchar(14) NOT NULL default '0',
  blanguage varchar(30) NOT NULL default '',
  blockfile varchar(255) NOT NULL default '',
  view int(1) NOT NULL default '0',
  PRIMARY KEY  (bid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_blocks'
#

INSERT INTO nuke_blocks VALUES (1,'','Modules','','','l',1,1,0,'','','block-Modules.php',0);
INSERT INTO nuke_blocks VALUES (2,'admin','Administration','<strong><big>·</big></strong> <a href=\"admin.php\">Administration</a><br>\r\n<strong><big>·</big></strong> <a href=\"admin.php?op=adminStory\">NEW Story</a><br>\r\n<strong><big>·</big></strong> <a href=\"admin.php?op=create\">Change Survey</a><br>\r\n<strong><big>·</big></strong> <a href=\"admin.php?op=content\">Content</a><br>\r\n<strong><big>·</big></strong> <a href=\"admin.php?op=logout\">Logout</a>','','l',2,1,0,'985591188','','',2);
INSERT INTO nuke_blocks VALUES (3,'','Who\'s Online','','','l',3,1,0,'','','block-Who_is_Online.php',0);
INSERT INTO nuke_blocks VALUES (4,'','Search','','','l',4,0,3600,'','','block-Search.php',0);
INSERT INTO nuke_blocks VALUES (5,'','Languages','','','l',5,1,3600,'','','block-Languages.php',0);
INSERT INTO nuke_blocks VALUES (6,'','Random Headlines','','','l',6,0,3600,'','','block-Random_Headlines.php',0);
INSERT INTO nuke_blocks VALUES (7,'userbox','User\'s Custom Box','','','r',1,1,0,'','','',1);
INSERT INTO nuke_blocks VALUES (8,'','Categories Menu','','','r',2,0,0,'','','block-Categories.php',0);
INSERT INTO nuke_blocks VALUES (9,'','Survey','','','r',3,1,3600,'','','block-Survey.php',0);
INSERT INTO nuke_blocks VALUES (10,'','Login','','','r',4,1,3600,'','','block-Login.php',3);
INSERT INTO nuke_blocks VALUES (11,'','Big Story of Today','','','r',5,1,3600,'','','block-Big_Story_of_Today.php',0);
INSERT INTO nuke_blocks VALUES (12,'','Old Articles','','','r',6,1,3600,'','','block-Old_Articles.php',0);
INSERT INTO nuke_blocks VALUES (13,'','Information','<br><center><font class=\"content\">\r\n<a href=\"http://phpnuke.org\"><img src=\"images/powered/phpnuke.gif\" border=\"0\" alt=\"Powered by PHP-Nuke\" width=\"88\" height=\"31\"></a>\r\n<br><br>\r\n<a href=\"http://validator.w3.org/check/referer\"><img src=\"images/html401.gif\" width=\"88\" height=\"31\" alt=\"Valid HTML 4.01!\" border=\"0\"></a>\r\n<br><br>\r\n<a href=\"http://jigsaw.w3.org/css-validator\"><img src=\"images/css.gif\" width=\"88\" height=\"31\" alt=\"Valid CSS!\" border=\"0\"></a></font></center>','','r',7,1,0,'','','',0);


#
# Table structure for table 'nuke_catagories'
#

CREATE TABLE nuke_catagories (
  cat_id int(10) NOT NULL auto_increment,
  cat_title varchar(100) default NULL,
  cat_order varchar(10) default NULL,
  PRIMARY KEY  (cat_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_catagories'
#


#
# Table structure for table 'nuke_comments'
#

CREATE TABLE nuke_comments (
  tid int(11) NOT NULL auto_increment,
  pid int(11) default '0',
  sid int(11) default '0',
  date datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  subject varchar(85) NOT NULL default '',
  comment text NOT NULL,
  score tinyint(4) NOT NULL default '0',
  reason tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (tid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_comments'
#


#
# Table structure for table 'nuke_config'
#

CREATE TABLE nuke_config (
  config_id int(10) NOT NULL auto_increment,
  allow_html int(2) default NULL,
  allow_bbcode int(2) default NULL,
  allow_sig int(2) default NULL,
  selected int(2) NOT NULL default '0',
  posts_per_page int(10) default NULL,
  hot_threshold int(10) default NULL,
  topics_per_page int(10) default NULL,
  email_sig varchar(255) default NULL,
  email_from varchar(100) default NULL,
  PRIMARY KEY  (config_id),
  UNIQUE KEY selected (selected)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_config'
#

INSERT INTO nuke_config VALUES (1,1,1,1,1,10,10,20,'Have a Nice Day!','webmaster@yoursite.com');

#
# Table structure for table 'nuke_counter'
#

CREATE TABLE nuke_counter (
  type varchar(80) NOT NULL default '',
  var varchar(80) NOT NULL default '',
  count int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_counter'
#

INSERT INTO nuke_counter VALUES ('total','hits',1);
INSERT INTO nuke_counter VALUES ('browser','WebTV',0);
INSERT INTO nuke_counter VALUES ('browser','Lynx',0);
INSERT INTO nuke_counter VALUES ('browser','MSIE',0);
INSERT INTO nuke_counter VALUES ('browser','Opera',0);
INSERT INTO nuke_counter VALUES ('browser','Konqueror',0);
INSERT INTO nuke_counter VALUES ('browser','Netscape',1);
INSERT INTO nuke_counter VALUES ('browser','Bot',0);
INSERT INTO nuke_counter VALUES ('browser','Other',0);
INSERT INTO nuke_counter VALUES ('os','Windows',0);
INSERT INTO nuke_counter VALUES ('os','Linux',1);
INSERT INTO nuke_counter VALUES ('os','Mac',0);
INSERT INTO nuke_counter VALUES ('os','FreeBSD',0);
INSERT INTO nuke_counter VALUES ('os','SunOS',0);
INSERT INTO nuke_counter VALUES ('os','IRIX',0);
INSERT INTO nuke_counter VALUES ('os','BeOS',0);
INSERT INTO nuke_counter VALUES ('os','OS/2',0);
INSERT INTO nuke_counter VALUES ('os','AIX',0);
INSERT INTO nuke_counter VALUES ('os','Other',0);

#
# Table structure for table 'nuke_disallow'
#

CREATE TABLE nuke_disallow (
  disallow_id int(10) NOT NULL auto_increment,
  disallow_username varchar(50) default NULL,
  PRIMARY KEY  (disallow_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_disallow'
#


#
# Table structure for table 'nuke_downloads_categories'
#

CREATE TABLE nuke_downloads_categories (
  cid int(11) NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  cdescription text NOT NULL,
  parentid int(11) NOT NULL default '0',
  PRIMARY KEY  (cid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_downloads_categories'
#


#
# Table structure for table 'nuke_downloads_downloads'
#

CREATE TABLE nuke_downloads_downloads (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  date datetime default NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  hits int(11) NOT NULL default '0',
  submitter varchar(60) NOT NULL default '',
  downloadratingsummary double(6,4) NOT NULL default '0.0000',
  totalvotes int(11) NOT NULL default '0',
  totalcomments int(11) NOT NULL default '0',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (lid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_downloads_downloads'
#


#
# Table structure for table 'nuke_downloads_editorials'
#

CREATE TABLE nuke_downloads_editorials (
  downloadid int(11) NOT NULL default '0',
  adminid varchar(60) NOT NULL default '',
  editorialtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  editorialtext text NOT NULL,
  editorialtitle varchar(100) NOT NULL default '',
  PRIMARY KEY  (downloadid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_downloads_editorials'
#


#
# Table structure for table 'nuke_downloads_modrequest'
#

CREATE TABLE nuke_downloads_modrequest (
  requestid int(11) NOT NULL auto_increment,
  lid int(11) NOT NULL default '0',
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  modifysubmitter varchar(60) NOT NULL default '',
  brokendownload int(3) NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (requestid),
  UNIQUE KEY requestid (requestid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_downloads_modrequest'
#


#
# Table structure for table 'nuke_downloads_newdownload'
#

CREATE TABLE nuke_downloads_newdownload (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  submitter varchar(60) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  version varchar(10) NOT NULL default '',
  homepage varchar(200) NOT NULL default '',
  PRIMARY KEY  (lid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_downloads_newdownload'
#


#
# Table structure for table 'nuke_downloads_votedata'
#

CREATE TABLE nuke_downloads_votedata (
  ratingdbid int(11) NOT NULL auto_increment,
  ratinglid int(11) NOT NULL default '0',
  ratinguser varchar(60) NOT NULL default '',
  rating int(11) NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingcomments text NOT NULL,
  ratingtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (ratingdbid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_downloads_votedata'
#


#
# Table structure for table 'nuke_encyclopedia'
#

CREATE TABLE nuke_encyclopedia (
  eid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  description text NOT NULL,
  elanguage varchar(30) NOT NULL default '',
  active int(1) NOT NULL default '0',
  PRIMARY KEY  (eid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_encyclopedia'
#


#
# Table structure for table 'nuke_encyclopedia_text'
#

CREATE TABLE nuke_encyclopedia_text (
  tid int(10) NOT NULL auto_increment,
  eid int(10) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  text text NOT NULL,
  counter int(10) NOT NULL default '0',
  PRIMARY KEY  (tid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_encyclopedia_text'
#


#
# Table structure for table 'nuke_ephem'
#

CREATE TABLE nuke_ephem (
  eid int(11) NOT NULL auto_increment,
  did int(2) NOT NULL default '0',
  mid int(2) NOT NULL default '0',
  yid int(4) NOT NULL default '0',
  content text NOT NULL,
  elanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (eid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_ephem'
#


#
# Table structure for table 'nuke_faqAnswer'
#

CREATE TABLE nuke_faqAnswer (
  id tinyint(4) NOT NULL auto_increment,
  id_cat tinyint(4) default NULL,
  question varchar(255) default NULL,
  answer text,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_faqAnswer'
#


#
# Table structure for table 'nuke_faqCategories'
#

CREATE TABLE nuke_faqCategories (
  id_cat tinyint(3) NOT NULL auto_increment,
  categories varchar(255) default NULL,
  flanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (id_cat)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_faqCategories'
#


#
# Table structure for table 'nuke_forum_access'
#

CREATE TABLE nuke_forum_access (
  forum_id int(10) NOT NULL default '0',
  user_id int(10) NOT NULL default '0',
  can_post tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (forum_id,user_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_forum_access'
#


#
# Table structure for table 'nuke_forum_mods'
#

CREATE TABLE nuke_forum_mods (
  forum_id int(10) NOT NULL default '0',
  user_id int(10) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_forum_mods'
#


#
# Table structure for table 'nuke_forums'
#

CREATE TABLE nuke_forums (
  forum_id int(10) NOT NULL auto_increment,
  forum_name varchar(150) default NULL,
  forum_desc text,
  forum_access int(10) default '1',
  forum_moderator int(10) default NULL,
  forum_topics int(10) NOT NULL default '0',
  forum_posts int(10) NOT NULL default '0',
  forum_last_post_id int(10) NOT NULL default '0',
  cat_id int(10) default NULL,
  forum_type int(10) default '0',
  PRIMARY KEY  (forum_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_forums'
#


#
# Table structure for table 'nuke_forumtopics'
#

CREATE TABLE nuke_forumtopics (
  topic_id int(10) NOT NULL auto_increment,
  topic_title varchar(100) default NULL,
  topic_poster int(10) default NULL,
  topic_time varchar(20) default NULL,
  topic_views int(10) NOT NULL default '0',
  forum_id int(10) default NULL,
  topic_status int(10) NOT NULL default '0',
  topic_notify int(2) default '0',
  PRIMARY KEY  (topic_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_forumtopics'
#


#
# Table structure for table 'nuke_headlines'
#

CREATE TABLE nuke_headlines (
  hid int(11) NOT NULL auto_increment,
  sitename varchar(30) NOT NULL default '',
  headlinesurl varchar(200) NOT NULL default '',
  PRIMARY KEY  (hid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_headlines'
#

INSERT INTO nuke_headlines VALUES (1,'PHP-Nuke','http://phpnuke.org/backend.php');
INSERT INTO nuke_headlines VALUES (2,'ODISEA','http://odisea.org/backend.php');
INSERT INTO nuke_headlines VALUES (3,'LinuxCentral','http://linuxcentral.com/backend/lcnew.rdf');
INSERT INTO nuke_headlines VALUES (4,'NewsForge','http://www.newsforge.com/newsforge.rdf');
INSERT INTO nuke_headlines VALUES (5,'PHPBuilder','http://phpbuilder.com/rss_feed.php');
INSERT INTO nuke_headlines VALUES (6,'PHP-Nuke Español','http://phpnuke-espanol.org/backend.php');
INSERT INTO nuke_headlines VALUES (7,'Freshmeat','http://freshmeat.net/backend/fm.rdf');
INSERT INTO nuke_headlines VALUES (8,'AppWatch','http://static.appwatch.com/appwatch.rdf');
INSERT INTO nuke_headlines VALUES (9,'LinuxWeelyNews','http://lwn.net/headlines/rss');
INSERT INTO nuke_headlines VALUES (10,'HappyPenguin','http://happypenguin.org/html/news.rdf');
INSERT INTO nuke_headlines VALUES (11,'Segfault','http://segfault.org/stories.xml');
INSERT INTO nuke_headlines VALUES (13,'KDE','http://www.kde.org/news/kdenews.rdf');
INSERT INTO nuke_headlines VALUES (14,'Perl.com','http://www.perl.com/pace/perlnews.rdf');
INSERT INTO nuke_headlines VALUES (15,'Themes.org','http://www.themes.org/news.rdf.phtml');
INSERT INTO nuke_headlines VALUES (16,'BrunchingShuttlecocks','http://www.brunching.com/brunching.rdf');
INSERT INTO nuke_headlines VALUES (17,'MozillaNewsBot','http://www.mozilla.org/newsbot/newsbot.rdf');
INSERT INTO nuke_headlines VALUES (18,'NewsTrolls','http://newstrolls.com/newstrolls.rdf');
INSERT INTO nuke_headlines VALUES (19,'FreakTech','http://sunsite.auc.dk/FreakTech/FreakTech.rdf');
INSERT INTO nuke_headlines VALUES (20,'AbsoluteGames','http://files.gameaholic.com/agfa.rdf');
INSERT INTO nuke_headlines VALUES (21,'SciFi-News','http://www.technopagan.org/sf-news/rdf.php');
INSERT INTO nuke_headlines VALUES (22,'SisterMachineGun','http://www.smg.org/index/mynetscape.html');
INSERT INTO nuke_headlines VALUES (23,'LinuxM68k','http://www.linux-m68k.org/linux-m68k.rdf');
INSERT INTO nuke_headlines VALUES (24,'Protest.net','http://www.protest.net/netcenter_rdf.cgi');
INSERT INTO nuke_headlines VALUES (25,'HollywoodBitchslap','http://hollywoodbitchslap.com/hbs.rdf');
INSERT INTO nuke_headlines VALUES (26,'DrDobbsTechNetCast','http://www.technetcast.com/tnc_headlines.rdf');
INSERT INTO nuke_headlines VALUES (27,'RivaExtreme','http://rivaextreme.com/ssi/rivaextreme.rdf.cdf');
INSERT INTO nuke_headlines VALUES (28,'Linuxpower','http://linuxpower.org/linuxpower.rdf');
INSERT INTO nuke_headlines VALUES (29,'PBSOnline','http://cgi.pbs.org/cgi-registry/featuresrdf.pl');
INSERT INTO nuke_headlines VALUES (30,'Listology','http://listology.com/recent.rdf');
INSERT INTO nuke_headlines VALUES (31,'Linuxdev.net','http://linuxdev.net/archive/news.cdf');
INSERT INTO nuke_headlines VALUES (32,'LinuxNewbie','http://www.linuxnewbie.org/news.cdf');
INSERT INTO nuke_headlines VALUES (33,'exoScience','http://www.exosci.com/exosci.rdf');
INSERT INTO nuke_headlines VALUES (34,'Technocrat','http://technocrat.net/rdf');
INSERT INTO nuke_headlines VALUES (35,'PDABuzz','http://www.pdabuzz.com/netscape.txt');
INSERT INTO nuke_headlines VALUES (36,'MicroUnices','http://mu.current.nu/mu.rdf');
INSERT INTO nuke_headlines VALUES (37,'TheNextLevel','http://www.the-nextlevel.com/rdf/tnl.rdf');
INSERT INTO nuke_headlines VALUES (38,'Gnotices','http://news.gnome.org/gnome-news/rdf');
INSERT INTO nuke_headlines VALUES (39,'DailyDaemonNews','http://daily.daemonnews.org/ddn.rdf.php3');
INSERT INTO nuke_headlines VALUES (40,'PerlMonks','http://www.perlmonks.org/headlines.rdf');
INSERT INTO nuke_headlines VALUES (41,'PerlNews','http://news.perl.org/perl-news-short.rdf');
INSERT INTO nuke_headlines VALUES (42,'BSDToday','http://www.bsdtoday.com/backend/bt.rdf');
INSERT INTO nuke_headlines VALUES (43,'DotKDE','http://dot.kde.org/rdf');
INSERT INTO nuke_headlines VALUES (44,'GeekNik','http://www.geeknik.net/backend/weblog.rdf');
INSERT INTO nuke_headlines VALUES (45,'HotWired','http://www.hotwired.com/webmonkey/meta/headlines.rdf');
INSERT INTO nuke_headlines VALUES (46,'JustLinux','http://www.justlinux.com/backend/features.rdf');
INSERT INTO nuke_headlines VALUES (47,'LAN-Systems','http://www.lansystems.com/backend/gazette_news_backend.rdf');
INSERT INTO nuke_headlines VALUES (48,'DigitalTheatre','http://www.dtheatre.com/backend.php3?xml=yes');
INSERT INTO nuke_headlines VALUES (49,'Linux.nu','http://www.linux.nu/backend/lnu.rdf');
INSERT INTO nuke_headlines VALUES (50,'Lin-x-pert','http://www.lin-x-pert.com/linxpert_apps.rdf');
INSERT INTO nuke_headlines VALUES (51,'MaximumBSD1','http://www.maximumbsd.com/backend/weblog.rdf1');
INSERT INTO nuke_headlines VALUES (52,'SolarisCentral','http://www.SolarisCentral.org/news/SolarisCentral.rdf');
INSERT INTO nuke_headlines VALUES (53,'Slashdot','http://slashdot.org/slashdot.rdf');
INSERT INTO nuke_headlines VALUES (54,'Linux.com','http://linux.com/mrn/front_page.rss');


#
# Table structure for table 'nuke_links_categories'
#

CREATE TABLE nuke_links_categories (
  cid int(11) NOT NULL auto_increment,
  title varchar(50) NOT NULL default '',
  cdescription text NOT NULL,
  parentid int(11) NOT NULL default '0',
  PRIMARY KEY  (cid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_links_categories'
#


#
# Table structure for table 'nuke_links_editorials'
#

CREATE TABLE nuke_links_editorials (
  linkid int(11) NOT NULL default '0',
  adminid varchar(60) NOT NULL default '',
  editorialtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  editorialtext text NOT NULL,
  editorialtitle varchar(100) NOT NULL default '',
  PRIMARY KEY  (linkid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_links_editorials'
#


#
# Table structure for table 'nuke_links_links'
#

CREATE TABLE nuke_links_links (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  date datetime default NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  hits int(11) NOT NULL default '0',
  submitter varchar(60) NOT NULL default '',
  linkratingsummary double(6,4) NOT NULL default '0.0000',
  totalvotes int(11) NOT NULL default '0',
  totalcomments int(11) NOT NULL default '0',
  PRIMARY KEY  (lid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_links_links'
#


#
# Table structure for table 'nuke_links_modrequest'
#

CREATE TABLE nuke_links_modrequest (
  requestid int(11) NOT NULL auto_increment,
  lid int(11) NOT NULL default '0',
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  modifysubmitter varchar(60) NOT NULL default '',
  brokenlink int(3) NOT NULL default '0',
  PRIMARY KEY  (requestid),
  UNIQUE KEY requestid (requestid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_links_modrequest'
#


#
# Table structure for table 'nuke_links_newlink'
#

CREATE TABLE nuke_links_newlink (
  lid int(11) NOT NULL auto_increment,
  cid int(11) NOT NULL default '0',
  sid int(11) NOT NULL default '0',
  title varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  description text NOT NULL,
  name varchar(100) NOT NULL default '',
  email varchar(100) NOT NULL default '',
  submitter varchar(60) NOT NULL default '',
  PRIMARY KEY  (lid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_links_newlink'
#


#
# Table structure for table 'nuke_links_votedata'
#

CREATE TABLE nuke_links_votedata (
  ratingdbid int(11) NOT NULL auto_increment,
  ratinglid int(11) NOT NULL default '0',
  ratinguser varchar(60) NOT NULL default '',
  rating int(11) NOT NULL default '0',
  ratinghostname varchar(60) NOT NULL default '',
  ratingcomments text NOT NULL,
  ratingtimestamp datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (ratingdbid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_links_votedata'
#


#
# Table structure for table 'nuke_main'
#

CREATE TABLE nuke_main (
  main_module varchar(255) NOT NULL default ''
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_main'
#

INSERT INTO nuke_main VALUES ('News');

#
# Table structure for table 'nuke_message'
#

CREATE TABLE nuke_message (
  mid int(11) NOT NULL auto_increment,
  title varchar(100) NOT NULL default '',
  content text NOT NULL,
  date varchar(14) NOT NULL default '',
  expire int(7) NOT NULL default '0',
  active int(1) NOT NULL default '1',
  view int(1) NOT NULL default '1',
  mlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (mid),
  UNIQUE KEY mid (mid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_message'
#

INSERT INTO nuke_message VALUES (1,'Welcome to PHP-Nuke!','Congratulations! You have now a web portal installed!. You can edit or change this message from the <a href=\"admin.php\">Administration</a> page.<br><br><center><b>For security reasons the best idea is to create the Super User right NOW by clicking <a href=\"admin.php\">HERE</a></b></center><br><br>You can also create a user for you from the same page. Please read carefully the README file for some details, CREDITS files to see from where comes the things and remember that this is free software under the GPL License (read COPYING file for details). Hope you enjoy this software. Please report any bug you find by dropping me an email when one of this annoying things happens and I\'ll try to fix it for the next release. If you like this software and want to make a contribution you can purchase me something from my <a href=\"http://www.amazon.com/exec/obidos/wishlist/1N51JTF344VHI\">Wish List</a>. PHP-Nuke is proudly sponsored by <a href=\"http://www.mandrakesoft.com\">MandrakeSoft</a>, creators of Linux Mandrake. Now, have fun using PHP-Nuke!','993373194',0,1,1,'');

#
# Table structure for table 'nuke_modules'
#

CREATE TABLE nuke_modules (
  mid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  custom_title varchar(255) NOT NULL default '',
  active int(1) NOT NULL default '0',
  view int(1) NOT NULL default '0',
  KEY mid (mid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_modules'
#

INSERT INTO nuke_modules VALUES (1,'AvantGo','',1,0);
INSERT INTO nuke_modules VALUES (2,'FAQ','',0,0);
INSERT INTO nuke_modules VALUES (3,'Members_List','',1,1);
INSERT INTO nuke_modules VALUES (4,'Feedback','',1,0);
INSERT INTO nuke_modules VALUES (5,'Addon_Sample','',0,2);
INSERT INTO nuke_modules VALUES (6,'Downloads','',1,0);
INSERT INTO nuke_modules VALUES (7,'Web_Links','',1,0);
INSERT INTO nuke_modules VALUES (8,'Stories_Archive','',1,0);
INSERT INTO nuke_modules VALUES (9,'Forum','',0,0);
INSERT INTO nuke_modules VALUES (10,'Sections','',1,0);
INSERT INTO nuke_modules VALUES (11,'Reviews','',1,0);
INSERT INTO nuke_modules VALUES (12,'Content','',0,0);
INSERT INTO nuke_modules VALUES (13,'Encyclopedia','',0,0);
INSERT INTO nuke_modules VALUES (14,'Top','Top 10',1,0);
INSERT INTO nuke_modules VALUES (15,'Topics','',1,0);
INSERT INTO nuke_modules VALUES (16,'Statistics','',1,0);
INSERT INTO nuke_modules VALUES (17,'Your_Account','',1,0);
INSERT INTO nuke_modules VALUES (18,'News','',1,0);
INSERT INTO nuke_modules VALUES (19,'Submit_News','',1,0);
INSERT INTO nuke_modules VALUES (20,'Recommend_Us','',1,0);
INSERT INTO nuke_modules VALUES (21,'Private_Messages','',1,0);
INSERT INTO nuke_modules VALUES (22,'Surveys','',1,0);
INSERT INTO nuke_modules VALUES (23,'Search','',1,0);

#
# Table structure for table 'nuke_pages'
#

CREATE TABLE nuke_pages (
  pid int(10) NOT NULL auto_increment,
  cid int(10) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  subtitle varchar(255) NOT NULL default '',
  active int(1) NOT NULL default '0',
  page_header text NOT NULL,
  text text NOT NULL,
  page_footer text NOT NULL,
  signature text NOT NULL,
  date datetime NOT NULL default '0000-00-00 00:00:00',
  counter int(10) NOT NULL default '0',
  clanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (pid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_pages'
#


#
# Table structure for table 'nuke_pages_categories'
#

CREATE TABLE nuke_pages_categories (
  cid int(10) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  description text NOT NULL,
  PRIMARY KEY  (cid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_pages_categories'
#


#
# Table structure for table 'nuke_poll_check'
#

CREATE TABLE nuke_poll_check (
  ip varchar(20) NOT NULL default '',
  time varchar(14) NOT NULL default '',
  pollID int(10) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_poll_check'
#


#
# Table structure for table 'nuke_poll_data'
#

CREATE TABLE nuke_poll_data (
  pollID int(11) NOT NULL default '0',
  optionText char(50) NOT NULL default '',
  optionCount int(11) NOT NULL default '0',
  voteID int(11) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_poll_data'
#

INSERT INTO nuke_poll_data VALUES (1,'Ummmm, not bad',0,1);
INSERT INTO nuke_poll_data VALUES (1,'Cool',0,2);
INSERT INTO nuke_poll_data VALUES (1,'Terrific',0,3);
INSERT INTO nuke_poll_data VALUES (1,'The best one!',0,4);
INSERT INTO nuke_poll_data VALUES (1,'what the hell is this?',0,5);
INSERT INTO nuke_poll_data VALUES (1,'',0,6);
INSERT INTO nuke_poll_data VALUES (1,'',0,7);
INSERT INTO nuke_poll_data VALUES (1,'',0,8);
INSERT INTO nuke_poll_data VALUES (1,'',0,9);
INSERT INTO nuke_poll_data VALUES (1,'',0,10);
INSERT INTO nuke_poll_data VALUES (1,'',0,11);
INSERT INTO nuke_poll_data VALUES (1,'',0,12);

#
# Table structure for table 'nuke_poll_desc'
#

CREATE TABLE nuke_poll_desc (
  pollID int(11) NOT NULL auto_increment,
  pollTitle varchar(100) NOT NULL default '',
  timeStamp int(11) NOT NULL default '0',
  voters mediumint(9) NOT NULL default '0',
  planguage varchar(30) NOT NULL default '',
  artid int(10) NOT NULL default '0',
  PRIMARY KEY  (pollID)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_poll_desc'
#

INSERT INTO nuke_poll_desc VALUES (1,'What do you think about PHP-Nuke?',961405160,9,'english',0);

#
# Table structure for table 'nuke_pollcomments'
#

CREATE TABLE nuke_pollcomments (
  tid int(11) NOT NULL auto_increment,
  pid int(11) default '0',
  pollID int(11) default '0',
  date datetime default NULL,
  name varchar(60) NOT NULL default '',
  email varchar(60) default NULL,
  url varchar(60) default NULL,
  host_name varchar(60) default NULL,
  subject varchar(60) NOT NULL default '',
  comment text NOT NULL,
  score tinyint(4) NOT NULL default '0',
  reason tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (tid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_pollcomments'
#


#
# Table structure for table 'nuke_posts'
#

CREATE TABLE nuke_posts (
  post_id int(10) NOT NULL auto_increment,
  image varchar(100) default NULL,
  topic_id int(10) NOT NULL default '0',
  forum_id int(10) NOT NULL default '0',
  poster_id int(10) default NULL,
  post_text text,
  post_time varchar(20) default NULL,
  poster_ip varchar(16) default NULL,
  PRIMARY KEY  (post_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_posts'
#


#
# Table structure for table 'nuke_posts_text'
#

CREATE TABLE nuke_posts_text (
  post_id int(10) NOT NULL default '0',
  post_text text,
  PRIMARY KEY  (post_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_posts_text'
#


#
# Table structure for table 'nuke_priv_msgs'
#

CREATE TABLE nuke_priv_msgs (
  msg_id int(10) NOT NULL auto_increment,
  msg_image varchar(100) default NULL,
  subject varchar(100) default NULL,
  from_userid int(10) NOT NULL default '0',
  to_userid int(10) NOT NULL default '0',
  msg_time varchar(20) default NULL,
  msg_text text,
  read_msg tinyint(10) NOT NULL default '0',
  PRIMARY KEY  (msg_id),
  KEY msg_id (msg_id),
  KEY to_userid (to_userid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_priv_msgs'
#


#
# Table structure for table 'nuke_queue'
#

CREATE TABLE nuke_queue (
  qid smallint(5) unsigned NOT NULL auto_increment,
  uid mediumint(9) NOT NULL default '0',
  uname varchar(40) NOT NULL default '',
  subject varchar(100) NOT NULL default '',
  story text,
  storyext text NOT NULL,
  timestamp datetime NOT NULL default '0000-00-00 00:00:00',
  topic varchar(20) NOT NULL default '',
  alanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (qid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_queue'
#


#
# Table structure for table 'nuke_quotes'
#

CREATE TABLE nuke_quotes (
  qid int(10) unsigned NOT NULL auto_increment,
  quote text,
  PRIMARY KEY  (qid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_quotes'
#

INSERT INTO nuke_quotes VALUES (1,'Nos morituri te salutamus - CBHS');

#
# Table structure for table 'nuke_ranks'
#

CREATE TABLE nuke_ranks (
  rank_id int(10) NOT NULL auto_increment,
  rank_title varchar(50) NOT NULL default '',
  rank_min int(10) NOT NULL default '0',
  rank_max int(10) NOT NULL default '0',
  rank_special int(2) default '0',
  rank_image varchar(255) default NULL,
  PRIMARY KEY  (rank_id),
  KEY rank_min (rank_min),
  KEY rank_max (rank_max)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_ranks'
#


#
# Table structure for table 'nuke_referer'
#

CREATE TABLE nuke_referer (
  rid int(11) NOT NULL auto_increment,
  url varchar(100) NOT NULL default '',
  PRIMARY KEY  (rid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_referer'
#


#
# Table structure for table 'nuke_related'
#

CREATE TABLE nuke_related (
  rid int(11) NOT NULL auto_increment,
  tid int(11) NOT NULL default '0',
  name varchar(30) NOT NULL default '',
  url varchar(200) NOT NULL default '',
  PRIMARY KEY  (rid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_related'
#


#
# Table structure for table 'nuke_reviews'
#

CREATE TABLE nuke_reviews (
  id int(10) NOT NULL auto_increment,
  date date NOT NULL default '0000-00-00',
  title varchar(150) NOT NULL default '',
  text text NOT NULL,
  reviewer varchar(20) default NULL,
  email varchar(60) default NULL,
  score int(10) NOT NULL default '0',
  cover varchar(100) NOT NULL default '',
  url varchar(100) NOT NULL default '',
  url_title varchar(50) NOT NULL default '',
  hits int(10) NOT NULL default '0',
  rlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_reviews'
#


#
# Table structure for table 'nuke_reviews_add'
#

CREATE TABLE nuke_reviews_add (
  id int(10) NOT NULL auto_increment,
  date date default NULL,
  title varchar(150) NOT NULL default '',
  text text NOT NULL,
  reviewer varchar(20) NOT NULL default '',
  email varchar(60) default NULL,
  score int(10) NOT NULL default '0',
  url varchar(100) NOT NULL default '',
  url_title varchar(50) NOT NULL default '',
  rlanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_reviews_add'
#


#
# Table structure for table 'nuke_reviews_comments'
#

CREATE TABLE nuke_reviews_comments (
  cid int(10) NOT NULL auto_increment,
  rid int(10) NOT NULL default '0',
  userid varchar(25) NOT NULL default '',
  date datetime default NULL,
  comments text,
  score int(10) NOT NULL default '0',
  PRIMARY KEY  (cid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_reviews_comments'
#


#
# Table structure for table 'nuke_reviews_main'
#

CREATE TABLE nuke_reviews_main (
  title varchar(100) default NULL,
  description text
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_reviews_main'
#

INSERT INTO nuke_reviews_main VALUES ('Reviews Section Title','Reviews Section Long Description');

#
# Table structure for table 'nuke_seccont'
#

CREATE TABLE nuke_seccont (
  artid int(11) NOT NULL auto_increment,
  secid int(11) NOT NULL default '0',
  title text NOT NULL,
  content text NOT NULL,
  counter int(11) NOT NULL default '0',
  slanguage varchar(30) NOT NULL default '',
  PRIMARY KEY  (artid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_seccont'
#


#
# Table structure for table 'nuke_sections'
#

CREATE TABLE nuke_sections (
  secid int(11) NOT NULL auto_increment,
  secname varchar(40) NOT NULL default '',
  image varchar(50) NOT NULL default '',
  PRIMARY KEY  (secid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_sections'
#


#
# Table structure for table 'nuke_session'
#

CREATE TABLE nuke_session (
  username varchar(25) NOT NULL default '',
  time varchar(14) NOT NULL default '',
  host_addr varchar(48) NOT NULL default '',
  guest int(1) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_session'
#


#
# Table structure for table 'nuke_smiles'
#

CREATE TABLE nuke_smiles (
  id int(10) NOT NULL auto_increment,
  code varchar(50) default NULL,
  smile_url varchar(100) default NULL,
  emotion varchar(75) default NULL,
  active tinyint(2) default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_smiles'
#

INSERT INTO nuke_smiles VALUES (1,':D','icon_biggrin.gif','Very Happy',0);
INSERT INTO nuke_smiles VALUES (2,':-D','icon_biggrin.gif','Very Happy',1);
INSERT INTO nuke_smiles VALUES (3,':grin:','icon_biggrin.gif','Very Happy',0);
INSERT INTO nuke_smiles VALUES (4,':)','icon_smile.gif','Smile',0);
INSERT INTO nuke_smiles VALUES (5,':-)','icon_smile.gif','Smile',1);
INSERT INTO nuke_smiles VALUES (6,':smile:','icon_smile.gif','Smile',0);
INSERT INTO nuke_smiles VALUES (7,':(','icon_frown.gif','Sad',0);
INSERT INTO nuke_smiles VALUES (8,':-(','icon_frown.gif','Sad',1);
INSERT INTO nuke_smiles VALUES (9,':sad:','icon_frown.gif','Sad',0);
INSERT INTO nuke_smiles VALUES (10,':o','icon_eek.gif','Surprised',0);
INSERT INTO nuke_smiles VALUES (11,':-o','icon_eek.gif','Surprised',1);
INSERT INTO nuke_smiles VALUES (12,':eek:','icon_eek.gif','Suprised',0);
INSERT INTO nuke_smiles VALUES (13,':-?','icon_confused.gif','Confused',1);
INSERT INTO nuke_smiles VALUES (14,':???:','icon_confused.gif','Confused',0);
INSERT INTO nuke_smiles VALUES (15,'8)','icon_cool.gif','Cool',0);
INSERT INTO nuke_smiles VALUES (16,'8-)','icon_cool.gif','Cool',1);
INSERT INTO nuke_smiles VALUES (17,':cool:','icon_cool.gif','Cool',0);
INSERT INTO nuke_smiles VALUES (18,':lol:','icon_lol.gif','Laughing',1);
INSERT INTO nuke_smiles VALUES (19,':x','icon_mad.gif','Mad',0);
INSERT INTO nuke_smiles VALUES (20,':-x','icon_mad.gif','Mad',1);
INSERT INTO nuke_smiles VALUES (21,':mad:','icon_mad.gif','Mad',0);
INSERT INTO nuke_smiles VALUES (22,':P','icon_razz.gif','Razz',0);
INSERT INTO nuke_smiles VALUES (23,':-P','icon_razz.gif','Razz',1);
INSERT INTO nuke_smiles VALUES (24,':razz:','icon_razz.gif','Razz',0);
INSERT INTO nuke_smiles VALUES (25,':oops:','icon_redface.gif','Embaressed',1);
INSERT INTO nuke_smiles VALUES (26,':cry:','icon_cry.gif','Crying (very sad)',1);
INSERT INTO nuke_smiles VALUES (27,':evil:','icon_evil.gif','Evil or Very Mad',1);
INSERT INTO nuke_smiles VALUES (28,':roll:','icon_rolleyes.gif','Rolling Eyes',1);
INSERT INTO nuke_smiles VALUES (29,':wink:','icon_wink.gif','Wink',0);
INSERT INTO nuke_smiles VALUES (30,';)','icon_wink.gif','Wink',0);
INSERT INTO nuke_smiles VALUES (31,';-)','icon_wink.gif','Wink',1);

#
# Table structure for table 'nuke_stats_date'
#

CREATE TABLE nuke_stats_date (
  year smallint(6) NOT NULL default '0',
  month tinyint(4) NOT NULL default '0',
  date tinyint(4) NOT NULL default '0',
  hits bigint(20) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_stats_date'
#


#
# Table structure for table 'nuke_stats_hour'
#

CREATE TABLE nuke_stats_hour (
  year smallint(6) NOT NULL default '0',
  month tinyint(4) NOT NULL default '0',
  date tinyint(4) NOT NULL default '0',
  hour tinyint(4) NOT NULL default '0',
  hits int(11) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_stats_hour'
#


#
# Table structure for table 'nuke_stats_month'
#

CREATE TABLE nuke_stats_month (
  year smallint(6) NOT NULL default '0',
  month tinyint(4) NOT NULL default '0',
  hits bigint(20) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_stats_month'
#


#
# Table structure for table 'nuke_stats_year'
#

CREATE TABLE nuke_stats_year (
  year smallint(6) NOT NULL default '0',
  hits bigint(20) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_stats_year'
#


#
# Table structure for table 'nuke_stories'
#

CREATE TABLE nuke_stories (
  sid int(11) NOT NULL auto_increment,
  catid int(11) NOT NULL default '0',
  aid varchar(30) NOT NULL default '',
  title varchar(80) default NULL,
  time datetime default NULL,
  hometext text,
  bodytext text NOT NULL,
  comments int(11) default '0',
  counter mediumint(8) unsigned default NULL,
  topic int(3) NOT NULL default '1',
  informant varchar(20) NOT NULL default '',
  notes text NOT NULL,
  ihome int(1) NOT NULL default '0',
  alanguage varchar(30) NOT NULL default '',
  acomm int(1) NOT NULL default '0',
  haspoll int(1) NOT NULL default '0',
  pollID int(10) NOT NULL default '0',
  score int(10) NOT NULL default '0',
  ratings int(10) NOT NULL default '0',
  PRIMARY KEY  (sid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_stories'
#


#
# Table structure for table 'nuke_stories_cat'
#

CREATE TABLE nuke_stories_cat (
  catid int(11) NOT NULL auto_increment,
  title varchar(20) NOT NULL default '',
  counter int(11) NOT NULL default '0',
  PRIMARY KEY  (catid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_stories_cat'
#


#
# Table structure for table 'nuke_topics'
#

CREATE TABLE nuke_topics (
  topicid int(3) NOT NULL auto_increment,
  topicname varchar(20) default NULL,
  topicimage varchar(20) default NULL,
  topictext varchar(40) default NULL,
  counter int(11) NOT NULL default '0',
  PRIMARY KEY  (topicid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_topics'
#

INSERT INTO nuke_topics VALUES (1,'phpnuke','phpnuke.gif','PHP-Nuke',0);

#
# Table structure for table 'nuke_users'
#

CREATE TABLE nuke_users (
  uid int(11) NOT NULL auto_increment,
  name varchar(60) NOT NULL default '',
  uname varchar(25) NOT NULL default '',
  email varchar(255) NOT NULL default '',
  femail varchar(255) NOT NULL default '',
  url varchar(255) NOT NULL default '',
  user_avatar varchar(30) default NULL,
  user_regdate varchar(20) NOT NULL default '',
  user_icq varchar(15) default NULL,
  user_occ varchar(100) default NULL,
  user_from varchar(100) default NULL,
  user_intrest varchar(150) default NULL,
  user_sig varchar(255) default NULL,
  user_viewemail tinyint(2) default NULL,
  user_theme int(3) default NULL,
  user_aim varchar(18) default NULL,
  user_yim varchar(25) default NULL,
  user_msnm varchar(25) default NULL,
  pass varchar(40) NOT NULL default '',
  storynum tinyint(4) NOT NULL default '10',
  umode varchar(10) NOT NULL default '',
  uorder tinyint(1) NOT NULL default '0',
  thold tinyint(1) NOT NULL default '0',
  noscore tinyint(1) NOT NULL default '0',
  bio tinytext NOT NULL,
  ublockon tinyint(1) NOT NULL default '0',
  ublock tinytext NOT NULL,
  theme varchar(255) NOT NULL default '',
  commentmax int(11) NOT NULL default '4096',
  counter int(11) NOT NULL default '0',
  newsletter int(1) NOT NULL default '0',
  user_posts int(10) NOT NULL default '0',
  user_attachsig int(2) NOT NULL default '0',
  user_rank int(10) NOT NULL default '0',
  user_level int(10) NOT NULL default '1',
  PRIMARY KEY  (uid)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_users'
#

INSERT INTO nuke_users VALUES (1,'','Anonymous','','','','blank.gif','Nov 10, 2000','','','','','',0,0,'','','','',10,'',0,0,0,'',0,'','',4096,0,0,0,0,0,1);

#
# Table structure for table 'nuke_words'
#

CREATE TABLE nuke_words (
  word_id int(10) NOT NULL auto_increment,
  word varchar(100) default NULL,
  replacement varchar(100) default NULL,
  PRIMARY KEY  (word_id)
) TYPE=MyISAM;

#
# Dumping data for table 'nuke_words'
#


