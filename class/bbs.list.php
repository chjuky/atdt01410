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

		// for 鯉系
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

			$this->m_CONFIG["BBS_LIST_HEAD_DEC_BOTTOM"] = "ΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜ&nbsp;".$SCREEN->m_strCRLF;
			$this->m_CONFIG["BBS_LIST_DEC_BOTTOM"] = "ΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜΜ&nbsp;".$SCREEN->m_strCRLF;
			

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

		// -- 鯉系秋去系 敗呪 ----------------------------------------------
		//
		//  * 惟獣毒 鯉系拭辞幻 紫遂鞠澗 敗呪 坦軒奄 去系
		//    - 切郊什滴験闘稽 user_shell( argc, argv ) 莫縦税 敗呪研
		//      幻級檎 搾搾拭什拭辞 切疑生稽 硲窒背 層陥.
		//    - 'lt SEARCH' 旭精 莫縦税 誤敬聖 坦軒馬奄 是背辞 紫遂
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
	
	// 酔識 授是亜 碍精 紫遂切 秋
	function user_shell_foot( argc, argv )
	{
		// 薄仙 鯉系拭 蒸澗 越腰硲研 脊径梅聖獣
		// 脊径廃 越腰硲研 惟獣毒 TABLE拭辞 伊紫
		if( argc == 1 ) {
			if( argv[0] > 0 ) { 
				// if 収切
				page_move( \"{$searchurl}&MODE=".BBS_MODE_VIEW."&NO=\"+argv[0] );
				return true;
			}
		}
		
		return false;
	}
			
	// 酔識 授是亜 株精 紫遂切 秋
	function user_shell( argc, argv )
	{
		if( argc < 2 ) {
			return false;
		}
		
		// 越薦鯉 伊事 ( LT )
		if( argv[0] == \"lt\" || argv[0] == \"びさ\" ) {
			page_move( \"{$searchurl}&SEARCH_FIELD=".BBS_SEARCH_TITLE."&SEARCH=\"+argv[1] );
			return true;
		}

		// NAME 伊事 ( LN )
		if( argv[0] == \"ln\" || argv[0] == \"びぬ\" ) {
			page_move( \"{$searchurl}&SEARCH_FIELD=".BBS_SEARCH_NAME."&SEARCH=\"+argv[1] );
			return true;
		}
				
		// 鎧遂 伊事 ( LC ) 
		if( argv[0] == \"lc\" || argv[0] == \"びず\" ) {
			page_move( \"{$searchurl}&SEARCH_FIELD=".BBS_SEARCH_TEXT."&SEARCH=\"+argv[1] );
			return true;
		}

		// PAGE 戚疑 ( PG )
		if( argv[0] == \"pg\" || argv[0] == \"つぞ\" ) {
			page_move( \"{$pageurl}&PAGE=\"+argv[1] );
			return true;
		}

		// 越 肢薦 ( DD )
		if( argv[0] == \"dd\" || argv[0] == \"しし\" ) {
			page_move( \"{$funcurl}&MODE=".BBS_MODE_DELETE."&NO=\"+argv[1] );
			return true;
		}
	
		// 越 畷増 ( E )
		if( argv[0] == \"e\" || argv[0] == \"ぇ\" ) {
			page_move( \"{$funcurl}&MODE=".BBS_MODE_EDIT."&NO=\"+argv[1] );
			return true;
		}

		// 窒径 乞球 ( PR )
		if( argv[0] == \"pr\" || argv[0] == \"つぁ\" ) {
			page_move( \"{$funcurl}&MODE=".BBS_MODE_PRINT."&NO=\"+argv[1] );
			return true;
		}
	
		return false;
	}
</script>";
		}
	
		// -- MAKEMENU 敗呪 --------------------------------------------
		//
		//  * 鯉系 鉢檎拭 琶推廃 五敢研 持失 & 去系
		//    - 惟獣弘 軒什闘 持失
		//    - F, B, L, LT, LN, LC, PG 誤敬嬢 持失
		//
		// -----------------------------------------------------------------
		function MAKEMENU( $SET="" )
		{
			global $PHP_SELF, $MENU, $SETUP, $_COOKIE;

			// ---------------------------
			//  惟獣弘 軒什闘研 石嬢紳陥.
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
			
			$SETUP["TITLE_RIGHT"] = "{$SET["PAGE"]}/".$this->GET_LASTPAGE()."(恥 {$this->m_nCount}闇)";

			$cnt = mysql_num_rows( $this->m_RESULT );

			$this->LISTINDEX[0] = $cnt;
		
			$TODAY = time() - 86400;
			
			// -----------------------------
			//  惟獣弘 軒什闘研 五敢稽 持失
			// -----------------------------
			for( $i=1; $i<=$cnt; $i++ )
			{
				$ROW   = mysql_fetch_array( $this->m_RESULT );

				// 殿益 買遂/買遂馬走 省製 坦軒
				
				// 岩痕越析 井酔, 越 薦鯉 級食床奄
				$SPACE = "";
				for( $j=0; $j<$ROW["depth"]; $j++ ) {
					$SPACE .= " ";
				}

				if( $ROW["depth"] > 0 )
					$SPACE .= "��";

				$NAME = "";

				reset( $this->m_CONFIG["BBS_FIELD_LIST"] );

				// -----------------------------------------
				//  惟獣弘 牌鯉(FIELD)掻, 識澱廃 牌鯉幻 妊獣
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
								$NAME .= "<font class=\"歯越\">!</font>";
							}
						
							$TITLE = SUBSTR_SPC( $LENGTH, $SPACE.$ROW["title"] );
							
							if( $_COOKIE["COOKIE_BOARD_LIST_TAG"] == 1 ) 
								$TITLE = str_replace( "<", "&lt;", $TITLE );
							
							if( $ROW["hit"] >= 100 && $ROW["recom"] < 10 )
								$NAME .= "<font class=\"繕噺100\">{$TITLE}</font>";
							else if( $ROW["hit"] >= 100 && $ROW["recom"] >= 10 )
								$NAME .= "<font class=\"繕噺100蓄探10\">{$TITLE}</font>";
							else if( $ROW["recom"] >= 10 )
								$NAME .= "<font class=\"蓄探10\">{$TITLE}</font>";
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
				//  託景FIELD人 腰硲FIELD亜 疑獣拭 識澱掬醸聖 井酔,
				//  腰硲FIELD葵聖 五敢腰硲稽 紫遂廃陥.
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
			//  PAGE 淫恵 五敢 持失
			// -----------------------
			
			if( $SET["PAGE"] < 1 || (! $SET["PAGE"]) )
				$SET["PAGE"] = 1;

			// - 戚穿PAGE ----------
			if( $SET["PAGE"] > 1 ) {
				$PREV_PAGESET = $SET;
				$PREV_PAGESET["PAGE"]--;
				$LINK = $PHP_SELF.$this->ARGUMENT( $PREV_PAGESET );
				$PREV_PAGE = Array (	"CODE" => "B",
										"NAME" => "B",
										"URL" => $LINK,
										"BOTTOM" => true,
										"TIP" => "穿凪戚走" );
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
										"TIP" => "陥製凪戚走" );
			
				// enter 徹稽 PAGE 角奄奄
				$ENTER_NEXT_PAGE = $NEXT_PAGE;
				$ENTER_NEXT_PAGE["CODE"] = "";
				$ENTER_NEXT_PAGE["NAME"] = "";
				$ENTER_NEXT_PAGE["BOTTOM"] = false;
			}
	
			$W  = Array ( "CODE" => "W",  "NAME" => "W",
						  "URL" => $PHP_SELF.$this->ARGUMENT()."&MODE=".BBS_MODE_WRITE,
						  "BOTTOM" => true,
						  "TIP" => "越床奄" );

			$L  = Array ( "CODE" => "L",  "NAME" => "L",
					 	  "URL" => $PHP_SELF,
						  "BOTTOM" => true,
						  "TIP" => "坦製鯉系" );
		
			$LT = Array ( "CODE" => "LT", "NAME" => "LT",
						  "URL" => "javascript:message('越薦鯉 伊事');",
						  "TIP" => "越薦鯉 伊事",
						  "BOTTOM" => true );
			
			$LN = Array ( "CODE" => "LN", "NAME" => "LN",
						  "URL" => "javascript:message('NAME 伊事');",
						  "TIP" => "NAME 伊事",
						  "BOTTOM" => true );
			
			$LC = Array ( "CODE" => "LC", "NAME" => "LC",
						  "URL" => "javascript:message('越鎧遂 伊事');",
						  "TIP" => "越鎧遂 伊事",
						  "BOTTOM" => true );

			$PG = Array ( "CODE" => "PG", "NAME" => "PG",
						  "URL" => "javascript:message('PAGE 戚疑');",
						  "TIP" => "PAGE 戚疑",
						  "BOTTOM" => true );
	
			$DD = Array ( "CODE" => "DD", "NAME" => "DD",
						  "URL" => "javascript:message('越 肢薦');",
						  "TIP" => "越 肢薦",
						  "BOTTOM" => true );
			
			$E = Array ( "CODE" => "E", "NAME" => "E",
						 "URL" => "javascript:message('越 畷増');",
						 "TIP" => "越 畷増",
						 "BOTTOM" => true );
		
			$PR = Array ( "CODE" => "PR", "NAME" => "PR",
						  "URL" => "javascript:message('越 窒径');",
						  "TIP" => "越 窒径",
						  "BOTTOM" => true );
			
			if( $PREV_PAGE )
				$MENU->ITEMADD( $PREV_PAGE );
			
				$PREV_PAGE["CODE"] = "ば";
				$PREV_PAGE["BOTTOM"] = false;
				$MENU->ITEMADD( $PREV_PAGE );
				
			if( $NEXT_PAGE ) {
				$MENU->ITEMADD( $NEXT_PAGE );
				$MENU->ITEMADD( $ENTER_NEXT_PAGE );

				$NEXT_PAGE["CODE"] = "ぉ";
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

			$L["CODE"] = "び";
			$L["BOTTOM"] = false;
			$MENU->ITEMADD( $L );

			$W["CODE"] = "じ";
			$W["BOTTOM"] = false;
			$MENU->ITEMADD( $W );
			
			$LT["CODE"] = "びさ";
			$LT["BOTTOM"] = false;
			$MENU->ITEMADD( $LT );

			$LN["CODE"] = "びぬ";
			$LN["BOTTOM"] = false;
			$MENU->ITEMADD( $LN );

			$LC["CODE"] = "びず";
			$LC["BOTTOM"] = false;
			$MENU->ITEMADD( $LC );

			$PG["CODE"] = "つぞ";
			$PG["BOTTOM"] = false;
			$MENU->ITEMADD( $PG );

			$DD["CODE"] = "しし";
			$DD["BOTTOM"] = false;
			$MENU->ITEMADD( $DD );

			$E["CODE"] = "ぇ";
			$E["BOTTOM"] = false;
			$MENU->ITEMADD( $E );

			$PR["CODE"] = "つぁ";
			$PR["BOTTOM"] = false;
			$MENU->ITEMADD( $PR );
			
			return true;
		}
		
		// -- 鯉系MODE窒径 敗呪 --------------------------------------------
		//
		//  * 惟獣毒 鯉系 MODE聖 窒径廃陥.
		//    - MODE窒径() 敗呪拭 税背 硲窒.
		//
		// -----------------------------------------------------------------
		function SHOW()
		{
			global $PHP_SELF, $SCREEN;

			$temp_SET = $this->m_SET;

			// 惟獣毒拭辞幻 紫遂鞠澗 誤敬嬢 蓄亜
			$this->ADD_USER_SHELL();

			// -----------------------------------------
			//  紫遂吉 FIELD税 NAME聖 鯉系 性採歳拭 窒径
			// -----------------------------------------
			reset( $this->m_CONFIG["BBS_FIELD_LIST"] );		// each 紫遂聖 是背.
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
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_THREAD;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "託景{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_NO":
						if( $SET["ORDER_FIELD"] == BBS_SORT_THREAD ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_THREAD;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "腰硲{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_TITLE":
						if( $SET["ORDER_FIELD"] == BBS_SORT_TITLE ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_TITLE;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "薦鯉{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_NAME":
						if( $SET["ORDER_FIELD"] == BBS_SORT_NAME ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_NAME;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "戚硯{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_DATE":
						if( $SET["ORDER_FIELD"] == BBS_SORT_DATE ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_DATE;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "劾促{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_HIT":
						if( $SET["ORDER_FIELD"] == BBS_SORT_HIT ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_HIT;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "繕噺{$ORDER_MARK}" )."</a>";
						break;
						
					case "BBS_FIELD_RECOM":
						if( $SET["ORDER_FIELD"] == BBS_SORT_RECOM ) {
							if( $SET["ORDER"] == BBS_ORDER_ASC ) {
								$SET["ORDER"] = BBS_ORDER_DESC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "＜";
							} else {
								$SET["ORDER"] = BBS_ORDER_ASC;
								if( $LENGTH >= 6 )
									$ORDER_MARK = "≦";
							}
						} else {
							$SET["ORDER"] = BBS_ORDER_DESC;
						}
						$SET["ORDER_FIELD"] = BBS_SORT_RECOM;
						$LINK  = $PHP_SELF.$this->ARGUMENT( $SET );
						$LABEL .= "<a href=\"{$LINK}\" class=\"惟獣毒鯉系虞婚\">".SUBSTR_SPC( $LENGTH, "蓄探{$ORDER_MARK}" )."</a>";
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
			//  惟獣弘 窒径
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
