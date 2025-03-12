<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <!-- Banner Text "HL Mobile Store" -->
    <div class="banner-text mb-4 text-center py-4" style="background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%); border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
        <h1 class="display-4 fw-bold" style="color: #fff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">HL Mobile Store</h1>
        <p class="lead" style="color: #fff; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);">Cửa hàng điện thoại và thiết bị công nghệ hàng đầu</p>
    </div>

    <!-- Banner Hình Ảnh -->
    <div class="banner mb-5">
        <img src="/webbanhang/app/images/Capture.png" 
             alt="Banner Khuyến Mãi" 
             class="img-fluid w-100" 
             style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
    </div>

    <!-- Thanh danh mục nằm ngang -->
    <nav class="navbar navbar-expand-lg navbar-light mb-4" style="border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 100%);">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product?category=tivi">Tivi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product?category=thiet-bi-am-thanh">Thiết bị âm thanh</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product?category=phu-kien">Phụ kiện</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product?category=may-tinh-bang">Máy tính bảng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product?category=laptop">Laptop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/webbanhang/Product?category=dien-thoai">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-center mb-4" style="color: #1a73e8; font-weight: 700; text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);">Danh sách sản phẩm</h1>

    <!-- Nút thêm sản phẩm mới -->
    <a href="/webbanhang/Product/add" class="btn btn-success mb-4">Thêm sản phẩm mới</a>

    <!-- Hiển thị số lượng sản phẩm trong giỏ hàng -->
    <?php 
    $cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; 
    if ($cartCount > 0): ?>
        <p class="text-center text-info mb-4">
            Có <strong><?php echo $cartCount; ?></strong> sản phẩm trong <a href="/webbanhang/Product/cart" class="text-decoration-underline">giỏ hàng</a>.
        </p>
    <?php endif; ?>

    <!-- Danh sách sản phẩm dạng lưới ngang -->
    <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card h-100 product-card">
                        <!-- Hình ảnh sản phẩm -->
                        <?php if ($product->image): ?>
                            <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                                 class="card-img-top" 
                                 alt="Product Image">
                        <?php endif; ?>

                        <!-- Nội dung sản phẩm -->
                        <div class="card-body text-center">
                            <h5 class="card-title">
                                <a href="/webbanhang/Product/show/<?php echo $product->id; ?>" class="text-decoration-none">
                                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted small mb-2">
                                <?php echo htmlspecialchars(substr($product->description, 0, 50), ENT_QUOTES, 'UTF-8'); ?>...
                            </p>
                            <p class="card-text fw-bold">
                                Giá: <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                            </p>
                            <p class="card-text text-muted small">
                                Danh mục: <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                        </div>

                        <!-- Nút hành động -->
                        <div class="card-footer bg-transparent border-0 text-center">
                            <a href="/webbanhang/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm mb-2">Sửa</a>
                            <a href="/webbanhang/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm mb-2" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>
                            <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-primary btn-sm">Thêm vào giỏ</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Hiện tại chưa có sản phẩm nào.</p>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- Thêm CSS tùy chỉnh -->
<style>
    .banner-text {
        position: relative;
        overflow: hidden;
    }
    .banner-text h1 {
        font-size: 3.5rem;
        animation: fadeIn 2s ease-in-out;
    }
    .banner-text p {
        font-size: 1.5rem;
        animation: fadeIn 3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .banner img {
        transition: transform 0.3s;
    }
    .banner img:hover {
        transform: scale(1.02);
    }

    .product-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-primary, .btn-warning, .btn-danger {
        transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
    }
    .btn-primary:hover {
        background-color: #2196f3 !important;
        border-color: #2196f3 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .btn-warning:hover {
        background-color: #ffa000 !important;
        border-color: #ffa000 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .btn-danger:hover {
        background-color: #c62828 !important;
        border-color: #c62828 !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 768px) {
        .navbar-nav {
            flex-direction: column;
            text-align: center;
        }
        .banner-text h1 {
            font-size: 2.5rem;
        }
        .banner-text p {
            font-size: 1.2rem;
        }
    }
</style>