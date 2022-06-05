<?php
include_once '../Models/User.php';

$action = "index";
if (isset($_GET['action']))
    $action = $_GET['action'];
else if(isset($_POST['action']))
    $action = $_POST['action'];
switch ($action) {
    case "Sign Up":
       /* Vendeur::InscriptionVendeur($_GET['nom'],$_GET['prenom'],$_GET['mail'],$_GET['password'],$_GET['domaine'],$_GET['gender']);*/
        break;
    case "sendMail":
        User::sendMails($_GET['to'],$_GET['subject'],$_GET['date'],$_GET['message'],$_GET['sender']);
        header('location:../GUI/Message.php');
    ;
    break;
    case  "delete":
        User::deleteMail($_GET['id']) ;
        header('location:../GUI/sentMails.php');
        break;
    case "logout":
        session_start();
        unset($_SESSION["clog"]);
        header('location:../index.php');
        break;
}

//header('location:../index.php');