<?php
function getdb()
{
    // DBへ接続
    $dbh = new PDO('sqlite:../paneume');
    return $dbh;
}
;
?>