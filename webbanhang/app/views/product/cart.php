<?php include 'app/views/shares/header.php'; ?>

<div class="container py-5">
    <h1 class="text-center mb-4">🛒 Giỏ hàng của bạn</h1>

    <?php if (!empty($cart)): ?>
        <div class="row">
            <div class="col-lg-8">
                <ul class="list-group mb-4 shadow rounded">
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $id => $item): ?>
                        <li class="list-group-item d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                            <div class="d-flex align-items-center mb-3 mb-md-0">
                                <?php if ($item['image']): ?>
                                    <img src="/webbanhang/<?php echo $item['image']; ?>" alt="Product Image" class="img-thumbnail me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                <?php endif; ?>
                                <div>
                                    <h5 class="mb-1"><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                    <p class="mb-1">Giá: <span class="fw-bold text-danger price" data-price="<?php echo $item['price']; ?>"><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</span></p>
                                    <div class="d-flex align-items-center">
                                        <label for="quantity-<?php echo $id; ?>" class="me-2 mb-0">Số lượng:</label>
                                        <input type="number" id="quantity-<?php echo $id; ?>" class="form-control quantity" name="quantity" value="<?php echo htmlspecialchars($item['quantity'], ENT_QUOTES, 'UTF-8'); ?>" min="1" style="width: 80px;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="subtotal fs-5 text-primary" id="subtotal-<?php echo $id; ?>">
                                    Tổng: <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VND
                                </p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-lg-4">
                <div class="card shadow p-4 rounded">
                    <h4 class="mb-3">Tổng thanh toán</h4>
                    <h3 id="total" class="text-success mb-4"><?php echo number_format($total, 0, ',', '.'); ?> VND</h3>

                    <div class="d-grid gap-2">
                        <a href="/webbanhang/Product/checkout" class="btn btn-success btn-lg">
                            <i class="bi bi-credit-card"></i> Thanh Toán
                        </a>
                        <a href="/webbanhang/Product" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center">
            <p>Giỏ hàng của bạn đang trống.</p>
            <a href="/webbanhang/Product" class="btn btn-primary mt-3">
                <i class="bi bi-bag-plus"></i> Mua sắm ngay
            </a>
        </div>
    <?php endif; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>

<!-- JavaScript cập nhật tổng tiền -->
<script>
    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', function() {
            let quantity = parseInt(this.value);
            if (isNaN(quantity) || quantity < 1) {
                quantity = 1;
                this.value = quantity;
            }

            const price = parseFloat(this.closest('li').querySelector('.price').dataset.price);
            const subtotal = quantity * price;

            this.closest('li').querySelector('.subtotal').innerText = 'Tổng: ' + subtotal.toLocaleString('vi-VN') + ' VND';

            updateTotal();
        });
    });

    function updateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(subtotal => {
            const subtotalValue = parseInt(subtotal.innerText.replace(/[^0-9]/g, ''));
            total += subtotalValue;
        });
        document.getElementById('total').innerText = total.toLocaleString('vi-VN') + ' VND';
    }

    // Khởi tạo tổng ngay khi load trang
    updateTotal();
</script>
