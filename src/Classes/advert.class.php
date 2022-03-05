 <?php

 class Advert {
	 private $id_advert;
	 private $title;
	 private $description;
	 private $postcode;
	 private $reservation_message;
	 private $category;
//	 private $category_id;
	 private $created_at;
 
	 public function __construct(array $data) {
        foreach($data as $key => $value) {
            $method = 'set'.ucfirst($key).'Ad';

            if ( method_exists($this, $method) ) {
                $this->$method($value);
            }
        } 
    }	

	/**
	 * GetIdAdvert
	 *
	 * @return int
	 */
	public function getIdAd() {
		return $this->id_advert;
	}

	/**
	 * SetIdAdvert
	 *
	 * @param integer $id
	 * @return object Advert
	 */
	public function setIdAd(int $id) {
        $this->id_advert = $id;
        return $this;
    }

	/**
	 * GetTitleAdvert
	 *
	 * @return string
	 */
	public function getTitleAd() {
		return $this->title;
	}

	/**
	 * SetIdAdvert
	 *
	 * @param integer $int
	 * @return object Advert
	 */
	public function setTitleAd(string $str) {
        $this->title = $str;
        return $this;
    }

	/**
	 * GetDescriptionAdvert
	 *
	 * @return string
	 */
	public function getDescriptionAd() {
		return $this->description;
	}

	/**
	 * SetDescriptionAdvert
	 *
	 * @param string $str
	 * @return object Advert
	 */
	public function setDescriptionAd(string $str) {
        $this->description = $str;
        return $this;
    }

	/**
	 * GetPostCodeAdvert
	 *
	 * @return int
	 */
	public function getPostcodeAd() {
		return $this->postcode;
	}

	/**
	 * SetPostCodeAdvert
	 *
	 * @param integer $int
	 * @return object Advert
	 */
	public function setPostcodeAd(int $int) {
        $this->title = $int;
        return $this;
    }

	/**
	 * GetCityAdvert
	 *
	 * @return string
	 */
	public function getCityAd() {
		return $this->city;
	}

	/**
	 * SetCityAdvert
	 *
	 * @param integer $str
	 * @return object Advert
	 */
	public function setCityAd(string $str) {
        $this->city = $str;
        return $this;
    }

	/**
	 * GetPriceAdvert
	 *
	 * @return int
	 */
	public function getPriceAd() {
		return $this->price;
	}

	/**
	 * SetPriceAdvert
	 *
	 * @param integer $id
	 * @return object Advert
	 */
	public function setPriceAd(int $price) {
        $this->price = $price;
        return $this;
    }

	/**
	 * GetReservation_messsageAdvert
	 *
	 * @return string
	 */
	public function getReservation_messageAd() {
		return $this->reservation_message;
	}

	/**
	 * SetReservation_messageAdvert
	 *
	 * @param integer $str
	 * @return object Advert
	 */
	public function setReservation_messageAd() {
        $this->reservation_message = 'disponible';
        return $this;
    }

	/**
	 * GetCategoryAdvert
	 *
	 * @return string
	 */
	public function getCategoryAd() {
		return $this->category_id;
	}

	/**
	 * SetCityAdvert
	 *
	 * @param string $str
	 * @return object Advert
	 */
	public function setCategoryAd(string $str) {
        $this->category = $str;
        return $this;
    }

	/**
	 * GetCreated_atAdvert
	 *
	 * @return datetime
	 */
	public function getCreated_atAd() {
		return $this->created_at;
	}

	/**
	 * SetCreated_atAdvert
	 *
	 * @param string $datetime
	 * @return object Advert			
	 */
	public function setCreated_atAd(string $datetime) {
        $this->created_at = $datetime;
        return $this;
    }

	

}


