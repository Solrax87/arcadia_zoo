<?php
namespace App\Models;

use MongoDB\Client;

class Animal
{
    public string $id;
    public string $nom;
    public string $espece;
    public string $imagePath;
    public string $habitatNom;
    public string $vetoNom;

    public function __construct(array $data)
    {
        // MongoDB _id est un objet, on le convertit en chaîne
        $this->id          = (string)($data['_id'] ?? $data['id']);
        $this->nom         = $data['nom'] ?? '';
        $this->espece      = $data['espece'] ?? '';
        $this->imagePath   = $data['image_path'] ?? '';
        $this->habitatNom  = $data['habitat_nom'] ?? '';
        $this->vetoNom     = $data['veterinaire_nom'] ?? '';
    }

    /**
     * Récupère tous les animaux (limités)
     */
    public static function all(int $limit = 5): array
    {
        // Connexion MongoDB (docker-compose service "mongo")
        $client = new Client("mongodb://mongo:27017");
        $db     = $client->a_zoo;
        $col    = $db->animaux;

        // Lookup sur habitats et utilisateurs
        $pipeline = [
            ['$limit' => $limit],
            [
              '$lookup' => [
                'from'         => 'habitats',
                'localField'   => 'habitat_id',
                'foreignField' => 'id',
                'as'           => 'habitat_docs'
              ]
            ],
            [
              '$lookup' => [
                'from'         => 'utilisateurs',
                'localField'   => 'veterinaire_id',
                'foreignField' => 'id',
                'as'           => 'veto_docs'
              ]
            ],
            // Pour n'avoir qu'un seul doc dans chaque tableau
            ['$addFields' => [
              'habitat_nom'        => ['$arrayElemAt' => ['$habitat_docs.nom', 0]],
              'veterinaire_nom'    => ['$arrayElemAt' => ['$veto_docs.nom', 0]],
            ]],
            // On ne garde plus les tableaux inutiles
            ['$project' => [
              'habitat_docs'     => 0,
              'veto_docs'        => 0
            ]]
        ];

        $cursor = $col->aggregate($pipeline);
        $list   = [];
        foreach ($cursor as $doc) {
            $list[] = new Animal((array)$doc);
        }
        return $list;
    }
}
