<?php
class ShippingCountry {
    const MALAYSIA  = 1;    // Free shipping for [QTY > 2] or [TOTAL > RM150]. Shipping Fee == RM10
    const SINGAPORE = 2;    // Min purchase is RM300 for Free Shipping. Shipping Fee == RM20
    const BRUNEI    = 3;    // Min purchase is RM300 for Free Shipping. Shipping Fee == RM25

    // Refactoring is necessary!
    public function calcMAL($items, $total) {
        $fee = 10;
        $qty = 0;

        foreach ($items as $k => $v) {
            $qty = $qty + $v['qty'];
        }

        if ($total >= 150 || $qty >= 2) {
            $fee = 0;
        }

        return $fee;
    }

    public function calcSIN($total) {
        $fee = 20;
        if ($total >= 300) {
            $fee = 0;
        }

        return $fee;
    }

    public function calcBRU($total) {
        $fee = 25;
        if ($total >= 300) {
            $fee = 0;
        }

        return $fee;
    }
}

class Promo {
    const PROMO_1   = 'OFF5PC';     // 5% Discount with min purchase of 2 quantities of any product
    const PROMO_2   = 'GIVEME15';   // RM15 Discount with min purchase of RM100

    public function promo1($items) {
        $value = 0;
        $satisfied = false;
        foreach ($items as $k => $v) {
            $value = $value + $v['linetotal'];
            // Promo condition check
            if ($v['qty'] >= 2) {
                $satisfied = true;
            }
        }
        if ($satisfied) {
            $value = round($value * ((100-5) / 100),2);
        } else {
            // Should let the users know condition is not met.
        }
        return $value;
    }

    public function promo2($items) {
        $value = 0;
        foreach ($items as $k => $v) {
            $value = $value + $v['linetotal'];
        }
        // Promo condition check
        if ($value >= 100) {
            $value = $value - 15;
        } else {
            // Should let the users know condition is not met.
        }
        return $value;
    }
}