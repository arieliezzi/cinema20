<?php
	namespace Controllers;

	use DAO\CinemaDAODB as CinemaDAODB;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\MovieDAODB as MovieDAODB;
	use DAO\ShowDAODB as ShowDAODB;
	use DAO\TicketDAODB as TicketDAODB;
	use DAO\GenreDAODB as GenreDAODB;

	class RevenueController 
	{
		public function showRevenueView($message="")
		{
			$this->cinemaDAO = new CinemaDAODB();
			$this->movieDAO = new MovieDAODB();
			$this->genreDAO = new GenreDAODB();

			$cinemaList = $this->cinemaDAO->getAll();
			$movieList = $this->movieDAO->getAll();
			$genreList = $this->genreDAO->getAll();
			require_once(VIEWS_PATH."adm-list-revenue.php");
		}

		public function showRevenueByCinema($idCinema,$message="")
		{
			$this->cinemaDAO = new CinemaDAODB();
			$this->ticketDAO = new TicketDAODB();
			$cinema = $this->cinemaDAO->getById($idCinema);
			$result = $this->ticketDAO->getRevenueByCinema($idCinema);
			require_once(VIEWS_PATH."adm-list-revenue-by-cinema.php");
		}

		public function showRevenueByMovie($idMovie,$message="")
		{
			$this->movieDAO = new MovieDAODB();
			$this->ticketDAO = new TicketDAODB();
			$movie = $this->movieDAO->getMovie($idMovie);
			$result = $this->ticketDAO->getRevenueByMovie($idMovie);
			require_once(VIEWS_PATH."adm-list-revenue-by-movie.php");
		}

		public function showRevenueByGenre($idGenre,$message="")
		{
			$this->movieDAO = new MovieDAODB();
			$this->genreDAO = new GenreDAODB();
			$this->ticketDAO = new TicketDAODB();
			$genre = $this->genreDAO->getGenre($idGenre);
			$movieList = $this->movieDAO->getByGenre($idGenre);
			$result = $this->ticketDAO->getRevenueByGenre($idGenre);
			require_once(VIEWS_PATH."adm-list-revenue-by-genre.php");
		}

		public function showRevenueByDate($startDate,$endDate,$message="")
		{
			if(!($endDate>=$startDate))
						$this->showRevenueView("❌ ¡La fecha de inicio debe ser inferior a la final!");
						else
							{
								$this->ticketDAO = new TicketDAODB();
								$result = $this->ticketDAO->getRevenueByDate($startDate,$endDate);
								require_once(VIEWS_PATH."adm-list-revenue-by-date.php");
							}
		}

		public function constructTicket ($ticketList)
		{
			$this->cinemaDAO = new CinemaDAODB();
			$this->roomDAO = new RoomDAODB();
			$this->movieDAO = new MovieDAODB();
			$this->showDAO = new ShowDAODB();

			if (is_array($ticketList))
			{
				foreach ($ticketList as $ticket)
				{
					//Aca se crea todo el objeto y dependencias del Show
					$ticket->setShow($this->showDAO->getById($ticket->getShow()));
					$ticket->getShow()->setCinema($this->cinemaDAO->getById($ticket->getCinema()));
					$ticket->getShow()->setRoom($this->roomDAO->getById($ticket->getRoom()));
					$ticket->getShow()->setMovie($this->movieDAO->getMovie($ticket->getMovie()));
					//Aca se crea todo el objeto y dependencias del User
				}
			} else {
				//Aca se crea todo el objeto y dependencias del Show
				$ticketList->setShow($this->showDAO->getById($ticketList->getShow()));
				$ticketList->getShow()->setCinema($this->cinemaDAO->getById($ticketList->getShow()->getCinema()));
				$ticketList->getShow()->setRoom($this->roomDAO->getById($ticketList->getShow()->getRoom()));
				$ticketList->getShow()->setMovie($this->movieDAO->getMovie($ticketList->getShow()->getMovie()));
				//Aca se crea todo el objeto y dependencias del User
			}

			return $ticketList;
		}
	}
?>