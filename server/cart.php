<?php

class Cart {
    public function add($product) {
        $newItem = true;
        if (isset($_SESSION['cart'])) {
            // Checks for duplicate IDs and add to qty
            foreach ($_SESSION['cart'] as &$v) {
                if ($v['id'] == $product['id']) {
                    $v['qty']++;
                    $newItem = false;
                    $v['linetotal'] = $v['qty'] * $v['selling_price'];
                }
            }
        }

        if ($newItem) {
            // Set new fields (QTY & LINETOTAL)
            $product['qty'] = 1;
            $product['linetotal'] = $product['qty'] * $product['selling_price'];
            $_SESSION['cart'][] = $product;
        }

        return $_SESSION['cart'];
    }
}