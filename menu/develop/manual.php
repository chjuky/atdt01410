<?php

	$SETUP["BBS_MODE"]  = $MODE;
	$SETUP["USING_BBS"] = true;
	$SETUP["USING_DB"]  = true;

	include "../../default.php";

	$SETUP["TITLE"] = "                        �Ŵ���";

	$THISPAGE = Array ( "NAME" => "DEVELOP",
						"URL" => "{$SETUP["URL"]}/menu/develop/",
						"TIP" => "���߽�" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}/menu/develop/", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}/menu/develop/", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

	// url���� get������� �Ѱܹ޾ƾ� �� �׸��
	$SET["TABLE"] 		= "develop_manual";
	$SET["NO"] 			= $NO;
	$SET["THREAD"] 		= $THREAD;
	$SET["PAGE"] 		= $PAGE;
	$SET["SEARCH"] 		= $SEARCH;
	$SET["SEARCH_FIELD"]= $SEARCH_FIELD;
	$SET["ORDER_FIELD"] = $ORDER_FIELD;
	$SET["ORDER"] 		= $ORDER;
	$SET["BASE"]		= $BASE;
	$SET["POS"]			= $POS;

	$SET["FILEUPLOAD"] 	= true;		// ���� ���ε� ���
	$SET["RECOM"] 		= false;	// ��õ�ϱ� ���

	$SET["PASSWORD"]	= "1234";	// �۾��� ���� ���� ( �� �н����带 ����ؾ� ���� ���� )
	
	$BBS->PROPERTY( "BBS_FIELD_LIST", Array("BBS_FIELD_NO", " ", 
											"BBS_FIELD_NAME", " ", 
											"BBS_FIELD_DATE", " ", 
											"BBS_FIELD_HIT", " ", 
											"BBS_FIELD_TITLE" ) );

	$BBS->MAKEMENU( $SET );
	
	START();
	$BBS->SHOW();
	FINISH();
?>
