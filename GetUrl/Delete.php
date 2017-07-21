<?php
session_start();

//检测是否登录，若没登录则转向登录界面
if(!isset($_SESSION['userid'])){
    header("Location:login.html");
    exit();
}
?>
<?php


if (isset($_GET["id"]))
{
    $id=intval($_GET["id"]);

}

if ($id==0)
{
    echo"<script>alert('请填写');history.go(-1);</script>";
    die(0);
}



$dbms='mysql';
$host='localhost';
$dbName='ipaddrlist';
$user='root';
$pass='';
$dsn="$dbms:host=$host;dbname=$dbName";
try {
    $dbh = new PDO($dsn, $user, $pass);
} catch (PDOException $e)
{
    echo 'Connection failed: ' . $e->getMessage();
}


//在表ipinfo中插入数据
$dbh->exec("DELETE FROM ipinfo WHERE id =".$id);
if ($dbh->errorCode() != '00000')
{echo "errorInfo为： ";
    print_r($pdo->errorInfo());
    die(0);
}
//删除iplist
$dbh->exec("DELETE FROM iplist WHERE ipinfo_id =".$id);
if ($dbh->errorCode() != '00000')
{echo "errorInfo为： ";
    print_r($pdo->errorInfo());
    die(0);
}

echo"<script>alert(\"删除成功！\"); top.location='index.php'; </script>";


?>