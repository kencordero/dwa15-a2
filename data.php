<?php
// Sales Tax Rates Source: https://en.wikipedia.org/wiki/Sales_taxes_in_the_United_States
$states = json_decode(file_get_contents('data/usStates.json'), true);
$inventory = json_decode(file_get_contents('data/inventory.json'), true);
$shippingMethods = json_decode(file_get_contents('data/shippingMethods.json'), true);

function getPriceByItemId($id) {
    global $inventory;
    return $inventory[$id]['price'];
}

function getSalesTax($stateCode) {
    global $states;
    return $states[$stateCode]['salesTaxRate'] / 100.0;
}


