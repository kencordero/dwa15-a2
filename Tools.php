<?php

namespace DWA;

class Tools {
    /**
     * Pretty print given value to screen
     */
    public static function dump($mixed = null) {
        echo '<pre>';
        var_dump($mixed);
        echo '</pre>';
    }

    # Alias for above method
    public static function d($mixed = null) {
        self::dump($mixed);
    }

    /**
     * Pretty print given value to screen, then die
     */
    public static function suicidalDump($mixed = null) {
        self::dump($mixed);
        die();
    }

    # Alias for above method
    public static function sd($mixed = null) {
        self::suicidalDump($mixed);
    }
} # end of class
