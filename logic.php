<?php
require('Form.php');

$form = new DWA\Form($_POST);
$errors = [];

$stateCode = $form->get('state');
$shippingMethodId = $form->get('shippingMethod', -1);
$itemIds = $form->get('items');

if ($form->isSubmitted()) {
    $errors = $form->validate(
        [
            'shippingMethod' => 'required',
            'state' => 'required'
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