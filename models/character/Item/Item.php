<?php



abstract class Item
{
    protected $item_id;
    protected $name;
    protected $description;
    protected $type_item;

    protected $item_image;

    public function __construct($item_id, $name, $description, $item_image, $type_item)
    {
        $this->item_id = $item_id;
        $this->name = $name;
        $this->description = $description;
        $this->type_item = $type_item;
        $this->item_image = $item_image;
    }



    public function getItemId()
    {
        return $this->item_id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getTypeItem()
    {
        return $this->type_item;
    }

    public function getImage()
    {
        return $this->item_image;
    }

}