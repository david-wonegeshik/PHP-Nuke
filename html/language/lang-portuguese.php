<?php

/**************************************************************************/
/* PHP-NUKE: Advanced Content Management System                           */
/* ============================================                           */
/*                                                                        */
/* This is the language module with all the system messages               */
/*                                                                        */
/* If you made a translation, please sent to me (fbc@mandrakesoft.com)    */
/* the translated file. Please keep the original text order by modules,   */
/* and just one message per line, also double check your translation!     */
/*                                                                        */
/* You need to change the second quoted phrase, not the capital one!      */
/*                                                                        */
/* If you need to use double quotes (") remember to add a backslash (\),  */
/* so your entry will look like: This is \"double quoted\" text.          */
/* And, if you use HTML code, please double check it.                     */
/**************************************************************************/


define("_CHARSET","ISO-8859-1");
define("_SEARCH","Localizar");
define("_LOGIN","Login");
define("_WRITES","escrever");
define("_POSTEDON","Enviado por ");
define("_NICKNAME","Nome");
define("_PASSWORD","Password");
define("_WELCOMETO","Bem vindo");
define("_EDIT","Editar");
define("_DELETE","Apagar");
define("_POSTEDBY","Enviado por");
define("_READS","leituras");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Voltar</a> ]");
define("_COMMENTS","comentários");
define("_PASTARTICLES","Outros artigos");
define("_OLDERARTICLES","Artigos antigos");
define("_BY","por");
define("_ON","em");
define("_LOGOUT","Sair");
define("_WAITINGCONT","Aguardando conteúdo");
define("_SUBMISSIONS","Envios");
define("_WREVIEWS","Aguardando revisão");
define("_WLINKS","Aguardando links");
define("_EPHEMERIDS","Eventos");
define("_ONEDAY","Um dia...");
define("_ASREGISTERED","Você ainda não tem uma conta? Pode criar uma <a href=\"modules.php?name=Your_Account\">aqui</a>. Como utilizador registado, pode configurar o web site de acordo com as suas preferências, além de ter outras vantagens exclusivas.");
define("_MENUFOR","Menu");
define("_NOBIGSTORY","Hoje ainda não apareceu um artigo.");
define("_BIGSTORY","O artigo mais lido de hoje é:");
define("_SURVEY","Votação");
define("_POLLS","Votação");
define("_PCOMMENTS","Comentários:");
define("_RESULTS","Resultados");
define("_HREADMORE","leia mais...");
define("_CURRENTLY","neste momento estão online");
define("_GUESTS","visitante(s) ");
define("_MEMBERS","utilizador(es).");
define("_YOUARELOGGED","Você está ligado como");
define("_YOUHAVE","Você tem");
define("_PRIVATEMSG","mensagem(s) na sua caixa de entrada.");
define("_YOUAREANON","Você ainda não é nosso utilizador. É grátis! Clique <a href=\"modules.php?name=Your_Account\">aqui</a>");
define("_NOTE","Nota:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Recebemos");
define("_PAGESVIEWS","visitantes desde");
define("_TOPIC","Tema");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Vote");
define("_VOTES","Votos");
define("_MVIEWADMIN","Podem ver: Somente o Administrador");
define("_MVIEWUSERS","Podem ver: Somente utilizadores Registrados");
define("_MVIEWANON","Podem ver: Somente utilizadores  anónimos");
define("_MVIEWALL","Podem ver: Todos");
define("_EXPIRELESSHOUR","Expira: Em menos de 1 hora");
define("_EXPIREIN","Expira em");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Ilimitado");
define("_HOURS","Horas");
define("_RSSPROBLEM","actualmente a um problema com as manchetes deste site");
define("_SELECTLANGUAGE","Selecionar Idioma");
define("_SELECTGUILANG","Selecionar a Interface do Idioma:");
define("_NONE","Nenhum");
define("_BLOCKPROBLEM","<center>Há um problema agora com este bloco.</center>");
define("_BLOCKPROBLEM2","<center>Neste momento não existe conteúdo para este bloco.</center>");
define("_MODULENOTACTIVE","Sorry, this Module isn't active!");
define("_NOACTIVEMODULES","Inactive Modules");
define("_FORADMINTESTS","(for Admin tests)");
define("_BBFORUMS","Forums");
define("_ACCESSDENIED", "Access Denied");
define("_RESTRICTEDAREA", "You are trying to access to a restricted area.");
define("_MODULEUSERS", "We are Sorry but this section of our site is for <i>Registered Users Only</i><br><br>You can register for free by clicking <a href=\"modules.php?name=Your_Account&op=new_user\">here</a>, then you can<br>access to this section without restrictions. Thanks.<br><br>");
define("_MODULESADMINS", "We are Sorry but this section of our site is for <i>Administrators Only</i><br><br>");
define("_HOME","Home");
define("_HOMEPROBLEM","There is a big problem here: we have not a Homepage!!!");
define("_ADDAHOME","Add a Module in your Home");
define("_HOMEPROBLEMUSER","There is a problem right now on the Homepage. Please check it back later.");
define("_MORENEWS","More in News Section");
define("_ALLCATEGORIES","All Categories");
define("_DATESTRING","%A, %B %d @ %T %Z");
define("_DATESTRING2","%A, %B %d");
define("_DATE","Date");
define("_HOUR","Hour");
define("_UMONTH","Month");
define("_YEAR","Year");
define("_JANUARY","January");
define("_FEBRUARY","February");
define("_MARCH","March");
define("_APRIL","April");
define("_MAY","May");
define("_JUNE","June");
define("_JULY","July");
define("_AUGUST","August");
define("_SEPTEMBER","September");
define("_OCTOBER","October");
define("_NOVEMBER","November");
define("_DECEMBER","December");

/*****************************************************/
/* Function to translate Datestrings                 */
/*****************************************************/

function translate($phrase) {
    switch($phrase) {
	case "xdatestring":	$tmp = "%A, %B %d @ %T %Z"; break;
	case "linksdatestring":	$tmp = "%d-%b-%Y"; break;
	case "xdatestring2":	$tmp = "%A, %B %d"; break;
	default:		$tmp = "$phrase"; break;
    }
    return $tmp;
}

?>