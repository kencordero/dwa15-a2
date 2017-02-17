<?php require('data.php'); ?>
<!doctype html>
<html lang="en-us">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Assignment 2</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.7/united/bootstrap.min.css">
<link rel="stylesheet" href="/css/styles.css">
<div class="container">
    <form method="POST" action="index.php">
        <fieldset class="checkboxes">
            <legend>What would you like to buy?</legend>
            <?php foreach ($apparel as $item => $price): ?>
            <label class="col-md-1"><input type="checkbox" name="apparel[]" value="<?=$item?>"> <?=$item.' $'.$price?></label>
            <?php endforeach; ?>
        </fieldset>
        <br>
        <fieldset class="dropbox">
            <legend>Which state do you live in?</legend>
            <label for="size">Pick your state:</label>
            <select name="state" id="state">
                <option value="na">Choose</option>
                <?php foreach ($states as $code => $name): ?>
                <option value="<?=$code?>"><?=$name?></option>
                <?php endforeach; ?>
            </select>
        </fieldset>
        <br>
        <fieldset class="radios">
            <legend>Shipping method</legend>
            <?php foreach ($shippingMethods as $method => $pricing): ?>
            <input type="radio" name="shippingMethod" value="<?=$method?>"> <?=$method.' $'.$pricing?><br>
            <?php endforeach; ?>
        </fieldset>
        <br>
        <input class="btn btn-default btn-small" type="submit">
    </form>
</div>
