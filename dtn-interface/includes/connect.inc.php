<?php
/*
 Parameters are set in the server conf file
 You must specify the value in the nginx or apache server conf file.

 Nginx:
 fastcgi_param DTNHTFFF_USER <value>;
 fastcgi_param DTNHTFFF_PWD  <value>;
 fastcgi_param DTNHTFFF_HOST <value>;
 fastcgi_param DTNHTFFF_PORT <value>;
 fastcgi_param DTNHTFFF_DATABASE <value>;
 fastcgi_param DTNHTFFF_EMAIL <value>;
 fastcgi_param DTNHTFFF_PROTOCOL <https|http>;

 Apapche:
 SetEnv DTNHTFFF_USER <value>
 SetEnv DTNHTFFF_PWD  <value>
 SetEnv DTNHTFFF_HOST <value>
 SetEnv DTNHTFFF_PORT <value>
 SetEnv DTNHTFFF_DATABASE <value>
 SetEnv DTNHTFFF_EMAIL <value>
 SetEnv DTNHTFFF_PROTOCOL <https|http>

*/
$_SERVER["DTNHTFFF_PROTOCOL"]="HTTP";
$_SERVER["DTNHTFFF_DATABASE"]="dtn_htfff";
$_SERVER["DTNHTFFF_HOST"]="localhost";
$_SERVER["DTNHTFFF_PORT"]="3306";
$_SERVER["DTNHTFFF_USER"]="root";
$_SERVER["DTNHTFFF_PWD"]="";
$_SERVER["DTNHTFFF_EMAIL"]="HTTP";

	$hosturl = 'mysql:host='.$_SERVER["DTNHTFFF_HOST"].';port='.$_SERVER["DTNHTFFF_PORT"].';charset=utf8;dbname='.$_SERVER["DTNHTFFF_DATABASE"];
	$conn = new PDO($hosturl, $_SERVER["DTNHTFFF_USER"], $_SERVER["DTNHTFFF_PWD"]);

function deconnect()
{
	// do nothing
}
?>
