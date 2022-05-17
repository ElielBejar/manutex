<?php
    require_once("php/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="globalStyles.css"/>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="mediaStyles.css"/>
    <link rel="shortcut icon" type="image/x-icon" href="img/logo.ico"/>
    <title>Manutex</title>
</head>
<body>
    <div class="content">
       <header>
           <div class="portada">
               <img src="img/fotos_galeria/foto16.jpeg"/>
           </div>
           <img class="menu_responsive" src="img/menu.png" width="5%"/>
           <img class="logo_img" src="img/logo.jpg" alt="failed" width="10%"></img>
           <nav class="menu">
           <ul>
               <li><a class="link_header" href="#">Inicio</a></li>
               <li><a class="link_header" href="telas/">Telas</a></li>
               <li><a class="link_header" href="acerca_de/">Acerca de</a></li>
               <li><a class="link_header" href="galeria/">Galería</a></li>
           </ul>
           <div class="search">
           <input type="text" class="text" placeholder="Buscar..." onkeyup="show_results(this.value, 'php/results.php', 'telas/tela.php')"/>
           <button class="search_button"><img src="img/lupa.png"></button>
           <div class="results" id="results"></div>
           </div>
           </nav>
           <nav class="nav_responsive">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="telas/">Telas</a></li>
                <li><a href="acerca_de/">Acerca de</a></li>
                <li><a href="galeria/">Galería</a></li>
            </ul>
            </nav>
       </header>
       <h1>Nuestras telas</h1>
       <div class="main">
           <?php
               $stmt = $connection->query("SELECT COUNT(*) FROM articles");//number of images.
               $img_length = $stmt->fetchColumn();//cuantos registros hay.
               $img_for_column = round($img_length / 4);//cuantas imagenes por columna.
               $img_length = $img_length%4;//cuantas imagenes sobran.
               $limit_column = 0; //Desde que registro mostrar.

           $column = $connection->query("SELECT * FROM articles LIMIT $limit_column, $img_for_column");

           for($i = 0; $i<3; $i++){//para cada columna que pase lo siguiente:
               if($img_length != 0){//si sobran imagenes:
                  if($i < 3){
                      $aux = $img_for_column;
                      $img_for_column++;
                      $img_length--;
                  }
               }
               $column = $connection->query("SELECT * FROM telas LIMIT $limit_column, $img_for_column");
               echo "<div class='column'>";
               while($fila = $column->fetch(PDO::FETCH_ASSOC)){
                       echo "<article><a href='telas/tela.php?tela=" . $fila["tela"] . "'> 
                          <div class='text'>
                          <h2>" . $fila["tela"] . "</h2>
                          </div>
                          <img src='data:image/jpeg; base64, " . base64_encode($fila["img"]) . "'/></a>
                       </article>";
               }
               echo "</div>";
               $limit_column = $limit_column + $img_for_column;
               if($img_length != 0){
               $img_for_column = $aux;
               }
             }
             ?>
       </div>
       <footer>Manutex 2021- Todos los derechos reservados
               <br/>
               Teléfono: 1169968510
               <div class="social-network">
               <a href="https://www.instagram.com/manutex_/"><img src="img/instagram_logo.jpeg" width="5%"/></a>
               <a href="https://api.whatsapp.com/send?phone=541155752150&text=Hola%20Manutex!%20Me%20gustar%C3%ADa%20recibir%20el%20listado%20de%20art%C3%ADculos."><img src="img/whatsapp_logo.png" width="5%"/></a>
               </div>
       </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" 
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous">
    </script>
    <script src="globalJs.js"></script>
    <script src="telas/telas_search.js"></script>
</body>
</html>