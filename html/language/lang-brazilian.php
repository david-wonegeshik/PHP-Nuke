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
define("_SEARCH","Busca");
define("_LOGIN","Login");
define("_WRITES","escrever");
define("_POSTEDON","Enviado por");
define("_NICKNAME","Nome");
define("_PASSWORD","Senha");
define("_WELCOMETO","Bem-Vindo");
define("_EDIT","Editar");
define("_DELETE","Apagar");
define("_POSTEDBY","Enviado por");
define("_READS","ler");
define("_GOBACK","[ <a href=\"javascript:history.go(-1)\">Voltar</a> ]");
define("_COMMENTS","comentários");
define("_PASTARTICLES","Artigos Velhos");
define("_OLDERARTICLES","Artigos Muito Velhos");
define("_BY","por");
define("_ON","em");
define("_LOGOUT","Sair");
define("_WAITINGCONT","Aguardando Conteúdo");
define("_SUBMISSIONS","Envios");
define("_WREVIEWS","Aguardando Revisão");
define("_WLINKS","Aguardando Links");
define("_EPHEMERIDS","Ephemerids");
define("_ONEDAY","One Day like Today...");
define("_ASREGISTERED","Você ainda não tem uma conta? Você pode criar uma <a href=\"modules.php?name=Your_Account\">aqui</a>. Como usuário registrado do site, você vai poder configura-lo de acordo com suas preferências, além de ter outras vantagens exclusivas.");
define("_MENUFOR","Menu");
define("_NOBIGSTORY","Ainda não apareceu uma história hoje.");
define("_BIGSTORY","A história mais lida de hoje é:");
define("_SURVEY","Pesquisa");
define("_POLLS","Votação");
define("_PCOMMENTS","Comentários:");
define("_RESULTS","Resultados");
define("_HREADMORE","leia mais...");
define("_CURRENTLY","Estão online atualmente,");
define("_GUESTS","visitantes(s) ");
define("_MEMBERS","usuário(s).");
define("_YOUARELOGGED","Você está conectado como");
define("_YOUHAVE","Você tem");
define("_PRIVATEMSG","mensagem(s) na sua caixa de entrada.");
define("_YOUAREANON","Você ainda não é nosso usuário. Você pode se registrar é grátis clicando <a href=\"modules.php?name=Your_Account\">aqui</a>");
define("_NOTE","Nota:");
define("_ADMIN","Admin:");
define("_WERECEIVED","Recebemos");
define("_PAGESVIEWS","visitantes desde");
define("_TOPIC","Tópico");
define("_UDOWNLOADS","Downloads");
define("_VOTE","Vote");
define("_VOTES","Votos");
define("_MVIEWADMIN","Podem ver: Somente o Administrador");
define("_MVIEWUSERS","Podem ver: Somente Usuários Registrados");
define("_MVIEWANON","Podem ver: Somente Usuários  Anônimos");
define("_MVIEWALL","Podem ver: Todos");
define("_EXPIRELESSHOUR","Expira: Em menos de 1 hora");
define("_EXPIREIN","Expira em");
define("_HTTPREFERERS","HTTP Referers");
define("_UNLIMITED","Ilimitado");
define("_HOURS","Horas");
define("_RSSPROBLEM","Atualmente a um problema com as manchetes deste site");
define("_SELECTLANGUAGE","Selecionar Idioma");
define("_SELECTGUILANG","Selecionar a Interface do Idioma:");
define("_NONE","Nenhum");
define("_BLOCKPROBLEM","<center>There is a problem right now with this block.</center>");
define("_BLOCKPROBLEM2","<center>There isn't content right now for this block.</center>");
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