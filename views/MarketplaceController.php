<?php
require_once 'ProductModel.php';

class MarketplaceController {
    private $model;

    public function __construct() {
        $this->model = new ProductModel();
    }

    public function index() {
        // Here you could add logic for filtering or sorting
        return $this->model->getAllProducts();
    }
}