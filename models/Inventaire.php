<?php

require_once("/DongeonXplorer/bdd/Database.php");
class Inventaire
{
    private $hero_id;
    private $items = []; // Liste des items associée à l'inventaire

    public function __construct($hero_id)
    {
        $this->hero_id = $hero_id;
        $this->loadItems();
    }

    public function checkItem($item_id)
    {
        $item_type_query = "SELECT item_type FROM item WHERE item_id = " . $item_id;
        $item_type_tab=lireBase(connexionDb(), $item_type_query );

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
        return $new_item;
    }

    private function loadItems()
    {
        
        $query = "SELECT item_id, quantity FROM inventaire WHERE hero_id = " . $this->hero_id;
        $tab = lireBase(connexionDb(), $query);

        // Charger les items en fonction de leur type et leur quantité
        foreach ($tab as $row) {
            $item_id = $row['item_id'];
            $quantity = $row['quantity'];

            // Vérifier le type de l'item
            $item = $this->checkItem($item_id);

            // Ajouter l'item à l'inventaire en fonction de la quantité
            $this->items[] = ['item' => $item, 'quantity' => $quantity];
        }
    }

    // Getter pour obtenir la liste des items
    public function getItems()
    {
        return $this->items;
    }
    
    public function getItem($item_id)
    {
        foreach ($this->items as $item_entry) {
            if ($item_entry['item']->getItemId() == $item_id) {
                return $item_entry['item'];  // Retourner l'objet de l'item
            }
        }
        return null; // Si l'item n'est pas trouvé, retourner null
    }

    // Ajouter un item à l'inventaire
    public function addItem($item_id)
    {   

        if(lireBase(connexionDb(), "select charge_max from hero join class using (class_id) where hero_id = " . $this->hero_id)[0]['charge_max'] = this.getTotalItems()+1){
            return;
        }
        // Vérifier si l'item est déjà dans l'inventaire
        foreach ($this->items as &$item_entry) {
            if ($item_entry['item']->getItemId() == $item_id) {
                // L'item est déjà dans l'inventaire, on incrémente sa quantité
                $item_entry['quantity']++;
                // Mettre à jour dans la base de données
                $query = "UPDATE inventaire SET quantity = quantity + 1 WHERE hero_id = " . $this->hero_id . " AND item_id = " . $item_id;
                modifieBase(connexionDb(), $query);
                return;
            }
        }

        // Si l'item n'est pas dans l'inventaire, l'ajouter avec une quantité de 1
        $new_item = $this->checkItem($item_id);
        $this->items[] = ['item' => $new_item, 'quantity' => 1];

        // Insérer dans la base de données
        $query = "INSERT INTO inventaire (hero_id, item_id, quantity) VALUES (" . $this->hero_id . ", " . $item_id . ", 1)";
        modifieBase(connexionDb(), $query);
    }

    // Supprimer un item de l'inventaire
    public function removeItem($item_id)
    {
        // Retirer l'item ou diminuer sa quantité
        foreach ($this->items as &$item_entry) {
            if ($item_entry['item']->getItemId() == $item_id) {
                if ($item_entry['quantity'] > 1) {
                    // Si l'item a plusieurs exemplaires, réduire la quantité
                    $item_entry['quantity']--;
                    // Mettre à jour dans la base de données
                    $query = "UPDATE inventaire SET quantity = quantity - 1 WHERE hero_id = " . $this->hero_id . " AND item_id = " . $item_id;
                    modifieBase(connexionDb(), $query);
                } else {
                    // Si l'item n'a qu'un exemplaire, on le retire
                    unset($item_entry);
                    // Supprimer de la base de données
                    $query = "DELETE FROM inventaire WHERE hero_id = " . $this->hero_id . " AND item_id = " . $item_id;
                    modifieBase(connexionDb(), $query);
                }
                break;
            }
        }
    }
    function getTotalItems(){
        foreach ($this->items as $item_entry) {
            $total += $item_entry['quantity'];
        }
        return $total;
    }
}
