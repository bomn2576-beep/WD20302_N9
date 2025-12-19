<style>
    .form-control {
    border-radius: 8px;
    border: 1px solid #e5e5e5;
}
.form-control:focus {
    border-color: #111;
    box-shadow: none;
}
.btn-outline-dark:hover {
    background-color: transparent;
    color: #111;
    border-width: 2px;
}
</style>
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <h4 class="fw-bold mb-4">How would you like to get your order?</h4>
            <form action="index.php?page=place_order" method="POST">
                <div class="mb-4">
                    <button type="button" class="btn btn-outline-dark w-100 py-3 rounded-3 d-flex align-items-center px-4">
                        <i class="bi bi-truck fs-4 me-3"></i> <b>Deliver It</b>
                    </button>
                </div>

                <h5 class="fw-bold mb-3">Enter your name and address:</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="first_name" class="form-control py-3" placeholder="First Name" required>
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="last_name" class="form-control py-3" placeholder="Last Name" required>
                    </div>
                    <div class="col-12">
                        <input type="text" name="address" class="form-control py-3" placeholder="Address" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" name="email" class="form-control py-3" placeholder="Email" required>
                    </div>
                    <div class="col-md-6">
                        <input type="tel" name="phone" class="form-control py-3" placeholder="Phone Number" required>
                    </div>
                </div>

                <h5 class="fw-bold mt-5 mb-3">Payment</h5>
                <p class="text-secondary small">All transactions are secure and encrypted.</p>
                <div class="border p-3 rounded-3 mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="cod" checked>
                        <label class="form-check-label fw-bold" for="cod">Cash on Delivery (COD)</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark w-100 rounded-pill py-3 fw-bold mt-4">Place Order</button>
            </form>
        </div>

        <div class="col-lg-5">
            <div class="ps-lg-4">
                <h4 class="fw-bold mb-4">In Your Bag</h4>
                <div class="checkout-summary border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Subtotal</span>
                        <span><?= number_format($totalAmount, 0, ',', '.') ?>₫</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Estimated Shipping</span>
                        <span>Free</span>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold"><?= number_format($totalAmount, 0, ',', '.') ?>₫</span>
                    </div>
                </div>

                <div class="checkout-items">
                    <?php foreach ($cartItems as $item): ?>
                    <div class="d-flex mb-3">
                        <img src="<?= $GLOBALS['base_url_path'] ?>public/uploads/<?= $item['anh_dai_dien'] ?>" width="80" class="bg-light">
                        <div class="ms-3">
                            <p class="mb-0 fw-bold small"><?= $item['ten_san_pham'] ?></p>
                            <p class="mb-0 text-secondary small">Qty <?= $item['quantity'] ?> | <?= number_format($item['gia_ban'], 0, ',', '.') ?>₫</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>