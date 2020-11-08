<?php
    namespace Controllers;
    use DAO\UserDAODB as UserDAODB;
    use Models\User as User;

    class SessionController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }    
        
        public function logout()
        {
            session_start();
            session_destroy();
            require_once(VIEWS_PATH."home.php");
        }

        public function login($email,$pass)
        {
            $this->userDAO = new UserDAODB();
            $loggedUser = $this->userDAO->validUser($email,$pass);  
            
            if($loggedUser!=null) 
            {
                session_start();
                $_SESSION["loggedUser"]=$loggedUser;
                //el usuario de id=1 es el Admin
                if($loggedUser->getId()==1)
                {require_once(VIEWS_PATH."adm-list-show.php");} 
                else
                {require_once(VIEWS_PATH."usr-list-show.php");}
            }
            else
            {
                echo $this->Index("No es valido el usuario o la contraseña ¡!");
            }
        }


        //esta funcion se tendria que llamar en cada view para preguntar el estado de la sesion
        //Si la session tiene guardado un usuario que ya se logueo se seguira mostrando esa view pero si no hay usuario logueado volvera a la view login para que se loguee
      /* public function stateSession()
        {
            session_start();

            if(isset $_SESSION["loggedUser"])
            {
                $loggedUser=$_SESSION["loggedUser"];
                echo $loggedUser->getEmail();
            }
            else
            {
                require_once(VIEWS_PATH."login.php");  
            }
        }*/
        
    }
?>