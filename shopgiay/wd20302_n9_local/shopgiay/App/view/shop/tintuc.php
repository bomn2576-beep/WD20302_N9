<style>
    /* Latest News Section Custom */
.card {
    transition: transform 0.3s ease;
    cursor: pointer;
}

/* Hiệu ứng hình ảnh Nike Style */
.card-img-container {
    overflow: hidden; /* Để không bị tràn khi ảnh phóng to */
    background-color: #f5f5f5;
}

.card-img-top {
    transition: transform 0.5s ease;
    object-fit: cover;
}

.card:hover .card-img-top {
    transform: scale(1.03); /* Phóng to nhẹ khi hover */
}

/* Định dạng nội dung văn bản */
.card-body h4 {
    font-size: 24px;
    font-weight: 700;
    margin-top: 15px;
    letter-spacing: -0.5px;
}

.card-body p {
    font-size: 16px;
    line-height: 1.5;
    margin-bottom: 15px;
}

/* Nút Đọc thêm (Link kiểu Nike) */
.btn-link {
    text-decoration: none;
    position: relative;
    display: inline-block;
}

.btn-link::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: #111;
    visibility: hidden;
    transform: scaleX(0);
    transition: all 0.3s ease-in-out;
}

.btn-link:hover::after {
    visibility: visible;
    transform: scaleX(1);
}
</style>
<div class="container mt-5 mb-5">
    <h2 class="fw-bold mb-4" style="font-size: 24px;">Tin mới nhất</h2>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-img-container">
                    <img src="https://static.nike.com/a/images/f_auto/dpr_1.3,py_20/w_705,c_limit/c937171e-53c0-449e-b9b3-467657158752/nike-just-do-it.jpg" class="card-img-top rounded-0" alt="Nike News">
                </div>
                <div class="card-body px-0">
                    <h4 class="fw-bold">Tương lai của Air</h4>
                    <p class="text-secondary">Khám phá công nghệ đệm khí mới nhất trong dòng Air Max mới giúp tăng cường hiệu suất vận động.</p>
                    <a href="#" class="btn btn-link text-dark fw-bold p-0">Đọc thêm</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-img-container">
                    <img src="https://static.nike.com/a/images/f_auto/dpr_1.3,py_20/w_705,c_limit/d2f66453-2c1b-4d43-982c-29d91f4f5d22/nike-just-do-it.png" class="card-img-top rounded-0" alt="Jordan News">
                </div>
                <div class="card-body px-0">
                    <h4 class="fw-bold">Di sản Jordan</h4>
                    <p class="text-secondary">Sự trở lại của những thiết kế huyền thoại mang đậm dấu ấn văn hóa bóng rổ toàn cầu.</p>
                    <a href="#" class="btn btn-link text-dark fw-bold p-0">Đọc thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>