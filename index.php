<?php

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
