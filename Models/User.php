<?php
include_once __dir__.'/../Dataaccess/Dataaccess.php';

class User
{
    public static function Getuser($mail,$mdp){
        $req="Select * from user where  mail='$mail' and mdp='$mdp' ";
        $cur = Dataaccess::selection($req);
        return $cur->rowCount();
    }
    public static function showMail($sender){
        $req="SELECT *
            FROM message
            INNER JOIN user
            WHERE user.id = message.sender and message.sender!='$sender';";
        return Dataaccess::selection($req);
}
    public static function showmailDetail($id){
        $req="select * from message where id='$id'";
        return Dataaccess::selection($req);
    }
    public static function showSentMail($sender){
        $req="SELECT *
            FROM message
            INNER JOIN user
            WHERE user.id = message.sender and message.sender='$sender';";
        return Dataaccess::selection($req);
    }

    public static function  showUnreadMail($sender,$etat){
        $req="SELECT *
            FROM message
            INNER JOIN user
            WHERE user.id = message.sender and message.sender!='$sender' and message.etat='$etat';";
        return Dataaccess::selection($req);
    }
    public static  function  sendMails($addr_exp,$sujet,$date_envoie,$contenue,$sender){
        $req="INSERT INTO `message`(`adress_exp`, `sujet`, `date_envoie`, `contenue`, `etat`, `sender`) VALUES ('$addr_exp','$sujet','$date_envoie','$contenue','0','$sender')";
        return Dataaccess::majour($req);
    }
    public static function getNameAndID($mail){
        $req="select id, nom from user where `mail`='$mail'";
        return Dataaccess::selection($req);
    }

}