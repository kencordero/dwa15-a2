<?php
require('Form.php');

$form = new DWA\Form($_GET);
$errors = [];

if ($form->isSubmitted()) {
    $stateCode = $form->get('state');
    $shippingMethodId = $form->get('shippingMethod', null);
    $itemIds = $form->get('items');
    $errors = $form->validate(
        [
            'shippingMethod' => 'required'
        ]
    );

    $subtotal = $tax = $shippingRate = $grandTotal = 0.00;
    if (!$errors) {
        if (!empty($itemIds)) {
            foreach ($itemIds as $itemId) {
                $subtotal += getPriceByItemId($itemId);
            }
            $tax = $subtotal * getSalesTax($stateCode);
            $shippingRate = $shippingMethods[$shippingMethodId]['price'];
            $grandTotal = $subtotal + $tax + $shippingRate;
        }
    }
}