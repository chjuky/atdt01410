<?php

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
