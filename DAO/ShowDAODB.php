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
            $query = "INSERT INTO shows(startDate,endDate,startTime,endTime,duration,id_cinema,id_room,id_movie,isActive) VALUES(:startDate,:endDate,:startTime,:endTime,:duration,:id_cinema,:id_room,:id_movie,:isActive)";
           
            $parameters["startDate"] = $show->getStartDate();
            $parameters["endDate"] = $show->getEndDate();
            $parameters["startTime"] = $show->getStartTime();
            $parameters["endTime"] = $show->getEndTime();
            $parameters["duration"] = $show->getDuration();
            $parameters["id_cinema"]=$show->getCinema()->getId();
            $parameters["id_room"]=$show->getRoom()->getId();
            $parameters["id_movie"]=$show->getMovie()->getId();
            $parameters["isActive"]=$show->getIsActive();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
            echo "No se pudo agregar la funcion";
            }
        }

        public function Remove($id)
        {            
            try{
            $query="UPDATE shows SET isActive = :isActive WHERE id_show = :id_show";

            $parameters["id_show"] =  $id;
            $parameters["isActive"]=0;

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
           }catch(Exception $exception)
           {
            echo "No se pudo agregar la funcion";
            }
        }

        public function update($updatedShow)
        {  
            try{         
            $query = "UPDATE shows SET startDate= :startDate, endDate= :endDate, startTime = :startTime,endTime = :endTime, duration = :duration WHERE (id_show = :id_show)";
            
            $parameters["id_show"] = $updatedShow->getId();
            $parameters["startDate"] = $updatedShow->getStartDate();
            $parameters["endDate"] = $updatedShow->getEndDate();
            $parameters["startTime"] = $updatedShow->getStartTime();
            $parameters["endTime"] = $updatedShow->getEndTime();
            $parameters["duration"] = $updatedShow->getDuration();

            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            }catch(Exception $exception)
            {
               echo "No se pudo modificar la funcion";
            }
        }

        //valida si una funcion ya se encuentra en otros cines en las mismas fechas
        public function validateUniqueShow($startDate,$id_movie)
        {
            $showList= array();
            try{
                $query="SELECT *FROM shows WHERE shows.id_movie=:id_movie AND shows.endDate>= :startDate AND shows.isActive=1";

                $parameters["id_movie"]=$id_movie;
                $parameters["startDate"]=$startDate;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);


                foreach($result as $row)
                 {
                  $show = new Show();
                  $show->setId($row["id_show"]);
                  $show->setStartDate($row["startDate"]);
                  $show->setEndDate($row["endDate"]);
                  $show->setStartTime($row["startTime"]);
                  $show->setEndTime($row["endTime"]);
                  $show->setDuration($row["duration"]);
                  $show->setCinema($row["id_cinema"]);
                  $show->setRoom($row["id_room"]);
                  $show->setMovie($row["id_movie"]);
                  $show->setIsActive($row["isActive"]);

                  array_push($showList,$show);
                 }

            }catch(Exception $exception)
             {
             echo "No se pudo validar la funcion";
             }

         return $showList;
        }

        public function GetAll()
        {
            $query = "SELECT * FROM shows INNER JOIN movies ON shows.id_movie=movies.id_movie WHERE shows.isActive = 1 ORDER BY movies.title ASC";
            $showList=$this->getShows($query);
            return $showList;
        }

        public function GetAllFilterByCurrentDay()
        {
            $query = "SELECT *FROM shows WHERE CURDATE() between shows.startDate AND shows.endDate AND shows.isActive = 1";
            $showList=$this->getShows($query);
            return $showList;
        }

        public function GetAllOrderByNewest()
        {
            $query = "SELECT *FROM shows WHERE CURDATE() between shows.startDate AND shows.endDate AND shows.isActive = 1 ORDER BY startDate ASC";
            $showList=$this->getShows($query);
            return $showList;
        }

        public function GetAllOrderByOldest()
        {
            $query = "SELECT *FROM shows WHERE CURDATE() between shows.startDate AND shows.endDate AND shows.isActive = 1 ORDER BY startDate DESC";
            $showList=$this->getShows($query);
            return $showList;
        }

        public function GetAllByIdGenre($idGenre)
        {
            $query = "SELECT * FROM shows INNER JOIN movies ON shows.id_movie = movies.id_movie INNER JOIN movieGenre ON movies.id_movie=movieGenre.id_movie WHERE movieGenre.id_genre=:id_genre AND shows.isActive=1 AND CURDATE() between shows.startDate AND shows.endDate";
            $parameters["id_genre"]=$idGenre;
            $showList=$this->getShows($query,$parameters);
            return $showList;
        }

        public function GetById($idShow)
        {            
            $query = "SELECT * FROM shows WHERE id_show = :id_show";
            $parameters["id_show"]=$idShow;
           
            try {
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);

                foreach ($result as $row) {

                    $show = new Show();
                    $show->setId($row["id_show"]);
                    $show->setStartDate($row["startDate"]);
                    $show->setEndDate($row["endDate"]);
                    $show->setStartTime($row["startTime"]);
                    $show->setEndTime($row["endTime"]);
                    $show->setDuration($row["duration"]);
                    $show->setCinema($row["id_cinema"]);
                    $show->setRoom($row["id_room"]);
                    $show->setMovie($row["id_movie"]);
                    $show->setIsActive($row["isActive"]);
                }
                return $show;
            } catch (Exception $exception) {
                echo "No se pudo traer el show";
            }

        }

        public function getShows($query, $parameters = array())
        {
            try {
                $this->connection = Connection::GetInstance();

                $showList= array();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);

                foreach ($result as $row) {

                    $show = new Show();
                    $show->setId($row["id_show"]);
                    $show->setStartDate($row["startDate"]);
                    $show->setEndDate($row["endDate"]);
                    $show->setStartTime($row["startTime"]);
                    $show->setEndTime($row["endTime"]);
                    $show->setDuration($row["duration"]);
                    $show->setCinema($row["id_cinema"]);
                    $show->setRoom($row["id_room"]);
                    $show->setMovie($row["id_movie"]);
                    $show->setIsActive($row["isActive"]);

                    array_push($showList, $show);
                }
                return $showList;
            } catch (Exception $exception) {
                echo "No se pudo traer el show";
            }

  
        }

        public function getShowsByTime($startT,$finalT,$startD,$finalD)
        {
            $showList= array();
            try{
                $query="SELECT *FROM shows INNER JOIN rooms ON shows.id_room=rooms.id_room WHERE shows.isActive=:isActive AND :endTime between shows.startTime AND shows.endTime AND :endDate between shows.startDate AND shows.endDate";

                $parameters["endTime"]=$finalT;
                $parameters["endDate"]=$finalD;
                $parameters["isActive"]=1;
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);


                foreach($result as $row)
                 {
                  $show = new Show();
                  $show->setId($row["id_show"]);
                  $show->setStartDate($row["startDate"]);
                  $show->setEndDate($row["endDate"]);
                  $show->setStartTime($row["startTime"]);
                  $show->setEndTime($row["endTime"]);
                  $show->setDuration($row["duration"]);
                  $show->setCinema($row["id_cinema"]);
                  $show->setRoom($row["id_room"]);
                  $show->setMovie($row["id_movie"]);
                  $show->setIsActive($row["isActive"]);

                  array_push($showList,$show);
                 }

            }catch(Exception $exception)
             {
             echo "No se pudo validar la funcion";
             }

         return $showList;
        }



    }
?>