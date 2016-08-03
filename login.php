<?php
include_once 'init.inc.php';
include('header.inc.php');

if(logged_in() || is_unactivated() || is_blocked()) header ('Location: index.php');

?>
<div class="central">
    <div class="reg_log_top">
        <h2>Logovanje</h2>
    </div>

    <div class="reg_log_text">
        <p>Ulogujte se kako biste mogli da porucujete.<br><br>
        Hvala Vam što koristite naš servis za online naručivanje hrane. Prijatno!<br><br>
        Vaš M-Burger!</p>
    </div>  

    <div class="reg_log_form">  

        <form name='loginform' action='login.php' method="POST">
            Korisničko ime:<br>
            <input type="text" name="username"><br>
            Lozinka:<br>
            <input type="password" name="password"><br><br>
           
            <input type="submit" name="submit" value="Uloguj se" class="dugme"><br><br>
        </form>
    </div>    
</div>

<?php

$regex1 = "/^[a-zA-Z]+$/";
$regex2 = "/^[A-Za-z0-9._-]+\@[a-zA-Z0-9]+.[a-zA-Z]{2,3}$/";
$regex3 = "/^[a-zA-Z0-9]+$/";
$regex4 = "/^[0-9]+$/";
$regex5 = "/^[A-Za-z0-9._-]+$/";

if(isset($_POST['submit'])){

    //provera username-a
    if(!empty($_POST['username'])){
        $username = sredistring($_POST['username']);
        if(!preg_match($regex3, $username)){
            $errors[] = "Korisnicko ime nema razmaka i specijalnih karaktera";
        }
    }else{
        $errors[] = "Morate uneti korisnicko ime";
    }

    //provera passworda
    if(!empty($_POST['password'])){
        $password = sredistring($_POST['password']);

        if(!preg_match($regex3, $password)){
            $errors[] = "Lozinka sadrzi samo slova i brojeve";
        }

        if(!(strlen($password) > 5 && strlen($password) < 11 )){
            $errors[] = "Lozinka mora imati 6-10 karaktera";
        }


    }else{
        $errors[] = "Morate uneti lozinku";
    }

   //provera postojanja korisnika
  
    $checkUsername = mysqli_query($conn, "select * from korisnici where korisnik_username='$username'");
        
    if(mysqli_num_rows($checkUsername) == 0){
        $errors[] = "Korisnicko ime koje ste uneli ne postoji u bazi";
    }else{

        while($row1 = mysqli_fetch_assoc($checkUsername)){
            $userId = $row1['korisnik_id'];
            $userName = $row1['korisnik_username'];
            $userPassword = $row1['korisnik_password'];
            $userPhone = $row1['korisnik_brojtel'];
            $userEmail = $row1['korisnik_email'];
            $userStatus = $row1['korisnik_status'];

        }

        $checkPass = mysqli_query($conn, "select * from korisnici where korisnik_username='$username' and korisnik_password='$password'");

        if(mysqli_num_rows($checkPass) == 0){
            $errors[] = "Uneli ste pogresnu lozinku";
        }

        if($userStatus == 1){

            header('Location: logout.php');
            

        }elseif($userStatus == 0){

           header('Location: logout.php');

        }

        //provera greski i upis u sesiju ukoliko ih nema
        if(empty($errors)){

            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $userName;
            $_SESSION['password'] = $userPassword;
            $_SESSION['phone'] = $userPhone;
            $_SESSION['email'] = $userEmail;
            $_SESSION['status'] = $userStatus;
            
            header('Location: index.php');
        }
    }

}else{
    //$errors[] = "Ovo korisnik vidi kad prvi put otvori stranu";
}

foreach ($errors as $error) {
    echo "<div>". $error . "!</div>";
    echo "<br>";
}

include('footer.inc.php');
?>