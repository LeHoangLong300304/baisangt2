<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'app/helpers/SessionHelper.php';

// Kiểm tra quyền admin
if (!SessionHelper::isAdmin()) {
    header('Location: /webbanhang/account/login');
    exit;
}

include 'app/views/shares/header.php';
?>

<div class="container mt-5">

    <!-- Banner Admin -->
    <div class="banner-text mb-4 text-center py-4" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
        <h1 class="display-4 fw-bold text-white text-shadow">HL Mobile Admin</h1>
        <p class="lead text-white">Bảng điều khiển quản trị</p>
    </div>

    <!-- Tabs Điều khiển -->
    <ul class="nav nav-tabs mb-4 justify-content-center" id="adminTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" type="button" role="tab">Sản phẩm</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="categories-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab">Danh mục</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="accounts-tab" data-bs-toggle="tab" data-bs-target="#accounts" type="button" role="tab">Tài khoản</button>
        </li>
    </ul>

    <div class="tab-content" id="adminTabContent">

        <!-- Quản lý Sản phẩm -->
        <div class="tab-pane fade show active" id="products" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <h2 class="h4 fw-bold">Quản lý sản phẩm</h2>
                <a href="/webbanhang/admin/addProduct" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Thêm sản phẩm</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Giá</th>
                            <th>Danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr><td colspan="7">Không có sản phẩm nào.</td></tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product->id ?></td>
                                    <td><?= htmlspecialchars($product->name) ?></td>
                                    <td><?= htmlspecialchars(substr($product->description, 0, 50)) ?>...</td>
                                    <td><?= number_format($product->price, 0, ',', '.') ?> VND</td>
                                    <td><?= htmlspecialchars($product->category_name) ?></td>
                                    <td>
                                        <?php if (!empty($product->image)): ?>
                                            <img src="/webbanhang/<?= htmlspecialchars($product->image) ?>" alt="Ảnh sản phẩm" style="height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                            <span>Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="/webbanhang/admin/editProduct/<?= $product->id ?>" 
                                           class="btn btn-warning btn-sm me-2 d-inline-flex align-items-center" 
                                           style="min-width: 100px;">
                                            <i class="fas fa-edit me-1"></i> Sửa
                                        </a>

                                        <a href="/webbanhang/admin/deleteProduct/<?= $product->id ?>" 
                                           class="btn btn-danger btn-sm d-inline-flex align-items-center" 
                                           style="min-width: 100px;" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                                            <i class="fas fa-trash-alt me-1"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quản lý Danh mục -->
        <div class="tab-pane fade" id="categories" role="tabpanel">
            <div class="d-flex justify-content-between mb-3">
                <h2 class="h4 fw-bold">Quản lý danh mục</h2>
                <a href="/webbanhang/admin/addCategory" class="btn btn-primary"><i class="fas fa-plus me-2"></i> Thêm danh mục</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Mô tả</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($categories)): ?>
                            <tr><td colspan="4">Không có danh mục nào.</td></tr>
                        <?php else: ?>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= $category->id ?></td>
                                    <td><?= htmlspecialchars($category->name) ?></td>
                                    <td><?= htmlspecialchars($category->description) ?></td>
                                    <td>
                                        <a href="/webbanhang/admin/editCategory/<?= $category->id ?>" 
                                           class="btn btn-warning btn-sm me-2 d-inline-flex align-items-center" 
                                           style="min-width: 100px;">
                                            <i class="fas fa-edit me-1"></i> Sửa
                                        </a>

                                        <a href="/webbanhang/admin/deleteCategory/<?= $category->id ?>" 
                                           class="btn btn-danger btn-sm d-inline-flex align-items-center" 
                                           style="min-width: 100px;" 
                                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                            <i class="fas fa-trash-alt me-1"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Quản lý Tài khoản -->
        <div class="tab-pane fade" id="accounts" role="tabpanel">
            <h2 class="h4 fw-bold mb-3">Quản lý tài khoản</h2>

            <div class="table-responsive">
                <table class="table table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ tên</th>
                            <th>Vai trò</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($accounts)): ?>
                            <tr><td colspan="4">Không có tài khoản nào.</td></tr>
                        <?php else: ?>
                            <?php foreach ($accounts as $account): ?>
                                <tr>
                                    <td><?= $account->id ?></td>
                                    <td><?= htmlspecialchars($account->username) ?></td>
                                    <td><?= htmlspecialchars($account->fullname) ?></td>
                                    <td><?= htmlspecialchars($account->role) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- Style thêm -->
<style>
    .text-shadow {
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
    }

    .nav-tabs .nav-link.active {
        background-color: #667eea;
        color: #fff !important;
        border-color: #667eea #667eea #fff;
    }

    .nav-tabs .nav-link {
        color: #333;
    }

    .nav-tabs .nav-link:hover {
        color: #667eea;
    }

    .btn-primary {
        background-color: #667eea;
        border-color: #667eea;
    }

    .btn-primary:hover {
        background-color: #556cd6;
        border-color: #556cd6;
    }

    /* Nút Sửa */
    .btn-warning {
        background-color: #f0ad4e;
        border-color: #eea236;
        color: #fff;
    }

    .btn-warning:hover {
        background-color: #ec971f;
        border-color: #d58512;
    }

    /* Nút Xóa */
    .btn-danger {
        background-color: #d9534f;
        border-color: #d43f3a;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c9302c;
        border-color: #ac2925;
    }

    /* Kích thước và căn chỉnh nút */
    .btn-sm {
        padding: 8px 16px;
        font-size: 0.9rem;
        border-radius: 8px;
    }

    .d-inline-flex {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .d-inline-flex i {
        font-size: 1rem;
    }
</style>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
