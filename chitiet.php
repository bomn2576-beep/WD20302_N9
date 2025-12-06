<?php
// product.php (1 file - PHP + HTML + CSS + JS)
// Save as product.php and open http://localhost/product.php?id=1

session_start();

// --- Sample product data ---
$products = [
    1 => [
        'id' => 1,
        'name' => 'Nike Air Force 1 – Red Edition',
        'price' => 2599000,
        'currency' => '₫',
        'images' => [
            'https://images.unsplash.com/photo-1528701800489-476f8c8e9a0d?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1519741491582-4b1b2b64b3b3?auto=format&fit=crop&w=1200&q=80',
            'https://images.unsplash.com/photo-1491557345352-5929e343eb89?auto=format&fit=crop&w=1200&q=80'
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
            'https://images.unsplash.com/photo-1600180758890-05a37b3b9f2e?auto=format&fit=crop&w=1200&q=80'
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
            'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80'
        ],
        'description' => 'Túi đeo chéo phong cách, nhỏ gọn để điện thoại và ví.',
        'sku' => 'BAG-DB-003',
        'sizes' => [],
        'category' => 'Bags'
    ],
    4 => [
        'id' => 4,
        'name' => 'Nike Court – White/Red',
        'price' => 2199000,
        'currency' => '₫',
        'images' => [
            'https://images.unsplash.com/photo-1542293787932-8c3d5b1b8f63?auto=format&fit=crop&w=1200&q=80'
        ],
        'description' => 'Classic court shoe with retro vibes.',
        'sku' => 'CRT-WRD-004',
        'sizes' => ['38','39','40','41'],
        'category' => 'Sneakers'
    ],
    5 => [
        'id' => 5,
        'name' => 'Casual Slip-On – Beige',
        'price' => 1299000,
        'currency' => '₫',
        'images' => [
            'https://images.unsplash.com/photo-1519741491582-3b1b2b64b333?auto=format&fit=crop&w=1200&q=80'
        ],
        'description' => 'Comfort slip-on for everyday.',
        'sku' => 'SLP-BEG-005',
        'sizes' => ['36','37','38','39','40'],
        'category' => 'Sneakers'
    ],
];

// --- Cart handling (session) ---
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'add_to_cart' && isset($_POST['product_id'])) {
        $pid = (int)$_POST['product_id'];
        $qty = max(1, (int)($_POST['quantity'] ?? 1));
        $size = $_POST['size'] ?? null;
        if (!isset($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid] = ['qty' => $qty, 'size' => $size];
        } else {
            $_SESSION['cart'][$pid]['qty'] += $qty;
            $_SESSION['cart'][$pid]['size'] = $size;
        }
        // redirect to avoid repost
        header('Location: ' . strtok($_SERVER['REQUEST_URI'], '?') . '?id=' . $pid);
        exit;
    }
}

// --- Get product by id ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
if (!isset($products[$id])) {
    http_response_code(404);
    echo "Product not found";
    exit;
}
$product = $products[$id];
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
    <title>Chi tiết sản phẩm - <?=htmlspecialchars($product['name'])?></title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        /* Reset & base */
        *{box-sizing:border-box}
        body{margin:0;font-family:Inter, Roboto, Arial, sans-serif;background:#f7f7f7;color:#222}
        a{text-decoration:none;color:inherit}
        img{display:block;max-width:100%}

        /* Container */
        .wrap{max-width:1200px;margin:20px auto;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 6px 30px rgba(0,0,0,0.08)}
        .topbar{display:flex;align-items:center;padding:18px 28px;border-bottom:1px solid #eee}
        .logo{font-weight:800;letter-spacing:1px}
        .search{margin-left:20px;flex:1;opacity:.9}
        .cart-info{margin-left:auto;color:#555;font-size:14px}

        /* Main grid */
        .container{display:grid;grid-template-columns:1fr 380px;gap:28px;padding:28px}
        /* left column */
        .left{display:flex;flex-direction:column;gap:18px}
        .product-visual{display:grid;grid-template-columns:1fr 120px;gap:18px;align-items:start}
        .main-image-wrap{background:#fff;border-radius:8px;padding:30px;display:flex;align-items:center;justify-content:center;min-height:360px;border:1px solid #fafafa}
        .main-image-wrap img{max-height:520px;object-fit:contain}
        .thumbs{display:flex;flex-direction:column;gap:10px}
        .thumbs img{width:90px;height:70px;object-fit:cover;border-radius:6px;cursor:pointer;border:2px solid transparent}
        .thumbs img.active{border-color:#111}

        /* related */
        .related{margin-top:8px}
        .related h3{font-size:16px;margin:6px 0 12px;color:#333}
        .related-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:18px}
        .card{background:#fff;padding:10px;border-radius:8px;text-align:center;border:1px solid #fafafa}
        .card img{height:120px;object-fit:cover;border-radius:6px}
        .card .title{font-size:13px;margin-top:8px;color:#333}
        .card .price{color:#d32f2f;font-weight:700;margin-top:6px}

        /* right column (meta) */
        .meta{padding:16px 0}
        .meta h1{font-size:20px;margin:0 0 6px}
        .price{font-size:22px;color:#d32f2f;font-weight:800;margin:6px 0}
        .sku{color:#777;font-size:13px;margin-bottom:12px}
        .desc{color:#444;line-height:1.5;margin-bottom:12px}
        .options{margin:12px 0}
        .options label{display:block;font-size:13px;margin-bottom:6px;color:#333}
        .options select,.options input[type="number"]{width:100%;padding:10px;border-radius:6px;border:1px solid #e7e7e7;background:#fff}
        .btn{display:inline-block;padding:12px 22px;border-radius:8px;background:#111;color:#fff;border:0;cursor:pointer;font-weight:700}
        .small{font-size:13px;color:#666;margin-top:12px}

        footer{padding:18px;border-top:1px solid #f0f0f0;color:#777;font-size:13px;text-align:center}

        /* Responsive */
        @media (max-width:980px){
            .container{grid-template-columns:1fr}
            .product-visual{grid-template-columns:1fr 1fr}
            .thumbs{flex-direction:row;overflow:auto}
            .thumbs img{width:86px;height:66px}
        }

        /* Optional thin grid overlay to help alignment (hidden by default) */
        .grid-overlay { display: none; pointer-events: none; position: absolute; inset: 0; opacity: 0.12; }
        .grid-overlay .col { height:100%; background: repeating-linear-gradient(90deg, rgba(255,0,0,0.15) 0 1px, transparent 1px 40px); }
    </style>
</head>
<body>
<div class="wrap">
    <div class="topbar">
        <div class="logo">MyShop</div>
        <div class="search"> <!-- simple breadcrumb -->
            <small style="color:#888">Home / Product / <?=htmlspecialchars($product['name'])?></small>
        </div>
        <div class="cart-info">Giỏ hàng: <?=array_sum(array_column($_SESSION['cart'] ?: [], 'qty'))?> sp</div>
    </div>

    <div class="container">
        <div class="left">
            <div class="product-visual">
                <div class="main-image-wrap" id="mainWrap">
                    <img id="mainImage" src="<?=htmlspecialchars($product['images'][0])?>" alt="<?=htmlspecialchars($product['name'])?>">
                </div>
                <div>
                    <div style="display:flex;justify-content:flex-end;align-items:center;margin-bottom:10px;color:#999;font-size:13px">Thumbnails</div>
                    <div class="thumbs" id="thumbs">
                        <?php foreach ($product['images'] as $i => $src): ?>
                            <img src="<?=htmlspecialchars($src)?>" data-src="<?=htmlspecialchars($src)?>" class="<?= $i===0? 'active':'' ?>" alt="thumb">
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="related">
                <h3>You Might Also Like</h3>
                <div class="related-grid">
                    <?php foreach($related as $r): ?>
                        <div class="card">
                            <a href="?id=<?=$r['id']?>"><img src="<?=htmlspecialchars($r['images'][0])?>" alt="<?=htmlspecialchars($r['name'])?>"></a>
                            <div class="title"><?=htmlspecialchars($r['name'])?></div>
                            <div class="price"><?=formatPrice($r['price'])?></div>
                        </div>
                    <?php endforeach; ?>

                    <?php
                    // If no related (e.g., category different), show some other products
                    if (empty($related)) {
                        foreach ($products as $p) if ($p['id'] !== $product['id']) {
                            echo '<div class="card"><a href="?id='.$p['id'].'"><img src="'.htmlspecialchars($p['images'][0]).'"></a><div class="title">'.htmlspecialchars($p['name']).'</div><div class="price">'.formatPrice($p['price']).'</div></div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </div>

        <aside class="meta">
            <h1><?=htmlspecialchars($product['name'])?></h1>
            <div class="price"><?=formatPrice($product['price'])?></div>
            <div class="sku">Mã: <?=htmlspecialchars($product['sku'])?> &nbsp; • &nbsp; Category: <?=htmlspecialchars($product['category'])?></div>

            <p class="desc"><?=htmlspecialchars($product['description'])?></p>

            <form method="post" style="margin-top:10px">
                <input type="hidden" name="action" value="add_to_cart">
                <input type="hidden" name="product_id" value="<?=$product['id']?>">

                <?php if (!empty($product['sizes'])): ?>
                    <div class="options">
                        <label for="size">Size</label>
                        <select name="size" id="size">
                            <?php foreach($product['sizes'] as $s): ?>
                                <option value="<?=$s?>"><?=$s?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="options" style="margin-top:10px">
                    <label for="quantity">Số lượng</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1">
                </div>

                <div style="margin-top:16px">
                    <button class="btn" type="submit">Thêm vào giỏ</button>
                </div>
            </form>

            <div class="small">Chính sách đổi trả: Đổi trong 7 ngày nếu có lỗi nhà sản xuất.</div>
        </aside>
    </div>

    <footer>
        © <?=date('Y')?> - Demo product detail. Thiết kế responsive, dễ tuỳ chỉnh.
    </footer>
</div>

<script>
    // Thumbnails to main image
    (function(){
        const thumbs = document.getElementById('thumbs');
        const main = document.getElementById('mainImage');
        thumbs.addEventListener('click', function(e){
            if(e.target && e.target.tagName === 'IMG'){
                const src = e.target.dataset.src || e.target.src;
                main.src = src;
                // active class
                document.querySelectorAll('#thumbs img').forEach(img=>img.classList.remove('active'));
                e.target.classList.add('active');
            }
        });

        // quick prefetch other images for smoother swap
        document.querySelectorAll('#thumbs img').forEach(img=>{
            const i = new Image(); i.src = img.dataset.src || img.src;
        });
    })();
</script>
</body>
</html>
