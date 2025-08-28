<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cevichería El Punto Marino</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../public/css/ElPuntoMarino.css">
</head>
<body>

<?php require_once '../partials/header.php'; ?>

<section class="marino-header d-flex flex-column align-items-center justify-content-center text-center py-4">
  <img src="../../public/img/logo_marino_responsivo.png" 
       class="rounded-circle border-3 white shadow mb-3"
       alt="Logo El Punto Marino"
       width="240" height="250">
</section>


  <!-- PLATOS DESTACADOS -->
    <section class="container py-5" id="platosDestacados">
        <h1 class="text-black fw-bold mt-2 text-center" style="z-index:2;">🐟 CEVICHERÍA EL PUNTO MARINO 🌊</h1>
  <p class="lead text-black text-center"  style="z-index:2;">¡Frescura y sabor del mar directo a tu mesa!</p>
  <br>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-3" id="platosContainer">
    <!-- Los platos se cargarán dinámicamente aquí -->
  </div>
</section>

<!-- INFORMACIÓN DEL RESTAURANTE -->
<section class="container my-5" id="infoRestaurante">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <h2 class="mb-3 text-primary fw-bold"><i class="bi bi-info-circle"></i> Sobre Nosotros</h2>
      <p class="lead">
        En <b>El Punto Marino</b> te ofrecemos la mejor experiencia marina en Chincha. Disfruta de nuestros platos preparados con insumos frescos y recetas tradicionales, en un ambiente familiar y acogedor.
      </p>
      <ul class="list-unstyled mb-3">
        <li><i class="bi bi-geo-alt-fill text-danger"></i> Av. Principal 123, Chincha Alta</li>
        <li><i class="bi bi-telephone-fill text-success"></i> (056) 123-456</li>
        <li><i class="bi bi-clock-fill text-warning"></i> Lunes a Domingo: 11:00 am - 7:00 pm</li>
        <li><i class="bi bi-instagram text-danger"></i> @elpuntomarino</li>
      </ul>
    </div>
  </div>
</section>

<?php require_once '../partials/footer.php'; ?>


<script>
  // Función para cargar los platos desde el controller
  async function cargarPlatos() {
    try {
      const response = await fetch('../../controllers/Platos.php?task=ListaMariscos');
      const platos = await response.json();

      const container = document.getElementById('platosContainer');
      container.innerHTML = ''; // limpiar contenido previo

      platos.forEach(plato => {
        const col = document.createElement('div');
        col.className = 'col';

        col.innerHTML = `
          <div class="card h-100 shadow-sm plato-card">
            <img src="../../public/img/platos/${plato.imagen}" class="card-img-top" alt="${plato.nom_platos}">
            <div class="card-body">
              <h5 class="card-title">${plato.nom_platos}</h5>
              <p class="card-text">${plato.descripcion}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <span class="fw-bold text-success">S/ ${parseFloat(plato.precio).toFixed(2)}</span>
              <button class="btn btn-outline-primary btn-sm">⭐ Calificar</button>
            </div>
          </div>
        `;

        container.appendChild(col);
      });

    } catch (error) {
      console.error('Error al cargar los platos:', error);
    }
  }

  // Cargar los platos al cargar la página
  window.addEventListener('DOMContentLoaded', cargarPlatos);
</script>
</body>
</html>