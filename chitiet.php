<?php
session_start();

// --- DATA ---
$products = [
  1 => [
    "name" => "Nike Dunk Low Retro",
    "price" => 2500000,
    "desc" => "Giày thể thao phong cách, chất lượng cao.",
    "images" => ["p1-1.jpg", "p1-2.jpg", "p1-3.jpg"]
  ]
];

$id = $_GET['id'] ?? 1;
$product = $products[$id] ?? null;
if(!$product) die("Không tìm thấy sản phẩm");

if(isset($_POST['add'])){
  $_SESSION['cart'][] = ["id" => $id, "qty" => $_POST['qty']];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title><?= $product['name'] ?></title>
<style>
body{margin:0;font-family:Arial;background:#111;display:flex;justify-content:center;color:#000}
.wrap{width:1200px;background:#fff;padding:40px;}
.grid{display:grid;grid-template-columns:1fr 1fr;gap:40px;}
.thumbs img{width:70px;margin:5px;cursor:pointer;border:2px solid #ddd}
.main-img{width:100%;max-height:420px;object-fit:cover;border:1px solid #ddd}
.related{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;margin-top:40px;}
.related img{width:100%;border:1px solid #ddd}
</style>
<script>
function showImg(src){ document.getElementById('mainImg').src = src; }
</script>
</head>
<body>
<div class="wrap">

<h2><?= $product['name'] ?></h2>
<div class="grid">
  <div>
    <img id="mainImg" class="main-img" src="https://via.placeholder.com/800x600?text=<?= $product['images'][0] ?>">
    <div class="thumbs">
      <?php foreach($product['images'] as $img): ?>
        <img onclick="showImg('https://via.placeholder.com/800x600?text=<?= $img ?>')" src="https://via.placeholder.com/800x600?text=<?= $img ?>">
      <?php endforeach; ?>
    </div>
  </div>

  <div>
    <p><b>Giá:</b> <?= number_format($product['price']) ?>đ</p>
    <form method="post">
      Số lượng: <input type="number" name="qty" value="1" min="1"><br><br>
      <button name="add">Thêm vào giỏ</button>
    </form>
    <p><?= $product['desc'] ?></p>
  </div>
</div>

<h3>Sản phẩm liên quan</h3>
<div class="related">
  <?php for($i=1;$i<=4;$i++): ?>
    <div>
      <img src="https://via.placeholder.com/800x600?text=p1-1.jpg">
      <p>SP 0<?= $i ?></p>
      <p>1.200.000đ</p>
    </div>
  <?php endfor; ?>
</div>

</div>
</body>
</html>
