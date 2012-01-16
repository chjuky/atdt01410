/*
 * script/ie_bodyonkeydown.js
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

