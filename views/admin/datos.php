<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard de Datos - Ruta del Sabor Chincha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
</head>
<body>
    <?php include 'dashboard.php'; ?>
  <div class="container my-5">
    <h2 class="mb-4">Dashboard de Datos</h2>

    <!-- Estadísticas rápidas -->
    <div class="row mb-4">
      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm bg-primary text-white">
          <div class="card-body">
            <h5>Categorías</h5>
            <h3 id="totalCategorias">0</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm bg-success text-white">
          <div class="card-body">
            <h5>Restaurantes</h5>
            <h3 id="totalRestaurantes">0</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm bg-warning text-dark">
          <div class="card-body">
            <h5>Platos</h5>
            <h3 id="totalPlatos">0</h3>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-3">
        <div class="card text-center shadow-sm bg-danger text-white">
          <div class="card-body">
            <h5>Usuarios</h5>
            <h3 id="totalUsuarios">0</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Gráficos -->
    <div class="row mb-4">
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Platos por Restaurante</h5>
            <canvas id="chartPlatosRestaurante"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Platos por Categoría</h5>
            <canvas id="chartCategorias"></canvas>
          </div>
        </div>
      </div>
    </div>

    <!-- Tablas de datos -->
    <div class="row">
      <div class="col-12 mb-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Detalle de Platos por Restaurante</h5>
            <table id="tablaPlatos" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Plato</th>
                  <th>Restaurante</th>
                  <th>Categoría</th>
                  <th>Precio</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    async function cargarDatos() {
      try {
        const [categoriasRes, restaurantesRes, platosRes, usuariosRes] = await Promise.all([
          fetch('http://localhost/RutadelSaborChincha123/controllers/Categoria.php?task=getAll'),
          fetch('http://localhost/RutadelSaborChincha123/controllers/Restaurantes.php?task=getAll'),
          fetch('http://localhost/RutadelSaborChincha123/controllers/Platos.php?task=getAll')
          //fetch('http://localhost/RutadelSaborChincha123/controllers/Usuarios.php?task=getAll')
        ]);

        const categorias = await categoriasRes.json() || [];
        const restaurantes = await restaurantesRes.json() || [];
        const platos = await platosRes.json() || [];
        const usuarios = await usuariosRes.json() || [];

        // Estadísticas
        document.getElementById('totalCategorias').innerText = categorias.length;
        document.getElementById('totalRestaurantes').innerText = restaurantes.length;
        document.getElementById('totalPlatos').innerText = platos.length;
        document.getElementById('totalUsuarios').innerText = usuarios.length;

        // Precontar platos por restaurante y categoría
        const platosPorRestaurante = {};
        const platosPorCategoria = {};
        platos.forEach(p => {
          platosPorRestaurante[p.idrestaurante] = (platosPorRestaurante[p.idrestaurante] || 0) + 1;
          platosPorCategoria[p.idcategoria] = (platosPorCategoria[p.idcategoria] || 0) + 1;
        });

        // Gráfico Platos por Restaurante
        const rLabels = restaurantes.map(r => r.nom_restaurante);
        const rData = restaurantes.map(r => platosPorRestaurante[r.idrestaurante] || 0);
        new Chart(document.getElementById('chartPlatosRestaurante'), {
          type: 'bar',
          data: { labels: rLabels, datasets: [{ label: 'Platos', data: rData, backgroundColor: 'rgba(54,162,235,0.7)' }] },
          options: { responsive: true, scales: { y: { beginAtZero: true } } }
        });

        // Gráfico Platos por Categoría
        const cLabels = categorias.map(c => c.nombre);
        const cData = categorias.map(c => platosPorCategoria[c.idcategoria] || 0);
        new Chart(document.getElementById('chartCategorias'), {
          type: 'pie',
          data: { labels: cLabels, datasets: [{ label: 'Platos', data: cData, backgroundColor: ['#ff6384','#36a2eb','#ffce56','#4bc0c0','#9966ff','#ff9f40'] }] },
          options: { responsive: true }
        });

        // Tabla de Platos
        const tbody = document.querySelector('#tablaPlatos tbody');
        tbody.innerHTML = '';
        platos.forEach(p => {
          const categoria = categorias.find(c => c.idcategoria == p.idcategoria)?.nombre || '';
          const restaurante = restaurantes.find(r => r.idrestaurante == p.idrestaurante)?.nom_restaurante || '';
          tbody.innerHTML += `
            <tr>
              <td>${p.nom_platos}</td>
              <td>${restaurante}</td>
              <td>${categoria}</td>
              <td>S/ ${p.precio}</td>
            </tr>`;
        });

        // Reinicializar DataTable
        if ($.fn.DataTable.isDataTable('#tablaPlatos')) {
          $('#tablaPlatos').DataTable().destroy();
        }
        $('#tablaPlatos').DataTable();

      } catch (error) {
        console.error("Error cargando datos:", error);
      }
    }

    cargarDatos();
  </script>
</body>
</html>
