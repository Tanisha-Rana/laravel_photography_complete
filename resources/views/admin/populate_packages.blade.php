<?php
$c = new mysqli('localhost', 'root', '', 'photographybymonali');
if ($c->connect_error) { die("Connection failed: " . $c->connect_error); }

$packages = [
    // NEWBORN (Already has Silver/Gold)
    [9, 'Diamond', 18000, 3, "3 Set Up + Family Portraits\n2.5 Hour Session\n30 High Res Images\nPremium Album\nVideo Teaser included\nAll Raw Photos"],
    
    // MATERNITY (10)
    [10, 'Standard', 8000, 2, "2 Gowns Provided\n1 Hour Session\n15 High Res Images\nStudio Shoot\nMakeup Included"],
    [10, 'Premium', 12000, 3, "3 Gowns Provided\n2 Hour Session\n25 High Res Images\nStudio + Outdoor\nProfessional Makeup & Hair"],
    
    // FAMILY (11)
    [11, 'Mini', 5000, 1, "45 Min Session\n10 High Res Images\nUp to 4 Persons\nDigital Delivery"],
    [11, 'Elite', 9000, 2, "90 Min Session\n20 High Res Images\nLarge Family Group\nPhoto Frame Included"],
    
    // KIDS (12)
    [12, 'One Theme', 4000, 1, "Cake Smash or Theme\n45 Min Session\n12 Edited Images\nProps Included"],
    [12, 'Twin Themes', 7000, 2, "2 Theme Setups\n90 Min Session\n20 Edited Images\nOutfit Provided"]
];

foreach ($packages as $p) {
    $stmt = $c->prepare("INSERT INTO packages (category_id, package_name, price, max_catelogues, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("isdis", $p[0], $p[1], $p[2], $p[3], $p[4]);
    $stmt->execute();
}

echo "Added 7 professional packages.";
$c->close();
?>
