<?php

/*
 * menu/config/tag.php
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
