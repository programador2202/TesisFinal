<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Platos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
  <style>
    #tabla-Platos th, #tabla-Platos td {
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      vertical-align: middle;
    }
    #tabla-Platos td img {
      max-width: 100px;
      height: auto;
      display: block;
      margin: 0 auto;
    }
    .table-responsive {
      overflow-x: auto;
    }
  </style>
</head>
<body>
  <?php include 'dashboard.php'; ?>

  <div class="container my-4 mb-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="h4 mb-0">Gestión de Platos</h2>
      <button id="btnPlato" class="btn btn-success btn-sm">
        <i class="fa fa-plus me-2"></i> Nuevo Plato
      </button>
    </div>

    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white"><strong>Platos Registrados</strong></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middle" id="tabla-Platos">
            <thead class="table-primary">
              <tr>
                <th>ID</th>
                <th>Restaurante</th>
                <th>Nombre Plato</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- contenido dinámico -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para Platos -->
  <div class="modal fade" id="modalPlato" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <form id="formPlato" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modaltitle">Nuevo Plato</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="idPlato" name="idPlato" />

            <div class="mb-3">
              <label for="idrestaurante" class="form-label">Restaurante</label>
                <select id="idrestaurante" name="idrestaurante" class="form-select" required>
                    <option value="" selected disabled>Seleccione un restaurante</option>
                </select>
            </div>

            <div class="mb-3">
              <label for="nom_platos" class="form-label">Nombre del Plato</label>
              <input type="text" id="nom_platos" name="nom_platos" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="img" class="form-label">Imagen del Plato</label>
              <input type="file" id="img" name="img" class="form-control" accept="image/*" />
              <small class="text-muted">Formatos permitidos: JPG, PNG, WEBP</small>
              <div class="mt-2">
                <img id="previewImg" src="" alt="Vista previa" class="img-fluid rounded shadow-sm d-none" width="150">
              </div>
            </div>

            <div class="mb-3">
              <label for="descripcion" class="form-label">Descripción</label>
              <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
              <label for="precio" class="form-label">Precio</label>
              <input type="number" step="0.01" id="precio" name="precio" class="form-control" required />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<script>
  // Abrir modal para nuevo plato
  document.getElementById("btnPlato").addEventListener("click", () => {
    const form = document.getElementById("formPlato");
    form.reset();
    document.getElementById("idPlato").value = "";
    document.getElementById("idrestaurante").value = "";
    document.getElementById("previewImg").classList.add("d-none");
    document.getElementById("modaltitle").innerText = "Nuevo Plato";

    new bootstrap.Modal(document.getElementById("modalPlato")).show();
  });

  // Cargar platos
  async function cargarPlatos() {
    try {
      const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Platos.php?task=getAll");
      const data = await response.json();

      const tbody = document.querySelector("#tabla-Platos tbody");
      tbody.innerHTML = "";

      data.forEach(plato => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${plato.idplatos}</td>
          <td>${plato.nom_restaurante}</td>
          <td>${plato.nom_platos}</td>
          <td>${plato.descripcion}</td>
          <td>${plato.precio}</td>
          <td>${plato.imagen ? `<img src="http://localhost/RutadelSaborChincha123/public/img/platos/${plato.imagen}" alt="${plato.nom_platos}" class="img-fluid rounded">` : ''}</td>
          <td>
            <button class="btn btn-sm btn-warning btnEditar" data-id="${plato.idplatos}">
              <i class="fa fa-edit"></i> Editar
            </button>
            <button class="btn btn-sm btn-danger btnEliminar" data-id="${plato.idplatos}">
              <i class="fa fa-trash"></i> Eliminar
            </button>
          </td>
        `;
        tbody.appendChild(tr);
      });

      // Enlazar botones de editar y eliminar
      document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", () => editarPlato(btn.dataset.id));
      });
      document.querySelectorAll(".btnEliminar").forEach(btn => {
        btn.addEventListener("click", () => eliminarPlato(btn.dataset.id));
      });
    } catch (error) {
      console.error("Error cargando platos:", error);
    }
  }
  cargarPlatos();

  // Cargar restaurantes para select
  async function cargarRestaurantes() {
    try {
      const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Restaurantes.php?task=getAll");
      const data = await response.json();

      const selectRestaurante = document.getElementById("idrestaurante");
      selectRestaurante.innerHTML = `<option value="" selected disabled>Seleccione un restaurante</option>`;

      data.forEach(restaurante => {
        const option = document.createElement("option");
        option.value = restaurante.idrestaurante;
        option.textContent = restaurante.nom_restaurante;
        selectRestaurante.appendChild(option);
      });
    } catch (error) {
      console.error("Error cargando restaurantes:", error);
    }
  }
  cargarRestaurantes();

  // Previsualizar imagen
  document.getElementById("img").addEventListener("change", (e) => {
    const file = e.target.files[0];
    const preview = document.getElementById("previewImg");
    if (file) {
      const reader = new FileReader();
      reader.onload = (event) => {
        preview.src = event.target.result;
        preview.classList.remove("d-none");
      };
      reader.readAsDataURL(file);
    } else {
      preview.classList.add("d-none");
    }
  });

  // Crear o actualizar plato
  async function crearPlato(e) {
    e.preventDefault();
    const form = document.getElementById("formPlato");
    const idPlato = document.getElementById("idPlato").value;

    const formData = new FormData(form);
    formData.append("task", idPlato ? "update" : "create");

    try {
      const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Platos.php", {
        method: "POST",
        body: formData
      });

      const result = await response.json();

      if (result.success) {
        Swal.fire({
          icon: "success",
          title: "Éxito",
          text: result.success
        }).then(() => {
          cargarPlatos();
          form.reset();
          document.getElementById("previewImg").classList.add("d-none");
          bootstrap.Modal.getInstance(document.getElementById("modalPlato")).hide();
        });
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: result.error || "Error en la operación."
        });
      }
    } catch (error) {
      console.error("Error en la solicitud:", error);
      Swal.fire({
        icon: "error",
        title: "Error de conexión",
        text: "Hubo un problema al conectar con el servidor."
      });
    }
  }
  document.getElementById("formPlato").addEventListener("submit", crearPlato);

  // Editar plato
  async function editarPlato(idplatos) {
    try {
      const response = await fetch(`http://localhost/RutadelSaborChincha123/controllers/Platos.php?task=getById&idplatos=${idplatos}`);
      const data = await response.json();

      const form = document.getElementById("formPlato");
      document.getElementById("idPlato").value = data.idplatos;
      form.nom_platos.value = data.nom_platos;
      form.descripcion.value = data.descripcion;
      form.precio.value = data.precio;
      form.idrestaurante.value = data.idrestaurante;

      if (data.imagen) {
        const preview = document.getElementById("previewImg");
        preview.src = `http://localhost/RutadelSaborChincha123/public/img/platos/${data.imagen}`;
        preview.classList.remove("d-none");
      }

      document.getElementById("modaltitle").innerText = "Editar Plato";
      new bootstrap.Modal(document.getElementById("modalPlato")).show();

    } catch (error) {
      console.error("Error obteniendo plato:", error);
    }
  }

  // Eliminar plato
  async function eliminarPlato(id) {
    Swal.fire({
      title: "¿Eliminar plato?",
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar"
    }).then(async (result) => {
      if (result.isConfirmed) {
        try {
          const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Platos.php", {
            method: "DELETE",
            body: new URLSearchParams({ task: "delete", idplatos: id })
          });

          const result = await response.json();

          if (result.success) {
            Swal.fire("Eliminado", result.success, "success");
            cargarPlatos();
          } else {
            Swal.fire("Error", result.error || "No se pudo eliminar", "error");
          }
        } catch (error) {
          console.error("Error eliminando plato:", error);
          Swal.fire("Error", "Problema al conectar con el servidor", "error");
        }
      }
    });
  }
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
