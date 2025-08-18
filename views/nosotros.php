<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nosotros - Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="public/css/nosotros.css">
</head>
<body>
    <!-- HEADER -->
  <?php include '../views/partials/header.php'; ?>

<main class="bg-body-tertiary">
<section class="profile-cover position-relative text-center ">
  <img src="../public/img/Quique.jpg" 
       class="rounded-circle border-3 white shadow mt-4" 
       alt="Avatar" 
       width="190" height="200">
</section>

    <section class="container text-center mt-5">
      <P>Nuestro CEO</P>
      <h4>Enrique Mario Ronceros Flores </h4>
      <h2 class="fw-bold">Ruta del Sabor Chincha</h2>
      <p class="fw-bold">Descubre lo mejor de la gastronomía chinchana 🍲</p>
    </section>

    <!-- Sección de información -->
    <section class="container mt-4">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-warning"><i class="fas fa-info-circle"></i> Presentación</h5>
              <p class="card-text">
                Somos un proyecto gastronómico que busca difundir y conectar a todos los amantes de la buena comida en Chincha.  
                Aquí encontrarás los mejores restaurantes, bodegas y experiencias culinarias de la región.
              </p>
            </div>
          </div>
        </div>

        <!-- Misión -->
        <div class="col-md-6">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-warning"><i class="fas fa-bullseye"></i> Misión</h5>
              <p class="card-text">
                Promover la cultura gastronómica chinchana, fortaleciendo la identidad local y ofreciendo a los visitantes una experiencia única de sabores, tradición e innovación.
              </p>
            </div>
          </div>
        </div>

        <!-- Visión -->
        <div class="col-md-6">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-warning"><i class="fas fa-eye"></i> Visión</h5>
              <p class="card-text">
                Convertirnos en el referente gastronómico digital más importante de la provincia de Chincha, conectando a la comunidad con los mejores restaurantes y emprendimientos locales.
              </p>
            </div>
          </div>
        </div>

        <!-- Objetivos -->
        <div class="col-md-6">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-warning"><i class="fas fa-list-check"></i> Objetivos</h5>
              <ul class="list-unstyled">
                <li><i class="fas fa-check text-success"></i> Difundir la gastronomía chinchana a nivel regional y nacional.</li>
                <li><i class="fas fa-check text-success"></i> Apoyar a los restaurantes y emprendedores locales.</li>
                <li><i class="fas fa-check text-success"></i> Fomentar el turismo gastronómico en la provincia.</li>
                <li><i class="fas fa-check text-success"></i> Crear una comunidad digital activa de amantes de la comida.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <br>
    <br>
     <br>
    <br>
     <br>
    <br>
  </main>

    <!-- FOOTER -->
  <?php include '../views/partials/footer.php'; ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
