/*
����.. ��.. �̰� �� �ȵ���. -_-
open.ssu.ac.kr������ �� �ƴµ� -_- 
��.. ����!
*/

	key = event.keyCode;

	alt = 0;
	ctrl = 0;
	shift = 0;

    if( event.altKey )      alt=1;
    if( event.ctrlKey )     ctrl=1;
    if( event.shiftKey )    shift=1;

	content = document.getElementById( "content" );

    if( ! content ) {
        return true;
    }

    // ������ ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==39 ) {
        content.doScroll("scrollbarRight");
    }

    // ���� ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==37 ) {
        content.doScroll("scrollbarLeft");
    }

    // ���� ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==38 ) {
        content.doScroll("scrollbarUp");
    }

    // �Ʒ��� ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==40 ) {
        content.doScroll("scrollbarDown");
    }

    // �������� ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==33 ) {
        content.doScroll("scrollbarPageUp");
    }

    // �������ٿ� ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==34 ) {
        content.doScroll("scrollbarPageDown");
    }

    // HOME ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==36 ) {
        content.doScroll("scrollbarPageLeft");
    }

    // END ��ũ��
    if( shift==1 && alt==1 && ctrl==0 && key==35 ) {
        content.doScroll("scrollbarPageRight");
    }

    // Ȯ��( + Ű )
    if( shift==1 && alt==1 && ctrl==0 && key==107 ) {
        updateZoom( document.getElementById("content"), 1 );
    }

    // ���( - Ű )
    if( shift==1 && alt==1 && ctrl==0 && key==109 ) {
        updateZoom( document.getElementById("content"), -1 );
    }

