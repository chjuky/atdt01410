<?php

/*
 * index.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea
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

	include "default.php";

	$SETUP["TITLE"] = "                       ���۸޴�";

	$THISPAGE = Array ( "NAME" => "TOP",
						"URL"  => "{$SETUP["URL"]}",
						"TIP"  => "�ʱ�ȭ��" );
	
	$MENU->ADD( "P", "�����޴�", "javascript:message('�� �̻� �ڷ� �� �� �����ϴ�.');", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "javascript:message('�� �̻� �ڷ� �� �� �����ϴ�.');", "�����޴�" );

	
  	$MENU->ADD( 1, "ȯ�漳��", "{$SETUP["URL"]}/menu/config/"  );
	
  	$MENU->ADD( 11, "��Ƽ����", "{$SETUP["URL"]}/menu/netplaza/"  );

	$MENU->ADD( 12, "�ӽô�ȭ��", "http://dev3.stis.co.kr/TelnetChat/view.html" );

  	$MENU->ADD( 15, "��ȣȸ", "{$SETUP["URL"]}/menu/forum/" );
	
  	$MENU->ADD( 99, "���߽�", "{$SETUP["URL"]}/menu/develop/" );
	
	$MENU->EDIT( "P", "�ٴڸ޴�����", true );

	START();
?>

  <font class="����"> ��ommunication  </font> 

  <?=MLINK(11)?>          <?=MLINK(99)?>       <?=MLINK(1)?> 

  <?=MLINK(12)?> 
  
  <?=MLINK(15)?> 
  
 
  ----------------------------------------------------------------------------
  �� ����Ʈ�� <font class="����">������ PC��� �ϴ� ������� ����</font> �Դϴ�.
  <b>����</b>�� ���߰� <b>�ų�</b>�� ����ִ� ��� ��Ȱ ��Ź�帳�ϴ�. 

<?
	FINISH();
?>
