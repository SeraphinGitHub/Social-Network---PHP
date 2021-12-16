<?php
   $title = "Home";
   
   $script = "
      <script src='javascript/loadingHandler.js' async></script>
   ";

   @require_once "PHP_Templates/_header.php";
?>

<!-- Html -->

<?php
@require_once "PHP_Templates/_footer.php";
@require_once "connect.php";

$id = $_GET["id"];

$sql = "SELECT * FROM users WHERE `id` = $id";
$stmt = $db -> query($sql);
$user = $stmt -> fetchAll();

var_dump($user);