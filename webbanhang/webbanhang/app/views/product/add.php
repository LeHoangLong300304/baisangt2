<?php include 'app/views/shares/header.php'; ?>

<h1 class="mb-4 text-center">Thêm sản phẩm mới</h1>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body p-4">
                    <form method="POST" action="/webbanhang/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();" class="needs-validation">
                        <div class="form-group mb-3">
                            <label for="name" class="fw-bold">Tên sản phẩm:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="description" class="fw-bold">Mô tả:</label>
                            <textarea id="description" name="description" class="form-control" required></textarea>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="price" class="fw-bold">Giá:</label>
                            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="category_id" class="fw-bold">Danh mục:</label>
                            <select id="category_id" name="category_id" class="form-control" required>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->id ?>"> <?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="image" class="fw-bold">Hình ảnh:</label>
                            <input type="file" id="image" name="image" class="form-control">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                            <a href="/webbanhang/Product/" class="btn btn-secondary ms-2">Quay lại danh sách</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
