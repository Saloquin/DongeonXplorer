<?php
class Inventaire {
    private $hero_id;
    private $items = []; // Liste des items associée à l'inventaire

    
    public function __construct($hero_id) {
        $this->hero_id = $hero_id;
        $this->loadItems();
    }

    
    private function loadItems() {
        $tab = array();
        $query = "SELECT item_id FROM inventaire WHERE hero_id = " . $this->hero_id;
        lireBase(connexionDb(), $query, $tab);

        // Charger les items en fonction de leur type
        foreach ($tab as $row) {
            $item_id = $row['item_id'];
            // Récupérer le type de l'item
            $item_type_query = "SELECT item_type FROM item WHERE item_id = " . $item_id;
            $item_type_tab = array();
            lireBase(connexionDb(), $item_type_query, $item_type_tab);

            $item_type = $item_type_tab[0]['item_type'];

            // Instancier l'objet approprié en fonction du type
            switch ($item_type) {
                case 'Weapon':
                    $item = new Weapon($item_id);
                    break;
                case 'Armor':
                    $item = new Armor($item_id);
                    break;
                case 'Consumable':
                    $item = new Consumable($item_id);
                    break;
                case 'Loot':
                    $item = new Loot($item_id);
                    break;
                default:
                    throw new Exception("Item type unknown");
            }

            // Ajouter l'item à l'inventaire
            $this->items[] = $item;
        }
    }

    // Getter pour obtenir la liste des items
    public function getItems() {
        return $this->items;
    }

    // Ajouter un item à l'inventaire
    public function addItem($item_id) {
        // Vérifier si l'item est déjà dans l'inventaire (optionnel)
        foreach ($this->items as $item) {
            if ($item->getItemId() == $item_id) {
                return; // L'item est déjà dans l'inventaire
            }
        }
        // Si l'item n'est pas déjà dans l'inventaire, l'ajouter
        $item_type_query = "SELECT item_type FROM item WHERE item_id = " . $item_id;
            $item_type_tab = array();
            lireBase(connexionDb(), $item_type_query, $item_type_tab);

            $item_type = $item_type_tab[0]['item_type'];

            // Instancier l'objet approprié en fonction du type
            switch ($item_type) {
                case 'Weapon':
                    $new_item = new Weapon($item_id);
                    break;
                case 'Armor':
                    $new_item = new Armor($item_id);
                    break;
                case 'Consumable':
                    $new_item = new Consumable($item_id);
                    break;
                case 'Loot':
                    $new_item = new Loot($item_id);
                    break;
                default:
                    throw new Exception("Item type unknown");
            }
        $this->items[] = $new_item;

        // Insérer dans la base de données (ajouter une entrée dans la table inventaire)
        $query = "INSERT INTO inventaire (hero_id, item_id) VALUES (" . $this->hero_id . ", " . $item_id . ")";
        lireBase(connexionDb(), $query); // Cette fonction devrait exécuter la requête dans la base de données
    }

    // Supprimer un item de l'inventaire
    public function removeItem($item_id) {
        // Retirer l'item de la liste
        foreach ($this->items as $key => $item) {
            if ($item->getItemId() == $item_id) {
                unset($this->items[$key]);
                break;
            }
        }

        // Supprimer l'entrée correspondante de la base de données
        $query = "DELETE FROM inventaire WHERE hero_id = " . $this->hero_id . " AND item_id = " . $item_id;
        lireBase(connexionDb(), $query); // Exécuter la suppression dans la base de données
    }
}
