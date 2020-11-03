<?php

	namespace Models;

	class Movie {

		private $id;
		private $title;
		private $image;
		private $description;
		private $genres;
		private $poster;
		private $is_active;

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

		public function setPoster($poster) {
			$this->poster = $poster;
		}

		public function getPoster() {
			return $this->poster;
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
			$i=1;
			foreach($this->genres as $genre) {
				if ($i<3)
				{$genresToString = $genresToString.", ".$genre->getName();
				$i=$i+1;}
				
			}
			return $genresToString.".";
		}


		public function getIs_active()
		{
				return $this->is_active;
		}

		public function setIs_active($is_active)
		{
				$this->is_active = $is_active;

				return $this;
		}
	}

?>