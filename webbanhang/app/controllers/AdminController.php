<?php
require_once 'app/config/database.php';
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/models/AccountModel.php';
require_once 'app/helpers/SessionHelper.php';

class AdminController
{
    private $db;
    private $productModel;
    private $categoryModel;
    private $accountModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
        $this->accountModel = new AccountModel($this->db);
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function checkAdmin()
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /webbanhang/account/login');
            exit;
        }
    }

    public function index()
    {
        $this->checkAdmin();

        $products = $this->productModel->getProducts();
        $categories = $this->categoryModel->getCategories();
        $accounts = $this->accountModel->getAllAccounts();

        include_once 'app/views/admin/admin.php';
    }

    // Thêm sản phẩm
    public function addProduct()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $image = $_POST['image'] ?? '';

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);

            if (is_array($result) && !empty($result)) {
                $errors = $result;
                $categories = $this->categoryModel->getCategories();
                include_once 'app/views/product/add.php';
            } elseif ($result) {
                // ✅ Đưa về trang index admin sau khi thêm thành công
                header('Location: /webbanhang/admin/index');
                exit;
            } else {
                $errors['db'] = "Thêm sản phẩm thất bại!";
                $categories = $this->categoryModel->getCategories();
                include_once 'app/views/product/add.php';
            }
        } else {
            $categories = $this->categoryModel->getCategories();
            include_once 'app/views/product/add.php';
        }
    }

    // Sửa sản phẩm
    public function editProduct($id)
    {
        $this->checkAdmin();

        $product = $this->productModel->getProductById($id);
        if (!$product) {
            header('Location: /webbanhang/admin/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? '';
            $image = $_POST['image'] ?? '';

            $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

            if (is_array($result) && !empty($result)) {
                $errors = $result;
                $categories = $this->categoryModel->getCategories();
                include_once 'app/views/product/edit.php';
            } elseif ($result) {
                header('Location: /webbanhang/admin/index');
                exit;
            } else {
                $errors['db'] = "Sửa sản phẩm thất bại!";
                $categories = $this->categoryModel->getCategories();
                include_once 'app/views/product/edit.php';
            }
        } else {
            $categories = $this->categoryModel->getCategories();
            include_once 'app/views/product/edit.php';
        }
    }

    // Xóa sản phẩm
    public function deleteProduct($id)
    {
        $this->checkAdmin();

        $result = $this->productModel->deleteProduct($id);
        if ($result) {
            header('Location: /webbanhang/admin/index');
            exit;
        } else {
            $errors['db'] = "Xóa sản phẩm thất bại!";
            $products = $this->productModel->getProducts();
            $categories = $this->categoryModel->getCategories();
            $accounts = $this->accountModel->getAllAccounts();
            include_once 'app/views/admin/admin.php';
        }
    }

    // Thêm danh mục
    public function addCategory()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $result = $this->categoryModel->addCategory($name, $description);
            if (is_array($result) && !empty($result)) {
                $errors = $result;
                include_once 'app/views/category/add.php';
            } elseif ($result) {
                header('Location: /webbanhang/admin/index');
                exit;
            } else {
                $errors['db'] = "Thêm danh mục thất bại!";
                include_once 'app/views/category/add.php';
            }
        } else {
            include_once 'app/views/category/add.php';
        }
    }

    // Sửa danh mục
    public function editCategory($id)
    {
        $this->checkAdmin();

        $category = $this->categoryModel->getCategoryById($id);
        if (!$category) {
            header('Location: /webbanhang/admin/index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';

            $result = $this->categoryModel->updateCategory($id, $name, $description);
            if (is_array($result) && !empty($result)) {
                $errors = $result;
                include_once 'app/views/category/edit.php';
            } elseif ($result) {
                header('Location: /webbanhang/admin/index');
                exit;
            } else {
                $errors['db'] = "Sửa danh mục thất bại!";
                include_once 'app/views/category/edit.php';
            }
        } else {
            include_once 'app/views/category/edit.php';
        }
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        $this->checkAdmin();

        $result = $this->categoryModel->deleteCategory($id);
        if ($result) {
            header('Location: /webbanhang/admin/index');
            exit;
        } else {
            $errors['db'] = "Xóa danh mục thất bại! Có thể danh mục đang chứa sản phẩm.";
            $products = $this->productModel->getProducts();
            $categories = $this->categoryModel->getCategories();
            $accounts = $this->accountModel->getAllAccounts();
            include_once 'app/views/admin/admin.php';
        }
    }

    // Thêm tài khoản
    public function addAccount()
    {
        $this->checkAdmin();
        include_once 'app/views/account/add.php';
    }

    // Sửa tài khoản
    public function editAccount($id)
    {
        $this->checkAdmin();
        $account = $this->accountModel->getAccountById($id);
        include_once 'app/views/account/edit.php';
    }

    // Xóa tài khoản
    public function deleteAccount($id)
    {
        $this->checkAdmin();
        $this->accountModel->delete($id);
        header('Location: /webbanhang/admin/index');
        exit;
    }
}
?>
