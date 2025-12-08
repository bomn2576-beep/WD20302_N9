<?php
$products = [
    [
        "name" => "Nike Dunk Low SS",
        "price" => 2599000,
        "image" => "https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto/3ab52e15-1786-48a0-a42e-eead893895ff/W+NIKE+DUNK+LOW+SS.png"
    ],
    [
        "name" => "Nike Air Force 1",
        "price" => 2999000,
        "image" => "https://static.nike.com/a/images/t_prod_fs/w_640/7cd90f96-9390-4223-bbed-e4c2f87c177a/air-force-1-07-shoes-JWzFf6.png"
    ],
    [
        "name" => "Nike Blazer Low",
        "price" => 1999000,
        "image" => "https://static.nike.com/a/images/t_prod_fs/w_640/8d11ac2f-6bc0-4938-8a12-aaae2a405416/blazer-low-77-shoes-NpTfSZ.png"
    ]
];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nike Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="title">Sản phẩm nổi bật</h1>

<div class="product-grid">
    <?php foreach ($products as $p): ?>
        <div class="product-card">
            <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>">
            <div class="info">
                <h3><?= $p['name'] ?></h3>
                <p class="price"><?= number_format($p['price'], 0, ',', '.') ?>₫</p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
