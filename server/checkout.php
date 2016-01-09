<?php

include 'calc.php';

class Checkout {

    public function validate($data) {
        $response = [
            'grand_total'   => 0,
            'shipping_fee'  => 0,
            'promo_code'    => null
        ];

        $total = 0;
        foreach ($_SESSION['cart'] as $k => $v) {
            $total = $total + $v['linetotal'];
        }

        $s = new ShippingCountry();
        switch ($data['shipping_country']) {
            case ShippingCountry::MALAYSIA:
                $fee = $s->calcMAL($_SESSION['cart'], $total);
            break;
            case ShippingCountry::SINGAPORE:
                $fee = $s->calcSIN($total);
            break;
            case ShippingCountry::BRUNEI:
                $fee = $s->calcBRU($total);
            break;
        }

        $promo_code = (isset($data['promo_code'])) ? $data['promo_code'] : false;
        if ($promo_code) {
            $p = new Promo();
            if ($promo_code == Promo::PROMO_1) {
                $total = $p->promo1($_SESSION['cart']);
            } elseif ($promo_code == Promo::PROMO_2) {
                $total = $p->promo2($_SESSION['cart']);
            } else {
                $response['error'] = true;
                $response['message'] = 'Invalid Promo Code';
                return $response;
            }
        }

        $response['grand_total'] = $total + $fee;
        $response['shipping_fee'] = $fee;
        $response['shipping_country'] = $data['shipping_country'];
        $response['promo_code'] = $promo_code;

        $_SESSION['checkout'] = $response;

        return $response;
    }

    public function summary() {
        $response = [
            'items' => $_SESSION['cart'],
            'total' => $_SESSION['checkout']
        ];
        return $response;
    }
}