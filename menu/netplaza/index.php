<?php

/*
 * menu/netplaza/index.php
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

	$SETUP["TITLE"] = "                      ��Ƽ����";

	$THISPAGE = Array ( "NAME" => "NETPLAZA",
						"URL" => "{$SETUP["URL"]}/menu/netplaza/",
						"TIP" => "��Ƽ�����" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	$MENU->ADD( "1", "ū����(PLAZA)", "{$SETUP["URL"]}/menu/netplaza/plaza.php" );
	$MENU->ADD( "2", "����Խ���(HUMOR)", "{$SETUP["URL"]}/menu/netplaza/humor.php" );
	$MENU->ADD( "3", "�Ұ�����(MYSTERY)", "{$SETUP["URL"]}/menu/netplaza/mystery.php" );
	$MENU->ADD( "4", "������(SPORTS)", "{$SETUP["URL"]}/menu/netplaza/sports.php" );

	START();
?>
   <font class=������>��������������������</font>
   <font class=����>    ������~~    </font>
   <font class=���ϾƷ�>��������������������</font>
   <?=MLINK(1)?>                         
   
   
   <font class=������>��������������������</font>
   <font class=����>    �׸�  �Խ���    </font>
   <font class=���ϾƷ�>��������������������</font>
   <?=MLINK(2)?>                         
   <?=MLINK(3)?>                         
   <?=MLINK(4)?>                         
	

<?
	FINISH();
?>
