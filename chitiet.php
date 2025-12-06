<?php
// product_detail.php
// Single-file demo of a product detail page in PHP (no database required).
// Instructions:
// 1. Save this file as `product_detail.php` in your web server root (e.g., htdocs or www).
// 2. Create a folder `images/` and put product images there or leave URLs as-is.
// 3. Open in browser: http://localhost/product_detail.php?id=1

session_start();

// --- Sample product data (replace with DB queries in real project) ---
$products = [
    1 => [
        'id' => 1,
        'name' => 'Nike Air Force 1 – Red Edition',
        'price' => 2599000,
        'currency' => '₫',
        'images' => [
            'https://images.unsplash.com/photo-1528701800489-476f8c8e9a0d?auto=format&fit=crop&w=800&q=60',
            'https://images.unsplash.com/photo-1519741491582-4b1b2b64b3b3?auto=format&fit=crop&w=800&q=60',
            'https://images.unsplash.com/photo-1491557345352-5929e343eb89?auto=format&fit=crop&w=800&q=60'
        ],
        'description' => "Sneakers classic style. Màu đỏ nổi bật, chất liệu da tổng hợp, đế cao su êm.",
        'sku' => 'AF1-RED-001',
        'sizes' => ['38','39','40','41','42'],
        'category' => 'Sneakers'
    ],
    2 => [
        'id' => 2,
        'name' => 'Nike Blazer – Pink',
        'price' => 1999000,
        'currency' => '₫',
        'images' => [
            'https://images.unsplash.com/photo-1600180758890-05a37b3b9f2e?auto=format&fit=crop&w=800&q=60'
        ],
        'description' => 'Casual low-top, nhẹ nhàng, phối màu pastel.',
        'sku' => 'BLZ-PNK-002',
        'sizes' => ['36','37','38','39'],
        'category' => 'Sneakers'
    ],
    3 => [
        'id' => 3,
        'name' => 'Crossbody Bag – Dark Brown',
        'price' => 890000,
        'currency' => '₫',
        'images' => [
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=800&q=60'
        ],
        'description' => 'Túi đeo chéo phong cách, nhỏ gọn để điện thoại và ví.',
        'sku' => 'BAG-DB-003',
        'sizes' => [],
        'category' => 'Bags'
    ],
];

// Simple cart handling (session)
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add_to_cart' && isset($_POST['product_id'])) {
        $pid = (int)$_POST['product_id'];
        $qty = max(1, (int)($_POST['quantity'] ?? 1));
        $size = $_POST['size'] ?? null;
        // add or update
        if (!isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid] = ['qty' => $qty, 'size' => $size];
        } else {
            $_SESSION['cart'][$pid]['qty'] += $qty;
            $_SESSION['cart'][$pid]['size'] = $size;
        }
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}

// Get requested product id
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
if (!isset($products[$id])) {
    http_response_code(404);
    echo "Product not found";
    exit;
}
$product = $products[$id];

// Prepare related products (same category, other ids)
$related = array_filter($products, function($p) use ($product) {
    return $p['category'] === $product['category'] && $p['id'] !== $product['id'];
});

function formatPrice($n) {
    return number_format($n, 0, ',', '.') . ' ₫';
}
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi tiết: <?=htmlspecialchars($product['name'])?></title>
    <style>
        :root{--bg:#1f1f1f;--card:#fff;--muted:#777;}
        *{box-sizing:border-box}
        body{font-family:Inter, Roboto, Arial, sans-serif;margin:0;background:var(--bg);color:#222}
        .wrap{max-width:1100px;margin:32px auto;background:var(--card);border-radius:6px;padding:28px}
        .topbar{display:flex;align-items:center;gap:12px;margin-bottom:18px}
        .logo{font-weight:700;color:#333}
        .grid{display:grid;grid-template-columns:1fr 360px;gap:24px}
        /* left column (images) */
        .gallery{display:flex;flex-direction:column;gap:12px}
        .main-image{background:#f5f5f5;padding:30px;border-radius:6px;display:flex;align-items:center;justify-content:center}
        .main-image img{max-width:100%;max-height:480px;object-fit:contain}
        .thumbs{display:flex;gap:8px;margin-top:6px}
        .thumbs img{width:80px;height:80px;border-radius:6px;object-fit:cover;cursor:pointer;border:2px solid transparent}
        .thumbs img.active{border-color:#111}
        /* right column (meta) */
        .meta{padding:18px}
        .meta h1{margin:0 0 6px;font-size:22px}
        .price{font-size:20px;color:#d32f2f;font-weight:700;margin:6px 0}
        .sku{color:var(--muted);font-size:13px}
        .desc{margin:12px 0;color:#444}
        .options{margin:12px 0}
        .options select,.options input[type="number"]{padding:8px;border-radius:4px;border:1px solid #ddd;width:100%}
        .btn{display:inline-block;padding:10px 16px;border-radius:6px;background:#111;color:#fff;text-decoration:none;border:0;cursor:pointer}
        .share{margin-top:12px;color:var(--muted);font-size:13px}
        hr.sep{border:none;border-top:1px solid #eee;margin:18px 0}
        /* related products */
        .related{margin-top:30px}
        .related-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:18px}
        .card{background:#fff;padding:10px;border-radius:6px;text-align:center}
        .card img{max-width:100%;height:120px;object-fit:cover;border-radius:6px}
        .card .title{font-size:14px;margin-top:8px}
        .card .price{color:#d32f2f;font-weight:700}
        /* footer */
        footer{margin-top:36px;padding-top:18px;border-top:1px solid #eee;color:var(--muted);font-size:13px}

        /* mobile */
        @media (max-width:900px){
            .wrap{margin:14px}
            .grid{grid-template-columns:1fr}
            .meta{padding:8px}
            .thumbs img{width:60px;height:60px}
        }
    </style>
</head>
<body>

<div class="wrap">
    <div class="topbar">
        <div class="logo">chitiet</div>
        <div style="margin-left:auto;color:var(--muted)">Giỏ hàng: <?=array_sum(array_column($_SESSION['cart'] ?: [], 'qty'))?> sp</div>
    </div>

    <div class="grid">
        <div>
            <div class="gallery">
                <div class="main-image" id="mainImage">
                    <img src="<?=htmlspecialchars($product['images'][0])?>" alt="<?=htmlspecialchars($product['name'])?>">
                </div>
                <div class="thumbs" id="thumbs">
                    <?php foreach ($product['images'] as $i => $src): ?>
                        <img src="<?=htmlspecialchars($src)?>" data-src="<?=htmlspecialchars($src)?>" class="<?= $i===0? 'active':'' ?>" alt="thumb">
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="related">
                <h3>You Might Also Like</h3>
                <div class="related-grid">
                    <?php foreach($related as $r): ?>
                        <div class="card">
                            <a href="?id=<?=$r['id']?>"><img src="<?=htmlspecialchars($r['images'][0])?>" alt="<?=$r['name']?>"></a>
                            <div class="title"><?=htmlspecialchars($r['name'])?></div>
                            <div class="price"><?=formatPrice($r['price'])?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <aside class="meta">
            <h1><?=htmlspecialchars($product['name'])?></h1>
            <div class="price"><?=formatPrice($product['price'])?></div>
            <div class="sku">Mã: <?=htmlspecialchars($product['sku'])?> &nbsp; • &nbsp; Category: <?=htmlspecialchars($product['category'])?></div>

            <p class="desc"><?=htmlspecialchars($product['description'])?></p>

            <form method="post">
                <input type="hidden" name="action" value="add_to_cart">
                <input type="hidden" name="product_id" value="<?=$product['id']?>">

                <?php if (!empty($product['sizes'])): ?>
                <div class="options">
                    <label>Size</label>
                    <select name="size">
                        <?php foreach($product['sizes'] as $s): ?>
                            <option value="<?=$s?>"><?=$s?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php endif; ?>

                <div class="options" style="margin-top:8px">
                    <label>Số lượng</label>
                    <input type="number" name="quantity" value="1" min="1">
                </div>

                <div style="margin-top:12px">
                    <button class="btn" type="submit">Thêm vào giỏ</button>
                </div>
            </form>

            <div class="share">Chia sẻ | Wishlist | So sánh</div>

            <hr class="sep">
            <div style="font-size:13px;color:var(--muted)">
                <strong>Chính sách đổi trả:</strong> Đổi trong 7 ngày nếu có lỗi nhà sản xuất.
            </div>
        </aside>
    </div>

    <footer>
        © <?=date('Y')?> - Demo product detail. Thiết kế responsive, dễ tuỳ chỉnh.
    </footer>
</div>

<script>
// Simple JS for thumbnails
const thumbs = document.getElementById('thumbs');
const main = document.getElementById('mainImage').querySelector('img');
thumbs.addEventListener('click', (e)=>{
    if(e.target.tagName === 'IMG'){
        const src = e.target.dataset.src || e.target.src;
        main.src = src;
        document.querySelectorAll('#thumbs img').forEach(img=>img.classList.remove('active'));
        e.target.classList.add('active');
    }
});
</script>

</body>
</html>
