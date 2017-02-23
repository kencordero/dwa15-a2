<?php

require('Form.php');
require('Tools.php');
require('data.php');

$form = new DWA\Form($_GET);

$errors = [];

if ($form->isSubmitted()) {
    $state = $form->get('state');
    $shippingMethod = $form->get('shippingMethod', null);
    $items = $form->get('items');
    DWA\Tools::dump($items);

    $errors = $form->validate(
        [
            'shippingMethod' => 'required'
        ]
    );

    $total = 0.00;
    if (!$errors) {
        foreach ($items as $item) {
            DWA\Tools::dump($item);
            $total += $inventory[$item]['price'];
        }
        $tax = $total * $state['salesTaxRate'] / 100.0;
        DWA\Tools::dump($total);
        DWA\Tools::dump($tax);
    }
}