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
  <!-- HEADER -->
  <?php include 'views/partials/header.php'; ?>

  <main>
    <!-- HERO -->
    <section class="hero">
      <div class="container mb-5">
        <h1 class="text-center">¿Qué quieres comer hoy en Chincha?</h1>
        <div class="row justify-content-center mt-4">
          <div class="col-md-10">
            <form class="row g-2">
              <div class="col-md-3">
                <select class="form-select" name="categoria">
                  <option selected disabled>Tipo de comida</option>
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
                <button type="button" class="btn btn-primary w-100">
                  <i class="fas fa-location-arrow"></i> Usa mi ubicación
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- CATEGORÍAS -->
    <section class="py-5 bg-light " id="categoria">
      <div class="container">
        <h2 class="text-center mb-4"><b>Explora por Categorías</b></h2>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4 justify-content-center">


          <div class="col text-center"><a href="views/categorias/comidaOriental.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-utensils categoria-icono"></i><div>Comida Oriental</div>
    </div>
  </a>
</div>

          <div class="col text-center"><a href="views/categorias/hamburguesa.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-hamburger categoria-icono"></i><div>Hamburguesas</div></div></a></div>
          <div class="col text-center"><a href="views/categorias/marisco.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-fish categoria-icono"></i><div>Mariscos</div></div></a></div>
          <div class="col text-center"><a href="views/categorias/Pollerias.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-drumstick-bite categoria-icono"></i><div>Pollerías</div></div></a></div>
          <div class="col text-center"><a href="views/categorias/pizzeria.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-pizza-slice categoria-icono"></i><div>Pizzerías</div></div></a></div>
          <div class="col text-center"><a href="views/categorias/CafeteriaPasteleria.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-coffee categoria-icono"></i><div>Cafeterías Y Pastelerias</div></div></a></div>
          <div class="col text-center"><a href="views/categorias/Parrillas.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-fire categoria-icono"></i><div>Parrillas</div></div></a></div>
          <div class="col text-center"><a href="views/categorias/Vitinicolas.php" class="text-decoration-none text-dark"><div class="card border-0 shadow-sm p-3 categoria-card"><i class="fas fa-wine-glass-alt categoria-icono"></i><div>Vitivinícolas</div></div></a></div>
        </div>
      </div>
    </section>

    <!-- RESTAURANTES DESTACADOS -->
    <section class="py-5  bg-black">
      <div class="container">
        <h2 class="text-center mb-4 text-white"><b>Destacado Del Mes</b></h2>

        <div class="scroll-wrapper">
          <!-- Botones -->
          <button class="scroll-btn left" onclick="scrollRestaurantes(-1)">&#10094;</button>
          <button class="scroll-btn right" onclick="scrollRestaurantes(1)">&#10095;</button>

          <div class="scroll-container" id="restaurantesScroll">
            <!-- Tarjetas -->
            <div class="card scroll-card">
              <img src="public/img/causa_agresiva (2).jpg" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>El Punto Marino</b></h5>
                <p class="card-text">¡Explora el Encanto del Mar en el Punto Marino!</p>
                <a href="views/restaurantes/ElPuntoMarino.php" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="public/img/Chijaukay.jpg" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Mister Wok</b></h5>
                <p class="card-text">¿Antojo de comida china? Descubre el auténtico sabor del chifa en Mister Wok</p>
                <a href="views/restaurantes/MisterWok.php" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="public/img/el_gran_combo restaurante_chincha_c (3).jpg" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>El Gran Combo</b></h5>
                <p class="card-text">Una experiencia gastronómica que celebra las ricas tradiciones culinarias.</p>
                <a href="views/restaurantes/ElGranCombo.php" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="public/img/3.jpg" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Daddy’s Truck’s Burger!</b></h5>
                <p class="card-text">Una experiencia de comida rápida diferente en Chincha.</p>
                <a href="views/restaurantes/DaddyTrick.php" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="public/img/daito (5).jpg" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>DAITO</b></h5>
                <p class="card-text">Exquisita cocina Nikkei, mezcla de Perú y Japón.</p>
                <a href="views/restaurantes/Daito.php" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

            <div class="card scroll-card">
              <img src="public/img/vitivinicola_chincha_san_carlos (1).jpg" class="card-img-top">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><b>Viñedos San Carlos</b></h5>
                <p class="card-text">Una bodega en el pintoresco valle de Sunampe, Chincha, Perú.</p>
                <a href="#" class="btn btn-warning mt-auto"><b>Visitar</b></a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>


   <!-- Mapa Interactivo -->
<section id="mapa" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-4"><b>Encuentra los restaurantes en Chincha</b></h2>
    
    <!-- Contenedor del mapa -->
    <div id="map" style="height: 400px; border-radius: 12px; overflow: hidden;"></div>
    
    <!-- CTA Final -->
    <div class="text-center mt-5">
      <h3 class="mb-3 text-dark"><b>¿Tienes un restaurante? ¡Súmate a Ruta del Sabor y recibe visitas!</b></h3>
      <a href="#contacto" class="btn btn-danger btn-lg px-4 py-2 rounded-pill shadow-sm">
       <b>🍴 Quiero aparecer en la web</b> 
      </a>
    </div>
  </div>
</section>
  </main>

    <!-- Icono flotante de chat inteligente -->
  <a href="#" id="chatbot-fab" title="Chat inteligente">
    <i class="fas fa-robot"></i>
  </a>
  <!-- Chat flotante -->
<div id="chatbot-window" style="display:none; position:fixed; bottom:100px; right:32px; width:320px; background:#fff; border-radius:16px; box-shadow:0 4px 16px rgba(0,0,0,0.2); z-index:10000; overflow:hidden;">
  <div style="background:#007baf; color:#fff; padding:12px; font-weight:bold;">Chat Inteligente
    <span style="float:right; cursor:pointer;" onclick="document.getElementById('chatbot-window').style.display='none'">&times;</span>
  </div>
  <div id="chatbot-messages" style="height:260px; overflow-y:auto; padding:10px; font-size:1rem;"></div>
  <form id="chatbot-form" style="display:flex; border-top:1px solid #eee;">
    <input type="text" id="chatbot-input" autocomplete="off" placeholder="Escribe tu consulta..." style="flex:1; border:none; padding:10px;">
    <button type="submit" style="background:#007baf; color:#fff; border:none; padding:0 16px;">Enviar</button>
  </form>
</div>


  <!-- FOOTER -->
  <?php include 'views/partials/footer.php'; ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
  var map = L.map('map').setView([-13.40985, -76.13235], 14);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(map);

  var restaurantes = [
    { nombre: "El Punto Marino", coords: [-13.412, -76.131], descripcion: "Ceviches y platos marinos." },
    { nombre: "La Choza Náutica", coords: [-13.415, -76.135], descripcion: "Especialidad en arroz con mariscos." },
    { nombre: "Picantería Doña Julia", coords: [-13.408, -76.128], descripcion: "Comida criolla tradicional." }
  ];

  restaurantes.forEach(r => {
    L.marker(r.coords).addTo(map)
      .bindPopup(`<b>${r.nombre}</b><br>${r.descripcion}`);
  });
</script>


  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const selectCategoria = document.querySelector('select[name="categoria"]');
      fetch("http://localhost/RutadelSaborChincha123/controllers/Categoria.php?task=getAll")
        .then(response => response.json())
        .then(data => {
          data.forEach(categoria => {
            const option = document.createElement("option");
            option.value = categoria.idcategoria;
            option.textContent = categoria.nombre;
            selectCategoria.appendChild(option);
          });
        })
        .catch(error => console.error("Error al cargar categorías:", error));
    });

    function scrollRestaurantes(direction) {
      const container = document.getElementById('restaurantesScroll');
      const cardWidth = container.querySelector('.scroll-card').offsetWidth + 16; 
      container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
    }


  // Mostrar/ocultar chat al hacer click en el icono
  document.getElementById('chatbot-fab').onclick = function(e) {
    e.preventDefault();
    var win = document.getElementById('chatbot-window');
    win.style.display = win.style.display === 'none' ? 'block' : 'none';
  };

  // Manejo del chat
  document.getElementById('chatbot-form').onsubmit = async function(e) {
    e.preventDefault();
    const input = document.getElementById('chatbot-input');
    const msg = input.value.trim();
    if(!msg) return;
    addMessage('Tú', msg);
    input.value = '';
    // Enviar al backend PHP
    const res = await fetch('controllers/chatbot.php', {
      method: 'POST',
      headers: {'Content-Type':'application/x-www-form-urlencoded'},
      body: 'msg=' + encodeURIComponent(msg)
    });
    const data = await res.text();
    addMessage('Bot', data);
  };

  function addMessage(sender, text) {
    const box = document.getElementById('chatbot-messages');
    box.innerHTML += `<div><b>${sender}:</b> ${text}</div>`;
    box.scrollTop = box.scrollHeight;
  }

  </script>
</body>
</html>
