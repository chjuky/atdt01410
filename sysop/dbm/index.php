<?
$SETUP["USING_DB"] = true;
include "../../default.php";

$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

$query = "show tables";
$result = mysql_query($query);

echo "
<Style>
body, td { font-size:9pt; }
A:link, A:visited { font-size:9pt; text-decoration:none; }
A:hover { font-size:9pt; color:yellow; background-color:black; }
</Style>
";

echo "
<A Href=../>��������</A>
<Hr>
";

echo "
���̺� ��� ( ���̺� �̸��� Ŭ���Ͻø� �ڼ��� ������ ���� �� �ֽ��ϴ�. )<Br>
";

echo "
<Table border=1 cellspacing=0 bordercolordark=white bordercolorlight=black>
";

$cnt=0;
while( $row=mysql_fetch_array($result) ) {
	echo "<Tr>";
	echo "<Td bgColor=gray><font color=white>".$cnt++."</Td>";
	echo "<Td><A Href=showtable.php?tablename=".$row[0].">";
	echo $row[0];
	echo "</A></Td>";
	if( $row=mysql_fetch_array($result) ) {
		echo "<Td bgColor=gray><font color=white>".$cnt++."</Td>";
		echo "<Td><A Href=showtable.php?tablename=".$row[0].">";
		echo $row[0];
		echo "</A></Td>";
	}
	if( $row=mysql_fetch_array($result) ) {
		echo "<Td bgColor=gray><font color=white>".$cnt++."</Td>";
		echo "<Td><A Href=showtable.php?tablename=".$row[0].">";
		echo $row[0];
		echo "</A></Td>";
	}
}

echo "
</Table>
";

echo "
<Br>
$cnt ���� ���̺��� �˻��Ǿ����ϴ�.
";

echo "<Hr>End";
?>
