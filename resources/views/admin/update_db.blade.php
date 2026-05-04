<?php
$c = new mysqli('localhost', 'root', '', 'photographybymonali');
if ($c->connect_error) {
    die("Connection failed: " . $c->connect_error);
}

// Add petrol_charge
$sql1 = "ALTER TABLE bookings ADD COLUMN petrol_charge DECIMAL(10,2) DEFAULT 0.00 AFTER total_amount";
if ($c->query($sql1)) {
    echo "petrol_charge added. ";
} else {
    echo "Error adding petrol_charge: " . $c->error . ". ";
}

// Add venue_charge
$sql2 = "ALTER TABLE bookings ADD COLUMN venue_charge DECIMAL(10,2) DEFAULT 0.00 AFTER petrol_charge";
if ($c->query($sql2)) {
    echo "venue_charge added. ";
} else {
    echo "Error adding venue_charge: " . $c->error . ". ";
}

$c->close();
?>
