<?php
	namespace Models;

	class Show {

		private $id;
		private $cinema;
		private $room;
		private $movie;
		private $startDate;
		private $endDate;

		public function getId()
		{
				return $this->id;
		}

		public function setId($id)
		{
				$this->id = $id;

				return $this;
		}

		public function getCinema()
		{
				return $this->cinema;
		}

		public function setCinema($cinema)
		{
				$this->cinema = $cinema;

				return $this;
		}

		public function getRoom()
		{
				return $this->room;
		}

		public function setRoom($room)
		{
				$this->room = $room;

				return $this;
		}

		public function getMovie()
		{
				return $this->movie;
		}

		public function setMovie($movie)
		{
				$this->movie = $movie;

				return $this;
		}

		public function getStartDate()
		{
				return $this->startDate;
		}

		public function setStartDate($startDate)
		{
				$this->startDate = $startDate;

				return $this;
		}

		public function getEndDate()
		{
				return $this->endDate;
		}

		public function setEndDate($endDate)
		{
				$this->endDate = $endDate;

				return $this;
		}
	}
?>