<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("DB_config.php");
include("DB_class.php");
$id = mysql_escape_string($_POST['username']);
$pw = mysql_escape_string($_POST['password']);

//搜尋資料庫資料
$db = new DB();
$db->connect_db($_DB['host'], $_DB['username'], $_DB['password'], $_DB['dbname']);
$db->query("SELECT * FROM `register` WHERE username = '$id'");
$row = $db->fetch_array();
//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員

if($id != null && $pw != null && $row[1] == $id && $row[2] == $pw)
{
        //將帳號寫入session，方便驗證使用者身份
        $_SESSION['username'] = $id;
        echo '<meta http-equiv=REFRESH CONTENT=1;url=view.php>';
}
else
{
        echo '<meta http-equiv=REFRESH CONTENT=1;url=index.html>';
}


?>
