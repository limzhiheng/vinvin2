<?PHP 



$nama_host="localhost";

$user_sql="root";

$pass_sql="";

$nama_db="e-commerce";


$condb=new mysqli($nama_host,$user_sql,$pass_sql,$nama_db);


if ($condb->connect_error) 
{
    die("Access Denied" . $condb->connect_error);
} 
?>
