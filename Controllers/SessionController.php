<?php
    namespace Controllers;
    use DAO\UserDAODB as UserDAODB;
    use Controllers\ShowController as ShowController;
    use Models\User as User;

    class SessionController
    {
        public function Index($message = "")
        {
            require_once(VIEWS_PATH."home.php");
        }    

        public function showRegisterView($message = "")
        {
            require_once(VIEWS_PATH."register.php");
        }   
        
        public function logout()
        {
            if(isset($_SESSION["loggedUser"]))
            session_destroy();
            $this->Index();
        }

        public function register($name,$email,$pass)
        { 
            $this->userDAO = new UserDAODB();

            if (!(empty($this->userDAO->validEmail($email))))
            {
                $this->showRegisterView("❌ ¡El email ya tiene una cuenta asignada!");
            } else 
                {
                    if (strlen($pass)>5)
                    {
                        $this->showRegisterView("❌ ¡La contraseña tiene mas de 5 caracteres!");
                    } else
                        {
                            $user = new User();
                            $user->setName($name);
                            $user->setEmail($email);
                            $user->setPass($pass);
                            $user->setIsActive(1);
                            $this->userDAO->add($user);
                            $this->Index("✔️ ¡Cuenta creada con exito!");
                        }
                }
        }

        public function login($email,$pass)
        {
            $this->userDAO = new UserDAODB();
            $this->showController = new ShowController();
            $loggedUser = $this->userDAO->validUser($email,$pass);  
            
            if(!(empty($loggedUser))) 
            {
                $_SESSION["loggedUser"]=$loggedUser->getId();
                $_SESSION["userName"]=$loggedUser->getName();
                if($_SESSION["loggedUser"]==1) //El usuario de ID=1 es el ADM
                $this->showController->showListView("👋 ¡Bienvenido/a ".$_SESSION["userName"]."!");
                else
                $this->showController->showUserListView("👋 ¡Bienvenido/a ".$_SESSION["userName"]."!");
            }
            else
            {
                $this->Index("❌ ¡Usuario o contraseña incorrectos!");
            }
        }
    }
?>