<?php

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
