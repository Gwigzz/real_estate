 <?php
	/*
 * Fonctions pour mon application "Real_estate"
 */


	/**
	 * Fonctions pour créer le répertoire de stockage des images si il n'existe pas déjà
	 *
	 * @param $path str
	 * @return bool
	 */
	function checkdir($path)
	{
		if (!is_dir($path)) {
			mkdir($path, 0777, true);
		}
		if (file_exists($path)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Vérifie si les champs d'un formulaire sont remplis
	 *
	 * @param $post array
	 * @param $champs array
	 * @return bool
	 */
	function isNotEmpty($post, $champs)
	{
		foreach ($champs as $champ) {
			if (!isset($post[$champ]) || empty($post[$champ])) {
				return false;
			}
		}

		return true;
	}

	/** 
	 * Teste qu'un entier est dans un intervalle de valeurs $max est égal ou spérieur à $min non testé
	 * 
	 * @param $value int
	 * @param $min int
	 * @param $max int
	 * @return boolean
	 */

	function checkIntInRange($value, $min, $max)
	{
		if (($value >= $min) && ($value <= $max)) {
			return true;
		} else {
			return false;
		}
	}

	/** 
	 * Teste que la longuueur d'une chaîne est dans un intervalle de valeurs
	 * 
	 * @param $value int
	 * @param $min int
	 * @param $max int
	 * @return boolean
	 */

	function checkStrInRange($str, $min, $max)
	{
		if (is_string($str) && (strlen($str) >= $min) && (strlen($str) <= $max)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Vérifie les caractéristiques d'une image le poids du fichier est fixé à 8 Mo
	 *
	 * @param $file
	 * @return bool|string|string[]
	 */
	function verifPicture($file)
	{
		$taille_max = 8 * 1024 * 1024; // 8Mo
		$type_image = [
			'jpg' => 'image/jpeg',
			'jpeg' => 'image/jpeg',
			'png' => 'image/png',
			'gif' => 'image/gif'
		];

		// $file['name'] => $_FILES['image']['name']
		$extension = pathinfo($file['name'], PATHINFO_EXTENSION);
		if (array_key_exists(strtolower($extension), $type_image)) {

			// Vérifie le type MIME du fichier
			if (in_array($file['type'], $type_image)) {

				// Vérifie le poids de l'image
				if ($file['size'] <= $taille_max) {
					return $extension;
				} else {
					return false;
				}
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Upload d'image
	 *
	 * @param $file
	 * @param $nom
	 * @param $id
	 * @param $extension
	 * @return string
	 */
	function uploadImage($file, $id, $extension)
	{
		// Formatte le nom de l'image de façon a commencer par logement
		$slug = 'logement';

		// Formatte le nouveau nom
		// mon-titre-magazine_12.png
		$nouveau_nom = $slug . '_' . $id . '.' . $extension;

		// Upload l'image avec le nouveau nom
		move_uploaded_file($file['tmp_name'], 'images/' . $nouveau_nom);

		return $nouveau_nom;
	}
