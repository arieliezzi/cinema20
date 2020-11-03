<?php
    namespace DAO;

    use DAO\IShowDAO as IShowDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Show as Show;


    class ShowDAODB implements IShowDAO
    {
        private $connection;
        
        public function Add(Show $show)
        { 
         try{
            $query = "INSERT INTO shows(startDate,endDate,time,duration,id_cinema,id_room,id_movie,isActive) VALUES(:startDate,:endDate,:time,:duration,:id_cinema,:id_room,:id_movie,:isActive)";
           
            $parameters["startDate"] = $show->getStartDate();
            $parameters["endDate"] = $show->getEndDate();
            $parameters["time"] = $show->getTime();
            $parameters["duration"] = $show->getDuration();
            $parameters["id_cinema"]=$show->getCinema();
            $parameters["id_room"]=$show->getRoom();
            $parameters["id_movie"]=$show->getMovie();
            $parameters["isActive"]=$show->getIsActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
            echo "No se pudo agregar la funcion";
            }
        }

        public function GetAll()
        {
            try{
            $showList = array();

            $query = "SELECT * FROM shows";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, array(), QueryType::Query);

                foreach($result as $row)
                    {
                        $show = new Show();
                        $show->setId($row["id_show"]);
                        $show->setStartDate($row["startDate"]);
                        $show->setEndDate($row["endDate"]);
                        $show->setTime($row["time"]);
                        $show->setDuration($row["duration"]);
                        $show->setCinema($row["id_cinema"]);
                        $show->setRoom($row["id_room"]);
                        $show->setMovie($row["id_movie"]);
                        $show->setIsActive($row["isActive"]);

                        array_push($showList, $show);
                    }

           }catch(Exception $exception)
            {
            echo "No se pudo agregar la funcion";
            }

            return $showList;
        }


        public function Remove($id)
        {            
            try{
            $query="UPDATE shows SET (is_active = 0) WHERE (id_show = :id_show)";

            $parameters["id_show"] =  $id;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
           }catch(Exception $exception)
           {
            echo "No se pudo agregar la funcion";
            }
        }

        public function GetById($id)
        {            
            $query = "SELECT * FROM shows WHERE id_show = :id_show";

            $parameters["id_show"] = $id;

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query, $parameters, QueryType::Query);

            foreach($result as $row)
            {
                $show = new Show();
                $show->setId($row["id_show"]);
                $show->setStartDate($row["startDate"]);
                $show->setEndDate($row["endDate"]);
                $show->setTime($row["time"]);
                $show->setDuration($row["duration"]);
                $show->setCinema($row["id_cinema"]);
                $show->setRoom($row["id_room"]);
                $show->setMovie($row["id_movie"]);
                $show->setIsActive($row["isActive"]);
            }

            return $show;
        }

        public function update($updatedShow)
        {  
            try{         
            $query = "UPDATE shows SET startDate= :startDate, endDate= :endDate, time = :time, duration = :duration WHERE (id_show = :id_show)";
            
            $parameters["id_show"] = $updatedShow->getId();
            $parameters["startDate"] = $updatedShow->getStartDate();
            $parameters["endDate"] = $updatedShow->getEndDate();
            $parameters["time"] = $updatedShow->getTime();
            $parameters["duration"] = $updatedShow->getDuration();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
               echo "No se pudo modificar la funcion";
            }
        }

    }
?>