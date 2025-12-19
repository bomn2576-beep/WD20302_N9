<div class="container py-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h2 class="fw-bold mb-0">Sale Products</h2>
            <p class="text-secondary mt-2"><?= count($saleProducts) ?> Items found</p>
        </div>
    </div>

    <div class="row g-4">
        <?php if (!empty($saleProducts)): ?>
            <?php foreach ($saleProducts as $item): ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product-item position-relative">
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 rounded-0 px-3">SALE</span>
                        
                        <a href="index.php?page=detail&id=<?= $item['id'] ?>" class="text-decoration-none text-dark">
                            <img src="<?= $GLOBALS['base_url_path'] ?>public/uploads/<?= $item['anh_dai_dien'] ?>" class="w-100 bg-light" alt="<?= $item['ten_san_pham'] ?>">
                            <div class="pt-3">
                                <h6 class="fw-bold mb-0"><?= $item['ten_san_pham'] ?></h6>
                                <p class="text-secondary mb-1"><?= $item['ma_sku'] ?></p>
                                
                                <p class="mb-0">
                                    <span class="fw-bold text-danger"><?= number_format($item['gia_khuyen_mai'], 0, ',', '.') ?>₫</span>
                                    <span class="text-decoration-line-through text-secondary ms-2" style="font-size: 0.9rem;">
                                        <?= number_format($item['gia_ban'], 0, ',', '.') ?>₫
                                    </span>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <h3>Hiện tại chưa có chương trình giảm giá.</h3>
                <a href="index.php?page=home" class="btn btn-dark rounded-pill px-4 mt-3">Quay lại trang chủ</a>
            </div>
        <?php endif; ?>
    </div>
</div>