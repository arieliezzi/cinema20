<?php
	namespace Controllers;

	use Models\Ticket as Ticket;
	use Models\User as User;
	use DAO\CinemaDAODB as CinemaDAODB;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\MovieDAODB as MovieDAODB;
	use DAO\ShowDAODB as ShowDAODB;
	use DAO\TicketDAODB as TicketDAODB;
	use DAO\MovieGenreDAODB as MovieGenreDAODB;

	class TicketController 
	{

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-ticket.php");
		}

		public function showListView($message = "")
		{
			$this->ticketDAO = new TicketDAODB();		
			$ticketList = $this->constructTicket($this->ticketDAO->getAll());
			require_once(VIEWS_PATH."adm-list-ticket.php");
		}	

		public function showAddView($idShow,$message = "")
		{	
			$this->showDAO = new ShowDAODB();
			$show = $this->constructShow($this->showDAO->getById($idShow));
			$ticketsRemain=20;	

			require_once(VIEWS_PATH."usr-add-ticket.php");
		}	

		public function showConfirmView($idUser,$idShow,$quantity,$message = "")
		{
			$this->ticketDAO = new TicketDAODB();
			$this->showDAO = new ShowDAODB();
			$show = $this->constructShow($this->showDAO->getById($idShow));
			$ticketsRemain=20;
			require_once(VIEWS_PATH."usr-add-ticket-confirm.php");
		}	

		public function showDetailsView($idUser,$idShow,$quantity,$cardType,$cardNumber,$message = "")
		{
			$this->ticketDAO = new TicketDAODB();
			$this->showDAO = new ShowDAODB();
			$show = $this->constructShow($this->showDAO->getById($idShow));

			$user = new User();
			$user->setId(1);

			$ticket = new Ticket();
			$ticket->setUser($user);
			$ticket->setShow($show);
			$ticket->setQuantity($quantity);
			$ticket->setPrice(($ticket->getShow()->getRoom()->getPrice()*$quantity));
			$ticket->setCardType($cardType);
			$ticket->setCardNumber($cardNumber);

			$this->ticketDAO->add($ticket);

			require_once(VIEWS_PATH."usr-add-ticket-details.php");
		}	

		public function add($idUser,$idShow,$cardType,$cardNumber,$quantity) 
		{
			$this->ticketDAO = new TicketDAODB();

			$ticket = new Ticket();
			$ticket->setUser($idUser);
			$ticket->setShow($idShow);
			$ticket->setPrice(($price=0));
			$ticket->setCardType($cardType);
			$ticket->setCardNumber($cardNumber);
			$ticket->setQuantity($quantity);

			$this->ticketDAO->add($ticket);
			$this->showListView("✔️ Compra confirmada ¡Gracias por su compra!");
		}

		public function remove($idTicket) 
		{
			$this->ticketDAO = new TicketDAODB();
			$this->ticketDAO->remove($idTicket);
			$this->showListView("✔️ ¡Ticket eliminado con exito!");
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

		public function constructShow($showList) {
	
			$this->cinemaDAO = new CinemaDAODB();
			$this->roomDAO = new RoomDAODB();
			$this->movieDAO = new MovieDAODB();
			$this->genreDAO = new MovieGenreDAODB();

			if (is_array($showList))
			{
				foreach ($showList as $show)
				{
					$show->setCinema($this->cinemaDAO->getById($show->getCinema()));
					$show->setRoom($this->roomDAO->getById($show->getRoom()));
					$show->setMovie($this->movieDAO->getMovie($show->getMovie()));
					$show->getMovie()->setGenres($this->genreDAO->getGenres($show->getMovie()->getId()));
				}
			} else {
				$showList->setCinema($this->cinemaDAO->getById($showList->getCinema()));
				$showList->setRoom($this->roomDAO->getById($showList->getRoom()));
				$showList->setMovie($this->movieDAO->getMovie($showList->getMovie()));
				$showList->getMovie()->setGenres($this->genreDAO->getGenres($showList->getMovie()->getId()));
			}
	
            return $showList;
		}
	}

?>