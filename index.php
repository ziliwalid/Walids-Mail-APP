<?php
include_once './Models/User.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="../Index.php"><h4 class="logo">Messagerie</h4></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./inscriptionVendeur.php">Sign Up</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-sm col-4">
    <form method="post" action="index.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="wa" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control" id="exampleInputPassword1"><br>
            <center>
                <button type="submit" name="connection" value="connection" class="btn btn-danger">Connectez-vous</button><br>
                Vous n'avez pas de compte ?<br> <a style="color: #fe302f" href="./InscriptionClient.php">Inscrivez-vous</a>
            </center>
    </form>
</div>
<?php
if(!empty($_POST['connection']))
{
    $mail=$_POST['wa'];
    $password=$_POST['pass'];

    $r=User::Getuser($_POST['wa'],$_POST['pass']);
    if($r==0)
    {
        echo"<center><span>E-mail</span> ou <span>mot de pass</span> incorrect</center>";
    }
    else   {

        session_start();
        $_SESSION['clog']= $mail;
        header("location:./GUI/Message.php");

    }


}
?>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Smooch&display=swap');
    span{
        color: red;
        font-weight: bold;
    }
    .container-sm{
        margin-top: 100px;
        padding: 5%;
        background: aliceblue;
        border-radius: 5px;
        box-shadow: black;
    }
    .logo{
        color: #fe302f;
        font-family: 'Smooch', cursive;
        font-weight: bolder;
    }
</style>
