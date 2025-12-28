<?php

class ProductModel {

    private $products = [
        ['id' => 1, 'name' => 'Rice', 'price' => 24, 'quantity' => 100, 'category' => 'Grains'],
        ['id' => 2, 'name' => 'Tomatoes', 'price' => 20, 'quantity' => 50, 'category' => 'Vegetables'],
        ['id' => 3, 'name' => 'Wheat', 'price' => 22, 'quantity' => 80, 'category' => 'Grains'],
        ['id' => 4, 'name' => 'Cucumber', 'price' => 18, 'quantity' => 60, 'category' => 'Vegetables']
    ];

    public function getAllProducts() {

        return $this->products;
    }
}