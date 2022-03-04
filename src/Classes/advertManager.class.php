<?php


class AdvertManager {
    private $bdd;
    public function __construct(PDO $bdd) {
        $this->bdd = $bdd;
    }

/**
 * Récupère la liste des categories
 *
 * @return array
 */	
public function getAllCategories() {
	return $this->bdd->query("SELECT id_category AS category_id, value AS category FROM category")->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * Récupère les 15 dernières annonces
 * 
 * @return array
 */
    public function getLastAdverts() {

    //    return $this->bdd->query("SELECT advert.id, advert.title, advert.description,  FROM `advert`, category.value AS category INNER JOIN advert.category_id = category.category_id")->fetchAll(PDO::FETCH_ASSOC);
		return $this->bdd->query("SELECT advert.id_advert, advert.title, advert.description, advert.postcode, advert.city, advert.price, category.value AS category, advert.created_at 
	FROM advert INNER JOIN category WHERE category.id_category = advert.category_id
	ORDER BY advert.created_at DESC LIMIT 15")->fetchAll(PDO::FETCH_ASSOC);


	}

/**
 * Récupère toutes les annonces
 * 
 * @return array
 */
public function getAllAdverts() {

    //    return $this->bdd->query("SELECT advert.id, advert.title, advert.description,  FROM `advert`, category.value AS category INNER JOIN advert.category_id = category.category_id")->fetchAll(PDO::FETCH_ASSOC);
		return $this->bdd->query("SELECT advert.id_advert, advert.title, advert.description, advert.postcode, advert.city, advert.price, category.value AS category, advert.created_at 
	FROM advert INNER JOIN category WHERE category.id_category = advert.category_id")->fetchAll(PDO::FETCH_ASSOC);


	}

 /**
  * Récupère less infos d'une annonce
  *
  * @param integer $id
  * @return Advert $ad
  */
    public function getAdvertById(int $id)
    {

        // Préparation de ma requête SQL
        $requete = $this->bdd->prepare("SELECT * FROM advert WHERE id_advert = :id");
        $requete->bindValue(':id', $id, PDO::PARAM_INT);
        $requete->execute();
        $res = $requete->fetch();
		$ad = new Advert( $res );

        // Retourne les informations trouvées
        return $ad;
    }

/**
 * Undocumented function
 *
 * @param Ad $ad
 * @return int
 */
    public function addAdvertFromObject(Ad $ad)
    {

        // Préparation de la requête
        $add_advert = $this->bdd->prepare("INSERT INTO advert (title, description, postcode, city, price, reservation_message, ) VALUES (:nom, :modele, :annee, :prix, :categorie, :corde)");

        // Passage des valeurs à la requête
        $add_advert->bindValue(':title', $advert->getTitle(), PDO::PARAM_STR);
        $add_advert->bindValue(':description', $advert->getDescription(), PDO::PARAM_STR);
        $add_advert->bindValue(':postcodde', $advert->getPostcode(), PDO::PARAM_INT);
        $add_advert->bindValue(':city', $advert->getCity(), PDO::PARAM_STR);
        $add_ad->bindValue(':price', $advert->getPrice(), PDO::PARAM_INT);
 //       $add_ad->bindValue(':reservation_message', $advert->getReservation_messageAd(), PDO::PARAM_STR);

        // Execute
        $add_ad->execute();

        // Retourne l'ID de l'annonce insérée en BDD
        return $add_advert>lastInsertId();
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
	$add_advert = $this->bdd->prepare("INSERT INTO advert (title, description, postcode, city, price, category_id ) VALUES (:title, :description, :postcode, :city, :price, :id_category)");

	// Passage des valeurs à la requête
	$add_advert->bindValue(':title', $ad['title'], PDO::PARAM_STR);
	$add_advert->bindValue(':description', $ad['description'], PDO::PARAM_STR);
	$add_advert->bindValue(':postcode', $ad['postcode'], PDO::PARAM_STR);
	$add_advert->bindValue(':city', $ad['city'], PDO::PARAM_STR);
	$add_advert->bindValue(':price', $ad['price'], PDO::PARAM_INT);
	$add_advert->bindValue(':id_category', $ad['category'], PDO::PARAM_INT);

	// Execute
	$add_advert->execute();
	//$add_advert->closeCuursor();

	// Retourne l'ID de l'annonce insérée en BDD
	return $this->bdd->lastInsertId();
}

    /**
     * Undocumented function
     *
     * @param Advert $advert
     * @return int
     */
    // Update a  guitar in the bdd and returns the status
    public function updateAdvert(Advert $advert)
    {
        // Préparation de la requète SQL
        $update_advert = bdd->prepare("UPDATE `advert` SET `title` = :title, `description` = :description, `postcode` = :postcode, `city`= :city, `price` = :price, `resservtion_message` = :reservation_message, `categorie` = :categorie WHERE `id_advert` = :id;");
        // On associe les différentes variables aux marqueurs en respectant les types
        $update_advert->bindValue(':title', $advert->getTitle(), PDO::PARAM_STR);
        $update_advert->bindValue(':description', $advert->getDescription(), PDO::PARAM_STR);
        $update_advert->bindValue(':postcodde', $advert->getPostcode(), PDO::PARAM_INT);
        $update_advert->bindValue(':city', $advert->getCity(), PDO::PARAM_STR);
        $update_advert->bindValue(':price', $advert->getPrice(), PDO::PARAM_INT);
        $update_advert->bindValue(':reservation_message', $advert->getReservation(), PDO::PARAM_STR);
	//	$update_advert->bindValue(':idcategory', $idcategory, PDO::PARAM_INT);
        // On execute la requète
        $update_advert->execute();
        $update_advert>closeCursor();
        return($update_advert->rowCount());

    }

/**
 * Supprime uune annonce
 *
 * @param integer $id
 * @return int
 */
    public function deleteAdvertById(int $id)
    {

        $delete_advert = $this->bdd->prepare("DELETE FROM advert WHERE id_advert = :id");
        $delete_advert->bindValue(':id', $id, PDO::PARAM_INT);
        $delete_advert->execute();
		$delete_advert->closeCuursor();

		return $delete_advert->rowCount();
    }
}