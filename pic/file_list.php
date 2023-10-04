<?php
ini_set('display_errors', 'On');
require '../features/DbM.php';
$db = getDb();
$stt = $db->prepare('select * from panel');
$stt->execute();
$tbl = $stt->fetchAll(PDO::FETCH_ASSOC);

echo '<table><tr>
        <th>名前</th>
        <th>よこたて</th>
        <th>リンク</th>
      </tr>';
foreach ($paths as $row) {
  ?>
  <tr>
    <td>
      <?= $row['width'] . ':' . $row['height'] ?>
    </td>
    <td>
      <?= $row['name'] ?>
    </td>
    <td>
      <a href="../show/show.php?id=<?=$row['id']?>">ここ</a>
    </td>
  </tr>
  <?php
}
?>