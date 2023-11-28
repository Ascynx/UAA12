<?php
    //Age (18-95)
    //Temps permis (années)
    //Accidents depuis début permis
    //ancienneté chez la boite.

    function CalculeContrat($age, $permisAge, $accidents, $anciennete) {
        $contrat = "";

        if ($age < 25 && $permisAge < 2) {
            if ($accidents == 0) {
                $contrat = "Rouge";
            } else {
                $contrat = "Refus";
            }
        } else if (($age < 25 && $permisAge >= 2) || ($age >= 25 && $permisAge < 2)) {
            if ($accidents == 0) {
                $contrat = "Orange";
            } else if ($accidents == 1) {
                $contrat = "Rouge";
            } else {
                $contrat = "Refus";
            }
        } else {
            if ($accidents == 0) {
                $contrat = "Vert";
            } else if ($accidents == 1) {
                $contrat = "Orange";
            } else if ($accidents == 2) {
                $contrat = "Rouge";
            } else {
                $contrat = "Refus";
            }
        }

        if ($anciennete > 5) {
            if ($contrat == "Rouge") {
                $contrat = "Orange";
            } else if ($contrat == "Orange") {
                $contrat = "Vert";
            } else if ($contrat == "Vert") {
                $contrat = "Bleu";
            }
        }

        return $contrat;
    }
?>