<?
// DB���ִ�  inoboard ���̺��� ���� 

$SETUP["USING_DB"] = true;
include "../../default.php";

$DB->CONNECT( $SETUP["MYSQL_SERVER"], $SETUP["MYSQL_ACCOUNT"], $SETUP["MYSQL_PASSWORD"], $SETUP["MYSQL_DATABASE"] );

echo "
<A Href=./>��������</A>
<Hr>
";
$query = "drop table ".$boardid;
$result = mysql_query($query);
echo mysql_error();

echo "
<Hr>
End
";
?>
