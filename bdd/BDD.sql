CREATE TABLE IF NOT EXISTS Class (
    class_id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(50) NOT NULL,
    class_description TEXT,
    base_pv INT NOT NULL,
    base_mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    max_items INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Chapter (
    chapter_id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    image VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS Item (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    object_id INT NOT NULL,
    item_name VARCHAR(50) NOT NULL,
    item_description TEXT,
    item_type ENUM('weapon', 'armor', 'consumable') NOT NULL
);

CREATE TABLE IF NOT EXISTS armor (
    armor_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT UNIQUE NOT NULL,
    defense INT,
    initiative INT,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS weapon (
    weapon_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT UNIQUE NOT NULL,
    damage INT,
    defense INT,
    mana INT,
    isTwoHanded BOOLEAN,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS consumable (
    consumable_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT UNIQUE NOT NULL,
    health INT,
    mana INT,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS Treasure (
    treasure_id INT AUTO_INCREMENT PRIMARY KEY,
    loot_name VARCHAR(50) NOT NULL,
    loot_description TEXT,
    item_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS Loot (
    loot_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT,
    quantity INT NOT NULL,
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS Encounter (
    encounter_id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    entity_type ENUM('monster', 'npc') NOT NULL,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS NPC (
    npc_id INT AUTO_INCREMENT PRIMARY KEY,
    encounter_id INT NOT NULL UNIQUE,
    npc_name VARCHAR(50) NOT NULL,
    npc_description TEXT,
    FOREIGN KEY (encounter_id) REFERENCES Encounter(encounter_id)
);

CREATE TABLE IF NOT EXISTS Monster (
    monster_id INT AUTO_INCREMENT PRIMARY KEY,
    encounter_id INT NOT NULL UNIQUE,
    monster_name VARCHAR(50) NOT NULL,
    pv INT NOT NULL,
    mana INT,
    initiative INT NOT NULL,
    strength INT NOT NULL,
    attack TEXT,
    loot_id INT,
    xp INT NOT NULL,
    FOREIGN KEY (loot_id) REFERENCES Loot(loot_id),
    FOREIGN KEY (encounter_id) REFERENCES Encounter(encounter_id)
);

CREATE TABLE IF NOT EXISTS Hero (
    hero_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    chapter_id INT,
    hero_name VARCHAR(50) NOT NULL,
    class_id INT,
    image VARCHAR(255),
    biography TEXT,
    pv INT NOT NULL,
    mana INT NOT NULL,
    strength INT NOT NULL,
    initiative INT NOT NULL,
    armor VARCHAR(50),
    primary_weapon VARCHAR(50),
    secondary_weapon VARCHAR(50),
    spell_list TEXT,
    xp INT NOT NULL,
    money INT,
    current_level INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES Users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id),
    FOREIGN KEY (class_id) REFERENCES Class(class_id)
);

CREATE TABLE IF NOT EXISTS Inventory (
    inventory_id INT AUTO_INCREMENT PRIMARY KEY,
    quantity INT,
    hero_id INT NOT NULL,
    item_id INT NOT NULL,
    FOREIGN KEY (hero_id) REFERENCES Hero(hero_id),
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS Level (
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

CREATE TABLE IF NOT EXISTS SHOP (
    npc_id INT NOT NULL,
    item_id INT NOT NULL,
    price INT,
    PRIMARY KEY (npc_id, item_id),
    FOREIGN KEY (npc_id) REFERENCES NPC(npc_id),
    FOREIGN KEY (item_id) REFERENCES Item(item_id)
);

CREATE TABLE IF NOT EXISTS Link (
    link_id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    next_chapter_id INT NOT NULL,
    link_description TEXT,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id),
    FOREIGN KEY (next_chapter_id) REFERENCES Chapter(chapter_id)
);

CREATE TABLE IF NOT EXISTS Chapter_Treasure (
    ch_treasure_id INT AUTO_INCREMENT PRIMARY KEY,
    chapter_id INT NOT NULL,
    treasure_id INT NOT NULL,
    FOREIGN KEY (chapter_id) REFERENCES Chapter(chapter_id),
    FOREIGN KEY (treasure_id) REFERENCES Treasure(treasure_id)
);
