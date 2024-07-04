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
  $insertSQL = sprintf("INSERT INTO subjectallocation (AllocationCode, S1, S2, S3, S4, S5, S6, S7, S8, S9, S10, S11, S12, S13, S14, S15, S16, S17, S18, S19, S20, GradeCode, Term, AcYear) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['AllocationCode'], "text"),
                       GetSQLValueString($_POST['S1'], "text"),
                       GetSQLValueString($_POST['S2'], "text"),
                       GetSQLValueString($_POST['S3'], "text"),
                       GetSQLValueString($_POST['S4'], "text"),
                       GetSQLValueString($_POST['S5'], "text"),
                       GetSQLValueString($_POST['S6'], "text"),
                       GetSQLValueString($_POST['S7'], "text"),
                       GetSQLValueString($_POST['S8'], "text"),
                       GetSQLValueString($_POST['S9'], "text"),
                       GetSQLValueString($_POST['S10'], "text"),
                       GetSQLValueString($_POST['S11'], "text"),
                       GetSQLValueString($_POST['S12'], "text"),
                       GetSQLValueString($_POST['S13'], "text"),
                       GetSQLValueString($_POST['S14'], "text"),
                       GetSQLValueString($_POST['S15'], "text"),
                       GetSQLValueString($_POST['S16'], "text"),
                       GetSQLValueString($_POST['S17'], "text"),
                       GetSQLValueString($_POST['S18'], "text"),
                       GetSQLValueString($_POST['S19'], "text"),
                       GetSQLValueString($_POST['S20'], "text"),
                       GetSQLValueString($_POST['GradeCode'], "text"),
                       GetSQLValueString($_POST['Term'], "int"),
                       GetSQLValueString($_POST['AcYear'], "int"));

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
<legend align="center">Enter Subject Allocation Details And Save </legend>
<p>&nbsp;</p>
<p>&nbsp;</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center"  bgcolor="#00FF00">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">AllocationCode:</td>
      <td><input type="text" name="AllocationCode" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 1:</td>
      <td><input type="text" name="S1" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 2:</td>
      <td><input type="text" name="S2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 3:</td>
      <td><input type="text" name="S3" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 4:</td>
      <td><input type="text" name="S4" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 5:</td>
      <td><input type="text" name="S5" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 6:</td>
      <td><input type="text" name="S6" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 7:</td>
      <td><input type="text" name="S7" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 8:</td>
      <td><input type="text" name="S8" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 9:</td>
      <td><input type="text" name="S9" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 10:</td>
      <td><input type="text" name="S10" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 11:</td>
      <td><input type="text" name="S11" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 12:</td>
      <td><input type="text" name="S12" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 13:</td>
      <td><input type="text" name="S13" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 14:</td>
      <td><input type="text" name="S14" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 15:</td>
      <td><input type="text" name="S15" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 16:</td>
      <td><input type="text" name="S16" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 17:</td>
      <td><input type="text" name="S17" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 18:</td>
      <td><input type="text" name="S18" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 19:</td>
      <td><input type="text" name="S19" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Subject 20:</td>
      <td><input type="text" name="S20" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">GradeCode:</td>
      <td><input type="text" name="GradeCode" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Term:</td>
      <td>
      <select name="Term">
      <option> Select Term</option>
      <option> Boarding</option>
      <option> Day Schooler</option>
      </select>
      </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">AcYear:</td>
      <td><select name="AcYear">
      <option>Select Acc Year</option>
      <option>2022</option>
      <option> 2023</option>
      <option> 2024</option>
      <option> 2025</option>
      <option> 2026</option>
      <option> 2027</option>
      <option> 2027</option>
      <option> 2028</option>
      <option> 2029</option>
      <option> 2030</option>
      <option> 2031</option>
      <option> 2032</option>
      <option> 2033</option>
      <option> 2034</option>
      <option> 2035</option>
      </select></td>
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
?>