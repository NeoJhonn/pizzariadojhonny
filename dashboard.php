
<?php
   include_once("templates/header.php");
   include_once("process/orders.php");

?>
    <div id="main-container">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <h2>Gerenciar Pedidos:</h2>
            </div>
            <!--Bootstrap-->
            <div class="col-md-12 table-container">
               <!--Tabela-->
               <table class="table">
                  <!-- cabeçalho da tabela-->
                  <thead>
                     <tr>
                        <!--coluna da tabela th(table headind), nome de cada coluna da tabela-->
                        <th scope="col"><span>Pedido</span> #</th>
                        <th scope="col">Borda</th>
                        <th scope="col">Massa</th>
                        <th scope="col">Sabores</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>  
                     </tr>
                  </thead>
                  <!-- corpo da tabela-->
                  <tbody>
                     <?php foreach($pizzas as $pizza): ?>
                        <tr>
                           <!-- data das colunas da tabela,td(table data), dado que vai em cada coluna da tabela-->
                           <td><?= $pizza["id"] ?></td>
                           <td><?= $pizza["borda"] ?></td>
                           <td><?= $pizza["massa"] ?></td>
                           <td>
                              <!-- lista -->
                              <ul>
                                 <?php foreach($pizza["sabores"] as $sabor): ?>
                                    <!-- intem da lista -->
                                    <li><?= $sabor ?></li>                     
                                 <?php endforeach; ?>
                              </ul>
                           </td>
                           <td>
                              <form action="process/orders.php" 
                              method="POST" class="form-group update-form">
                                 <input type="hidden" name="type" value="update">
                                 <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                                 <select name="status" class="form-control status-input">
                                    <?php foreach($status as $st): ?>
                                       <option value="<?= $st["id"] ?>" <?php echo($st["id"] == $pizza["status"]) ? "selected" : ""; ?> ><?= $st["tipo"] ?></option>
                                    <?php endforeach; ?>
                                 </select>
                                 <button type="submit" class="update-btn">
                                    <i class="fas fa-sync-alt"></i>
                                 </button>
                              </form>
                           </td>
                           <td>
                              <form action="process/orders.php" method="POST">
                                 <input type="hidden" name="type" value="delete">
                                 <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                                 <button type="submit" class="delete-btn">
                                    <i class="fas fa-times"></i>
                                 </button>
                              </form>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
    </div>
<?php
   include_once("templates/footer.php")
?>