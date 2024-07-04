<?php require_once('Connections/conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT school.schoolName, school.address, school.town FROM school";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $conn) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>comprehensive school</title>
</head>

<body>
<table border="1" align="center">

  
</table>
<br />

<table width="100%" border="0">
      <tr>
        <td height="100">
          <center>
        
        
        <img src="images/image 2.jpeg" width="100" height="100" alt="mok" /><br/>
      
        <?php do { ?>
    
      <?php echo $row_Recordset1['schoolName']; ?><br />
      <?php echo $row_Recordset1['address']; ?><br />&nbsp;
      <?php echo $row_Recordset1['town']; ?>
    
      <br />
      GRADE:____________ STREAM:_____________ ASSESSMENT:________________ YEAR: ______________ TERM:____________
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <hr size="5" color="black" width="100%"/>
        
        </center></td>
  </tr>
</table>
<table width="100%" border="1">
<tr></tr>
<tr></tr>
<tr></tr>
<tr>
  <td width="4%">SN</td>
  <td width="14%">STUDENT NAME</td>
  <td width="4%">ENG</td>
  <td width="4%">PL</td>
  <td width="4%">KISW</td>
  <td width="4%">PL</td>
  <td width="4%">MATH</td>
  <td width="4%">PL</td>
  <td width="4%">INT/SCI</td>
  <td width="4%">PL</td>
  <td width="4%">PRE-TECH</td>
  <td width="4%">PL</td>
  <td width="4%">CRE</td>
  <td width="4%">PL</td>
  <td width="4%">SST</td>
  <td width="4%">PL</td>
  <td width="4%">AGRI/NUT</td>
  <td width="4%">PL</td>
  <td width="4%">CA/SP</td>
  <td width="4%">PL</td>
  <td width="4%">TOTAL AVERAGE</td>
  <td width="4%">REMARKS</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<p>&nbsp;</p>
<table width="92%" border="1" align="center">
  <tr>
    
    <td width="19%">SUBJECT TOTAL</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
  <tr>
    
    <td width="19%">NO. OF LEARNERS</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
  <tr>
    
    <td width="19%">MEAN SCORE</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
  <tr>
    
    <td width="19%">SUBJECT POSITION</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
    <td width="4%">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">generated by___________________________________________________________________ signature:__date <u style="color:blue ;font:Arial, Helvetica, sans-serif;">03-Jul-2024</u></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>