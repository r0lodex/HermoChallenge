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

    public function delete($productid) {
        foreach ($_SESSION['cart'] as $k => &$v) {
            if ($productid === $v['id']) {
                array_splice($_SESSION['cart'], $k, 1);
            }
        }
        return true;
    }

    public function update($productid, $action) {
        foreach ($_SESSION['cart'] as &$v) {
            if ($productid === $v['id']) {
                if ($action == 'add') {
                    $v['qty']++;
                } else {
                    $v['qty'] = ($v['qty'] > 1) ? $v['qty'] - 1 : $v['qty'];
                }
                // Recalculate linetotal
                $v['linetotal'] = $v['qty'] * $v['selling_price'];
            }
        }
        return true;
    }
}