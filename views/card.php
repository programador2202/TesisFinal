<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Platos - Ruta del Sabor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .plato-card img {
      height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


 