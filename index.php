<?php
    require('data.php');
    require('logic.php');
?>
<!doctype html>
<html lang="en-us">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>One Stop Shop</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css">
<link rel="stylesheet" href="/css/styles.css">
<div class="container">
    <form method="GET" action="index.php">
        <fieldset class="checkboxes">
            <legend>What would you like to buy?</legend>
            <div class="row">
            <?php foreach ($inventory as $itemName => $item): ?>
                <img class="itemPhoto col-md-2" src="<?=$item['imageUrl']?>" alt="<?=$itemName?>">
            <?php endforeach; ?>
            </div>
            <div class="row">
            <?php foreach ($inventory as $itemName => $item): ?>
                <label class="col-md-2"><input type="checkbox" name="items[]" value="<?=$item['id']?>"> <?=$itemName.' $'.number_format($item['price'], 2)?></label>
            <?php endforeach; ?>
            </div>
        </fieldset>
        <br>
        <fieldset class="dropbox">
            <legend>Which state do you live in?</legend>
            <label for="state">Pick your state:</label>
            <select name="state" id="state" required>
                <option value="">Choose</option>
                <?php foreach ($states as $code => $state): ?>
                <option value="<?=$code?>"><?=$state['name']?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <br>
        <fieldset class="radios">
            <legend>Shipping method</legend>
            <?php foreach ($shippingMethods as $methodId => $method): ?>
            <input type="radio" name="shippingMethod" value="<?=$methodId?>" required> <?=$method['description'].' $'.number_format($method['price'], 2)?><br>
            <?php endforeach; ?>
        </fieldset>
        <br>
        <input class="btn btn-default btn-small" type="submit">
    </form>
    <?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?=$error?>
            <?php endforeach; ?>

    </div>
    <?php elseif ($form->isSubmitted()): ?>
    <div class="alert alert-in">
        <div class="row">
            <div class="col-md-6 text-right">Subtotal:</div>
            <div class="col-md-1 text-right">$<?=number_format($subtotal, 2)?></div>
        </div>
        <div class="row">
            <div class="col-md-6 text-right">Tax Rate (<?=$stateCode?>):</div>
            <div class="col-md-1 text-right"><em><?=$states[$stateCode]['salesTaxRate']?>%</em></div>
        </div>
        <div class="row">
            <div class="col-md-6 text-right">Tax:</div>
            <div class="col-md-1 text-right">$<?=number_format($tax, 2)?></div>
        </div>
        <div class="row">
            <div class="col-md-6 text-right">Shipping:</div>
            <div class="col-md-1 text-right">$<?=number_format($shippingRate, 2)?></div>
        </div>
        <div class="row">
            <div class="col-md-6 text-right">Total:</div>
            <div class="col-md-1 text-right"><strong>$<?=number_format($grandTotal, 2)?></strong></div>
        </div>
    </div>
    <?php endif; ?>
</div>
