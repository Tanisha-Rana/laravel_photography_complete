<?php
$c = new mysqli('localhost', 'root', '', 'photographybymonali');
if ($c->connect_error) { die("Connection failed: " . $c->connect_error); }

$new_packages = [
    ['Basic', 9999, 2, "90 Mins Session\nProps & Accessories Included\nAll Raw Photos Included"],
    ['Gold', 12999, 2, "90 Mins Session\n20 Edited Images\n2 Setups + Parents Portraits\nPhoto Album Included\nMother Gowns Included\nSiblings Included\nProps & Accessories Included\nAll Raw Photos Included"],
    ['Platinum', 16999, 3, "120 Mins Session\n25 Edited Images\n3 Setups + Parents Portraits\nPhoto Album Included\nMother Gowns Included\nSiblings Included\nProps & Accessories Included\nAll Raw Photos Included"],
    ['Premium', 19999, 3, "150 Mins Session\n30 Edited Images\n3 Setups + Parents Portraits\nPremium Photo Album Included\nMother Gowns Included\nSiblings Included\nProps & Accessories Included\nAll Raw Photos Included\nCinematic Reel Included"]
];

// Fetch existing packages for category 9
$res = $c->query("SELECT package_id FROM packages WHERE category_id = 9 ORDER BY package_id ASC");
$existing_ids = [];
while($row = $res->fetch_assoc()) $existing_ids[] = $row['package_id'];

foreach ($new_packages as $index => $p) {
    if (isset($existing_ids[$index])) {
        // Update existing
        $stmt = $c->prepare("UPDATE packages SET package_name=?, price=?, max_catelogues=?, description=? WHERE package_id=?");
        $stmt->bind_param("sdisi", $p[0], $p[1], $p[2], $p[3], $existing_ids[$index]);
    } else {
        // Insert new if we have more than before
        $stmt = $c->prepare("INSERT INTO packages (category_id, package_name, price, max_catelogues, description) VALUES (9, ?, ?, ?, ?)");
        $stmt->bind_param("sdis", $p[0], $p[1], $p[2], $p[3]);
    }
    $stmt->execute();
}

echo "Successfully updated Newborn packages with the new names and details.";
$c->close();
?>
