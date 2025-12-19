<style>
    .nike-category-container { font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; padding: 0 40px; }
    /* Sidebar Filter Sticky */
    .filter-sidebar { position: sticky; top: 80px; height: calc(100vh - 80px); overflow-y: auto; padding-right: 20px; }
    .filter-section { border-bottom: 1px solid #e5e5e5; padding: 20px 0; }
    .filter-section h6 { font-weight: 600; font-size: 16px; margin-bottom: 15px; }
    
    /* Product Grid */
    .product-grid-item { text-decoration: none; color: #111; margin-bottom: 30px; display: block; }
    .img-box { background: #f5f5f5; aspect-ratio: 1/1; overflow: hidden; }
    .img-box img { width: 100%; height: 100%; object-fit: cover; mix-blend-mode: multiply; }
    .p-info { padding-top: 12px; }
    .p-name { font-size: 16px; font-weight: 600; margin: 0; }
    .p-type { color: #707072; font-size: 16px; }
    .p-price { font-size: 16px; font-weight: 600; margin-top: 8px; }
</style>

<div class="nike-category-container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><?= $title ?> (<?= count($products) ?>)</h4>
        <div class="d-flex gap-4 align-items-center">
            <span class="fw-bold" style="cursor:pointer">Hide Filters <i class="bi bi-sliders"></i></span>
            <div class="dropdown">
                <span class="fw-bold dropdown-toggle" data-bs-toggle="dropdown" style="cursor:pointer">Sort By</span>
                <ul class="dropdown-menu border-0 shadow">
                    <li><a class="dropdown-item" href="#">Newest</a></li>
                    <li><a class="dropdown-item" href="#">Price: High-Low</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 d-none d-lg-block">
            <div class="filter-sidebar">
                <div class="filter-section pt-0 border-0">
                    <ul class="list-unstyled fw-bold mb-0">
                        <li class="mb-2"><a href="#" class="text-dark text-decoration-none">Lifestyle</a></li>
                        <li class="mb-2"><a href="#" class="text-dark text-decoration-none">Jordan</a></li>
                        <li class="mb-2"><a href="#" class="text-dark text-decoration-none">Running</a></li>
                    </ul>
                </div>
                <div class="filter-section">
                    <h6>Gender</h6>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="men"><label class="form-check-label" for="men">Men</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="women"><label class="form-check-label" for="women">Women</label></div>
                </div>
                <div class="filter-section">
                    <h6>Shop By Price</h6>
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="p1"><label class="form-check-label" for="p1">Under 2,000,000₫</label></div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-12">
            <div class="row g-3">
                <?php foreach ($products as $p): ?>
                <div class="col-6 col-md-4">
                    <a href="index.php?page=detail&id=<?= $p['id'] ?>" class="product-grid-item">
                    <div class="img-box" style="aspect-ratio: 1/1; background: #f5f5f5; overflow: hidden;">
    <?php 
        $path = trim($p['anh_dai_dien']); // Xóa khoảng trắng thừa
        
        // Kiểm tra xem $path có phải là URL (bắt đầu bằng http hoặc https)
        if (preg_match('/^https?:\/\//', $path)) {
            $image_src = $path;
        } else {
            // Nếu là file trong thư mục nội bộ
            $image_src = $base_url_path . "public/uploads/" . $path;
        }
    ?>
    <img src="<?= $image_src ?>" 
         alt="<?= $p['ten_san_pham'] ?>" 
         style="width: 100%; height: 100%; object-fit: cover;"
         onerror="this.src='https://placehold.co/600x600?text=Nike+Shoes'">
</div>   <div class="p-info">
                            <h6 class="p-name"><?= $p['ten_san_pham'] ?></h6>
                            <p class="p-type text-secondary">Shoes</p>
                            <p class="p-price"><?= number_format($p['gia_ban'], 0, ',', '.') ?>₫</p>
                        </div>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>