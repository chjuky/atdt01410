<?php

	include "../../default.php";

	$SETUP["TITLE"] = "                         ����";

	$THISPAGE = Array ( "NAME" => "CONFIG",
						"URL" => "{$SETUP["URL"]}/menu/config/",
						"TIP" => "����" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}/menu/config/", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}/menu/config/", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$CSS = Array(	"http://www.01410.net/style/default.css",
					"http://www.01410.net/style/hitelfont.css",
					"http://www.01410.net/style/fixedfont.css"
				);
	

	$MENU->ADD( "1", "�� ��� �ױ� ���", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDLISTTAG=0&location=$PHP_SELF", "" );
	$MENU->ADD( "2", "�� ��� �ױ� ������� ����", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDLISTTAG=1&location=$PHP_SELF", "" );
	$MENU->ADD( "3", "�� ���� �ױ� ���", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDVIEWTAG=0&location=$PHP_SELF", "" );
	$MENU->ADD( "4", "�� ���� �ױ� ������� ����", "{$SETUP["URL"]}/menu/config/cookie.php?BOARDVIEWTAG=1&location=$PHP_SELF", "" );

	START();

	$LISTTAG = "���";
	$VIEWTAG = "���";
	
	if( $_COOKIE["COOKIE_BOARD_LIST_TAG"] == 1 ) {
		$LISTTAG = "������� ����";
	}

	if( $_COOKIE["COOKIE_BOARD_VIEW_TAG"] == 1) {
		$VIEWTAG = "������� ����";
	}

	echo "\n";
	echo "    ���� ����\n";
	echo "     ���� ��� �±�: {$LISTTAG}\n";
	echo "     ���� ���� �±�: {$VIEWTAG}\n";

?>

    <?=MLINK(1)?> 
    <?=MLINK(2)?> 

    <?=MLINK(3)?> 
    <?=MLINK(4)?> 
	
<?
	FINISH();
?>
