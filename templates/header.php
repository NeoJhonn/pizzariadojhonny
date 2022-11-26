<?php

   include("process/connection.php");

   $msg = "";

   //Se a mensagem da sessão está com algo dentro?
   if(isset($_SESSION["msg"])) {

     $msg = $_SESSION["msg"];
     $status = $_SESSION["status"];
     
     //limpa a mensagem depois de exibir
     $_SESSION["msg"] = "";
     $_SESSION["status"] = "";

   }

?>


<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu Pedido</title>
    <!-- Bootstrap, pega o link no site do Boostrap, clicar em 4.6 docs, de CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" 
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Font Awesome, pegar o link em cdnjs.com-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
     integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- App CSS -->
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
            <a href="index.php" class="navbar-brand">
                <img src="assets/pizza.svg" alt="Pizzaria do Jhonny" id="brand-logo">
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a href="index.php" class="nav-link"><h4>Peça sua pizza</h4></a>
                    </li>
                </ul>

            </div>
        </nav>
       
    </header>
    <!-- Mostra mensagem de sucesso ou erro-->
    <?php if($msg != ""): ?>
    <div class="alert alert-<?= $status ?>">
        <p><?= $msg ?></p>
    </div>
    <?php endif; ?>

