<?php

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

		// for ����
		var $DATA;

		// -- ������ �Լ� --------------------------------------------------
		//
		//  * �ʱ�ȭ �� $PROPERTY ���� ����Ʈ�� ����
		//
		// -----------------------------------------------------------------
		function CBBS()
		{
			global $SCREEN;
			
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

		// -- ����޴����� �Լ� --------------------------------------------
		//
		//  * ����MODE�� �ʿ��� �޴����� ���� & ���
		//    - L
		//    - P ����
		//
		// -----------------------------------------------------------------
		function MAKEMENU( $SET="" )
		{
			global $MENU, $SCREEN, $SETUP;

			if( $SET )
				$this->m_SET = $SET;

			// P �޴� EDIT
			$PREV = $PHP_SELF.$this->ARGUMENT();
			$MENU->EDIT( "P", "URL", $PREV ); 
			$MENU->EDIT( "��", "URL", $PREV ); 
			
			// �޴�����
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "�۸��" );

			$MENU->ITEMADD( $L );
			$SCREEN->SET_AUTOFOCUS( false );
			
			// �亯���� or ���� MODE�� ���, ������ �о�´�.
			if( $SETUP["BBS_MODE"] == BBS_MODE_REPLY ||
				$SETUP["BBS_MODE"] == BBS_MODE_EDIT ) {

				$SET = $this->m_SET;
				$SET["SEARCH_FIELD"] = BBS_SEARCH_NO;
				$SET["SEARCH"] = $SET["NO"];
				$SET["ORDER_FIELD"] = " ";
				$SET["LIMIT"] = "1";
				$this->GET_LIST( $SET );
			
				if( ! $this->m_RESULT )
					return false;

				$DATA = mysql_fetch_array( $this->m_RESULT );

				if( $SETUP["BBS_MODE"] == BBS_MODE_REPLY ) {
					$DATA["text"] = "\n\n---- {$DATA["name"]}�Բ��� ���� ������ ----\n".$DATA["text"];
					$DATA["title"] = "";
					$DATA["name"] = "";
					$DATA["email"] = "";
					$DATA["filename"] = "";
					$DATA["homepage"] = ""; 
				}
				
				$this->DATA = $DATA;
			}
			
		}
		
		// -- ����MODE��� �Լ� --------------------------------------------
		//
		//  * �Խù� ���� MODE�� ����Ѵ�.
		//    - MODE���() �Լ��� ���� ȣ��.
		//
		// -----------------------------------------------------------------
		function SHOW()
		{
			global $PHP_SELF, $SETUP;

			echo "<div class=\"�۾�����\">\n";
			echo "<form method=post action=\"{$PHP_SELF}".$this->ARGUMENT()."&MODE=".BBS_MODE_WORK_SAVE."\" enctype=\"multipart/form-data\">\n";
			echo "<input type=hidden name=\"DATA[MODE]\" value=\"".$SETUP["BBS_MODE"]."\">\n";

			if( $SETUP["BBS_MODE"] == BBS_MODE_REPLY ||
				$SETUP["BBS_MODE"] == BBS_MODE_EDIT ) {
				echo "<input type=hidden name=\"DATA[NO]\" value=\"{$this->m_SET[NO]}\">\n";
			}
			
			echo "<span class=\"�����Է�\">";
			echo "<label class=\"�����Է�\" for=\"�����Է�\">��  ��(T)</label><input id=\"�����Է�\" type=text name=\"DATA[TITLE]\" class=\"�����Է�\" maxlength=127 accesskey='t' value='{$this->DATA["title"]}'>";
			echo "</span>\n";
			
			echo "<span class=\"�̸��Է�\">";
			echo "<label class=\"�̸��Է�\" for=\"�̸��Է�\">��  ��(N)</label><input id=\"�̸��Է�\" type=text name=\"DATA[NAME]\" class=\"�̸��Է�\" maxlength=20 accesskey='n' value='{$this->DATA["name"]}'>";
			echo "</span>\n";
		
			echo "<span class=\"��ȣ�Է�\">";
			echo "<label class=\"��ȣ�Է�\" for=\"��ȣ�Է�\">��  ȣ(P)</label><input id=\"��ȣ�Է�\" type=password name=\"DATA[PASSWORD]\" class=\"��ȣ�Է�\" maxlength=20 accesskey='p'>";
			echo "</span>\n";
			
			echo "<span class=\"EMAIL�Է�\">";
			echo "<label class=\"EMAIL�Է�\" for=\"EMAIL�Է�\">E-Mail(E)</label><input id=\"EMAIL�Է�\" type=text name=\"DATA[EMAIL]\" class=\"EMAIL�Է�\" maxlength=127 accesskey='e' value='{$this->DATA["email"]}'>";
			echo "</span>\n";
			
			echo "<span class=\"HOME�Է�\">";
			echo "<label class=\"HOME�Է�\" for=\"HOME�Է�\">Home(H)</label><input id=\"HOME�Է�\" type=text name=\"DATA[HOME]\" class=\"HOME�Է�\" maxlength=127 accesskey='h' value='{$this->DATA["homepage"]}'>";
			echo "</span>\n";

			if( $this->m_SET["FILEUPLOAD"] ) {
				echo "<span class=\"�����Է�\">";
				echo "<label class=\"�����Է�\" for=\"�����Է�\">��  ��(F)</label><input id=\"�����Է�\" type=file name=\"DATA[FILE]\" class=\"�����Է�\" maxlength=255 accesskey='f'>";
				echo "</span>\n";
			}
			
			echo "<span class=\"�����Է�\">";
			echo "<label class=\"�����Է�\" for=\"�����Է�\">��  ��(C)</label>";
			echo "<textarea id=\"�����Է�\" name=\"DATA[TEXT]\" class=\"�����Է�\" accesskey='c'>{$this->DATA["text"]}</textarea>";
			echo "</span>\n";

			echo "<span class=\"�Է¿Ϸ�\">";
			echo "<input type=submit value=\"�Է¿Ϸ�(S)\" class=\"�Է¿Ϸ�\" accesskey='s'>";
			echo "</span>\n";

			echo "</form>\n";
			echo "</div>\n";
			
			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
		}
		
	}
	
?>
