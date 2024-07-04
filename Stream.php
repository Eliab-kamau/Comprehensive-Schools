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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO stream (streamId, gradeId, streamname, capacity) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['streamId'], "text"),
                       GetSQLValueString($_POST['gradeId'], "text"),
                       GetSQLValueString($_POST['streamname'], "text"),
                       GetSQLValueString($_POST['capacity'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO stream (streamCode, gradeCode, streamname, capacity) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['streamCode'], "text"),
                       GetSQLValueString($_POST['gradeCode'], "text"),
                       GetSQLValueString($_POST['streamname'], "text"),
                       GetSQLValueString($_POST['capacity'], "text"));

  mysql_select_db($database_conn, $conn);
  $Result1 = mysql_query($insertSQL, $conn) or die(mysql_error());
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_conn, $conn);
$query_Recordset1 = "SELECT school.SchoolName, school.Address, school.Town FROM school";
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

mysql_select_db($database_conn, $conn);
$query_GradeCode = "SELECT GradeCode FROM grade";
$GradeCode = mysql_query($query_GradeCode, $conn) or die(mysql_error());
$row_GradeCode = mysql_fetch_assoc($GradeCode);
$totalRows_GradeCode = mysql_num_rows($GradeCode);

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
<title>Comprensive School</title>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="skyblue">
<table width="100%" border="0" >
<tr>
<td > <center> header
</center>

 <center>
   <img src="images/com sch.jpeg" width="100" height="100" alt="juju" /><br />
 <br />
 
  <?php do { ?>
    
       <?php echo $row_Recordset1['SchoolName']; ?><br />
       <?php echo $row_Recordset1['Address']; ?>
      <?php echo $row_Recordset1['Town']; ?> 
   
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </center>
    <hr size="5" color="black" width="100%" />
</td>
</tr>
</table>

<br />


<table width="100%" border="0">
<tr>
<td > <center> menu
  <ul id="MenuBar1" class="MenuBarHorizontal">
    <li><a href="Homepage.php">Home</a>      </li>
    <li><a href="Instructor.php">Instructor</a></li>
    <li><a href="Assesment.php">Assesment</a>      </li>
    <li><a href="Grade.php">Grade</a></li>
    <li><a href="Stream.php">Stream</a></li>
    <li><a href="Subject Grading.php">Subject Grading</a></li>
    <li><a href="Learner.php">Learner</a></li>
    <li><a href="Subject Allocation.php">Subject Allocation</a></li>
    <li><a href="MenuBarItemSubmenu.php" class="MenuBarItemSubmenu">Results</a>
      <ul>
        <li><a href="Summertive.php">Summertive</a></li>
        <li><a href="Formative.php">Formative</a></li>
      </ul>
    </li>
  </ul>
</center></td>
</tr>
</table>



<table width="100%" border="0" bgcolor="white">
<tr>
<td height="250px"> <center> 



<fieldset>
<legend align="center">Enter Stream Details And Save </legend>
<p></p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center" bgcolor="#00FF00">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">StreamCode:</td>
      <td><input type="text" name="streamCode" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">GradeCode:</td>
      <td><select name="gradeCode">
        <?php 
do {  
?>
        <option value="<?php echo $row_GradeCode['GradeCode']?>" <?php if (!(strcmp($row_GradeCode['GradeCode'], $row_GradeCode['GradeCode']))) {echo "SELECTED";} ?>><?php echo $row_GradeCode['GradeCode']?></option>
        <?php
} while ($row_GradeCode = mysql_fetch_assoc($GradeCode));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Streamname:</td>
      <td><input type="text" name="streamname" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Capacity:</td>
      <td><input type="text" name="capacity" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="save" />
        <input type="submit" name="button" id="button" value="Submit" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</fieldset>



</center></td>
</tr>
</table>

<table  width="100%" border="0">
<tr>
<td> <center> &copy; INDUSTRIAL TRAINING 20224.ALL Rights Reserved.</td>
</tr>

</table>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
</script>
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($GradeCode);
?>