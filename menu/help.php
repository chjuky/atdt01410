<?php

	include "../default.php";

	$SETUP["TITLE"] = "                        ����";

	$THISPAGE = Array ( "NAME" => "HELP",
						"URL" => "{$SETUP["URL"]}/menu/help.ph",
						"TIP" => "����" );

	$MENU->ADD( "P", "�����޴�", "javascript:history.go(-1);", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "javascript:history.go(-1);", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );
	
	START();
?>
<div class="����" id="content"><pre>
����

 -- �⺻ ��ɾ� --
 GO
 T
 Z
 AR
 DRAG
 P

 -- �Խ��� ��ɾ� --
 LT
 LN
 LC
 PG
 L
 W
 R
 E
 D
 OK
 HOME
 DN
 EMAIL
 
</pre></div>
 ������������������������������������������������������������������������������ 
<?
	FINISH();
?>
