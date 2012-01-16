<?php

/*
 * default_menu.php
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


	// �̰��� ��ϵ� �޴��� ������ �ε��� �ڵ����� ��ϵȴ�.
	// �̰��� �޴��� �ʹ� ������ ������ �ε��� ��������.
       // �׷���, default_shell.php ������ �̿�.

	// ��ɾ�
	$MENU->ADD( "GO", "GO", "javascript:message('aa'')", "�ٷΰ���" );
	$MENU->ADD( "T", "�ʱ�ȭ��", "{$SETUP["URL"]}", "�ʱ�ȭ��" );	
	$MENU->ADD( "��", "�ʱ�ȭ��", "{$SETUP["URL"]}", "�ʱ�ȭ��" );	
	$MENU->ADD( "H", "����", "{$SETUP["URL"]}/menu/help.php", "����" );	
	$MENU->ADD( "��", "����", "{$SETUP["URL"]}/menu/help.php", "����" );	
	$MENU->ADD( "Z", "���ΰ�ħ", "javascript:document.location=document.location;", "���ΰ�ħ" );
	$MENU->ADD( "��", "���ΰ�ħ", "javascript:document.location=document.location;", "���ΰ�ħ" );
	$MENU->ADD( "AR","�ڵ����ΰ�ħ", "javascript:toggle_auto_refresh();", "�ڵ����ΰ�ħ" );
	$MENU->ADD( "����","�ڵ����ΰ�ħ", "javascript:toggle_auto_refresh();", "�ڵ����ΰ�ħ" );
	$MENU->ADD( "DRAG", "�巡�� ����/�Ұ���", "javascript:toggle_auto_focus();", "�巡�� ����/�Ұ���" );
	$MENU->ADD( "��������", "�巡�� ����/�Ұ���", "javascript:toggle_auto_focus();", "�巡�� ����/�Ұ���" );
	$MENU->ADD( "X", "����", "javascript:window.close();", "01410 ����" );
	
	// �޴�
	$MENU->ADD( "NETPLAZA", "��Ƽ����", "{$SETUP["URL"]}/menu/netplaza/", "��Ƽ����" );
	$MENU->ADD( "PLAZA", "ū����", "{$SETUP["URL"]}/menu/netplaza/plaza.php", "ū����" );
	$MENU->ADD( "HUMOR", "����Խ���", "{$SETUP["URL"]}/menu/netplaza/humor.php", "����Խ���" );
	$MENU->ADD( "SIG", "��ȣȸ", "{$SETUP["URL"]}/menu/forum/", "��ȣȸ" );
	$MENU->ADD( "FORUM", "��ȣȸ", "{$SETUP["URL"]}/menu/forum/", "��ȣȸ" );
	$MENU->ADD( "SYSOP", "�����ڸ޴�", "{$SETUP["URL"]}/sysop/", "�����ڸ޴�" );
	$MENU->ADD( "DEVELOP", "���߽�", "{$SETUP["URL"]}/menu/develop/", "01410 ���߽�" );
	$MENU->ADD( "CONFIG", "����", "{$SETUP["URL"]}/menu/config/", "����" );
	$MENU->ADD( "MYSTERY", "�Ұ�����", "{$SETUP["URL"]}/menu/netplaza/mystery.php", "�Ұ�����" );
	$MENU->ADD( "SPORTS", "������", "{$SETUP["URL"]}/menu/netplaza/sports.php", "������" );
	$MENU->ADD( "CHAT", "��ȭ��", "http://dev3.stis.co.kr/TelnetChat/view.html", "��ȭ��" );

	// �ٴڸ޴� ���� SETUP 
	$MENU->EDIT( "GO", "BOTTOM", true );
	$MENU->EDIT( "T",  "BOTTOM", true );
	$MENU->EDIT( "Z",  "BOTTOM", true );
	$MENU->EDIT( "AR","BOTTOM", true );
	$MENU->EDIT( "DRAG","BOTTOM", true );
	$MENU->EDIT( "X", "BOTTOM", true );
	
?>
