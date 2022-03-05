<?php

require_once './db/DataBase.php';

class AdvertManager extends DataBase
{

    /** 
     * Table "advert" 
     */
    protected string $advert = 'advert';

    /** 
     * Table "category"
     */
    protected string $category = 'category';

    /**
     * Add Advert
     * 
     * @return int
     */
    public function addAdvert(AdvertEntity $advertEntity): int
    {
        $addAdvert = $this->getPDO()->prepare(
            "INSERT INTO {$this->advert} (title, description, postcode, city, price, category_id, created_at)
                VALUE(:title, :description, :postcode, :city, :price, :category_id, :created_at)"
        );

        $addAdvert->bindValue(':title', $advertEntity->getTitle(), PDO::PARAM_STR);
        $addAdvert->bindValue(':description', $advertEntity->getDescription(), PDO::PARAM_STR);
        $addAdvert->bindValue(':postcode', $advertEntity->getPostcode(), PDO::PARAM_STR);
        $addAdvert->bindValue(':city', $advertEntity->getCity(), PDO::PARAM_STR);
        $addAdvert->bindValue(':price', $advertEntity->getPrice(), PDO::PARAM_INT);
        $addAdvert->bindValue(':category_id', $advertEntity->getCategory_id(), PDO::PARAM_INT);
        $addAdvert->bindValue(':created_at', $advertEntity->getCreated_at(), PDO::PARAM_STR);

        $addAdvert->execute();

        return $addAdvert->rowCount();
    }

    /** 
     * Show Article
     * @return array|false
     */
    public function showAllArticle()
    {
        return $this->getPDO()->query(
            "SELECT * FROM {$this->advert} 
                INNER JOIN {$this->category}
                    WHERE {$this->advert}.category_id = {$this->category}.id_category"
        )->fetchAll();
    }

    /** 
     * Show Category List
     * @return array|false
     */
    public function showCategoryList()
    {
        return $this->getPDO()->query(
            "SELECT * FROM {$this->category}"
        )->fetchAll();
    }

    /**
     * Récupère les 15 dernières annonces
     * @return array
     */
    public function getLastAdverts(): array
    {
        return $this->getPDO()->query("SELECT advert.id_advert, advert.title, advert.description, advert.postcode, advert.city, advert.price, category.value AS category, DATE_FORMAT(advert.created_at, '%d/%m/%Y') AS created_at	  
	FROM advert INNER JOIN category WHERE category.id_category = advert.category_id
	ORDER BY advert.created_at DESC LIMIT 15")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère toutes les annonces
     * @return array
     */
    public function getAllAdverts(): array
    {
        return $this->getPDO()->query("SELECT advert.id_advert, advert.title, advert.description, advert.postcode, advert.city, advert.price, category.value AS category, DATE_FORMAT(advert.created_at, '%d/%m/%Y') AS created_at 
	FROM advert INNER JOIN category WHERE category.id_category = advert.category_id")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère less infos d'une annonce
     * @param integer $id
     */
    public function getAdvertById(int $id): mixed
    {
        $requete = $this->getPDO()->prepare(
            "SELECT *, category.value AS category, DATE_FORMAT(created_at, '%d/%m/%Y') AS created_at FROM advert 
            INNER JOIN category WHERE category.id_category = advert.category_id AND advert.id_advert = :id"
        );
        $requete->bindValue(':id', intval($id), PDO::PARAM_INT);
        $requete->execute();

        return $requete->fetch();
    }

    /**
     * Undocumented function
     *
     * @param array $ad
     * @return int
     */
    public function addAdvertFromArray(array $ad)
    {
        // Préparation de la requête
        $add_advert = $this->getPDO()->prepare(
            "INSERT INTO advert (title, description, postcode, city, price, category_id ) 
            VALUES (:title, :description, :postcode, :city, :price, :id_category)"
        );

        // Passage des valeurs à la requête
        $add_advert->bindValue(':title', $ad['title'], PDO::PARAM_STR);
        $add_advert->bindValue(':description', $ad['description'], PDO::PARAM_STR);
        $add_advert->bindValue(':postcode', $ad['postcode'], PDO::PARAM_STR);
        $add_advert->bindValue(':city', $ad['city'], PDO::PARAM_STR);
        $add_advert->bindValue(':price', $ad['price'], PDO::PARAM_INT);
        $add_advert->bindValue(':id_category', $ad['category'], PDO::PARAM_INT);

        $add_advert->execute();
        //$add_advert->closeCuursor();

        // Retourne l'ID de l'annonce insérée en BDD
        return $add_advert->rowCount();
    }

    /**
     * Undocumented function
     *
     * @param array 
     * @return int
     */
    // Update a  guitar in the bdd and returns the status
    public function updateAdvertFromArray(array $advert)
    {
        // Préparation de la requète SQL
        $update_advert = $this->getPDO()->prepare("UPDATE `advert` SET `title` = :title, `description` = :description, `postcode` = :postcode, `city`= :city, `price` = :price, `reservation_message` = :reservation_message, `category_id` = :category_id WHERE `id_advert` = :id;");
        // On associe les différentes variables aux marqueurs en respectant les types
        $update_advert->bindValue(':id', $advert['id'], PDO::PARAM_INT);
        $update_advert->bindValue(':title', $advert['title'], PDO::PARAM_STR);
        $update_advert->bindValue(':description', $advert['description'], PDO::PARAM_STR);
        $update_advert->bindValue(':postcode', $advert['postcode'], PDO::PARAM_INT);
        $update_advert->bindValue(':city', $advert['city'], PDO::PARAM_STR);
        $update_advert->bindValue(':price', $advert['price'], PDO::PARAM_INT);
        $update_advert->bindValue(':reservation_message', $advert['reservation_message'], PDO::PARAM_STR);
        $update_advert->bindValue(':category_id', $advert['category'], PDO::PARAM_INT);
        // On execute la requète
        $update_advert->execute();
        $update_advert->closeCursor();
        return ($update_advert->rowCount());
    }

    /**
     * Supprime uune annonce
     *
     * @param integer $id
     * @return int
     */
    public function deleteAdvertById(int $id)
    {

        $delete_advert = $this->getPDO()->prepare("DELETE FROM advert WHERE id_advert = :id");
        $delete_advert->bindValue(':id', $id, PDO::PARAM_INT);
        $delete_advert->execute();
        $delete_advert->closeCursor();

        return $delete_advert->rowCount();
    }
}
