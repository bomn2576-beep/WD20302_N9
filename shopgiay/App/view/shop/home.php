<div id="nikeHeroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://png.pngtree.com/thumb_back/fw800/background/20220929/pngtree-shoes-promotion-banner-background-image_1466238.jpg" class="d-block w-100" alt="Banner 1">
        </div>
        <div class="carousel-item">
            <img src="https://upcontent.vn/wp-content/uploads/2024/07/mau-banner-giay-the-thao-3.jpg" class="d-block w-100" alt="Banner 2">
        </div>
         <div class="carousel-item">
            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/1400/48796e176747257.64ca4387527ec.jpg" class="d-block w-100" alt="Banner 2">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#nikeHeroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#nikeHeroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="hero-content-center text-center py-5">
    <p class="fw-bold mb-2">New Arrival</p>
    <h1 style="font-size: 72px; font-weight: 900;">POWER THEIR NEXT REP</h1>
    <p>Gift the latest gear to help them set a new personal best.</p>
    <div class="d-flex justify-content-center gap-2">
        <a href="#" class="btn btn-dark rounded-pill px-4">Shop Training</a>
        <a href="#" class="btn btn-dark rounded-pill px-4">Watch <i class="bi bi-play-fill"></i></a>
    </div>
</div>

<div class="container-fluid px-4 mb-5">
    <h3 class="section-title mb-4">Featured</h3>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="featured-card position-relative overflow-hidden" style="height: 550px;">
                <img src="https://specials-images.forbesimg.com/imageserve/5f6b6a8d00c70d87fda599fc/960x0.jpg?cropX1=0&cropX2=540&cropY1=0&cropY2=360" class="w-100 h-100 object-fit-cover" alt="">
                <div class="position-absolute bottom-0 left-0 p-5 text-white">
                    <p class="mb-1">Jordan</p>
                    <h4 class="fw-bold mb-3">AJ1 'Lost & Found'</h4>
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold">Shop</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="featured-card position-relative overflow-hidden" style="height: 550px;">
                <img src="https://static.nike.com/a/images/f_auto/dpr_1.0,cs_srgb/h_1320,c_limit/2ff2dcf8-5cf0-48e6-a57a-ab3358054565/nike-just-do-it.png" class="w-100 h-100 object-fit-cover" alt="">
                <div class="position-absolute bottom-0 left-0 p-5 text-white">
                    <p class="mb-1">Luyện tập</p>
                    <h4 class="fw-bold mb-3">PKD Training Gear</h4>
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold">Shop</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="featured-card position-relative overflow-hidden" style="height: 550px;">
                <img src="https://img.buzzfeed.com/buzzfeed-static/static/2023-09/14/1/asset/37f07e3d0fed/sub-buzz-2500-1694653985-2.png?downsize=1840:*&output-format=jpg&output-quality=auto" class="w-100 h-100 object-fit-cover" alt="">
                <div class="position-absolute bottom-0 left-0 p-5 text-white">
                    <p class="mb-1">Luyện tập</p>
                    <h4 class="fw-bold mb-3">3 Day of Drops</h4>
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold">Shop</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="featured-card position-relative overflow-hidden" style="height: 550px;">
                <img src="https://static.nike.com/a/images/f_auto/dpr_1.0,cs_srgb/h_1616,c_limit/1641c845-d060-40be-b5da-2d5b6c966e42/the-6-most-comfortable-running-shoes-by-nike.jpg" class="w-100 h-100 object-fit-cover" alt="">
                <div class="position-absolute bottom-0 left-0 p-5 text-white">
                    <p class="mb-1">Luyện tập</p>
                    <h4 class="fw-bold mb-3">More Comfort = More Running</h4>
                    <a href="#" class="btn btn-light rounded-pill px-4 fw-bold">Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Refresh Your Sneaker Rotation</h3>
    </div>
    <div class="row g-3">
        <?php if (!empty($newProducts)): ?>
            <?php foreach ($newProducts as $item): ?>
                <div class="col-6 col-md-3"> 
                    <a href="index.php?page=detail&id=<?= $item['id'] ?>" class="text-decoration-none text-dark">
                        <div class="product-item">
                            <?php 
                                $img = trim($item['anh_dai_dien']); 
                                $src = (strpos($img, 'http') === 0) ? $img : $base_url_path . "public/uploads/" . $img;
                            ?>
                            <div class="img-wrapper mb-2" style="aspect-ratio: 1/1; overflow: hidden; background: #f6f6f6;">
                                <img src="<?= $src ?>" class="w-100 h-100 object-fit-cover" alt="<?= $item['ten_san_pham'] ?>" 
                                     onerror="this.src='https://placehold.co/600x600?text=No+Image'">
                            </div>
                            
                            <div class="pt-2">
                                <h6 class="fw-bold mb-0" style="font-size: 15px;"><?= $item['ten_san_pham'] ?></h6>
                                <p class="text-secondary mb-1" style="font-size: 14px;">Shoes</p>
                                <p class="fw-bold" style="font-size: 15px;"><?= number_format($item['gia_ban'], 0, ',', '.') ?>₫</p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center w-100">Đang cập nhật sản phẩm mới...</p>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid px-4 mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Shop by Sport</h3>
    </div>
    <div class="row g-3">
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $cat): ?>
                <div class="col-6 col-md-4"> <a href="index.php?page=category&id=<?= $cat['id'] ?>" class="text-decoration-none">
                        <div class="sport-item position-relative overflow-hidden">
                            <?php 
                                // Nếu chưa có ảnh trong DB, dùng ảnh mặc định theo tên
                                $cat_img = !empty($cat['hinh_anh']) ? $cat['hinh_anh'] : "https://placehold.co/600x800?text=" . $cat['ten_danh_muc'];
                            ?>
                            <img src="<?= $cat_img ?>" class="w-100 img-fluid" style="height: 450px; object-fit: cover;" alt="<?= $cat['ten_danh_muc'] ?>">
                            
                            <div class="position-absolute bottom-0 start-0 m-4">
                                <span class="btn btn-light rounded-pill px-4 fw-bold">
                                    <?= $cat['ten_danh_muc'] ?>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center w-100">Đang cập nhật danh mục thể thao...</p>
        <?php endif; ?>
    </div>
</div>

<style>
    .sport-item img {
        transition: transform 0.5s ease;
    }
    .sport-item:hover img {
        transform: scale(1.05);
    }
    .sport-item .btn {
        border: none;
        font-size: 14px;
    }
</style>    
