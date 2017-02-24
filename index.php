<?php
    require('data.php');
    require('logic.php');
?>
<!doctype html>
<html lang="en-us">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>One Stop Shop</title>
<!-- image source: http://paulferrett.com/fontawesome-favicon/ -->
<link rel="shortcut icon" type="'image/x-icon" href="/images/favicon-shopping-cart.ico">

<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css">
<div class="container">
    <form method="post" action="index.php">
        <fieldset class="checkboxes">
            <legend>What would you like to buy?<span class="text-danger">*</span><span class="text-info small"> Please choose at least one.</span></legend>
            <div class="row">
            <?php foreach ($inventory as $item): ?>
                <img class="itemPhoto col-md-2" src="<?=$item['imageUrl']?>" alt="<?=$item['name']?>" title="<?=$item['name']?>">
            <?php endforeach; ?>
            </div>
            <div class="row">
            <?php foreach ($inventory as $itemId => $item): ?>
                <label class="col-md-2"><input type="checkbox" name="items[]" value="<?=$itemId?>"> <?=$item['name'].' $'.number_format($item['price'], 2)?></label>
            <?php endforeach; ?>
            </div>
        </fieldset>
        <br>
        <fieldset class="dropdown">
            <legend>Which state do you live in?<span class="text-danger">*</span></legend>
            <label for="state">Pick your state:</label>
            <select name="state" id="state" required>
                <option value="">Choose</option>
                <?php foreach ($states as $code => $state): ?>
                <option value="<?=$code?>"<?php if ($code == $stateCode) echo ' selected'; ?>> <?=$state['name']?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <br>
        <fieldset class="radios">
            <legend>Shipping method<span class="text-danger">*</span></legend>
            <?php foreach ($shippingMethods as $methodId => $method): ?>
            <input type="radio" name="shippingMethod" value="<?=$methodId?>" required <?php if ($methodId == $shippingMethodId) echo 'checked'; ?> > <?=$method['description'].' $'.number_format($method['price'], 2)?><br>
            <?php endforeach; ?>
        </fieldset>
        <br>
        <input class="btn btn-primary btn-lg" type="submit" value="Submit">
    </form>
    <?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($errors as $error): ?>
            <li><?=$error?>
            <?php endforeach; ?>

    </div>
    <?php elseif ($form->isSubmitted()): ?>
    <hr>
    <div class="alert alert-info">
        <h1 class="text-center">Order Summary</h1>
        <div class="row">
            <div class="col-md-6 text-right">Subtotal:</div>
            <div class="col-md-1 text-right">$<?=number_format($subtotal, 2)?></div>
        </div>
        <div class="row">
            <div class="col-md-6 text-right"><i>Tax Rate (<?=$stateCode?>):</i></div>
            <div class="col-md-1 text-right"><i><?=$states[$stateCode]['salesTaxRate']?>%</i></div>
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
            <div class="col-md-6 text-right"><b>Total:</b></div>
            <div class="col-md-1 text-right"><b>$<?=number_format($grandTotal, 2)?></b></div>
        </div>
    </div>
    <?php endif; ?>
</div>
