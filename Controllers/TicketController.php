<?php
	namespace Controllers;

	use Models\Ticket as Ticket;
	use Models\User as User;
	use Controllers\ShowController as ShowController;
	use DAO\CinemaDAODB as CinemaDAODB;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\MovieDAODB as MovieDAODB;
	use DAO\ShowDAODB as ShowDAODB;
	use DAO\TicketDAODB as TicketDAODB;

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
			$this->showController = new ShowController;
			$show = $this->showController->constructShow($this->showDAO->getById($idShow));
			$ticketsRemain=20;	
			$dateList=$this->datesByShow($show);

			require_once(VIEWS_PATH."usr-add-ticket.php");
		}	

		public function showConfirmView($idUser,$idShow,$date,$quantity,$message = "")
		{
			$this->showDAO = new ShowDAODB();
			$this->ticketDAO = new TicketDAODB();	
			$this->showController = new ShowController;
			$show = $this->showController->constructShow($this->showDAO->getById($idShow));
			$ticketsRemain=$show->getRoom()->getCapacity() - $this->ticketDAO->ticketRemain($idShow,$date);
			if ($show->getRoom()->getCapacity()< ($this->ticketDAO->ticketRemain($idShow,$date) + $quantity))
			$this->showAddView($idShow,"❌ ¡No hay stock para esa cantidad de tickets, el maximo disponible es: ".$ticketsRemain."!");
			  else
			  {
			$discount=1;

			if ($this->checkDiscount($date,$quantity))
			{
				$discount=0.75;
			}	
		
			require_once(VIEWS_PATH."usr-add-ticket-confirm.php");}
		}	

		public function showDetailsView($idShow,$date,$quantity,$discount,$cardType,$cardNumber,$message = "")
		{
			$this->ticketDAO = new TicketDAODB();
			$this->showDAO = new ShowDAODB();
			$this->showController = new ShowController;
			$show = $this->showController->constructShow($this->showDAO->getById($idShow));
		
			$user = new User();
			$user->setId($_SESSION["loggedUser"]);

			$ticket = new Ticket();
			$ticket->setUser($user);
			$ticket->setShow($show);
			$ticket->setDate($date);
			$ticket->setQuantity($quantity);
			$ticket->setPrice(($ticket->getShow()->getRoom()->getPrice()*$quantity*$discount));
			$ticket->setCardType($cardType);
			$ticket->setCardNumber($cardNumber);

			$ticketList=$this->add($ticket);

			$message="✔️ Compra confirmada ¡Gracias por su compra!";

			require_once(VIEWS_PATH."usr-add-ticket-details.php");
		}	


		public function add($ticket) 
		{
			$this->ticketDAO = new TicketDAODB();

			$ticketList=array();

			for ($i=1; $i<=$ticket->getQuantity(); $i++)
			{
				$unitaryTicket = new Ticket();
				$unitaryTicket->setUser($ticket->getUser());
				$unitaryTicket->setShow($ticket->getShow());
				$unitaryTicket->setPrice($ticket->getPrice()/$ticket->getQuantity());
				$unitaryTicket->setCardType($ticket->getCardType());
				$unitaryTicket->setCardNumber($ticket->getCardNumber());
				$unitaryTicket->setQuantity(1);
				$unitaryTicket->setDate($ticket->getDate());
	
				$this->ticketDAO->add($unitaryTicket);

				array_push($ticketList, $unitaryTicket);
			}

			return $ticketList;
		}

		public function datesByShow($show) 
		{
			$dateList=array();

			for ($date=$show->getStartDate();$date<=$show->getEndDate();$date=date('Y-m-d', strtotime($date . ' +1 day')))
			{
				if ($date>=date("Y-m-d"))
				{
					array_push($dateList, $date);
				}
			}

			return $dateList;
		}	

		public function checkDiscount($date,$quantity) 
		{
			$result=false;
			if (((date("l",strtotime($date))=="Tuesday") || (date("l",strtotime($date))=="Wednesday")) && $quantity>=2)
			{
					$result=true;
			}
			return $result;
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
	}

?>