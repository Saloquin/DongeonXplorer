<?php
class Combat {
    public function tourCombat($attaquant, $defenseur) {
        // Calcul de l'initiative
        $initiativeAttaquant = rand(1, 6) + $attaquant->initiative;
        $initiativeDefenseur = rand(1, 6) + $defenseur->initiative;

        // Qui attaque en premier ?
        if ($initiativeAttaquant >= $initiativeDefenseur) {
            $attaquant->attack();
        } else {
            $defenseur->attack();
        }

        // Boucle jusqu'à ce qu'un personnage meure
        while ($attaquant->base_health > 0 && $defenseur->base_health > 0) {
            //echo "Combat en cours...\n";
        }

        return $attaquant->base_health > 0 ? "L'attaquant a gagné !" : "Le défenseur a gagné !";
    }
}
