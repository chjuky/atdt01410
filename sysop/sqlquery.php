<?
include "dbconn.php";

echo "
<Style>
body, td { font-size:9pt; }
</Style>
";

echo "
<A Href=./>��������</A><Br>
<Hr>
";

echo "
������ : $query<Br>
";

$result = mysql_query($query);
if( mysql_error() ) {
	echo "Error:".mysql_error();
} else {
	echo "[���]<Br>";
	$fields = mysql_num_fields($result);
	$rows = mysql_num_rows($result);
	echo "[��: $rows] &nbsp;&nbsp;&nbsp; [�ʵ��: $fields]<Br>";
	echo "<Table border=1>";
	echo "<Tr bgColor=cccccc>";
	for($i=0; $i<$fields; $i++) {
		$fname = mysql_field_name($result,$i);
		echo "<Td>".$fname."</Td>";
	}
	while( $row = mysql_fetch_array($result) ) {
		echo "<Tr>";
		for($i=0; $i<$fields; $i++) {
			echo "<Td>".$row[$i]."</Td>";
		}
	}
	echo "</Table>";
}
echo "<Hr>End";
?>
