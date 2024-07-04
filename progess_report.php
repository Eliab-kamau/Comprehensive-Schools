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
<table border="2" width="100%"> <tr><td>
<b>
<table border="1" align="center">
</table>
<br />

<table width="100%" border="0">
      <tr>
        <td height="100">
          <center>
        
        
        <img src="images/logo2.jpeg" width="100" height="100" alt="jukj" /><br/>
        
      
        <?php do { ?>
    <font size="14">
      <?php echo $row_Recordset1['schoolName']; ?><br />
      <?php echo $row_Recordset1['address']; ?><br />&nbsp;
      <?php echo $row_Recordset1['town']; ?>
      
   </font>
      <br />
      GRADE:____________ STREAM:_____________ ASSESSMENT:________________ YEAR: ______________ TERM:____________
            <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    <hr size="5" color="black" width="100%"/>
        
        </center></td>
  </tr>
</table>
<center>
<p><center>THE SCHOOL PROGRESSIVE REPORT</p>
<p>Leaner__________________________Leaner Signature________________________ </p>
<p>Grade______________________Stream___________ Term______________ Year____________________Date<u><font color="blue"> <!-- #BeginDate format:En2 -->04-Jul-2024<!-- #EndDate --></font></p>
<p>&nbsp;</p>
<table width="100%" border="1">
  <tr>
    <th scope="col">S/NO</th>
    <th scope="col">LEARNING</th>
    <th scope="col">CAT 1</th>
    <th scope="col">P.L</th>
    <th scope="col">CAT 2</th>
    <th scope="col">P.L</th>
    <th scope="col">END TERM</th>
    <th scope="col">P.L</th>
    <th scope="col">FACILITATOR'S SIGN</th>
  </tr>
  <tr>
    <td>1</td>
    <td>MATHEMATICS</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>2</td>
    <td>ENGLISH</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>3</td>
    <td>KISWAHILI</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>4</td>
    <td>INTERGRATED SCIENCE</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>5</td>
    <td>PRE-TECHNICAL STUDIES</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>6</td>
    <td>CRE</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>7</td>
    <td>SOCIAL STUDIES</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>8</td>
    <td>AGRI/NUTRITUTION</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>9</td>
    <td>CREATIVE ARTS&amp;SPORTS</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>Class Teachers Comment's..........................................................................................................................................................................................................................................................</p>
<p>..........................................................................................................................................................................................................................................................................</p>
<p>&nbsp;</p>
<p>PAREN/GUARDIAN COMMENTS....................................................................................................................................................................................................................</p>
<p>..............................................................................................................................................................................................................................................................................</p>
<p>NAME:.....................................................................................PHONE NUMBER:......................................................SIGN.........................................................................</p>
<p>KEY</p>
<table width="100%" height="96" border="1">
  <tr>
    <td><p>MATH, INTERGRATED SCIENCE,</p>
      <p> PRE-TECH, CREATIVE ARTS&amp;SP</p></td>
    <td>ENG, KISW, CRE, AGRI/NUT</td>
    <td>P.L PERFORMING LEVELS</td>
  </tr>
  <tr>
    <td><p>0-19 B.E</p>
      <p>20-49 A.E</p>
      <p>50-69 M.E</p></td>
    <td><p>0-29 B.E</p>
      <p>30-59A.E</p>
      <p>60-79 E.E</p></td>
    <td><p>B.E - BELOW EXPECTATION</p>
      <p>A.E - APPROACHING EXPECTATION</p>
      <p>M.E - MEETING EXPECTATION</p>
      <p>E.E - EXCEEDING EXPECTATION</p></td>
  </tr>
</table>
<p>&nbsp;</p>
</center>
<p align="center">generated by___________________________________________________________________ signature:__date <u style="color:blue ;font:Arial, Helvetica, sans-serif;">03-Jul-2024</u></p>
<p>&nbsp;</p>
</b>
</td></tr></table>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>