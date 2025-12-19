 <style>
        :root { --nike-black: #111; --nike-gray: #707072; --nike-light: #f5f5f5; }
        body { font-family: 'Helvetica Neue', Arial, sans-serif; color: var(--nike-black); overflow-x: hidden; }
        
        /* Gallery Ảnh: Dàn trang kiểu Nike */
        .product-image-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .product-image-grid img { width: 100%; height: auto; background: var(--nike-light); transition: transform 0.5s ease; cursor: zoom-in; }
        .product-image-grid img:hover { transform: scale(1.02); }

        /* Cột thông tin bên phải */
        .product-info-sticky { position: sticky; top: 20px; padding-bottom: 50px; }
        .price-tag { font-size: 20px; font-weight: 500; margin: 15px 0 30px 0; }
        
        /* Size Selector */
        .size-header { display: flex; justify-content: space-between; margin-bottom: 10px; font-weight: 500; }
        .size-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        .size-item { 
            border: 1px solid #e5e5e5; padding: 12px; text-align: center; border-radius: 4px; 
            cursor: pointer; font-size: 15px; transition: all 0.2s; 
        }
        .size-item:hover { border-color: var(--nike-black); }
        .size-item.active { border-color: var(--nike-black); box-shadow: inset 0 0 0 1px var(--nike-black); }
        .size-item.disabled { background: #f9f9f9; color: #ccc; cursor: not-allowed; border-color: #f0f0f0; }

        /* Buttons */
        .btn-nike { width: 100%; border-radius: 30px; padding: 18px; font-weight: 500; margin-bottom: 12px; transition: 0.3s; }
        .btn-add-cart { background: var(--nike-black); color: white; border: none; }
        .btn-add-cart:hover { background: #333; }
        .btn-wishlist { background: white; border: 1px solid #e5e5e5; }
        .btn-wishlist:hover { border-color: var(--nike-black); }

        /* Description & Accordion */
        .description-text { font-size: 16px; line-height: 1.6; margin-top: 40px; }
        .accordion-button:not(.collapsed) { background-color: white; color: black; box-shadow: none; }
        .accordion-button:focus { box-shadow: none; }
        .accordion-item { border-left: none; border-right: none; }

        @media (max-width: 768px) {
            .product-image-grid { grid-template-columns: 1fr; }
            .product-info-sticky { position: static; margin-top: 30px; }
        }
    </style>
    <div class="container-fluid px-md-5 mt-4">
        <div class="row">
            <div class="col-md-7 pe-md-4">
                <div class="product-image-grid">
                    <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/b7d9211c-26e7-431a-ac24-b0540fb3c00f/AIR+FORCE+1+%2707.png" alt="view 1">
                    <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/33d39580-0a25-4ac6-943f-84d4127027ae/AIR+FORCE+1+%2707.png" alt="view 2">
                    <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/0446927d-0897-4258-a89c-50a9c8087951/AIR+FORCE+1+%2707.png" alt="view 3">
                    <img src="https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/c735d54a-e45e-4ba0-a359-86699a223f66/AIR+FORCE+1+%2707.png" alt="view 4">
                </div>
            </div>

            <div class="col-md-5 ps-md-5">
                <div class="product-info-sticky">
                    <h5 class="text-danger fw-bold" style="font-size: 14px;">Bán chạy nhất</h5>
                    <h1 class="fw-bold h2">Nike Air Force 1 '07</h1>
                    <p class="text-secondary mb-0">Giày Nam (Lifestyle)</p>
                    <div class="price-tag">2.929.000₫</div>

                    <div class="size-selection mb-4">
                        <div class="size-header">
                            <span>Chọn Size</span>
                            <a href="#" class="text-secondary text-decoration-none">Bảng kích cỡ</a>
                        </div>
                        <div class="size-grid">
                            <div class="size-item">EU 38.5</div>
                            <div class="size-item">EU 39</div>
                            <div class="size-item">EU 40</div>
                            <div class="size-item active">EU 41</div>
                            <div class="size-item">EU 42</div>
                            <div class="size-item">EU 43</div>
                            <div class="size-item">EU 44</div>
                            <div class="size-item disabled">EU 45</div>
                            <div class="size-item disabled">EU 46</div>
                        </div>
                    </div>

                    <button class="btn-nike btn-add-cart">Thêm vào Giỏ hàng</button>
                    <button class="btn-nike btn-wishlist">Yêu thích <i class="bi bi-heart ms-2"></i></button>

                    <div class="description-text">
                        <p>Huyền thoại tiếp tục tỏa sáng với Nike Air Force 1 '07—biểu tượng bóng rổ mang lại diện mạo mới mẻ cho những gì bạn biết rõ nhất: lớp phủ khâu bền bỉ, lớp hoàn thiện sạch sẽ.</p>
                    </div>

                    <div class="accordion accordion-flush mt-4" id="detailAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold px-0 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#ship">
                                    Vận chuyển & Trả hàng
                                </button>
                            </h2>
                            <div id="ship" class="accordion-collapse collapse" data-bs-parent="#detailAccordion">
                                <div class="accordion-body px-0 small text-secondary">
                                    Giao hàng tiêu chuẩn miễn phí cho Thành viên Nike. Đổi trả trong 30 ngày.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed fw-bold px-0 py-3" type="button" data-bs-toggle="collapse" data-bs-target="#review">
                                    Đánh giá (150)
                                </button>
                            </h2>
                            <div id="review" class="accordion-collapse collapse" data-bs-parent="#detailAccordion">
                                <div class="accordion-body px-0">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                                    <p class="mt-2">"Đôi giày cực kỳ thoải mái và bền!" - <strong>An Trần</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>