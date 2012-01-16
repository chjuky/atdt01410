<?php

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

		// for ����
		var $DATA;

		function CBBS()
		{
			global $SCREEN;
			
			$this->m_CONFIG["BBS_VIEW_HEAD_DEC_BOTTOM"] = " ������������������������������������������������������������������������������".$SCREEN->m_strCRLF;

			$this->m_CONFIG["BBS_LIST_DEC_BOTTOM"] = " ������������������������������������������������������������������������������&nbsp;".$SCREEN->m_strCRLF;
		}

		function PROPERTY( $PROPERTY, $VALUE )
		{
			$this->m_CONFIG[$PROPERTY] = $VALUE;
		}
		
		function ARGUMENT( $SET="" )
		{
			if( ! $SET )
				$SET = $this->m_SET;
			
			$setstr = "?";

			if( $SET["PAGE"]   )		$setstr .= "&PAGE={$SET["PAGE"]}";
			if( $SET["SEARCH"]   )		$setstr .= "&SEARCH={$SET["SEARCH"]}";
			if( $SET["SEARCH_FIELD"] )	$setstr .= "&SEARCH_FIELD={$SET["SEARCH_FIELD"]}";
			if( $SET["ORDER_FIELD"] )	$setstr .= "&ORDER_FIELD={$SET["ORDER_FIELD"]}";
			if( $SET["ORDER"] )			$setstr .= "&ORDER={$SET["ORDER"]}";

			return $setstr;
		}

		// -- ���⽩��� �Լ� ----------------------------------------------
		//
		//  * �Խ��� �ۺ��� ��忡���� ���Ǵ� �Լ� ó���� ���
		//
		// -----------------------------------------------------------------
		function ADD_USER_SHELL()
		{
			global $PHP_SELF;

			echo "<script language=\"javascript\">
	
	// 
	var obj;
			
	function user_shell( argc, argv )
	{
		if( ! obj ) {
			obj = document.getElementById( 'content' );
			if( ! obj ) 
				return false;
		}
		
		if( argv == 0 ) {

			obj.doScroll( \"pageDown\" );

			return true;
		}

		if( argc == 1 ) {
			if( argv[0] == \"b\" || argv[0] == \"��\" ) {
				obj.doScroll( \"pageUp\" );

				return true;
			}
		}
		
		return false;
	}
</script>";
		}
		
		
		// -- ����޴����� �Լ� --------------------------------------------
		//
		//  * ����MODE�� �ʿ��� �޴����� ���� & ���
		//    - L, W, R, E, D, DN, MAIL, HOME
		//    - P ����
		//
		// -----------------------------------------------------------------
		function MAKEMENU( $SET="" )
		{
			global $PHP_SELF, $MENU, $SETUP;
			
			$this->m_SET = $SET;
			
			if( $SET["NO"] != "" ) {
				$SET["SEARCH_FIELD"] = BBS_SEARCH_NO;
				$SET["SEARCH"] = $SET["NO"];
			}
			
			$SET["ORDER_FIELD"] = " ";
			$SET["LIMIT"] = "1";

			// ������, ������ ����� ���, ���� ã�� ������ ��ȸ���� �ø���.
			if( $SET["BASE"] == "" )	
				$this->ADD_HIT( $SET );
			
			// �� ���
			$this->GET_LIST( $SET );
			
			if( ! $this->m_RESULT )
				return false;
			
			
			// 
			if( $SET["BASE"] != "" ) {
				$DATA = $this->m_DATA;

				// m_PROPERTY ���� ����
				$this->m_PROPERTY["NO"] = $DATA["no"];
				$this->ADD_HIT( $this->m_PROPERTY );

				// SET ���� ����
				$SET["NO"] = $DATA["no"];
				$SET["THREAD"] = $DATA["thread"];
			} else {
				$DATA = mysql_fetch_array( $this->m_RESULT );
			}
		
			if( ! isset($SET["THREAD"]) )
				$SET["THREAD"] = $DATA["thread"];

			// �±� ���/������� ���� ó��
			if( $_COOKIE["COOKIE_BOARD_VIEW_TAG"] == 1 ) {
				$DATA["title"] = str_replace( "<", "&lt;", $DATA["title"] );
				$DATA["name"] = str_replace( "<", "&lt;", $DATA["name"] );
			}
			
			$DATA["NO"] = $DATA["no"];
			$DATA["TITLE"] = $DATA["title"];
			$DATA["NAME"] = SUBSTR_SPC( 20, $DATA["name"] );
			if( $DATA["email"] )
				$DATA["NAME"] = "<a href=\"mailto:{$DATA["email"]}\" class=\"�޴�\" title=\"���� ������\">{$DATA["NAME"]}</a>";
			
			$DATA["HIT"] = SUBSTR_SPC( 4, $DATA["hit"] );
			$DATA["DATE"] = date("Y�� m�� d�� H�� i�� s��", $DATA["date"]);	
			$DATA["IP"]   = SUBSTR_SPC( 15, $DATA["ip"] );
			$DATA["TEXT"] = $DATA["text"];
			
			if( $DATA["filename"] ) {
				$DATA["FILEURL"] = "{$SETUP["BBS_PDS_URL"]}/{$SET["TABLE"]}/{$DATA["filename"]}";
				$DATA["FILE"] = "<a href=\"{$DATA["FILEURL"]}\" class=\"�޴�\" title=\"���� �ޱ�\">{$DATA["filename"]}</a>";
			} else
				$DATA["FILE"] = "����";
				
			if( $DATA["homepage"] != "http://" && $DATA["homepage"] != "" )
				$DATA["HOME"] = "[<a href=\"{$DATA["homepage"]}\" target=_blank class=\"�޴�\" title=\"Ȩ������ ��â���� ����\">Ȩ������</a>]";
			
			if( $SET["RECOM"] ) {
				$DATA["RECOM"] = "��õ: ".SUBSTR_SPC( 4, $DATA["recom"] );
			}
			
			$this->DATA = $DATA;
			
			// P �޴� ����
			$PREV = $PHP_SELF.$this->ARGUMENT();
			$MENU->EDIT( "P", "URL", $PREV ); 
			$MENU->EDIT( "��", "URL", $PREV ); 
		
			// �޴�����
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "�۸��" );
			
			$W  = Array ( "CODE" => "W",  "NAME" => "W",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_WRITE,
						  "BOTTOM" => true,
						  "TIP" => "�۾���" );
			
			$R  = Array ( "CODE" => "R",  "NAME" => "R",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_REPLY,
						  "BOTTOM" => true,
						  "TIP" => "�亯����" );
			
			$E  = Array ( "CODE" => "E",  "NAME" => "E",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_EDIT,
						  "BOTTOM" => true,
						  "TIP" => "�ۼ���" );
			
			$DD = Array ( "CODE" => "DD",  "NAME" => "DD",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_DELETE,
						  "BOTTOM" => true,
						  "TIP" => "�ۻ���" );
			
			$MAIL  = Array( "CODE" => "MAIL",  "NAME" => "MAIL",
						  	"URL" => "mailto:{$DATA["email"]}",
						  	"BOTTOM" => true,
						  	"TIP" => "���� ������" );
				
			$DN  = Array( "CODE" => "DN",  "NAME" => "DN",
						  "URL" => "{$DATA["FILEURL"]}",
						  "BOTTOM" => true,
						  "TIP" => "���� �ޱ�" );
			
			$HOME = Array( "CODE" => "HOME",  "NAME" => "HOME",
						   "URL" => "{$DATA["homepage"]}",
						   "BOTTOM" => true,
						   "TIP" => "Ȩ������ ����" );
		
				
			$OK = Array( "CODE" => "OK", "NAME" => "OK",
						 "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&MODE=".BBS_MODE_WORK_RECOM,
						 "BOTTOM" => true,
						 "TIP" => "��õ�ϱ�" );
		
			$A = Array( "CODE" => "A", "NAME" => "A",
						"URL" => $PHP_SELF.$this->ARGUMENT()."&BASE={$SET["THREAD"]}&MODE=".BBS_MODE_VIEW."&POS=UP",
						"BOTTOM" => true,
						"TIP" => "����" );
			
			$N = Array( "CODE" => "N", "NAME" => "N",
						"URL" => $PHP_SELF.$this->ARGUMENT()."&BASE={$SET["THREAD"]}&MODE=".BBS_MODE_VIEW."&POS=DN",
						"BOTTOM" => true,
						"TIP" => "����" );
			
			$PR = Array( "CODE" => "PR", "NAME" => "PR",
						 "URL" => $PHP_SELF.$this->ARGUMENT()."&NO={$SET["NO"]}&THREAD={$SET["THREAD"]}&MODE=".BBS_MODE_PRINT,
						 "BOTTOM" => true,
						 "TIP" => "���" );
			
			$B = Array( "CODE" => "B", "NAME" => "B",
						"URL" => "javascript:run_command('b');",
						"BOTTOM" => true,
						"TIP" => "��������" );
						
			$MENU->ITEMADD( $L );
			$MENU->ITEMADD( $W );
			$MENU->ITEMADD( $R );
			$MENU->ITEMADD( $E );
			$MENU->ITEMADD( $DD );
			$MENU->ITEMADD( $A );
			$MENU->ITEMADD( $N );
			$MENU->ITEMADD( $PR );
			$MENU->ITEMADD( $B );

			$L["CODE"] = "��";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$W["CODE"] = "��";
			$W["BOTTOM"] = false;
			$MENU->ITEMADD( $W );
			
			$R["CODE"] = "��";
			$R["BOTTOM"] = false;
			$MENU->ITEMADD( $R );
			
			$E["CODE"] = "��";
			$E["BOTTOM"] = false;
			$MENU->ITEMADD( $E );
			
			$D["CODE"] = "��";
			$D["BOTTOM"] = false;
			$MENU->ITEMADD( $D );
			
			$A["CODE"] = "��";
			$A["BOTTOM"] = false;
			$MENU->ITEMADD( $A );

			$N["CODE"] = "��";
			$N["BOTTOM"] = false;
			$MENU->ITEMADD( $N );

			if( $SET["RECOM"] ) {
				$MENU->ITEMADD( $OK );
				$OK["CODE"] = "����";
				$OK["BOTTOM"] = false;
				$MENU->ITEMADD( $OK );
			}
			
			if( $DATA["email"] ) 
				$MENU->ITEMADD( $MAIL );
			if( $DATA["filename"] )
				$MENU->ITEMADD( $DN );
			if( $DATA["homepage"] )
				$MENU->ITEMADD( $HOME );
		}
		
		// -- ����MODE��� �Լ� --------------------------------------------
		//
		//  * �Խù� ���� MODE�� ����Ѵ�.
		//    - MODE���() �Լ��� ���� ȣ��.
		//
		// -----------------------------------------------------------------
		function SHOW( )
		{
			global $SCREEN, $NO, $MODE;

			$DATA = $this->DATA;

			if( ! $DATA["NO"] ) {
				echo "{$NO}�� ���� �������� �ʽ��ϴ�.";
				echo $SCREEN->m_strCRLF;
				return true;
			}

			// �ۺ��⿡���� ���Ǵ� ��ɾ� �߰�
			$this->ADD_USER_SHELL();
			
			// �۳��� ���
			echo $this->m_CONFIG["BBS_VIEW_HEAD_DEC_TOP"];
			echo " ����: {$DATA["TITLE"]}{$SCREEN->m_strCRLF}";
			echo " �̸�: {$DATA["NAME"]}    ��ȸ: {$DATA["HIT"]}   I P : {$DATA["IP"]}    {$DATA["HOME"]}";
			echo $SCREEN->m_strCRLF;
			
			if( $DATA["RECOM"] )
				echo " ��¥: {$DATA["DATE"]}      {$DATA["RECOM"]}  ����: {$DATA["FILE"]}";
			else
				echo " ��¥: {$DATA["DATE"]}      ����: {$DATA["FILE"]}";
			echo $SCREEN->m_strCRLF;
			
			echo $this->m_CONFIG["BBS_VIEW_HEAD_DEC_BOTTOM"];

			if( $MODE != BBS_MODE_PRINT )
				echo "<div class=\"�۳���\" id=\"content\"><pre>";
			else
				echo "<div class=\"�۳������\" id=\"content\"><pre>";
			
			echo $DATA["TEXT"];
			
			$FILENAME = split( "\.", $DATA["filename"] ) ;
			$FILEEXT  = strtoupper( $FILENAME[1] );

			if( $FILEEXT == "JPG" || $FILEEXT == "GIF" || $FILEEXT == "BMP"  || $FILEEXT == "PNG" ) {
				echo "<br><img src='{$DATA["FILEURL"]}' alt='{$DATA["FILEURL"]}'><br>";
			}
			
			echo "</pre></div>";

			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
		}
		
		
	}
	
?>
