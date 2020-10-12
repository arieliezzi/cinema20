<?php

	namespace Models;

	class Movie {

		private $id;
		private $title;
		private $image;
		private $description;
		private $genres;

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setTitle($title) {
			$this->title = $title;
		}

		public function getTitle() {
			return $this->title;
		}

		public function setImage($image) {
			$this->image = $image;
		}

		public function getImage() {
			return $this->image;
		}

		public function setDescription($description) {
			$this->description = $description;
		}

		public function getDescription() {
			return $this->description;
		}

		public function setGenres($genres) {
			$this->genres = $genres;
		}

		public function getGenres() {
			return $this->genres;
		}

		public function genresToString() {
			$genresToString = array_pop($this->genres)->getName();
			foreach($this->genres as $genre) {
				$genresToString = $genresToString.", ".$genre->getName();
			}
			return $genresToString.".";
		}

	}

?>