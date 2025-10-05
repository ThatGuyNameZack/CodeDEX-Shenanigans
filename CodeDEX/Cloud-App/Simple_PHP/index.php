
// FILE 1: index.php
<?php
$appName = "Sistem Manajemen Produk";
$version = 1.0;
$totalProducts = 0;
$isActive = true;

$products = [
    [
        'id' => 1,
        'name' => 'Laptop Dell XPS',
        'price' => 15000000,
        'stock' => 5,
        'category' => 'Elektronik'
    ],
    [
        'id' => 2,
        'name' => 'Mouse Logitech',
        'price' => 250000,
        'stock' => 20,
        'category' => 'Aksesoris'
    ],
    [
        'id' => 3,
        'name' => 'Keyboard Mechanical',
        'price' => 800000,
        'stock' => 12,
        'category' => 'Aksesoris'
    ],
    [
        'id' => 4,
        'name' => 'Monitor LG 27 inch',
        'price' => 3500000,
        'stock' => 8,
        'category' => 'Elektronik'
    ],
    [
        'id' => 5,
        'name' => 'Webcam HD',
        'price' => 450000,
        'stock' => 15,
        'category' => 'Aksesoris'
    ]
];

$totalProducts = count($products);

$totalValue = 0;
foreach ($products as $product) {
    $totalValue += $product['price'] * $product['stock'];
}

$taxRate = 0.10;
$totalWithTax = $totalValue * (1 + $taxRate);

$expensiveProducts = [];
foreach ($products as $product) {
    if ($product['price'] > 1000000) {
        $expensiveProducts[] = $product;
    }
}

function formatRupiah($amount) {
    return "Rp " . number_format($amount, 0, ',', '.');
}

function getStockStatus($stock) {
    if ($stock > 15) {
        return "Stok Banyak";
    } elseif ($stock >= 10 && $stock <= 15) {
        return "Stok Sedang";
    } else {
        return "Stok Terbatas";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $appName; ?> v<?php echo $version; ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📦 <?php echo $appName; ?></h1>
            <p>Version <?php echo $version; ?> | Status: <?php echo $isActive ? "Active" : "Inactive"; ?></p>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Produk</h3>
                <p><?php echo $totalProducts; ?> Item</p>
            </div>
            <div class="stat-card">
                <h3>Total Nilai Inventori</h3>
                <p><?php echo formatRupiah($totalValue); ?></p>
            </div>
            <div class="stat-card">
                <h3>Total + Pajak (10%)</h3>
                <p><?php echo formatRupiah($totalWithTax); ?></p>
            </div>
            <div class="stat-card">
                <h3>Produk Mahal (>1jt)</h3>
                <p><?php echo count($expensiveProducts); ?> Item</p>
            </div>
        </div>

        <div class="content">
            <div class="section">
                <h2>📋 Daftar Semua Produk</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status Stok</th>
                            <th>Total Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): 
                            $stockStatus = getStockStatus($product['stock']);
                            $totalProductValue = $product['price'] * $product['stock'];
                            
                            if ($product['stock'] > 15) {
                                $badgeClass = 'badge-success';
                            } elseif ($product['stock'] >= 10) {
                                $badgeClass = 'badge-warning';
                            } else {
                                $badgeClass = 'badge-danger';
                            }
                        ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><strong><?php echo $product['name']; ?></strong></td>
                            <td><span class="category-tag"><?php echo $product['category']; ?></span></td>
                            <td><?php echo formatRupiah($product['price']); ?></td>
                            <td><?php echo $product['stock']; ?> unit</td>
                            <td><span class="badge <?php echo $badgeClass; ?>"><?php echo $stockStatus; ?></span></td>
                            <td><?php echo formatRupiah($totalProductValue); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>💎 Produk Premium (Harga > Rp 1.000.000)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($expensiveProducts); $i++): ?>
                        <tr>
                            <td><strong><?php echo $expensiveProducts[$i]['name']; ?></strong></td>
                            <td><?php echo formatRupiah($expensiveProducts[$i]['price']); ?></td>
                            <td><?php echo $expensiveProducts[$i]['stock']; ?> unit</td>
                            <td><span class="category-tag"><?php echo $expensiveProducts[$i]['category']; ?></span></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>

            <div class="section">
                <h2>🔄 Demonstrasi Struktur Looping</h2>
                
                <div class="loop-demo">
                    <h3>1️⃣ WHILE LOOP - Countdown Stok Terbatas</h3>
                    <?php 
                    $counter = 1;
                    while ($counter <= 5): 
                    ?>
                    <div class="loop-item">
                        ⚠️ Peringatan #<?php echo $counter; ?>: Segera restok produk dengan stok < 10 unit!
                    </div>
                    <?php 
                        $counter++;
                    endwhile; 
                    ?>
                </div>

                <div class="loop-demo">
                    <h3>2️⃣ DO-WHILE LOOP - Kategori Produk</h3>
                    <?php 
                    $categories = ['Elektronik', 'Aksesoris', 'Perangkat Lunak'];
                    $index = 0;
                    do {
                        echo "<div class='loop-item'>📂 Kategori: " . $categories[$index] . "</div>";
                        $index++;
                    } while ($index < count($categories));
                    ?>
                </div>

                <div class="loop-demo">
                    <h3>3️⃣ FOR LOOP - Diskon Bertingkat</h3>
                    <?php for ($discount = 10; $discount <= 30; $discount += 10): ?>
                    <div class="loop-item">
                        🎉 Diskon <?php echo $discount; ?>% untuk pembelian di atas <?php echo formatRupiah(1000000 * ($discount / 10)); ?>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="section">
                <h2>🧮 Demonstrasi Operators</h2>
                <div class="loop-demo">
                    <?php
                    $num1 = 100;
                    $num2 = 25;
                    
                    echo "<div class='loop-item'><strong>Arithmetic Operators:</strong><br>";
                    echo "Penjumlahan: $num1 + $num2 = " . ($num1 + $num2) . "<br>";
                    echo "Pengurangan: $num1 - $num2 = " . ($num1 - $num2) . "<br>";
                    echo "Perkalian: $num1 * $num2 = " . ($num1 * $num2) . "<br>";
                    echo "Pembagian: $num1 / $num2 = " . ($num1 / $num2) . "<br>";
                    echo "Modulus: $num1 % $num2 = " . ($num1 % $num2) . "</div>";
                    
                    echo "<div class='loop-item'><strong>Comparison Operators:</strong><br>";
                    echo "$num1 > $num2: " . ($num1 > $num2 ? 'TRUE' : 'FALSE') . "<br>";
                    echo "$num1 < $num2: " . ($num1 < $num2 ? 'TRUE' : 'FALSE') . "<br>";
                    echo "$num1 == $num2: " . ($num1 == $num2 ? 'TRUE' : 'FALSE') . "<br>";
                    echo "$num1 != $num2: " . ($num1 != $num2 ? 'TRUE' : 'FALSE') . "</div>";
                    
                    echo "<div class='loop-item'><strong>Logical Operators:</strong><br>";
                    $hasStock = true;
                    $isAvailable = true;
                    echo "Has Stock AND Available: " . ($hasStock && $isAvailable ? 'TRUE' : 'FALSE') . "<br>";
                    echo "Has Stock OR Available: " . ($hasStock || $isAvailable ? 'TRUE' : 'FALSE') . "<br>";
                    echo "NOT Has Stock: " . (!$hasStock ? 'TRUE' : 'FALSE') . "</div>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>