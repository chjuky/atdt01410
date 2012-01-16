<?php

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

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

		function MAKEMENU( $SET="" )
		{
			global $MENU, $DATA;
			
			if( $SET ) {
				$this->m_SET = $SET;
			}
			
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
		
			$L["CODE"] = "��";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$DATA[TABLE] = $SET["TABLE"];

			if( trim($DATA[NO]) == "" ||
				trim($DATA[PASSWORD]) == "" ) {

				$this->m_bState = false;
				return false;
			}

			$this->m_bState = $this->DELETE( $DATA );
			
		}

		function SHOW()
		{
			global $SCREEN;

			$m_bState = "{$this->m_bState}";
			
			if( ($m_bState == "PASSWORD") ) {
				echo " �� ���� ���� !!!";
				echo $SCREEN->m_strCRLF;
				echo $SCREEN->m_strCRLF;
				echo " ��ȣ�� Ʋ�Ƚ��ϴ�.";	
				echo $SCREEN->m_strCRLF;
				echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
				return false;
			}
			
			if( ($m_bState == "FILE") ) {
				echo " �� ���� ���� !!!";
				echo $SCREEN->m_strCRLF;
				echo $SCREEN->m_strCRLF;
				echo " �ۿ� ÷�ε� ���� ������ �����߽��ϴ�.";	
				echo $SCREEN->m_strCRLF;
				echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
				return false;
			}
			
			if( ! $this->m_bState ) {
				echo " �� ���� ���� !!!";
				echo $SCREEN->m_strCRLF;
				echo $SCREEN->m_strCRLF;
				echo " �ʼ� �Է� �׸��� ����� �Էµ��� �ʾҽ��ϴ�.";
				echo $SCREEN->m_strCRLF;
				echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
				return false;
			}
			
			echo " {$this->m_SET["NO"]}�� ���� �����Ͽ����ϴ�.";
			echo $SCREEN->m_strCRLF;
			echo $SCREEN->m_strCRLF;
			echo " ������� ���ư����� P�� ��������.";
			echo $SCREEN->m_strCRLF;
			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
			return true;
		}
		
	}
	
?>
