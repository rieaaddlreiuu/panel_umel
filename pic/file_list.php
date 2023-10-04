<?php
ini_set('display_errors', 'On');

$db = getDb();
$stt = $db->prepare('select * from user where id=:id');
$stt->bindValue(':id', $id);
$stt->execute();
$usr = $stt->fetch(PDO::FETCH_ASSOC);
$dir = '../pictures/' . $usr['name'];
$nm = $usr['name'];

$paths = glob('../pictures/*');
echo '<table><tr>
        <th>画像</th>
        <th>パス</th>
      </tr>';
      foreach ($paths as $row) {
        ?>
        <tr>
            <td><img src=<?= $row?> width="300" height="300"></td>
            <td><?=$row ?></td>
        </tr>
        <?php
      }
?>