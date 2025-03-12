<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">Chi tiết sản phẩm</h2>
        </div>
        <div class="card-body">
            <?php if ($product): ?>
                <div class="row">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="col-md-6 text-center">
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>"
                                 class="img-fluid rounded product-image"
                                 alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                        <?php else: ?>
                            <img src="/webbanhang/images/no-image.png"
                                 class="img-fluid rounded product-image"
                                 alt="Không có ảnh">
                        <?php endif; ?>
                    </div>
                    <!-- Thông tin sản phẩm -->
                    <div class="col-md-6">
                        <h3 class="card-title text-dark font-weight-bold mb-3">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </h3>
                        <p class="card-text text-muted mb-4">
                            <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                        </p>
                        <p class="text-danger font-weight-bold h4 mb-4">
                            💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                        </p>
                        <p class="mb-4">
                            <strong>Danh mục:</strong>
                            <span class="badge bg-info text-white">
                                <?php echo !empty($product->category_name) 
                                    ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') 
                                    : 'Chưa có danh mục'; ?>
                            </span>
                        </p>
                        <!-- Nút hành động -->
                        <div class="mt-4 d-flex gap-3">
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>"
                               class="btn btn-success px-4 py-2 btn-action">
                                ➕ Thêm vào giỏ hàng
                            </a>
                            <a href="/webbanhang/Product/list" 
                               class="btn btn-secondary px-4 py-2 btn-action">
                                Quay lại danh sách
                            </a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Thông báo khi không tìm thấy sản phẩm -->
                <div class="alert alert-danger text-center py-4">
                    <h4 class="mb-0">Không tìm thấy sản phẩm!</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- CSS tùy chỉnh -->
<style>
    .product-image {
        max-height: 400px;
        width: auto;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-image:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .card-header {
        font-size: 1.5rem;
        font-weight: 700;
        padding: 1.5rem;
    }

    .card-title {
        font-size: 2rem;
        font-weight: 700;
        color: #333;
    }

    .card-text {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .badge {
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }

    .btn-action {
        font-size: 1rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }
</style>