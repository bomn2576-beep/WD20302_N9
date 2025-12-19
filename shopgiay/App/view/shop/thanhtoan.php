<style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background: #fff; }
        .checkout-container { max-width: 880px; margin: 50px auto; }
        .form-control { border-radius: 4px; padding: 16px; border: 1px solid #e5e5e5; }
        .form-control:focus { border-color: #111; box-shadow: none; }
        .btn-order { background: #111; color: #fff; border-radius: 30px; padding: 16px; width: 100%; border: none; font-weight: 500; }
        .order-summary { background: #f6f6f6; padding: 25px; border-radius: 8px; }
    </style>
<div class="checkout-container px-3">
        <div class="row">
            <div class="col-md-7 pe-md-5">
                <h4 class="fw-bold mb-4">Bạn muốn giao hàng đến đâu?</h4>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Họ và Tên">
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Địa chỉ chi tiết (Số nhà, đường...)">
                </div>
                <div class="row mb-3">
                    <div class="col"><input type="text" class="form-control" placeholder="Tỉnh/Thành phố"></div>
                    <div class="col"><input type="text" class="form-control" placeholder="Số điện thoại"></div>
                </div>
                <div class="mb-4">
                    <input type="email" class="form-control" placeholder="Email nhận thông báo">
                </div>

                <h4 class="fw-bold mb-4">Phương thức thanh toán</h4>
                <div class="border p-3 rounded mb-3 d-flex align-items-center">
                    <input type="radio" name="payment" checked>
                    <span class="ms-3">Thanh toán khi nhận hàng (COD)</span>
                </div>
                <button class="btn-order mt-4">ĐẶT HÀNG NGAY</button>
            </div>

            <div class="col-md-5 mt-5 mt-md-0">
                <div class="order-summary">
                    <h5 class="fw-bold mb-3">Tóm tắt đơn hàng</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Tạm tính</span>
                        <span>2.929.000đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-secondary">Phí giao hàng</span>
                        <span>Miễn phí</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold border-top pt-3 h5">
                        <span>Tổng cộng</span>
                        <span>2.929.000đ</span>
                    </div>

                    <div class="mt-4">
                        <small class="text-secondary">Dự kiến giao hàng: 3-5 ngày làm việc.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>