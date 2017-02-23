<?php require('data.php'); ?>
<?php require('logic.php'); ?>
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
                <?php foreach ($states as $stateCode => $state): ?>
                <option value="<?=$stateCode?>"><?=$state['name']?></option>
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
    <div class="alert alert-info">
        <div>Subtotal: $<?=number_format($subtotal, 2)?></div>
        <div>Tax:      $<?=number_format($tax, 2)?></div>
        <div>Shipping: $<?=number_format($shippingRate, 2)?></div>
        <div>Total:    $<?=number_format($grandTotal, 2)?></div>
    </div>
    <?php endif; ?>
</div>
