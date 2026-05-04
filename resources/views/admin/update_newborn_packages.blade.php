<?php
$c = new mysqli('localhost', 'root', '', 'photographybymonali');
if ($c->connect_error) { die("Connection failed: " . $c->connect_error); }

// 1. Delete existing Newborn packages (Category ID: 9)
$c->query("DELETE FROM packages WHERE category_id = 9");

// 2. Define the exact packages requested
$new_packages = [
    [
        'name' => 'Basic',
        'price' => 9999,
        'max' => 2,
        'desc' => "90 Mins Session\nProps & Accessories Included\nAll Raw Photos Included"
    ],
    [
        'name' => 'Gold',
        'price' => 12999,
        'max' => 2,
        'desc' => "90 Mins Session\n20 Edited Images\n2 Setups + Parents Portraits\nPhoto Album Included\nMother Gowns Included\nSiblings Included\nProps & Accessories Included\nAll Raw Photos Included"
    ],
    [
        'name' => 'Platinum',
        'price' => 16999,
        'max' => 3,
        'desc' => "120 Mins Session\n25 Edited Images\n3 Setups + Parents Portraits\nPhoto Album Included\nMother Gowns Included\nSiblings Included\nProps & Accessories Included\nAll Raw Photos Included"
    ],
    [
        'name' => 'Premium',
        'price' => 19999,
        'max' => 3,
        'desc' => "150 Mins Session\n30 Edited Images\n3 Setups + Parents Portraits\nPremium Photo Album Included\nMother Gowns Included\nSiblings Included\nProps & Accessories Included\nAll Raw Photos Included\nCinematic Reel Included"
    ]
];

// 3. Insert them
foreach ($new_packages as $p) {
    $stmt = $c->prepare("INSERT INTO packages (category_id, package_name, price, max_catelogues, description) VALUES (9, ?, ?, ?, ?)");
    $stmt->bind_param("sdis", $p['name'], $p['price'], $p['max'], $p['desc']);
    $stmt->execute();
}

echo "Successfully updated Newborn packages with your provided details.";
$c->close();
?>
