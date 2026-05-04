<?php
$c = new mysqli('localhost', 'root', '', 'photographybymonali');
if ($c->connect_error) {
    die("Connection failed: " . $c->connect_error);
}
$res = $c->query("SHOW TABLES");
while($row = $res->fetch_array()) {
    echo $row[0] . PHP_EOL;
}
$c->close();
?>
