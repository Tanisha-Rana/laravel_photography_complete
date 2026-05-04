<?php
$c = new mysqli('localhost', 'root', '', 'photographybymonali');
$res = $c->query("SELECT * FROM categories");
while($row = $res->fetch_assoc()) echo json_encode($row).PHP_EOL;
$c->close();
?>
