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
	
	for( $i=0; $i<count($CSS); $i++ ) {
		$NAME = $CSS[$i];
		$URL  = "{$SETUP["URL"]}/menu/config/cookie.php?location=$PHP_SELF&CSS=".$CSS[$i];
		$MENU->ADD( $i+1, $NAME, $URL);
	}

	START();

	echo "\n";
	echo "    ���� ��Ÿ��: ".$_COOKIE["COOKIE_CSS"];
	
	echo "\n\n";

	for( $i=0; $i<count($CSS); $i++ ) {
		echo "    ";
		echo MLINK($i+1);
		echo "\n";
	}
?>
    <form method=post action=cookie.php style="margin:0;">
    ����� ���� ��Ÿ��(DRAG��带 ���� �Ͻð� �Է��ϼ���.)
    <input type=text name=CSS value='http://' style="width:400;"> <input type=submit value='�����ϱ�'>
	</form>
<?
	FINISH();
?>
