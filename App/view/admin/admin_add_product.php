<style>
        :root { --sidebar-width: 260px; --nike-black: #111; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        .main-content { margin-left: var(--sidebar-width); padding: 30px; }
        .form-card { background: white; border-radius: 15px; border: none; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .upload-zone { border: 2px dashed #dee2e6; border-radius: 10px; padding: 40px; text-align: center; cursor: pointer; transition: 0.3s; }
        .upload-zone:hover { border-color: var(--nike-black); background: #fdfdfd; }
        .btn-save { background: var(--nike-black); color: white; border-radius: 30px; padding: 12px 40px; font-weight: 600; border: none; }

        
               :root { --sidebar-width: 260px; --nike-black: #111; }
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; }
        
        /* Sidebar (Giữ nguyên từ trang Dashboard) */
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: var(--nike-black); color: white; padding-top: 20px; }
        .sidebar .nav-link { color: #adb5bd; padding: 12px 25px; display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: white; background: rgba(255,255,255,0.1); }

        /* Content */
        .main-content { margin-left: var(--sidebar-width); padding: 30px; }
        
        /* Product Table Custom */
        .product-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; background: #f5f5f5; }
        .table-container { background: white; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); overflow: hidden; }
        .search-box { max-width: 300px; border-radius: 20px; padding-left: 40px; }
        .search-wrapper { position: relative; }
        .search-wrapper i { position: absolute; left: 15px; top: 10px; color: #6c757d; }
        
        /* Buttons */
        .btn-add { background: var(--nike-black); color: white; border-radius: 25px; padding: 8px 20px; font-weight: 600; }
        .btn-add:hover { background: #333; color: white; }
        .action-btn { width: 35px; height: 35px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; transition: 0.3s; }
    </style>
<div class="page-header mb-4">
    <h2 class="fw-bold">Thêm sản phẩm mới</h2>
</div>

<div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
    <form action="admin.php?page=insert_product" method="POST">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-4">
                    <label class="form-label fw-bold">Tên giày</label>
                    <input type="text" name="ten_san_pham" class="form-control border-0 bg-light py-2" placeholder="VD: Nike Air Force 1" required>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                        <input type="number" name="gia_ban" class="form-control border-0 bg-light py-2" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Danh mục</label>
                        <select name="id_danh_muc" class="form-select border-0 bg-light py-2">
                            <?php 
                            $db = getConnection();
                            $cates = $db->query("SELECT * FROM danh_muc")->fetchAll();
                            foreach($cates as $c): ?>
                                <option value="<?= $c['id'] ?>"><?= $c['ten_danh_muc'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Mô tả sản phẩm</label>
                    <textarea name="mo_ta" class="form-control border-0 bg-light" rows="6"></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Link URL hình ảnh</label>
                <input type="text" name="anh_dai_dien" class="form-control border-0 bg-light py-2" placeholder="Dán link ảnh tại đây">
                <p class="small text-muted mt-2">Dán link ảnh từ Nike.com để hiển thị nhanh.</p>
            </div>
        </div>
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-dark rounded-pill px-5 py-2 fw-bold">Đăng sản phẩm</button>
        </div>
    </form>
</div>