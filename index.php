<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="public/css/index.css">
</head>
<body>
<!----MENU PRINCIPAL--->
<?php include 'views/partials/header.php'; ?>
  
<main>
<!----CONTENIDO PRINCIPAL--->
<section class="hero">
  <div class="container">
    <h1>¿Qué quieres comer hoy en Chincha?</h1>
    <div class="row justify-content-center mt-4">
      <div class="col-md-10">
        <form class="row g-2">
          <div class="col-md-3">
            <select class="form-select" name="categoria">
             <option selected disabled>Tipo de comida</option>
              </option>
            </select>
          </div>
          <div class="col-md-3">
            <select class="form-select">
              <option selected>Ordenar por</option>
              <option value="valorados">Top valorados</option>
              <option value="economico">Económico</option>
              <option value="abierto">Abierto ahora</option>
            </select>
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-light w-100">Buscar</button>
          </div>
          <div class="col-md-3">
            <button type="button" class="btn btn-outline-warning w-100">
              <i class="fas fa-location-arrow"></i> Usa mi ubicación
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


<!----SECCION CATEGORIAS ---->

<section class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4"><b>Explora por Categorías</b></h2>
    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center">

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-utensils"></i></div>
          <div>Comida Oriental</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-drumstick-bite"></i></div>
          <div>Pollerías</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-pizza-slice"></i></div>
          <div>Pizzerías</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-hamburger"></i></div>
          <div>Hamburguesas</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-fish"></i></div>
          <div>Mariscos</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-coffee"></i></div>
          <div>Cafeterías</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-fire"></i></div>
          <div>Parrillas</div>
        </div>
      </div>

      <div class="col text-center">
        <div class="card border-0 shadow-sm p-3 categoria-card">
          <div class="categoria-icono"><i class="fas fa-wine-glass-alt"></i></div>
          <div>Vitivinícolas</div>
        </div>
      </div>
        </div>
    </div>
  </div>
</section>

<section class="home">
    <h1 class="titulo"><b>Lo Más Visto de la Semana</b></h1>

    <div class="my-5">
        <div class="subtitulo d-flex flex-wrap justify-content-center gap-5"></div>
        <div class="d-flex flex-wrap justify-content-center gap-5 my-3">

            <!-- Card 1 -->
            <div class="flip-card shadow">
                <div class="flip-card-inner">
                    <!-- Frente -->
                    <div class="flip-card-front">
                        <img src="public/img/causa_agresiva (2).jpg" alt="El Punto Marino">
                    </div>
                    <!-- Reverso -->
                    <div class="flip-card-back">
                        <h5><b>El Punto Marino</b></h5>
                        <p>¡Explora el Encanto del Mar en el Punto Marino!</p>
                        <a href="#" class="btn btn-warning mt-2"><b>Visitar</b></a>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="flip-card shadow">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="public/img/Chijaukay.jpg" alt="Mister Wok">
                    </div>
                    <div class="flip-card-back">
                        <h5><b>Mister Wok</b></h5>
                        <p>¿Antojo de comida china? Descubre el auténtico sabor del chifa en Mister Wok</p>
                        <a href="#" class="btn btn-warning mt-2"><b>Visitar</b></a>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="flip-card shadow">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="public/img/el_gran_combo restaurante_chincha_c (3).jpg" alt="El Gran Combo">
                    </div>
                    <div class="flip-card-back">
                        <h5><b>El Gran Combo</b></h5>
                        <p>Somos el lugar ideal para disfrutar de una experiencia gastronómica que celebra las ricas tradiciones culinarias.</p>
                        <a href="#" class="btn btn-warning mt-2"><b>Visitar</b></a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="my-1">
        <div class="destacados d-flex flex-wrap justify-content-center gap-5">

            <!-- Card 4 -->
            <div class="flip-card shadow">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="public/img/3.jpg" alt="Daddy’s Truck’s Burger">
                    </div>
                    <div class="flip-card-back">
                        <h5><b>¡Daddy’s Truck’s Burger!</b></h5>
                        <p>Daddy’s Trucks Burger es un restaurante único en Chincha que se distingue por ofrecer una experiencia de comida rápida diferente</p>
                        <a href="#" class="btn btn-warning mt-2"><b>Visitar</b></a>
                    </div>
                </div>
            </div>

            <!-- Card 5 -->
            <div class="flip-card shadow">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="public/img/daito (5).jpg" alt="DAITO">
                    </div>
                    <div class="flip-card-back">
                        <h5><b>DAITO</b></h5>
                        <p>En Daito, nos enorgullecemos de ser un restaurante dedicado a presentar la exquisita cocina Nikkei, mezcla de sabores que refleja la rica herencia cultural de Perú y Japón.</p>
                        <a href="#" class="btn btn-warning mt-2"><b>Visitar</b></a>
                    </div>
                </div>
            </div>

            <!-- Card 6 -->
            <div class="flip-card shadow">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="public/img/vitivinicola_chincha_san_carlos (1).jpg" alt="Viñedos San Carlos">
                    </div>
                    <div class="flip-card-back">
                        <h5><b>Viñedos San Carlos</b></h5>
                        <p>Somos una bodega ubicada en el pintoresco valle de Sunampe, Chincha, Perú. Viñedos San Carlos se destaca por su dedicación a la calidad, la innovación y el respeto por el medio ambiente.</p>
                        <a href="#" class="btn btn-warning mt-2"><b>Visitar</b></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


  <section class="auspiciadores my-5 mb-4">
    <h1><b>Nuestros Auspiciadores</b></h1>

    <div class="container1 my-1 mb-2">
      <div class="card-auspiciadores"><img src="public/img/logo_marino_responsivo.png" alt=""></div>
      <div class="card-auspiciadores"><img src="public/img/logo_misterwok.png" alt=""></div>
      <div class="card-auspiciadores"><img src="public/img/Marca-de-daito.png" alt=""></div>
      <div class="card-auspiciadores"><img src="public/img/logo_gran_combo.png" alt=""></div>
    </div>
  </section>


</main>
<!----FOOTER--->
<?php include 'views/partials/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  
document.addEventListener("DOMContentLoaded", function () {
  const selectCategoria = document.querySelector('select[name="categoria"]');

  fetch("http://localhost/RutadelSaborChincha/controllers/Categoria.php?task=getAll")
    .then(response => response.json())
    .then(data => {
      data.forEach(categoria => {
        const option = document.createElement("option");
        option.value = categoria.idcategoria;
        option.textContent = categoria.nombre;
        selectCategoria.appendChild(option);
      });
    })
    .catch(error => {
      console.error("Error al cargar categorías:", error);
    });
});
</script>


</body>
</html>
