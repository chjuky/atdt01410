<?php

	$SETUP["PATH"] = "/home/bbs01410/public_html";
	$SETUP["URL"]  = "http://www.01410.net";
	
	// �����Ӱ��� ������ �ְ������ 2�� �������� �ٸ���� �����͸� ���� ����.
	//$SETUP["DOMAIN"]   = "www.webispy.com";							

	if( $_COOKIE["COOKIE_CSS"] != "" )
		$SETUP["CSS"] = $_COOKIE["COOKIE_CSS"];
	else
		$SETUP["CSS"]	  = "{$SETUP["URL"]}/style/default.css";	
		
	$SETUP["TITLE"]	  = "   W e b i s p y - B B S";
	$SETUP["SIZE_TITLE"] = 40;
	$SETUP["TITLE_RIGHT"]= "01410.net";
	$SETUP["SIZE_TITLE_RIGHT"] = 30;
	$SETUP["JSCRIPT"]	 = "{$SETUP["URL"]}/script/default.js";
	$SETUP["DEFAULT_MENU_FILE"] 	 = "{$SETUP["PATH"]}/default_menu.php";
	$SETUP["DEFAULT_SHELL_FILE"]	 = "{$SETUP["URL"]}/default_shell.php";
	$SETUP["AUTO_</HTML>"] = "1";
	$SETUP["TAG_TITLE"]	 = "01410.net";
	$SETUP["TITLE_DECO_TOP"] = "<font class=\"����_���_��_����\"> 01410.net</font><font class=\"����_���_��\">����������������������������������������������������������������������</font>";
	$SETUP["TITLE_DECO_BOTTOM"] = "<font class=\"����_���_�Ʒ�\">��������������������������������������������������������������������������������</font>";

	// �Խ���
	$SETUP["BBS_LIST_SIZE"]  = 20;
	$SETUP["BBS_ERROR_SHOW"] = true;
	$SETUP["BBS_PDS_URL"]  	 = "{$SETUP["URL"]}/pds";
	$SETUP["BBS_PDS_PATH"]   = "{$SETUP["PATH"]}/pds";

	// �����ͺ��̽�
	$SETUP["MYSQL_SERVER"]   = "localhost";
	$SETUP["MYSQL_ACCOUNT"]  = "";
	$SETUP["MYSQL_PASSWORD"] = "";
	$SETUP["MYSQL_DATABASE"] = "";
	$SETUP["MYSQL_ERROR_SHOW"] = true;

	// �Խ��� class�� ����� ���, 
	// �ڵ����� �����ͺ��̽� class�� ���õ�.
	if( isset($SETUP["USING_BBS"]) ) {
		$SETUP["USING_DB"] = true;
		include "{$SETUP["PATH"]}/class/bbs.php";
	}
	
	if( isset($SETUP["USING_DB"]) ) {
		include "{$SETUP["PATH"]}/class/db.php";
	}
	
	include "{$SETUP["PATH"]}/class/util.php";	
	include "{$SETUP["PATH"]}/class/screen.php";
	include "{$SETUP["PATH"]}/class/menu.php";
	include "{$SETUP["PATH"]}/class/main.php";
?>
