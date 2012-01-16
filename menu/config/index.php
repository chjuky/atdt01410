<?php

/*
 * menu/config/index.php
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
