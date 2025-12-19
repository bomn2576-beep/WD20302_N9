<style>
    .product-detail-container { max-width: 1200px; margin: 40px auto; padding: 0 48px; }
    .main-img { width: 100%; border-radius: 8px; background: #f6f6f6; }
    .product-info { padding-left: 40px; }
    
    /* Style cho lưới chọn Size */
    .size-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 20px; }
    .size-item { position: relative; }
    .size-item input { position: absolute; opacity: 0; width: 0; height: 0; }
    .size-item label { 
        display: block; border: 1px solid #e5e5e5; padding: 12px; 
        text-align: center; cursor: pointer; border-radius: 4px; transition: 0.2s;
        font-weight: 500;
    }
    .size-item input:checked + label { border-color: #111; background: #111; color: #fff; }
    .size-item label:hover:not(.active) { border-color: #111; }
    
    .btn-add-cart { 
        background: #111; color: #fff; border-radius: 30px; padding: 18px; 
        width: 100%; border: none; font-weight: 600; margin-top: 25px; 
        transition: opacity 0.3s;
    }
    .btn-add-cart:hover { opacity: 0.8; }
</style>

<div class="product-detail-container">
    <div class="row">
        <div class="col-md-7">
            <img src="<?= $product['anh_dai_dien'] ?>" class="main-img" id="mainImage">
        </div>

        <div class="col-md-5 product-info">
            <h3 class="fw-bold mb-1"><?= $product['ten_san_pham'] ?></h3>
            <p class="text-secondary mb-3">Shoes | PKD Icons</p>
            <h4 class="fw-bold mb-4"><?= number_format($product['gia_ban'], 0, ',', '.') ?>₫</h4>

            <div class="size-selection">
                <div class="d-flex justify-content-between mb-2">
                    <span class="fw-bold">Select Size</span>
                    <span class="text-secondary">Size Guide</span>
                </div>
                <div class="size-grid">
                    <?php 
                    $list_size = [38, 39, 40, 41, 42, 43, 44, 45];
                    foreach($list_size as $s): ?>
                        <div class="size-item">
                            <input type="radio" name="nike_size" id="s-<?= $s ?>" value="<?= $s ?>" <?= $s == 40 ? 'checked' : '' ?>>
                            <label for="s-<?= $s ?>">EU <?= $s ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <button type="button" onclick="handleAddToBag(<?= $product['id'] ?>)" class="btn-add-cart">
                Add to Bag
            </button>
            
            <div class="mt-5 text-secondary" style="font-size: 15px; line-height: 1.6;">
                <?= $product['mo_ta'] ?>
            </div>
        </div>
    </div>
</div>

<script>
function handleAddToBag(productId) {
    // Lấy size đang được chọn
    const selectedSize = document.querySelector('input[name="nike_size"]:checked').value;
    
    // Chuyển hướng đến CartController kèm theo ID và Size
    const url = `index.php?page=cart&action=add&id=${productId}&size=${selectedSize}`;
    window.location.href = url;
}
</script>