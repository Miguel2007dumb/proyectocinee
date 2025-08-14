<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panel del Cine</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="header">
  <div class="menu">
    <div class="logo">Cinerman</div>
    <label for="menu-toggle" class="menu-icon">&#9776;</label>
    <nav class="navbar">
      <a href="index.php">Inicio</a>
      <?php if(isset($_SESSION['user_id'])): ?>
        <a href="proximamente.html">Proximamente</a>
        <a href="logout.php">Cerrar sesión</a>
      <?php else: ?>
        <a href="login.php">Iniciar sesión</a>
      <?php endif; ?>
    </nav>
  </div>

  <div class="header-content container">
    <div class="header-left">
      <img src="img/f1-logo.png" alt="Logo Cine">
    </div>

    <?php if(isset($_SESSION['usuario'])): ?>
    <div class="header-right">
      <h1>Bienvenido,<br><?= htmlspecialchars($_SESSION['usuario']) ?></h1>
      <a href="https://youtu.be/aw8YyC4B1EA?si=NmEUjYO7sZU9Tgn8"><button class="btn btn-primary" >Ver trailer</button></a>
    </div>
    <?php else: ?>
    <div class="header-right">
      <h1>Las mejores<br>películas para ti</h1>
      <a href="login.php" class="btn btn-primary">Iniciar sesión para más</a>
    </div>
    <?php endif; ?>

  </div>
</header>


  <section class="movies container">
    <h2>Películas más vistas</h2>
    <hr class="separator">

    <div class="box-container-1">

      <div class="box-1">
  <div class="content">
    <a href="peliculass.html"><img src="img/lqdo.jpg" alt="La quimera del oro"></a>
    <h3>La quimera del oro</h3>
  </div>
</div>

<div class="box-1">
  <div class="content">
    <a href="los pitufos.html"><img src="img/lpt.jpg" alt="Los Pitufos"></a>
    <h3>Los Pitufos</h3>
  </div>
</div>

<div class="box-1">
  <div class="content">
    <a href="superman.html"><img src="img/spmn.jpg" alt="Superman"></a>
    <h3>Superman</h3>
  </div>
</div>

<div class="box-1">
  <div class="content">
   <a href="jurrassic.html"><img src="img/jurra.png" alt="Jurassic World"></a>
    <h3>Jurassic Word Renace</h3>
  </div>
</div>

<div class="box-1">
  <div class="content">
    <a href="l4f.html"><img src="img/l4f.webp" alt="Los 4 Fantasticos"></a>
    <h3>Los 4 Fantasicos</h3>
  </div>
</div>

<div class="box-1">
  <div class="content">
    <a href="catd.html"><img src="img/ceatd.png" alt="Como entrenar a tu dragon"></a>
    <h3>Como entrenar a tu dragon</h3>
  </div>
</div>

<div class="box-1">
  <div class="content">
    <a href="f1.html"><img src="img/f1pos.webp" alt="F1"></a>
    <h3>Formula 1 : La pelicula </h3>
  </div>
</div>
<br>
  </section>

  <section class="movies container">
    <h2>Películas de estreno</h2>
    <hr class="separator">
    <div class="box-container-2">
      <div class="box-2">
        <div class="content">
          <a href="exor.html"><img src="img/exor.jpg" alt=""></a>
          <li>Exorcismo: El ritual</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="david.html"><img src="img/david.png" alt=""></a>
          <li>David Gilmour Live at the Circus Maximus, Rome</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="hora.html"><img src="img/la hora.png" alt=""></a>
          <li>La hora de la desaparición</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="ping.html"><img src="img/lecciones.png" alt=""></a>
          <li>Lecciones de un pingüino</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="viernes.html"><img src="img/otro viernes.png" alt=""></a>
          <li>Otro viernes de locos</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="super.html"><img src="img/supermascotas.png" alt=""></a>
          <li>RE: DC Liga de Supermascotas</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="terre.html"><img src="img/terremoto.png" alt=""></a>
          <li>Terremoto magnitud 9.0</li>
        </div>
      </div>
      <div class="box-2">
        <div class="content">
          <a href="sdw.html"><img src="img/shadow.png" alt=""></a>
          <li>Shadow Force: Sentencia de muerte</li>
        </div>
      </div>
    </div>
    <button class="load-more" id="load-more-2">Cargar más</button>
  </section>

  <footer class="footer container">
    <h3>© Cinerman</h3>
    <ul>
      <li><a href="#">Facebook</a></li>
      <li><a href="#">Instagram</a></li>
      <li><a href="#">Twitter</a></li>
    </ul>
  </footer>

  <script src="js/script.js"></script>
</body>
</html>