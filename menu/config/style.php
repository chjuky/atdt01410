<?php

/*
 * menu/config/style.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

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
