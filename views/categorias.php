<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../public/css/index.css">
    <title>Categorias</title>
</head>
<body>
    <!-- HEADER -->
    <?php include '../views/partials/header.php'; ?>

    <!-- CATEGORÍAS -->
    <section class="py-5 bg-light">
      <div class="container">
        <h2 class="text-center mb-4"><b>Explora por Categorías</b></h2>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center">
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-utensils categoria-icono"></i><div>Comida Oriental</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-drumstick-bite categoria-icono"></i><div>Pollerías</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-pizza-slice categoria-icono"></i><div>Pizzerías</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-hamburger categoria-icono"></i><div>Hamburguesas</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-fish categoria-icono"></i><div>Mariscos</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-coffee categoria-icono"></i><div>Cafeterías</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-fire categoria-icono"></i><div>Parrillas</div></div></div>
          <div class="col text-center"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-wine-glass-alt categoria-icono"></i><div>Vitivinícolas</div></div></div>
        </div>
      </div>
    </section>

    <section>
        <div class="container py-5">
  <h1 class="text-center mb-4">🍽️ Platos Destacados</h1>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
    
    <!-- Aquí iría el loop PHP -->
    <?php
    // Conexión a la BD
    $conn = new mysqli("localhost", "root", "", "sistema_ruta_del_sabor");
    $sql = "SELECT nom_platos, descripcion, precio, imagen FROM platos";
    $result = $conn->query($sql);
    
    while ($row = $result->fetch_assoc()) {
    ?>
      <div class="col">
        <div class="card h-100 shadow-sm plato-card">
          <img src="<?php echo $row['imagen']; ?>" class="card-img-top" alt="<?php echo $row['nom_platos']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['nom_platos']; ?></h5>
            <p class="card-text"><?php echo $row['descripcion']; ?></p>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center">
            <span class="fw-bold text-success">S/ <?php echo number_format($row['precio'], 2); ?></span>
            <button class="btn btn-outline-primary btn-sm">⭐ Calificar</button>
          </div>
        </div>
      </div>
    <?php } ?>
    
  </div>
</div>
    </section>
    
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>