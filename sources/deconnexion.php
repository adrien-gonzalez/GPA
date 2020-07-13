<?php

session_start();
session_destroy();

?>
<script>
    	localStorage.clear();
</script>

<?php

$url = $_SERVER['PHP_SELF']; 
$reg = '#^(.+[\\\/])*([^\\\/]+)$#';
define('ma_courante', preg_replace($reg, '$2', $url));

if(ma_courante != "index.php")
{
	header('Location: ../');
}
else
{
?>

<script>
    window.history.go(-1);
</script>

<?php
}
?>