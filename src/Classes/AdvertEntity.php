<?php

class AdvertEntity
{
    private int $id_avert;
    private string $title;
    private string $description;
    private string $postcode;
    protected string $city;
    protected int $price;
    protected string $reservation_message;
    protected int $category_id;
    protected string $created_at;

    public function __construct(array $datas)
    {
        foreach ($datas as $key => $data) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($data);
            }
        }
    }

    public function getId_avert()
    {
        return $this->id_avert;
    }
    public function setId_avert($id_avert)
    {
        $this->id_avert = $id_avert;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
        return $this;
    }

    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getReservation_message()
    {
        return $this->reservation_message;
    }
    public function setReservation_message($reservation_message)
    {
        $this->reservation_message = $reservation_message;
        return $this;
    }

    public function getCategory_id()
    {
        return $this->category_id;
    }
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }
}
