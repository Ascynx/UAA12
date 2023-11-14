<?php
    function devinerNombre($value, &$message) {
        $num = 150;
        $message = null;
        $gagne = false;

        if ($value > $num) {
            $message = "Votre chiffre est trop élevé";
        } else {
            if ($value < $num) {
                $message = "Votre chiffre est trop bas";
            } else {
                $message = "Bravo, vous avez deviné le chiffre ".$num;
                $gagne = true;
            }
        }

        return $gagne;
    }
?>