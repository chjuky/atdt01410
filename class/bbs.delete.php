<?php

/*
 * class/bbs.delete.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

	class CBBS extends CBBS_CORE
	{
		var $m_SET;
		var $m_CONFIG;
		var $m_bState;

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

		// -- �����޴����� �Լ� --------------------------------------------
		//
		//  * ����ȭ�鿡 �ʿ��� �޴����� ���� & ���
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
			
			// �޴�����
			$L  = Array ( "CODE" => "L",  "NAME" => "L",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".MODE_LIST,
						  "BOTTOM" => true,
						  "TIP" => "�۸��" );

			$MENU->ITEMADD( $L );
			
			$L["CODE"] = "��";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$SCREEN->SET_AUTOFOCUS( false );
			
		}
		
		// -- ����ȭ����� �Լ� --------------------------------------------
		//
		//  * �Խù� ���� ȭ���� ����Ѵ�.
		//
		// -----------------------------------------------------------------
		function SHOW()
		{
			global $PHP_SELF, $SETUP;

			echo "<div class=\"�ۻ�����\">\n";
			echo "<form method=post action=\"{$PHP_SELF}".$this->ARGUMENT()."&MODE=".BBS_MODE_WORK_DEL."\" enctype=\"multipart/form-data\">\n";
			
			echo "<input type=hidden name=\"DATA[NO]\" value=\"{$this->m_SET[NO]}\">\n";
			
			echo "<span class=\"�ۻ�����ȣ�Է�\">";
			echo "<label class=\"�ۻ�����ȣ�Է�\" for=\"�ۻ�����ȣ�Է�\">��  ȣ(P)</label><input id=\"�ۻ�����ȣ�Է�\" type=password name=\"DATA[PASSWORD]\" class=\"�ۻ�����ȣ�Է�\" maxlength=20 accesskey='p'>";
			echo "</span>\n";
			
			echo "<span class=\"�ۻ����Է¿Ϸ�\">";
			echo "<input type=submit value=\"�Է¿Ϸ�(S)\" class=\"�ۻ����Է¿Ϸ�\" accesskey='s'>";
			echo "</span>\n";

			echo "</form>\n";
			echo "</div>\n";
			
			echo $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"];
		}
		
	}
	
?>
