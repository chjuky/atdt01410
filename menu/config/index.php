<?php

	include "../../default.php";

	$SETUP["TITLE"] = "                         ����";

	$THISPAGE = Array ( "NAME" => "CONFIG",
						"URL" => "{$SETUP["URL"]}/menu/config/",
						"TIP" => "����" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$MENU->ADD( "1", "��Ÿ��", "{$SETUP["URL"]}/menu/config/style.php" );
	$MENU->ADD( "2", "HTML �±�", "{$SETUP["URL"]}/menu/config/tag.php" );

	START();
?>

   <?=MLINK(1)?>                         
   <?=MLINK(2)?>                         
	

<?
	FINISH();
?>
