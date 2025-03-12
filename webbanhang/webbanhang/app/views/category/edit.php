<?php include 'app/views/shares/header.php'; ?>

<h1 class="mb-4 text-center">Sửa danh mục</h1>

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
    <form method="POST" action="/webbanhang/Category/edit?id=<?= $category->id ?>">
        <div class="form-group mb-3">
            <label for="name">Tên danh mục:</label>
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="/webbanhang/Category/" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php include 'app/views/shares/footer.php'; ?>
