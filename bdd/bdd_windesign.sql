-- Supprimer les tables existantes pour éviter les conflits
DROP TABLE IF EXISTS Chapter_Treasure, Link, SHOP, Level, Inventory, Hero, Monster, NPC, Encounter, Loot, Treasure, consumable, weapon, armor, Item, Chapter, User, Class;

-- Table des classes de personnages
CREATE TABLE Class (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(50) NOT NULL,
    class_description VARCHAR(255),
    base_pv INT NOT NULL,
    base_mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    max_items INT NOT NULL
);

-- Table des utilisateurs
CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des chapitres
CREATE TABLE Chapter (
    chapter_id INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(255) NOT NULL,
    image VARCHAR(255)
);

-- Table des objets
CREATE TABLE Item (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    object_id INT NOT NULL,
    item_name VARCHAR(50) NOT NULL,
    item_description VARCHAR(255),
    item_type VARCHAR(50) NOT NULL -- Remplacement de ENUM
);

-- Table des armures
CREATE TABLE armor (
    armor_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT UNIQUE NOT NULL,
    defense INT,
    initiative INT,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des armes
CREATE TABLE weapon (
    weapon_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT UNIQUE NOT NULL,
    damage INT,
    defense INT,
    mana INT,
    isTwoHanded TINYINT(1), -- Remplacement de BOOLEAN
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des consommables
CREATE TABLE consumable (
    consumable_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT UNIQUE NOT NULL,
    health INT,
    mana INT,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des trésors
CREATE TABLE Treasure (
    treasure_id INT AUTO_INCREMENT PRIMARY KEY,
    loot_name VARCHAR(50) NOT NULL,
    loot_description VARCHAR(255),
    item_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des loots
CREATE TABLE Loot (
    loot_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des rencontres
CREATE TABLE Encounter (
    encounter_id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    entity_type VARCHAR(50) NOT NULL, -- Remplacement de ENUM
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id) ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table des NPC
CREATE TABLE NPC (
    npc_id INT AUTO_INCREMENT PRIMARY KEY,
    encounter_id INT NOT NULL UNIQUE,
    npc_name VARCHAR(50) NOT NULL,
    npc_description VARCHAR(255),
    FOREIGN KEY (encounter_id) REFERENCES Encounter(encounter_id)
);

-- Table des monstres
CREATE TABLE Monster (
    monster_id INT AUTO_INCREMENT PRIMARY KEY,
    encounter_id INT NOT NULL UNIQUE,
    monster_name VARCHAR(50) NOT NULL,
    pv INT NOT NULL,
    mana INT,
    initiative INT NOT NULL,
    strength INT NOT NULL,
    attack VARCHAR(255),
    loot_id INT,
    xp INT NOT NULL,
    FOREIGN KEY (loot_id) REFERENCES Loot(loot_id),
    FOREIGN KEY (encounter_id) REFERENCES Encounter(encounter_id)
);

-- Table des héros
CREATE TABLE Hero (
    hero_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    chapter_id INT,
    hero_name VARCHAR(50) NOT NULL,
    class_id INT,
    image VARCHAR(255),
    biography VARCHAR(255),
    pv INT NOT NULL,
    mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    armor VARCHAR(50),
    primary_weapon VARCHAR(50),
    secondary_weapon VARCHAR(50),
    spell_list VARCHAR(255),
    xp INT NOT NULL,
    money INT,
    current_level INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES User(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id),
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
);

-- Table des inventaires
CREATE TABLE Inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    quantity INT,
    hero_id INT NOT NULL,
    item_id INT NOT NULL,
    FOREIGN KEY (hero_id) REFERENCES Hero(hero_id),
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des niveaux
CREATE TABLE Level (
    level_id INT AUTO_INCREMENT PRIMARY KEY,
    class_id INT NOT NULL,
    level INT NOT NULL,
    required_xp INT NOT NULL,
    pv_bonus INT NOT NULL,
    mana_bonus INT NOT NULL,
    strength_bonus INT NOT NULL,
    initiative_bonus INT NOT NULL,
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
);

-- Table des boutiques
CREATE TABLE SHOP (
    npc_id INT NOT NULL,
    item_id INT NOT NULL,
    price INT,
    PRIMARY KEY (npc_id, item_id),
    FOREIGN KEY (npc_id) REFERENCES NPC(npc_id),
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

-- Table des liens entre chapitres
CREATE TABLE Link (
    link_id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    next_chapter_id INT NOT NULL,
    link_description VARCHAR(255),
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id),
    FOREIGN KEY (next_chapter_id) REFERENCES Chapter(chapter_id)
);

-- Table des trésors par chapitre
CREATE TABLE Chapter_Treasure (
    ch_treasure_id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    treasure_id INT NOT NULL,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id),
    FOREIGN KEY (treasure_id) REFERENCES Treasure(treasure_id)
);
