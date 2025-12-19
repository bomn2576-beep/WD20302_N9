<style>
    /* Banner & Carousel */
    .carousel-item { height: 500px; background-color: #f5f5f5; }
    .carousel-item img { height: 100%; width: 100%; object-fit: cover; object-position: center; }
    
    /* Hero Content */
    .hero-content-center h1 { font-size: 48px !important; letter-spacing: -1px; }

    /* Shop by Icons */
    .icons-slider-container { padding-top: 40px; }
    .icon-card { 
        border: none; border-radius: 24px; overflow: hidden;
        background: linear-gradient(to bottom, #f5f5f5 0%, #e0e0e0 100%);
        transition: all 0.3s ease; cursor: pointer;
    }
    .icon-card:hover { transform: translateY(-8px); background: linear-gradient(to bottom, #eeeeee 0%, #cccccc 100%); }
    .icon-card img { padding: 20px; mix-blend-mode: multiply; }
    
    /* User Greeting Style */
    .user-welcome { font-size: 12px; font-weight: 600; color: #111; }
</style>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Nike VN - Just Do It'; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <?php include_once 'header.php'; ?>
</head>
<body>

    <div class="content-wrapper">
        <?php 
            if (isset($content_view) && file_exists($content_view)) {
                include $content_view;
            } else {
                echo "<div class='container text-center mt-5'>
                        <img src='https://via.placeholder.com/150?text=404' class='mb-3'>
                        <h3>Nội dung đang được cập nhật</h3>
                        <a href='index.php' class='btn btn-dark rounded-pill mt-3'>Quay lại trang chủ</a>
                      </div>";
            }
        ?>
    </div>

    <?php include_once 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>