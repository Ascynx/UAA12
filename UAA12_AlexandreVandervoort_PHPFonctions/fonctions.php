<?php


function algorithmeEuclide2($nbr1, $nbr2) {
    $reste = $nbr2;
    while( $reste != 0 ) {
        $reste = $nbr1 % $nbr2;
        $nbr1 = $nbr2;
        $nbr2 = $reste;
    }

    return $nbr1;
}

function fonctionSpeciale($nombreDepart, $nombreElementsSouhaite) {
    $suite = "" . $nombreDepart . " ";
    for ($i = 0; $i < $nombreElementsSouhaite; $i++) {
        if ($nombreDepart < 5 && $nombreDepart % 3 != 0) {
            $nombreDepart *= 5;
        } else {
            if ($nombreDepart > 5 && $nombreDepart < 10) {
                $nombreDepart /= 6;
            } else {
                $nombreDepart **= 2;
            }
        }

        $suite .= $nombreDepart . " ";
    }

    return $suite;
}


?>