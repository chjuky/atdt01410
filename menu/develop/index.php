<?php

	include "../../default.php";

	$SETUP["TITLE"] = "                        ���߽�";

	$THISPAGE = Array ( "NAME" => "DEVELOP",
						"URL" => "{$SETUP["URL"]}/menu/develop/",
						"TIP" => "01410 ���߽�" );
	
	$MENU->ADD( "P", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->ADD( "��", "�����޴�", "{$SETUP["URL"]}", "�����޴�" );
	$MENU->EDIT( "P", "BOTTOM", true );

	$MENU->ADD( "11", "�����ϱ�", "{$SETUP["URL"]}/menu/develop/propose.php", "�����ϱ�" );
	$MENU->ADD( "12", "�Ŵ���  ", "{$SETUP["URL"]}/menu/develop/manual.php", "�Ŵ���" );
	$MENU->ADD( "13", "��ϱ�", "{$SETUP["URL"]}/menu/develop/manage.php", "�Բ� ��ؿ�~" );
	
	START();
?>

    *******  * *       ������~
          *  * *
         *   ***
        *    * *
       *     * *       ��������������������
                       �� <?=MLINK(11)?>   ��     �ҽ������� �������� -_-..
    *     *  *         �� <?=MLINK(12)?>   ��
    *******  *         �� <?=MLINK(13)?>   ��
    *     *  ***       ��������������������
    *******  *
	
    **********          ��~~
             *            ��.
    **********              ��.
    *                         ��.... �̳��� �������� ���� �������� -_-..
    **********       
	
<?
	FINISH();
?>
