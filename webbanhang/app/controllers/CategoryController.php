<?php
require_once('app/config/database.php');
require_once('app/models/CategoryModel.php');

class CategoryController
{
    private $categoryModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->categoryModel = new CategoryModel($this->db);
    }

    // Mặc định hiển thị danh sách danh mục
    public function index()
    {
        $this->list();
    }

    // Hiển thị danh sách danh mục
    public function list()
    {
        $categories = $this->categoryModel->getCategories();
        include 'app/views/category/list.php';
    }

    // Hiển thị form thêm danh mục và xử lý thêm
    public function add()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống.";
            }

            if (empty($errors)) {
                $success = $this->categoryModel->createCategory($name, $description);
                if ($success) {
                    header("Location: /webbanhang/Category/");
                    exit();
                } else {
                    $errors[] = "Có lỗi xảy ra khi thêm danh mục.";
                }
            }
        }

        include 'app/views/category/add.php';
    }

    // Hiển thị form sửa danh mục và xử lý cập nhật
    public function edit()
    {
        $errors = [];
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header("Location: /webbanhang/Category/");
            exit();
        }

        $category = $this->categoryModel->getCategoryById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (empty($name)) {
                $errors[] = "Tên danh mục không được để trống.";
            }

            if (empty($errors)) {
                $success = $this->categoryModel->updateCategory($id, $name, $description);
                if ($success) {
                    header("Location: /webbanhang/Category/");
                    exit();
                } else {
                    $errors[] = "Có lỗi xảy ra khi cập nhật danh mục.";
                }
            }
        }

        include 'app/views/category/edit.php';
    }

    // Xoá danh mục
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->categoryModel->deleteCategory($id);
        }

        header("Location: /webbanhang/Category/");
        exit();
    }
}
?>
