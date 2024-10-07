
<?php

require "dbBroker.php";// ako zovemo pre usera.php, kao da pre svega ovoga stoji sadrzaj Brokera
require "model/user.php";

//sesija cuva id korisnika da bi na svakoj stanici zbog super glob bile zapamcene te vrednosti id, znamo da je ulogovan

session_start();//pokretanje sesije

if(isset($_POST["username"])&& isset($_POST["password"])){//postoji li input polje user i pass
    $uname=$_POST["username"];
    $pass=$_POST["password"];
    
    $korisnik= new User(1,$uname,$pass);
    //$conn=new mysqli(); kreiranje konekcije //nema potrebe za ovim jer sad koristimo Brokera
   // $korisnik->loginUser($korisnik,$conn);//I nacin
    $odgovor=User::loginUser($korisnik,$conn); //II nacin , poziv staticke metode neke klase, sa ::
    if($odgovor->num_rows==1){//kad se doda Broker ne moze odg==true nego ako postoji taj user u bazi sa tim onda nastavi tj broj redova=1
        echo `
        <script>
        console.log("Uspesna prijava");
        </script>
        
        `;
        $_SESSION["user-id"]=$korisnik->$id;//sesijska prom user-id, ako je nadjen user kroz funck loginUser pamti ga?
        //sacuvamo id tog korisnika koji je nadjen
        header("Location: home.php");//nakon post zahteva prebacivanje na home.php
        exit(); //terminacija skripte da se dalje ne izvrsava ovaj post zahtev
    }else{
        echo `
        <script>
        console.log("Neuspesna prijava");
        </script>
        
        `;
    }

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>FON: Zakazivanje kolokvijuma</title>

</head>
<body>
    <div class="login-form">
        <div class="main-div">
            <form method="POST" action="#">
                <div class="container">
                    <label class="username">Korisnicko ime</label>
                    <input type="text" name="username" class="form-control"  required>
                    <br>
                    <label for="password">Lozinka</label>
                    <input type="password" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                </div>

            </form>
        </div>

        
    </div>
</body>
</html>