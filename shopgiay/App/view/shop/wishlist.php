<style>
    .wishlist-container { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; padding: 0 48px; }
    .wishlist-title { font-size: 24px; font-weight: 500; margin-bottom: 30px; }
    .product-card-wishlist { text-decoration: none; color: #111; }
    .img-box { background: #f5f5f5; aspect-ratio: 1/1; position: relative; }
    .img-box img { width: 100%; height: 100%; object-fit: cover; mix-blend-mode: multiply; }
    .remove-wishlist { position: absolute; top: 10px; right: 10px; background: #fff; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; cursor: pointer; border: none; }
</style>

<div class="wishlist-container container py-5">
    <h2 class="wishlist-title">Favourites</h2>

    <?php if (empty($products)): ?>
        <div class="text-center py-5">
            <p class="text-secondary">Items added to your Favourites will be saved here.</p>
            <a href="index.php?page=new_featured" class="btn btn-dark rounded-pill px-4 py-2 mt-3">Shop Now</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($products as $p): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-card-wishlist">
                        <div class="img-box">
                            <a href="index.php?page=detail&id=<?= $p['id'] ?>">
                                <img src="<?= $GLOBALS['base_url_path'] ?>public/uploads/<?= $p['anh_dai_dien'] ?>" alt="">
                            </a>
                            <a href="index.php?page=wishlist_remove&id=<?= $p['id'] ?>" class="remove-wishlist shadow-sm">
                                <i class="bi bi-heart-fill text-dark"></i>
                            </a>
                        </div>
                        <div class="mt-3">
                            <h6 class="fw-bold mb-0"><?= $p['ten_san_pham'] ?></h6>
                            <p class="text-secondary mb-1">Men's Shoes</p>
                            <p class="fw-bold"><?= number_format($p['gia_ban'], 0, ',', '.') ?>₫</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>