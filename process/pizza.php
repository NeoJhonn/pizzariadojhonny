<?php
  
  include_once("connection.php");

  $method = $_SERVER["REQUEST_METHOD"];


  //Resgaste dos dados, montagem do pedido
  if($method === "GET") {

    $bordasQuery = $conn->query("SELECT * FROM bordas;");

    $bordas = $bordasQuery->fetchAll();

    $massasQuery = $conn->query("SELECT * FROM massas;");

    $massas = $massasQuery->fetchAll();

    $saboresQuery = $conn->query("SELECT * FROM sabores;");

    $sabores = $saboresQuery->fetchAll();

  //Criação do Pedido  
  } else if ($method === "POST") {

    $data = $_POST;
    $borda = $data["borda"];
    $massa = $data["massa"];
    $sabores = $data["sabores"];

    //Validação de borda, massa e sabores
    if($borda === "" or $massa === "") {
     
      $_SESSION["msg"] = "Selecione uma borda e uma massa!";
      $_SESSION["status"] = "warning";

    } else if($sabores === null) {

      $_SESSION["msg"] = "Selecione pelo menos um sabor!";
      $_SESSION["status"] = "warning";
    

    } else if(count($sabores) > 3){

      $_SESSION["msg"] = "Selecione no máximo 3 sabores!";
      $_SESSION["status"] = "warning";
      
    }else {
      
      

      //salvando borda e massa na pizza
      $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id) VALUES (:borda, :massa)");

      //filtando inputs
      $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
      $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);

      $stmt->execute();

      //Resgatando último id da última pizza
      $pizzaId = $conn->lastInsertId();

      $stmt = $conn->prepare("INSERT INTO pizza_sabor (pizza_id, sabor_id) VALUES (:pizza, :sabor)");

      //Fazer loop para adicionar os sabores
      foreach($sabores as $sabor){

        //filtando os inputs
      $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
      $stmt->bindParam(":sabor", $sabor, PDO::PARAM_INT);

      $stmt->execute();

        
      }

      //Criar o pedido da pizza
      $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id, status_id) VALUES (:pizza, :status)");

      //status -> sempre inicia com 1, que é em produção
      $statusId = 1;

      //filtrar inputs
      $stmt->bindParam(":pizza", $pizzaId);
      $stmt->bindParam(":status", $statusId);

      $stmt->execute();

      //Exibir mensagem de sucesso
      $_SESSION["msg"] = "Pedido realizado com sucesso";
      $_SESSION["status"] = "success";




    }
    
    //Retorna para página inicial
   
    header("Location: ..");
   

  }

?>