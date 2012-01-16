<?php

/*
 * class/bbs.list.php
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

		// for ���
		var $LISTINDEX;

		function CBBS()
		{
			global $SCREEN;

			$this->m_CONFIG["BBS_FIELD_LIST"] = Array( 	"BBS_FIELD_NO", " ",
														"BBS_FIELD_NAME", " ",
												 		"BBS_FIELD_DATE", " ",
												 		"BBS_FIELD_HIT", " ",
												 		"BBS_FIELD_TITLE" );

			$this->m_CONFIG["BBS_FIELD_TITLE"] = 48;
			$this->m_CONFIG["BBS_FIELD_NO"] = 6;
			$this->m_CONFIG["BBS_FIELD_NAME"] = 8;
			$this->m_CONFIG["BBS_FIELD_DATE"] = 8;
			$this->m_CONFIG["BBS_FIELD_HIT"] = 4;
			$this->m_CONFIG["BBS_FIELD_DATE_TYPE"] = "y-m/d";

			$this->m_CONFIG["BBS_LIST_HEAD_DEC_BOTTOM"] = "������������������������������������������������������������������������������&nbsp;".$SCREEN->m_strCRLF;
			$this->m_CONFIG["BBS_LIST_DEC_BOTTOM"] = "������������������������������������������������������������������������������&nbsp;".$SCREEN->m_strCRLF;
			

			$this->m_bState = true;
		}

		function PROPERTY( $PROPERTY, $VALUE )
		{
			$this->m_CONFIG[$PROPERTY] = $VALUE;
		}
		
		function ARGUMENT( $SET="" )
		{
			if( ! $SET )
				$SET = $this->m_SET;
			
			//$setstr  = "?&TABLE={$SET["TABLE"]}";
			$setstr = "?";

			if( $SET["PAGE"]   )		$setstr .= "&PAGE={$SET["PAGE"]}";
			if( $SET["SEARCH"]   )		$setstr .= "&SEARCH={$SET["SEARCH"]}";
			if( $SET["SEARCH_FIELD"] )	$setstr .= "&SEARCH_FIELD={$SET["SEARCH_FIELD"]}";
			if( $SET["ORDER_FIELD"] )	$setstr .= "&ORDER_FIELD={$SET["ORDER_FIELD"]}";
			if( $SET["ORDER"] )			$setstr .= "&ORDER={$SET["ORDER"]}";

			return $setstr;
		}

		// -- ��Ͻ���� �Լ� ----------------------------------------------
		//
		//  * �Խ��� ��Ͽ����� ���Ǵ� �Լ� ó���� ���
		//    - �ڹٽ�ũ��Ʈ�� user_shell( argc, argv ) ������ �Լ���
		//      ����� ��񿡽����� �ڵ����� ȣ���� �ش�.
		//    - 'lt SEARCH' ���� ������ ����� ó���ϱ� ���ؼ� ���
		//
		// -----------------------------------------------------------------
		function ADD_USER_SHELL()
		{
			global $PHP_SELF;

			$search = $this->SET;
			$search["SEARCH"] = "";
			$search["SEARCH_FIELD"] = "";
			
			$page = $this->SET;
			$page["PAGE"] = "";
	
			$func = $this->SET;
			$func["MODE"] = "";
			
			$searchurl	= $PHP_SELF.$this->ARGUMENT( $search );
			$pageurl   	= $PHP_SELF.$this->ARGUMENT( $page );
			$funcurl	= $PHP_SELF.$this->ARGUMENT( $func );
			
			echo "<script language=\"javascript\">
	
	// �켱 ������ ���� ����� ��
	function user_shell_foot( argc, argv )
	{
		// ���� ��Ͽ� ���� �۹�ȣ�� �Է�������
		// �Է��� �۹�ȣ�� �Խ��� TABLE���� �˻�
		if( argc == 1 ) {
			if( argv[0] > 0 ) { 
				// if ����
				page_move( \"{$searchurl}&MODE=".BBS_MODE_VIEW."&NO=\"+argv[0] );
				return true;
			}
		}
		
		return false;
	}
			
	// �켱 ������ ���� ����� ��
	function user_shell( argc, argv )
	{
		if( argc < 2 ) {
			return false;
		}
		
		// ������ �˻� ( LT )
		if( argv[0] == \"lt\" || argv[0] == \"�Ӥ�\" ) {
			page_move( \"{$searchurl}&SEARCH_FIELD=".BBS_SEARCH_TITLE."&SEARCH=\"+argv[1] );
			return true;
		}

		// NAME �˻� ( LN )
		if( argv[0] == \"ln\" || argv[0] == \"�Ӥ�\" ) {
			page_move( \"{$searchurl}&SEARCH_FIELD=".BBS_SEARCH_NAME."&SEARCH=\"+argv[1] );
			return true;
		}
				
		// ���� �˻� ( LC ) 
		if( argv[0] == \"lc\" || argv[0] == \"�Ӥ�\" ) {
			page_move( \"{$searchurl}&SEARCH_FIELD=".BBS_SEARCH_TEXT."&SEARCH=\"+argv[1] );
			return true;
		}

		// PAGE �̵� ( PG )
		if( argv[0] == \"pg\" || argv[0] == \"�Ĥ�\" ) {
			page_move( \"{$pageurl}&PAGE=\"+argv[1] );
			return true;
		}

		// �� ���� ( DD )
		if( argv[0] == \"dd\" || argv[0] == \"����\" ) {
			page_move( \"{$funcurl}&MODE=".BBS_MODE_DELETE."&NO=\"+argv[1] );
			return true;
		}
	
		// �� ���� ( E )
		if( argv[0] == \"e\" || argv[0] == \"��\" ) {
			page_move( \"{$funcurl}&MODE=".BBS_MODE_EDIT."&NO=\"+argv[1] );
			return true;
		}

		// ��� ��� ( PR )
		if( argv[0] == \"pr\" || argv[0] == \"�Ĥ�\" ) {
			page_move( \"{$funcurl}&MODE=".BBS_MODE_PRINT."&NO=\"+argv[1] );
			return true;
		}
	
		return false;
	}
</script>";
		}
	
		// -- MAKEMENU �Լ� --------------------------------------------
		//
		//  * ��� ȭ�鿡 �ʿ��� �޴��� ���� & ���
		//    - �Խù� ����Ʈ ����
		//    - F, B, L, LT, LN, LC, PG ��ɾ� ����
		//
		// -----------------------------------------------------------------
		function MAKEMENU( $SET="" )
		{
			global $PHP_SELF, $MENU, $SETUP, $_COOKIE;

			// ---------------------------
			//  �Խù� ����Ʈ�� �о�´�.
			// ---------------------------
			$this->m_SET = $SET;
			if( ! $this->GET_LIST( $SET ) )
				return false;
			
			if( ! $SET["PAGE"] )
				$SET["PAGE"] = 1;
			
			if( $SET["PAGE"] > $this->GET_LASTPAGE() ) {
				$SET["PAGE"] = $this->GET_LASTPAGE();
				$this->GET_LIST( $SET );
			}
			
			if( ! $this->m_RESULT )
				return false;
			
			$SETUP["TITLE_RIGHT"] = "{$SET["PAGE"]}/".$this->GET_LASTPAGE()."(�� {$this->m_nCount}��)";

			$cnt = mysql_num_rows( $this->m_RESULT );

			$this->LISTINDEX[0] = $cnt;
		
			$TODAY = time() - 86400;
			
			// -----------------------------
			//  �Խù� ����Ʈ�� �޴��� ����
			// -----------------------------
			for( $i=1; $i<=$cnt; $i++ )
			{
				$ROW   = mysql_fetch_array( $this->m_RESULT );

				// �±� ���/������� ���� ó��
				
				// �亯���� ���, �� ���� �鿩����
				$SPACE = "";
				for( $j=0; $j<$ROW["depth"]; $j++ ) {
					$SPACE .= " ";
				}

				if( $ROW["depth"] > 0 )
					$SPACE .= "��";

				$NAME = "";

				reset( $this->m_CONFIG["BBS_FIELD_LIST"] );

				// -----------------------------------------
				//  �Խù� �׸�(FIELD)��, ������ �׸� ǥ��
				// -----------------------------------------
				while( $FIELD = each( $this->m_CONFIG["BBS_FIELD_LIST"] ) ) {
					
					$LENGTH = $this->m_CONFIG[$FIELD[value]];
					
					switch( $FIELD[value] ) {
						case "BBS_FIELD_THREAD":
							$NAME .= SUBSTR_SPC( $LENGTH, $ROW["thread"], ALIGN_RIGHT );
							break;
						case "BBS_FIELD_NO":
							$NAME .= SUBSTR_SPC( $LENGTH, $ROW["no"], ALIGN_RIGHT );
							break;
						case "BBS_FIELD_TITLE":
							if( $ROW["date"] >= $TODAY ) {
								$NAME[strlen($NAME)-1] = "\0";
								$NAME .= "<font class=\"����\">!</font>";
							}
						
							$TITLE = SUBSTR_SPC( $LENGTH, $SPACE.$ROW["title"] );
							
							if( $_COOKIE["COOKIE_BOARD_LIST_TAG"] == 1 ) 
								$TITLE = str_replace( "<", "&lt;", $TITLE );
							
							if( $ROW["hit"] >= 100 && $ROW["recom"] < 10 )
								$NAME .= "<font class=\"��ȸ100\">{$TITLE}</font>";
							else if( $ROW["hit"] >= 100 && $ROW["recom"] >= 10 )
								$NAME .= "<font class=\"��ȸ100��õ10\">{$TITLE}</font>";
							else if( $ROW["recom"] >= 10 )
								$NAME .= "<font class=\"��õ10\">{$TITLE}</font>";
							else
								$NAME .= $TITLE;
									
							break;
							
						case "BBS_FIELD_NAME":
							$WRITERNAME = SUBSTR_SPC( $LENGTH, $ROW["name"] );
						
							if( $_COOKIE["COOKIE_BOARD_LIST_TAG"] == 1 ) 
								$WRITERNAME = str_replace( "<", "&lt;", $WRITERNAME );

							$NAME .= $WRITERNAME;
							break;
							
						case "BBS_FIELD_DATE":
							$DATE = date( $this->m_CONFIG["BBS_FIELD_DATE_TYPE"], $ROW["date"] );
							$NAME .= SUBSTR_SPC( $LENGTH, $DATE);
							break;
							
						case "BBS_FIELD_HIT":
							$NAME .= SUBSTR_SPC( $LENGTH, $ROW["hit"] );
							break;
							
						case "BBS_FIELD_RECOM":
							$NAME .= SUBSTR_SPC( $LENGTH, $ROW["recom"] );
							break;
							
						default:
							$NAME .= $FIELD[1];
					}

				}
			
				// -----------------------------------------------
				//  ����FIELD�� ��ȣFIELD�� ���ÿ� ���õž��� ���,
				//  ��ȣFIELD���� �޴���ȣ�� ����Ѵ�.
				// -----------------------------------------------
				if( $this->m_CONFIG["BBS_FIELD_THREAD"] )
					$CODE = $ROW["thread"];
				if( $this->m_CONFIG["BBS_FIELD_NO"] )
					$CODE = $ROW["no"];

				$SETSTR = $this->ARGUMENT();
				$ROW_URL = $PHP_SELF.$SETSTR."&MODE=".BBS_MODE_VIEW."&NO={$ROW["no"]}&THREAD={$ROW["thread"]}";
				
				$ITEM = Array ( "CODE" => $CODE,
								"NAME" => $NAME,
								"URL" => $ROW_URL,
								"TIP" => $ROW_TIP,
								"SHOWMODE"   => MENU_SHOW_NAME | MENU_SHOW_TIP,
								"ARROWINDEX" => $i,
								"CLASS" => $CLASS );

				$MENU->ITEMADD( $ITEM );
				$this->LISTINDEX[$i] = $CODE;
			}
	
			// -----------------------
			//  PAGE ���� �޴� ����
			// -----------------------
			
			if( $SET["PAGE"] < 1 || (! $SET["PAGE"]) )
				$SET["PAGE"] = 1;

			// - ����PAGE ----------
			if( $SET["PAGE"] > 1 ) {
				$PREV_PAGESET = $SET;
				$PREV_PAGESET["PAGE"]--;
				$LINK = $PHP_SELF.$this->ARGUMENT( $PREV_PAGESET );
				$PREV_PAGE = Array (	"CODE" => "B",
										"NAME" => "B",
										"URL" => $LINK,
										"BOTTOM" => true,
										"TIP" => "��������" );
			}

			// - NEXT_PAGE ----------
			if( $SET["PAGE"] < $this->GET_LASTPAGE() ) {
				$NEXT_PAGESET = $SET;
				$NEXT_PAGESET["PAGE"]++;
				$LINK = $PHP_SELF.$this->ARGUMENT( $NEXT_PAGESET );
				$NEXT_PAGE = Array (	"CODE" => "F",
										"NAME" => "F",
										"URL" => $LINK,
										"BOTTOM" => true,
										"TIP" => "����������" );
			
				// enter Ű�� PAGE �ѱ��
				$ENTER_NEXT_PAGE = $NEXT_PAGE;
				$ENTER_NEXT_PAGE["CODE"] = "";
				$ENTER_NEXT_PAGE["NAME"] = "";
				$ENTER_NEXT_PAGE["BOTTOM"] = false;
			}
	
			$W  = Array ( "CODE" => "W",  "NAME" => "W",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_WRITE,
						  "BOTTOM" => true,
						  "TIP" => "�۾���" );

			$L  = Array ( "CODE" => "L",  "NAME" => "L",
					 	  "URL" => $PHP_SELF,
						  "BOTTOM" => true,
						  "TIP" => "ó�����" );
		
			$LT = Array ( "CODE" => "LT", "NAME" => "LT",
						  "URL" => "javascript:message('������ �˻�');",
						  "TIP" => "������ �˻�",
						  "BOTTOM" => true );
			
			$LN = Array ( "CODE" => "LN", "NAME" => "LN",
						  "URL" => "javascript:message('NAME �˻�');",
						  "TIP" => "NAME �˻�",
						  "BOTTOM" => true );
			
			$LC = Array ( "CODE" => "LC", "NAME" => "LC",
						  "URL" => "javascript:message('�۳��� �˻�');",
						  "TIP" => "�۳��� �˻�",
						  "BOTTOM" => true );

			$PG = Array ( "CODE" => "PG", "NAME" => "PG",
						  "URL" => "javascript:message('PAGE �̵�');",
						  "TIP" => "PAGE �̵�",
						  "BOTTOM" => true );
	
			$DD = Array ( "CODE" => "DD", "NAME" => "DD",
						  "URL" => "javascript:message('�� ����');",
						  "TIP" => "�� ����",
						  "BOTTOM" => true );
			
			$E = Array ( "CODE" => "E", "NAME" => "E",
						 "URL" => "javascript:message('�� ����');",
						 "TIP" => "�� ����",
						 "BOTTOM" => true );
		
			$PR = Array ( "CODE" => "PR", "NAME" => "PR",
						  "URL" => "javascript:message('�� ���');",
						  "TIP" => "�� ���",
						  "BOTTOM" => true );
			
			if( $PREV_PAGE )
				$MENU->ITEMADD( $PREV_PAGE );
			
				$PREV_PAGE["CODE"] = "��";
				$PREV_PAGE["BOTTOM"] = false;
				$MENU->ITEMADD( $PREV_PAGE );
				
			if( $NEXT_PAGE ) {
				$MENU->ITEMADD( $NEXT_PAGE );
				$MENU->ITEMADD( $ENTER_NEXT_PAGE );

				$NEXT_PAGE["CODE"] = "��";
				$NEXT_PAGE["BOTTOM"] = false;
				$MENU->ITEMADD( $NEXT_PAGE );
			}

			$MENU->ITEMADD( $W );
			$MENU->ITEMADD( $L );
			$MENU->ITEMADD( $LT );
			$MENU->ITEMADD( $LN );
			$MENU->ITEMADD( $LC );
			$MENU->ITEMADD( $PG );
			$MENU->ITEMADD( $DD );
			$MENU->ITEMADD( $E );
			$MENU->ITEMADD( $PR );

			$L["CODE"] = "��";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$W["CODE"] = "��";
			$W["BOTTOM"] = false;
			$MENU->ITEMADD( $W );
			
			$LT["CODE"] = "�Ӥ�";
			$LT["BOTTOM"] = false;
			$MENU->ITEMADD( $LT );

			$LN["CODE"] = "�Ӥ�";
			$LN["BOTTOM"] = false;
			$MENU->ITEMADD( $LN );

			$LC["CODE"] = "�Ӥ�";
			$LC["BOTTOM"] = false;
			$MENU->ITEMADD( $LC );

			$PG["CODE"] = "�Ĥ�";
			$PG["BOTTOM"] = false;
			$MENU->ITEMADD( $PG );

			$DD["CODE"] = "����";
			$DD["BOTTOM"] = false;
			$MENU->ITEMADD( $DD );

			$E["CODE"] = "��";
			$E["BOTTOM"] = false;
			$MENU->ITEMADD( $E );

			$PR["CODE"] = "�Ĥ�";
			$PR["BOTTOM"] = false;
			$MENU->ITEMADD( $PR );
			
			return true;
		}
		
		// -- ���MODE��� �Լ� --------------------------------------------
		//
		//  * �Խ��� ��� MODE�� ����Ѵ�.
		//    - MODE���() �Լ��� ���� ȣ��.
		//
		// -----------------------------------------------------------------
		function SHOW()
		{
			global $PHP_SELF, $SCREEN;

			$temp_SET = $this->m_SET;

			// �Խ��ǿ����� ���Ǵ� ��ɾ� �߰�
			$this->ADD_USER_SHELL();

			// -----------------------------------------
			//  ���� FIELD�� NAME�� ��� ���κп� ���
			// -----------------------------------------
			reset( $this->m_CONFIG["BBS_FIELD_LIST"] );		// each ����� ����.
			while( $FIELD = each( $this->m_CONFIG["BBS_FIELD_LIST"] ) ) {
			
				$LENGTH = $this->m_CONFIG[$FIELD[value]];
				$SET = $temp_SET;
				$ORDER_MARK = "";
				
				if( $SET["ORDER_FIELD"] == "" ) 
					$SET["ORDER_FIELD"] = BBS_SORT_THREAD;
				if( $SET["ORDER"] == "" )
					$SET["ORDER"] = BBS_ORDER_DESC;

				switch( $FIELD[value] ) {
					
					case "BBS_FIELD_THREAD":
						if( $SET["ORDER_FIELD"] == BBS_SORT_THREAD ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_THREAD;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "����{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_NO":
						if( $SET["ORDER_FIELD"] == BBS_SORT_THREAD ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_THREAD;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "��ȣ{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_TITLE":
						if( $SET["ORDER_FIELD"] == BBS_SORT_TITLE ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_TITLE;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "����{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_NAME":
						if( $SET["ORDER_FIELD"] == BBS_SORT_NAME ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_NAME;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "�̸�{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_DATE":
						if( $SET["ORDER_FIELD"] == BBS_SORT_DATE ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_DATE;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "��¥{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_HIT":
						if( $SET["ORDER_FIELD"] == BBS_SORT_HIT ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_HIT;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "��ȸ{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_RECOM":
						if( $SET["ORDER_FIELD"] == BBS_SORT_RECOM ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "��";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_RECOM;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"�Խ��Ǹ�϶�\">".SUBSTR_SPC( $LENGTH, "��õ{$ORDER_MARK}" )."</a>";
						break;
					default:
						$LABEL .= $FIELD[1];
				}

			}
	
			if( $this->m_CONFIG["BBS_LIST_HEAD_DEC_TOP"] )
				echo " {$this->m_CONFIG["BBS_LIST_HEAD_DEC_TOP"]}";

			echo " {$LABEL} ";
			echo $SCREEN->m_strCRLF;

			if( $this->m_CONFIG["BBS_LIST_HEAD_DEC_BOTTOM"] )
				echo " {$this->m_CONFIG["BBS_LIST_HEAD_DEC_BOTTOM"]}";
			
			// -------------
			//  �Խù� ���
			// -------------
			for( $i=1; $i<=$this->LISTINDEX[0]; $i++ )
			{
				echo " ".$SCREEN->MLINK( $this->LISTINDEX[$i] )." ";
				echo $SCREEN->m_strCRLF;
			}
			
			if( $this->m_CONFIG["BBS_LIST_DEC_BOTTOM"] )
				echo " {$this->m_CONFIG["BBS_LIST_DEC_BOTTOM"]}";
		}
		
	}
	
?>
