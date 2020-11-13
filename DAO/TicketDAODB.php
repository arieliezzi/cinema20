<?php
    namespace DAO;

    use DAO\ITicketDAO as ITicketDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Ticket as Ticket;


    class TicketDAODB implements ITicketDAO
    {
        public function add(Ticket $ticket)
        { 
            try {
                $query = "INSERT INTO tickets(id_user, id_show, date, quantity, price, card_type, card_number) VALUES (:id_user,:id_show,:date,:quantity,:price,:card_type,:card_number)";

                $parameters["id_user"] = $ticket->getUser()->getId();
                $parameters["id_show"] = $ticket->getShow()->getId();
                $parameters["date"] = $ticket->getDate();
                $parameters["quantity"] = $ticket->getQuantity();
                $parameters["price"] = $ticket->getPrice();
                $parameters["card_type"] = $ticket->getCardType();
                $parameters["card_number"] = $ticket->getCardNumber();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
                } catch (Exception $exception) 
                    {
                        echo "No se pudo agregar el ticket";
                    }
        }

        public function remove($idTicket) 
        {  
            try {          
                $query = "DELETE FROM tickets WHERE id_ticket = :id_ticket";

                $parameters["id_ticket"] =  $idTicket;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
                } catch(Exception $exception)
                    {
                        echo "No se pudo eliminar el ticket";
                    }
        }

        
        public function getAll()
        {
            $query = "SELECT * FROM tickets";

            return $this->getTickets($query);
        }
        

        public function getTickets($query, $parameters = array())
        {
            try {
                $ticketList = array();

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);

                foreach($result as $row) {

                    $ticket = new Ticket();
                    $ticket->setId($row["id_ticket"]);
                    $ticket->setUser($row["id_user"]);
                    $ticket->setShow($row["id_show"]);
                    $ticket->setDate($row["date"]);
                    $ticket->setQuantity($row["quantity"]);
                    $ticket->setPrice($row["price"]);
                    $ticket->setCardType($row["card_type"]);
                    $ticket->setCardNumber($row["card_number"]);

                    array_push($ticketList, $ticket);
                }

                return $ticketList;

            } catch(Exception $exception) 
                {
                    echo "No se pudo traer el/los ticket/s";
                }
        }

        public function ticketRemain($showID,$date)
         {
          $query=" SELECT SUM(quantity) FROM tickets WHERE tickets.id_show=:id_show AND tickets.date=:date";
          $parameters["id_show"] = $showID;
          $parameters["date"] =$date;
        
          $this->connection = Connection::GetInstance();
          $placesSold = $this->connection->Execute($query, $parameters, QueryType::Query);

          foreach($placesSold as $places)
           {
            $result=$places["SUM(quantity)"];
            }
        
         return $result;
         }


    }
?>