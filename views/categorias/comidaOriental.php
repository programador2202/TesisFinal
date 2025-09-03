<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comida Oriental - Restaurante Sakura</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../../public/css/ComidaOriental.css">
</head>
<body>

<!--- header -->
<?php require_once '../partials/header.php'; ?>
  <!-- HERO -->
  <section class="hero d-flex flex-column justify-content-center align-items-center">
    <h1><b>🍣Comida Oriental</b></h1>
  </section>

  <section id="menu" class="container py-5 menu-section">
  <h2 class="text-center mb-4">Restaurantes Orientales</h2>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="platosContainer">
    <!-- Los restaurantes se cargarán dinámicamente aquí -->
  </div>
</section>

<?php  require_once '../partials/footer.php' ?>

<script>
// Cuando cargue la página, pedimos los restaurantes orientales
document.addEventListener("DOMContentLoaded", () => {
fetch("http://localhost/RutaDelSaborChincha123/controllers/Restaurantes.php?task=listarPorCategoria&idcategoria=1")
    .then(response => response.json())
    .then(data => {
      const container = document.getElementById("platosContainer");
      container.innerHTML = ""; 

      function renderStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
          if (rating >= i) {
            stars += '<i class="bi bi-star-fill text-warning"></i>';
          } else if (rating >= i - 0.5) {
            stars += '<i class="bi bi-star-half text-warning"></i>';
          } else {
            stars += '<i class="bi bi-star text-warning"></i>';
          }
        }
        return stars;
      }

      if (data.length > 0) {
        data.forEach(rest => {
          const card = `
            <div class="col">
              <div class="card menu-card h-100 shadow-sm">
                <img src="http://localhost/RutaDelSaborChincha123/public/img/restaurantes/${rest.img}" 
                  class="card-img-top" alt="${rest.nom_restaurante}">
                <div class="card-body">
                  <h5 class="card-title">${rest.nom_restaurante}</h5>
                  <div class="mb-2">
                    ${renderStars(rest.calificacion ?? 0)}
                    <span class="ms-2 text-secondary fw-bold">${rest.calificacion ? rest.calificacion.toFixed(1) : '0.0'}</span>
                  </div>
                  <p class="card-text">${rest.descripcion}</p>
                  <p class="text-muted">
                    <i class="bi bi-geo-alt"></i> ${rest.direccion} <br>
                    <i class="bi bi-telephone"></i> ${rest.telefono}
                  </p>
                  <a href="restaurante.php?id=${rest.idrestaurante}" 
                    class="btn btn-warning mt-auto">
                    <b>Visitar Restaurante</b>            
                  </a>
                </div>
              </div>
            </div>
          `;
          container.insertAdjacentHTML("beforeend", card);
        });
      } else {
        container.innerHTML = `<p class="text-center text-muted">No hay restaurantes orientales disponibles.</p>`;
      }
    })
    .catch(error => {
      console.error("Error al cargar los restaurantes:", error);
    });
});

</script>
</body>
</html>
