<?php
namespace App\Controllers;

use App\Models\Animal;

class AnimalController
{
    /**
     * Prépare les données et appelle la vue
     */
    public function index(): void
    {
        // On récupère les animaux
        $animaux = Animal::all(4);

        // On rend la vue (ton incluTemplate peut accepter un 2eme paramètre)
        incluTemplate('animal_card', ['animaux' => $animaux]);
    }
}
