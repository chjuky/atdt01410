<?php

/*
 * menu/forum/index.php
 * atdt01410 - The Web interface mimics virtual terminal environment
 * Copyright (C) 2003, 2004 SPLUG, Soongsil university, Republic of Korea.
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

	include "../../default.php";

	$SETUP["TITLE"] = "                        ��ȣȸ";

	$THISPAGE = Array ( "NAME" => "FORUM",
						"URL" => "{$SETUP["URL"]}/menu/forum/",
						"TIP" => "��ȣȸ" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$MENU->ADD( "99", "��ȣȸ��û", "{$SETUP["URL"]}/menu/forum/request.php", "��ȣȸ ��û" );
	$MENU->EDIT( "99", "TAG", "style=\"color:yellow;\"" );

	START();
?>
 ����<font class="����">    ��Ȱ/���     </font>���� ����<font class="����">    ����/��ǻ��   </font>���� ����<font class="����"> ����/����/��Ÿ </font>����
 �� 1. ��ȸ/����         �� ��  9. �м�/����/����   �� �� 16. ����           ��
 �� 2. ��Ȱ/����         �� �� 10. ����/���        �� �� 17. ����(��-��)    ��
 �� 3. ��ȭ/����         �� �� 11. �ܱ���           �� �� 18. ����(��-��)    ��
 �� 4. ����/����         �� �� 12. ���/ģ��        �� �� 19. ����(��-��)    ��
 �� 5. ����/���/����    �� �� 13. ��ǻ������       �� �� 20. �űԵ�ȣȸ     ��
 �� 6. ����/����         �� �� 14. ��ǻ��OS         �� �� 21. ��.��.��       ��
 �� 7. ������            �� �� 15. ��ǻ�����α׷��� �� ��                    ��
 �� 8. �Ƿ�/�ǰ�         �� �������������������������� ������������������������
 �������������������������� 
   91. ��������
   92. ��ȣȸ �̿�ȳ�
   <?=MLINK(99)?> 
	
<?
	FINISH();
?>
