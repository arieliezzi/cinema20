<?php
namespace DAO;
use Models\Ticket as Ticket;

    interface ITicketDAO
    {
        function add(Ticket $ticket);
        function remove ($idTicket);
        function getAll();
    }
    
?>