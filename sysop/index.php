<?php

	include "../default.php";

	$THISPAGE = Array ( "NAME" => "SYSOP",
						"URL"  => "{$SETUP["URL"]}/sysop/",
						"TIP"  => "������ȭ��" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->EDIT( "P", "�ٴڸ޴�����", true );

	$MENU->ADD( "1", "�Խ��ǰ���", "{$SETUP["URL"]}/sysop/bbs/", "�Խ��ǰ���" );
	
	START();
?>

    <?=MLINK(1)?> 
	
<?
	FINISH();
?>
