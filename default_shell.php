<?php

/*
 * default_shell.php
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

	// ---------------------------------------------------------------
	//  ��ɾ� ó����
	//
	//   ���� ������ �ʰų�, ��ɾ���� �ʹ� ���� ��� �ٽ� ��ɾ���� 
	// ������ ��ɾ���� �̰��� ����س��´�.
	// ---------------------------------------------------------------

	// ---------------------------------------------------------------
	// ����ڷκ��� �Ѱܹ��� ��ɾ� : $CMD
	// ---------------------------------------------------------------
	
	// ---------------------------------------------------------------
	//  ������ ���ÿ�.
	// ---------------------------------------------------------------

	Header("Pragma: no-cache");
	Header("Expires: 0");

	function move( $url )
	{
		echo "
		<script language=\"javascript\">
			parent.page_move( \"{$url}\" );
		</script>";
	}
	
	function message( $msg )
	{
		echo "
		<script language=\"javascript\">
			parent.message( \"{$msg}\" );
		</script>";
	}

	function alert( $msg )
	{
		echo "
		<script language=\"javascript\">
			alert( \"{$msg}\" );
		</script>";
	}
	
	function script( $script )
	{
		echo "
		<script language=javascript>
			{$script};
		</script>";
	}

	if( (! isset($CMD)) or (trim($CMD) == "") ) {
		message( "UNKNOWN" );
		exit();
	}

	$argv = split( " ", $CMD );
	$argc = count($argv);
	
	// ---------------------------------------------------------------
	

	// ---------------------------------------------------------------
	//  �̰��� ��ɾ� ���
	//  argv �� argc �� �̿�.
	// ---------------------------------------------------------------
	
	// ����
	if( $argv[0] == "go" ) {
		if( $argv[1] == "free" ) {
			move( "http://www.01410.net/menu/netplaza/plaza.php" );
			exit();
		}
	}

	// ---------------------------------------------------------------
	//  bye ���
	//  X����� default_menu ���� ����Ͽ�����, bye ����� 
	//  �ٴڸ޴��� ǥ���� �ʿ䰡 ���� ������, default_shell �� ���.
	// ---------------------------------------------------------------
	if( $argc == 1 ) {
		if( $argv[0] == "bye" ) {
			script( "parent.close();" );
			exit();
		}
	}

	
	// ---------------------------------------------------------------
	//  URL �̵�
	// ---------------------------------------------------------------
	if( substr( $argv[0], 0, 7 ) == "http://" ) move( $argv[0] );
	if( substr( $argv[0], 0, 4 ) == "www." ) 	move( "http://{$argv[0]}" );

	// ---------------------------------------------------------------
	//  ���� ��ɾ� ó��
	// ---------------------------------------------------------------
	message( "UNKNOWN" );
?>
