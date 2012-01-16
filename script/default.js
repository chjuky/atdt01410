/*********************************************************************
*                                                                    *
*                            �ڹ� ��ũ��Ʈ                           *
*                                                                    *
*                                                                    *
*********************************************************************/

// ���� ����
var MenuCode  = new Array();
var MenuHref  = new Array();
var gMenuCode = new Array();
var gMenuHref = new Array();
var ArrowIndex= new Array();
var cntMenu   = 0;
var cntGMenu  = 0;
var maxArrowIndex = 0;
var curArrowIndex = 0;
var autoFocus = 0;
var userShellFile = "";
var objRefresh;
var autoRefresh;

// ----------------
//  ��Ű ���� �Լ�
// ----------------
function SetCookie(sName, sValue)
{
  //document.cookie = sName+'='+escape(sValue)+'; domain='+self.location.host;
  document.cookie = sName+'='+escape(sValue);
}

function GetCookie(sName)
{
  var aCookie = document.cookie.split("; ");
  for (var i=0; i < aCookie.length; i++)
  {
    var aCrumb = aCookie[i].split("=");
    if (sName == aCrumb[0])
      return unescape(aCrumb[1]);
  };
  return null;
}

// --------------
//  �ڵ� Refresh
// --------------
function toggle_auto_refresh() {
    if( autoRefresh == 1 ) {
        var expires = new Date();

        autoRefresh = 0;
        message( "Auto Refresh OFF" );
        // ��Ű ��� �����
        document.cookie = "auto_refresh=;expires="+ expires.toGMTString();
        // �������� off
        window.clearInterval( objRefresh );
    } else {
        autoRefresh = 1;
        message( "Auto Refresh ON - 10 sec" );
        // ��Ű ��� �����
        document.cookie = "auto_refresh=auto_refresh";
        // �������� on
        objRefresh = window.setInterval( "auto_refresh()", 10000 );
    }
}

function set_refresh() {
    autoRefresh = 1;
    message( "Auto Refresh ON - 10 sec" );
    // ��Ű ��� �����
    document.cookie = "auto_refresh=auto_refresh";
    // �������� on
    objRefresh = window.setInterval( "auto_refresh()", 10000 );
}

function auto_refresh() {
    location.reload();
}

// ---------------------------------------------------------
//  �ڵ� ��Ŀ��
//  - ���콺 Ŭ�� �̺�Ʈ�� ������ CMDINPUT ���� ��Ŀ�� �̵�
// ---------------------------------------------------------
function auto_focus()
{
	cmdobj = document.getElementById( "CMDINPUT" );
	if( cmdobj && autoFocus )
		cmdobj.focus();
}

// --------------------
//  �ڵ� ��Ŀ�� on/off
// --------------------
function toggle_auto_focus()
{
	autoFocus = ! autoFocus;
	auto_focus();
	if( ! autoFocus )
		message( "�巡�� ����" );
	else
		message( "�巡�� �Ұ���" );
}

// ---------------
//  �ڵ� ���ΰ�ħ
// ---------------
function aotu_refresh()
{
}

// -----------------------
//  �޴� �߰� 
//  - GO ��ɾ� ���� ����
// -----------------------
function menu_add( code, href )
{
	MenuCode[cntMenu] = code;
	MenuHref[cntMenu] = href;
	++cntMenu;
}

// -------------------------
//  Ŀ��Ű ���� �޴� �߰�
//  - UP/DOWN Ű�� �޴�����
// -------------------------
function arrow_add( code, index )
{
	ArrowIndex[index] = code;
	if( index > maxArrowIndex )
		maxArrowIndex = index;
}

function get_prev_arrow()
{
	var oldcur = curArrowIndex;
	var cur = curArrowIndex;
	
	while(1) {
		cur--;
		if( cur < 0 )
			cur = maxArrowIndex;
		if( cur == oldcur )
			return false;
		
		if( ArrowIndex[cur] ) {
			curArrowIndex = cur;
			return ArrowIndex[cur];
		}
	}
	
	return false;
}

function get_next_arrow()
{
	var oldcur = curArrowIndex;
	var cur = curArrowIndex+1;
	
	while(1) {
		if( ArrowIndex[cur] ) {
			curArrowIndex = cur;
			return ArrowIndex[cur];
		}

		cur++;
		if( cur > maxArrowIndex )
			cur = 0;
		if( cur == oldcur )
			return false;
	}
	
	return false;
}

// ----------------------------------
//  �߰����� ��ɾ� ó���� �ּ� ����
// ----------------------------------
function set_userShellFile( file )
{
	userShellFile = file;
}

// --------------------------
//  �޴� �߰�
//  - GO�� �տ� �ٿ��� ����
// --------------------------
function go_add( code, href )
{
	gMenuCode[cntGMenu] = code;
	gMenuHref[cntGMenu] = href;
	++cntGMenu;
}


// -----------------------
//  �޽��� �ڽ� ���� ����    
// -----------------------
function message( str )
{
	var msgobj = document.getElementById( "MSGBOX" );

	if( ! msgobj )
		return false;
		
	if( str == "UNKNOWN" )
		str = "�� �� ���� ��ɾ��Դϴ�.";
		
	msgobj.innerHTML = "&nbsp;"+str;
}

function page_move( url )
{
	message( "�������� �̵����Դϴ�." );

	document.location.href = url;
	return true;
}

// --------------------------------------------------
//  ���â �Է¾��� �ٷ� ����
//  cmd_check(str)�� �ٷ� ����ϴ� �͵� �����ϳ�, 
//  cmd_check(str)�� ���ϰ����� ���� �������� �ٲ�� 
//  ������ �����ϱ� ���� run_command()�� ����Ѵ�.
// --------------------------------------------------
function run_command( str )
{
	cmd_check( str );
}

// --------------------------------
//  ���â���� �Է��� ��ɾ� �˻�
//  1. �޴��˻�
//  2. GO �޴��˻�
//  3. ����� ��� ó���� �˻�
//  4. �߰����� ���ó�� ���� �˻�
// --------------------------------
function cmd_check( str )
{
	var cmdobj   = document.getElementById( "CMDINPUT" );
	var debugobj = document.getElementById( "DEBUG" );
	var string;
	var argv = "&plusargv=";

	if( str ) {
		string = "" +str;
		string = string.toLowerCase();
	} else {
		string = cmdobj.value.toLowerCase();

		if( ! cmdobj ) {
			message( "��� �Է¹ڽ��� ã�� �� �����ϴ�." );
			return false;
		}
	}

	strarray = string.split(" ");

	// ����� ���� ��ɾ� ó����( �켱 ���� 1 )
	if( user_shell( strarray.length, strarray ) )
		return true;
	
	// GO �޴� �˻�( �켱 ���� 2 )
	if( strarray[0] == "go" && strarray.length > 1 ) {
		for( i=0; i<cntGMenu; i++ ) {
			if( strarray[1] == gMenuCode[i].toLowerCase() ) {
				if( strarray.length > 2 ) {
					// go menu 3 ���� ������ �����ܰ� ���İ��� ó��
					for( j=2; j<strarray.length; j++ ) {
						argv += strarray[j] + " ";
					}
				
					if( gMenuHref[i].indexOf("?") == -1 ) {
						argv = "?" + argv;
					}
					
					page_move( gMenuHref[i] +  argv );
				} else {
					page_move( gMenuHref[i] );
				}
				return true;
			}
		}
	} else {
		// �޴� �˻�( �켱 ���� 3 )
		for( i=0; i<cntMenu; i++ ) {
			if( strarray[0] == MenuCode[i].toLowerCase() && strarray[0] != "go" ) {
				// menu 3 ���� ������ �����ܰ� ���İ��� ó��
				if( strarray.length > 1 ) {
					for( j=1; j<strarray.length; j++ ) {
						argv += strarray[j] + " ";
					}
				
					if( MenuHref[i].indexOf("?") == -1 ) {
						argv = "?" + argv;
					}
					page_move( MenuHref[i] + argv );
				} else {
					page_move( MenuHref[i] );
				}
				return true;
			}
		}
	}


	// ����� ���� ��ɾ� ó����( �켱 ���� 4 )
	if( user_shell_foot( strarray.length, strarray ) )
		return true;

	
	// �߰����� ��� ó������ �˻�( �켱 ���� 5 )
	if( userShellFile != "" ) {
		if( debugobj ) {
			debugobj.src = userShellFile + "?CMD=" + string;
		} else
			message( "�߰����� ��� ó���� �� �� �����ϴ�." );
	} else {
		message( "UNKNOWN" );
	}

}

// -------------------------------
//  �߰����� ��ɾ� �м��κ��� 
//  ����ڰ� ���� �߰��� �� �ִ�.
//  - �Լ��� �������̵��ؼ� ���
//  - ���ϰ��� false �� ���
//    �߸��� ��ɾ� ���� ǥ��
// -------------------------------
function user_shell( argc, argv )
{
	// NULL 
	//  - USE Overridding !!!
	return false;
}

// �켱������ ����
function user_shell_foot( argc, argv )
{
	return false;
}

// ----------------------------------
//  ��ɾ� �Է� ó�� 
//  - ����Ű �Է½� cmd_check() ȣ��
// ----------------------------------
function cmd_keydown( e )
{
	var keyCode;
	var cmdobj;
	
	if( e.keyCode )
		keyCode = e.keyCode;
	else if( e.charCode )
		keyCode = e.charCode;
	else 
		keyCode = e.which;

	// Up Arrow
	if( keyCode == 38 ) {
		tt = get_prev_arrow();
		if( tt ) {
			cmdobj = document.getElementById( "CMDINPUT" );
			cmdobj.value = tt;
		}
	}

	// Down Arrow
	if( keyCode == 40 ) {
		tt = get_next_arrow();
		if( tt ) {
			cmdobj = document.getElementById( "CMDINPUT" );
			cmdobj.value = tt;
		}
	}
	
	if( keyCode == 13 ) {
		message("");

		cmd_check();
	
		// �Է��� ��ɾ� �����
		cmdobj = document.getElementById( "CMDINPUT" );
		if( cmdobj ) {
			cmdobj.value = "";
		}
	}
	
	return true;
}

