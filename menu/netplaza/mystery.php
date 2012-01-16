<?php

	$SETUP["BBS_MODE"]  = $MODE;
	$SETUP["USING_BBS"] = true;
	$SETUP["USING_DB"]  = true;

	include "../../default.php";

	$SETUP["TITLE"] = "                       �Ұ�����";

	$THISPAGE = Array ( "NAME" => "MYSTERY",
						"URL" => "{$SETUP["URL"]}/menu/netplaza/mystery.php",
						"TIP" => "�Ұ�����" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}/menu/netplaza/", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}/menu/netplaza/", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

	// url���� get������� �Ѱܹ޾ƾ� �� �׸��
	$SET["TABLE"] 		= "mystery";
	$SET["NO"] 			= $NO;
	$SET["THREAD"] 		= $THREAD;
	$SET["PAGE"] 		= $PAGE;
	$SET["SEARCH"] 		= $SEARCH;
	$SET["SEARCH_FIELD"]= $SEARCH_FIELD;
	$SET["ORDER_FIELD"] = $ORDER_FIELD;
	$SET["ORDER"] 		= $ORDER;
	$SET["BASE"]		= $BASE;
	$SET["POS"]			= $POS;

	$SET["FILEUPLOAD"] 	= true;		// ���� ���ε� ����
	$SET["RECOM"] 		= true;		// ��õ�ϱ� ���

	// ��õ �׸� �߰�
	$BBS->PROPERTY( "BBS_FIELD_LIST", Array("BBS_FIELD_NO", " ", 
											"BBS_FIELD_NAME", " ", 
											"BBS_FIELD_DATE", " ", 
											"BBS_FIELD_HIT", " ", 
											"BBS_FIELD_RECOM", " ", 
											"BBS_FIELD_TITLE" ) );
	$BBS->PROPERTY( "BBS_FIELD_RECOM", 4 );
	$BBS->PROPERTY( "BBS_FIELD_TITLE", 43 );

	$BBS->MAKEMENU( $SET );
	
	START();
	$BBS->SHOW();
	FINISH();
?>
