<?php
	namespace Models;

	use Models\Movie as Movie;
	use Models\Cinema as Cinema;


	class Screening {

		private $id;
		private $movie;
		private $cinema;
		private $date;
		private $time;

		public function setId($id) {
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function setMovie(Movie $movie) {
			$this->movie = $movie;
		}

		public function getMovie() {
			return $this->movie;
		}

		public function setCinema(Cinema $cinema) {
			$this->cinema = $cinema;
		}

		public function getCinema() {
			return $this->cinema;
		}

		public function setDate($date) {
			$this->date = $date;
		}

		public function getDate() {
			return $this->date;
		}

		public function setTime($time) {
			$this->time = $time;
		}

		public function getTime() {
			return $this->time;
		}

		public function getInfo() {
			return $this->getCinema()->getName()." - ".$this->getDate()." - ".$this->getTime();
		}

	}

?>