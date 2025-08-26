<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Restaurantes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />
  <style>
    /* Evita desbordes de celdas y recorta texto largo */
    #tabla-Restaurantes th, #tabla-Restaurantes td {
      max-width: 180px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      vertical-align: middle;
    }
    #tabla-Restaurantes td img {
      max-width: 100px;
      height: auto;
      display: block;
      margin: 0 auto;
    }
    /* Permite scroll horizontal si la tabla es muy ancha */
    .table-responsive {
      overflow-x: auto;
    }
  </style>
</head>
<body>
  <?php include 'dashboard.php'; ?>

  <div class="container my-4 mb-5 mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="h4 mb-0">Gestión de Restaurantes</h2>
      <button id="btnRestaurante" class="btn btn-success btn-sm">
        <i class="fa fa-plus me-2"></i> Nuevo Restaurante
      </button>
    </div>

    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white"><strong>Restaurantes Registrados</strong></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-hover align-middle" id="tabla-Restaurantes">
            <thead class="table-primary">
              <tr>
                <th>ID</th>
                <th>Categoría</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Imagenes</th>
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

  <!-- Modal para Restaurantes -->
  <div class="modal fade" id="modalRestaurante" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <form id="formRestaurante" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modaltitle">Nuevo Restaurante</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" id="idRestaurante" name="idRestaurante" />

            <div class="mb-3">
              <label for="idcategoria" class="form-label">Categoría</label>
                <select id="idcategoria" name="idcategoria" class="form-select" required>
                    <option value="" selected disabled>Seleccione una categoría</option>
                </select>
            </div>
                
            <div class="mb-3">
              <label for="nom_restaurante" class="form-label">Nombre del Restaurante</label>
              <input type="text" id="nom_restaurante" name="nom_restaurante" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="img" class="form-label">Imagen</label>
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
              <label for="direccion" class="form-label">Dirección</label>
              <input type="text" id="direccion" name="direccion" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" id="telefono" name="telefono" class="form-control" required />
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Abrir modal para nuevo restaurante
  document.getElementById("btnRestaurante").addEventListener("click", () => {
    const form = document.getElementById("formRestaurante");
    form.reset();
    document.getElementById("idRestaurante").value = "";
    document.getElementById("idcategoria").value = "";
    document.getElementById("previewImg").classList.add("d-none");
    document.getElementById("modaltitle").innerText = "Nuevo Restaurante";

    new bootstrap.Modal(document.getElementById("modalRestaurante")).show();
  });

  // Cargar restaurantes
  async function cargarRestaurantes() {
    try {
      const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Restaurantes.php?task=getAll");
      const data = await response.json();

      const tbody = document.querySelector("#tabla-Restaurantes tbody");
      tbody.innerHTML = "";

      data.forEach(restaurante => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
          <td>${restaurante.idrestaurante}</td>
          <td>${restaurante.categoria}</td>
          <td>${restaurante.nom_restaurante}</td>      
          <td>${restaurante.descripcion}</td>
          <td>${restaurante.direccion}</td>
          <td>${restaurante.telefono}</td>
          <td>
            ${restaurante.img 
              ? `<img src="http://localhost/RutadelSaborChincha123/public/img/restaurantes/${restaurante.img}" 
                     alt="${restaurante.nom_restaurante}" 
                     class="img-fluid rounded" style="max-width:80px; height:auto;">` 
              : ''}
          </td>
          <td>
            <button class="btn btn-sm btn-warning btnEditar" data-id="${restaurante.idrestaurante}">
              <i class="fa fa-edit"></i> Editar
            </button>
            <button class="btn btn-sm btn-danger btnEliminar" data-id="${restaurante.idrestaurante}">
              <i class="fa fa-trash"></i> Eliminar
            </button>
          </td>
        `;
        tbody.appendChild(tr);
      });

      // Enlazar botones de editar y eliminar
      document.querySelectorAll(".btnEditar").forEach(btn => {
        btn.addEventListener("click", () => editarRestaurante(btn.dataset.id));
      });
      document.querySelectorAll(".btnEliminar").forEach(btn => {
        btn.addEventListener("click", () => eliminarRestaurante(btn.dataset.id));
      });
    } catch (error) {
      console.error("Error cargando restaurantes:", error);
    }
  }
  cargarRestaurantes();

  // Cargar categorías
  async function cargarCategorias() {
    try {
      const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Categoria.php?task=getAll");
      const data = await response.json();

      const selectCategoria = document.getElementById("idcategoria");
      selectCategoria.innerHTML = `<option value="" selected disabled>Seleccione una categoría</option>`;

      data.forEach(categoria => {
        const option = document.createElement("option");
        option.value = categoria.idcategoria;
        option.textContent = categoria.nombre;
        selectCategoria.appendChild(option);
      });
    } catch (error) {
      console.error("Error cargando categorías:", error);
    }
  }
  cargarCategorias();

  // Previsualizar imagen antes de subir
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

  // Crear o actualizar restaurante
  async function crearRestaurante(e) {
    e.preventDefault();
    const form = document.getElementById("formRestaurante");
    const idRestaurante = document.getElementById("idRestaurante").value;

    const formData = new FormData(form);
    formData.append("task", idRestaurante ? "update" : "create");

    try {
      const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Restaurantes.php", {
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
          cargarRestaurantes();
          form.reset();
          document.getElementById("previewImg").classList.add("d-none");
          bootstrap.Modal.getInstance(document.getElementById("modalRestaurante")).hide();
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
  document.getElementById("formRestaurante").addEventListener("submit", crearRestaurante);

  // Editar restaurante
  async function editarRestaurante(idrestaurante) {
    try {
      const response = await fetch(`http://localhost/RutadelSaborChincha123/controllers/Restaurantes.php?task=getById&idrestaurante=${idrestaurante}`);
      const data = await response.json();

      const form = document.getElementById("formRestaurante");
      document.getElementById("idRestaurante").value = data.idrestaurante;
      form.nom_restaurante.value = data.nom_restaurante;
      form.descripcion.value = data.descripcion;
      form.direccion.value = data.direccion;
      form.telefono.value = data.telefono;
      form.idcategoria.value = data.idcategoria;

      if (data.img) {
        const preview = document.getElementById("previewImg");
        preview.src = `http://localhost/RutadelSaborChincha123/public/img/restaurantes/${data.img}`;
        preview.classList.remove("d-none");
      } else {
        document.getElementById("previewImg").classList.add("d-none");
      }

      document.getElementById("modaltitle").innerText = "Editar Restaurante";
      new bootstrap.Modal(document.getElementById("modalRestaurante")).show();

    } catch (error) {
      console.error("Error obteniendo restaurante:", error);
    }
  }

  // Eliminar restaurante
  async function eliminarRestaurante(id) {
    Swal.fire({
      title: "¿Eliminar restaurante?",
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
          const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Restaurantes.php", {
            method: "DELETE",
            body: new URLSearchParams({ task: "delete", idrestaurante: id })
          });

          const result = await response.json();

          if (result.success) {
            Swal.fire("Eliminado", result.success, "success");
            cargarRestaurantes();
          } else {
            Swal.fire("Error", result.error || "No se pudo eliminar", "error");
          }
        } catch (error) {
          console.error("Error eliminando restaurante:", error);
          Swal.fire("Error", "Problema al conectar con el servidor", "error");
        }
      }
    });
  }
</script>



</body>
</html>
