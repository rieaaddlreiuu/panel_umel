<?php
$data = $_POST["data"];
$id = $_GET['id'];

require '../index.php';
require '../features/DbM.php';
$db = getDb();
$stt = $db->prepare('delete from panel_chk where panel= :id');
$stt->bindValue(':id', $id);
$stt->execute();
$s = 0;
$add_dat = "";
foreach($data as $row){
  $row = -($row+1);
  if($s == 0){
    $add_dat = $add_dat."(".$id.",".$row.","."1)";
    $s=114514;
  } else {
    $add_dat = $add_dat.",(".$id.",".$row.","."1)";
  }
}
$sql = "insert into panel_chk values ".$add_dat;
$stt = $db->prepare($sql);
$stt->execute();
?>
<a href="./show.php?id=<?=$id?>">modoru</a>