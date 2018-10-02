<?php
namespace app\models;

class Product extends DataEntity
{
    public $id;
    public $name;
    public $description;
    public $price;

    /**
     * Product constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $price
     */
    public function __construct($id = null, $name = null, $description = null, $price = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }
}