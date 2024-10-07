<?php

    class User{
        public $id;
        public $username;
        public $password;
    
        public function __construct($id=null,$username=null,$password=null){
            $this->id=$id;
            $this->username=$username;
            $this->password=$password;
        }

        public static function loginUser(User $user, mysqli $conn){//konekcija sa sql bazom
            $query="SELECT *
                    FROM user
                    WHERE username='$user->username' AND password='$user->password'" ;
                    //iz objekta $user uzima username i poredi sa username kolonom iz baze, isto i sa lozinkom
           // return true;
           return $conn->query($query);//nad konekcijom odradi query metodu koja ce da primi query string koji smo definisali u $query
           //vraca jedan ceo red u tabeli a ne samo true ili false
           //query je metoda koja pripada $conn i ona vraca sve kolone pronadjenog korisnika( tj jedan ceo red), 
           //u suprotnom vraca false ako taj user nije nadjen
        }
    }

?>