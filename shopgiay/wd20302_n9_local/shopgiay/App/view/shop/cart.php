<style>
    .qty-btn {
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        border: 1px solid #e5e5e5; border-radius: 50%;
        color: #111; text-decoration: none; transition: 0.2s;
    }
    .qty-btn:hover { background: #111; color: #fff; border-color: #111; }
    .qty-value { min-width: 40px; text-align: center; font-weight: 600; font-size: 16px; }
</style>

<div class="container my-5" style="max-width: 1100px;">
    <div class="row">
        <div class="col-lg-8">
            <h4 class="fw-bold mb-4">Bag</h4>
            
            <?php if (empty($cartItems)): ?>
                <div class="py-5 text-center border-top">
                    <p class="text-secondary">Your bag is empty.</p>
                    <a href="index.php?page=home" class="btn btn-dark rounded-pill px-4">Shop Now</a>
                </div>
            <?php else: ?>
                <?php foreach ($cartItems as $item): ?>
                    <div class="row mb-4 border-bottom pb-4">
                        <div class="col-3 col-md-2">
                            <img src="<?= $item['anh_dai_dien'] ?>" class="img-fluid bg-light rounded shadow-sm">
                        </div>
                        <div class="col-9 col-md-10">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-bold mb-1"><?= $item['ten_san_pham'] ?></h6>
                                    <p class="text-secondary mb-1">Size: EU <?= $item['selected_size'] ?></p>
                                    
                                    <div class="d-flex align-items-center mt-2">
                                        <a href="index.php?page=cart&action=update&type=minus&id=<?= $item['line_id'] ?>" class="qty-btn">
                                            <i class="bi bi-dash"></i>
                                        </a>
                                        <span class="qty-value"><?= $item['quantity'] ?></span>
                                        <a href="index.php?page=cart&action=update&type=plus&id=<?= $item['line_id'] ?>" class="qty-btn">
                                            <i class="bi bi-plus"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <p class="fw-bold mb-0"><?= number_format($item['subtotal'], 0, ',', '.') ?>₫</p>
                                    <small class="text-muted"><?= number_format($item['gia_ban'], 0, ',', '.') ?>₫ / đôi</small>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <a href="index.php?page=cart&action=remove&id=<?= $item['line_id'] ?>" class="text-secondary text-decoration-none me-4">
                                    <i class="bi bi-trash fs-5"></i> Remove
                                </a>
                                <i class="bi bi-heart fs-5 text-secondary cursor-pointer"></i>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="col-lg-4 ps-lg-5">
            <div class="summary-card p-4 border rounded bg-white shadow-sm">
                <h4 class="fw-bold mb-4">Summary</h4>
                <div class="d-flex justify-content-between mb-3">
                    <span>Subtotal</span>
                    <span><?= number_format($totalPrice, 0, ',', '.') ?>₫</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span>Estimated Delivery</span>
                    <span>Free</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5"><?= number_format($totalPrice, 0, ',', '.') ?>₫</span>
                </div>
                <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold mb-3">Checkout</button>
            </div>
        </div>
    </div>
</div>