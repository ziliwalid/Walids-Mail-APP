<?php
include_once '../Models/User.php';
session_start();
$mail=$_SESSION['clog'];
$getID=User::getNameAndID($mail);
while ($row = $getID->fetch()){
    $id=$row[0];
    $name=$row[1];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <!-- BEGIN INBOX -->
        <div class="col-md-12">
            <div class="grid email">
                <div class="grid-body">
                    <div class="row">
                        <!-- BEGIN INBOX MENU -->
                        <div class="col-md-3">
                            <h2 class="grid-title"><span style="color: #fe302f"><?=$name?></span> Here's your<br> <i class="fa-solid fa-paper-plane"></i> Sent E-mails</h2><br>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa fa-pencil"></i>&nbsp;&nbsp;NEW MESSAGE
                            </button>
                            <a class="btn btn-danger float-end" href="../Traitement/TraitementMail.php?action=logout">Logout</a>

                            <hr>

                            <div class="lol">
                                <nav class="nav flex-column">
                                    <center>
                                        <a class="nav-link btn btn-outline-primary" href="./unreadMails.php">Unread Mails <i class="fa-solid fa-dragon"></i></a><br>
                                        <a class="nav-link btn btn-outline-primary" href="./readMails.php">Read Mails <i class="fa-solid fa-dragon"></i></a><br>
                                        <a class="nav-link btn btn-outline-primary" href="./sentMails.php">Sent Mails <i class="fa-solid fa-kiwi-bird"></i></a>
                                    </center>
                                </nav>
                            </div>
                        </div>
                        <!-- END INBOX MENU -->

                        <!-- BEGIN INBOX CONTENT -->
                        <div class="col-md-9 mt-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label style="margin-right: 8px;" class="">
                                        <div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" id="check-all" class="icheck" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
                                    </label>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            Action <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Mark as read</a></li>
                                            <li><a href="#">Mark as unread</a></li>
                                            <li><a href="#">Mark as important</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#">Report spam</a></li>
                                            <li><a href="#">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div class="padding"></div>



                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                    <?php
                                    $data=User::showSentMail($id);
                                    while ($row = $data->fetch()){
                                        ?>
                                        <tr>
                                            <td class="name"><a href="#"><?=$row[8]?></a></td>
                                            <td class="subject"><a href="#"><?=$row[4]?></a></td>
                                            <td class="time"><?=$row[3]?></td>
                                            <td class="time"><a href="../Traitement/TraitementMail.php?id=<?=$row[0]?>&action=delete" class="btn btn-outline-danger"><i class="fa-solid fa-trash"></i></a></td>
                                        </tr>
                                    <?php }?>

                                    </tbody></table>
                            </div>
                        </div>
                        <!-- Begin INBOX CONTENT -->

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-wrapper">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-blue">
                                            <h4 class="modal-title"><i class="fa fa-envelope"></i> Compose New Message</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="../Traitement/TraitementMail.php" method="get">
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <input name="to" type="email" class="form-control" placeholder="To">
                                                </div>
                                                <div class="mb-3">
                                                    <input name="subject" type="text" class="form-control" placeholder="Subject">
                                                    <input value="<?=date("Y/m/d")?>" name="date" hidden>
                                                    <input value="<?=$id?>" name="sender" hidden>
                                                </div>
                                                <div class="mb-3">
                                                    <textarea name="message" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>
                                                <button type="submit" class="btn btn-primary pull-right" name="action" value="sendMail"><i class="fa fa-envelope"></i> Send Message</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--END COMPOSE MESSAGE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END INBOX -->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
<script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
</script>
</body>
</html>
<style>
    body{
        margin-top:20px;
        background:#eee;
    }
    /* EMAIL */
    .email {
        padding: 20px 10px 15px 10px;
        font-size: 1em;
    }

    .email .btn.search {
        font-size: 0.9em;
    }

    .email h2 {
        margin-top: 0;
        padding-bottom: 8px;
    }

    .email .nav.nav-pills > li > a {
        border-top: 3px solid transparent;
    }

    .email .nav.nav-pills > li > a > .fa {
        margin-right: 5px;
    }

    .email .nav.nav-pills > li.active > a,
    .email .nav.nav-pills > li.active > a:hover {
        background-color: #f6f6f6;
        border-top-color: #3c8dbc;
    }

    .email .nav.nav-pills > li.active > a {
        font-weight: 600;
    }

    .email .nav.nav-pills > li > a:hover {
        background-color: #f6f6f6;
    }

    .email .nav.nav-pills.nav-stacked > li > a {
        color: #666;
        border-top: 0;
        border-left: 3px solid transparent;
        border-radius: 0px;
    }

    .email .nav.nav-pills.nav-stacked > li.active > a,
    .email .nav.nav-pills.nav-stacked > li.active > a:hover {
        background-color: #f6f6f6;
        border-left-color: #3c8dbc;
        color: #444;
    }

    .email .nav.nav-pills.nav-stacked > li.header {
        color: #777;
        text-transform: uppercase;
        position: relative;
        padding: 0px 0 10px 0;
    }

    .email table {
        font-weight: 600;
    }

    .email table a {
        color: #666;
    }

    .email table tr.read > td {
        background-color: #f6f6f6;
    }

    .email table tr.read > td {
        font-weight: 400;
    }

    .email table tr td > i.fa {
        font-size: 1.2em;
        line-height: 1.5em;
        text-align: center;
    }

    .email table tr td > i.fa-star {
        color: #f39c12;
    }

    .email table tr td > i.fa-bookmark {
        color: #e74c3c;
    }

    .email table tr > td.action {
        padding-left: 0px;
        padding-right: 2px;
    }

    .grid {
        position: relative;
        width: 100%;
        background: #fff;
        color: #666666;
        border-radius: 2px;
        margin-bottom: 25px;
        box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
    }



    .grid .grid-header:after {
        clear: both;
    }

    .grid .grid-header span,
    .grid .grid-header > .fa {
        display: inline-block;
        margin: 0;
        font-weight: 300;
        font-size: 1.5em;
        float: left;
    }

    .grid .grid-header span {
        padding: 0 5px;
    }

    .grid .grid-header > .fa {
        padding: 5px 10px 0 0;
    }

    .grid .grid-header > .grid-tools {
        padding: 4px 10px;
    }

    .grid .grid-header > .grid-tools a {
        color: #999999;
        padding-left: 10px;
        cursor: pointer;
    }

    .grid .grid-header > .grid-tools a:hover {
        color: #666666;
    }

    .grid .grid-body {
        padding: 15px 20px 15px 20px;
        font-size: 0.9em;
        line-height: 1.9em;
    }

    .grid .full {
        padding: 0 !important;
    }

    .grid .transparent {
        box-shadow: none !important;
        margin: 0px !important;
        border-radius: 0px !important;
    }


</style>
