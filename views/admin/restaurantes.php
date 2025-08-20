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
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Dirección</th>
                <th>Teléfono</th>
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
    // Abrir modal nuevo restaurante
    document.getElementById("btnRestaurante").addEventListener("click", () => {
      document.getElementById("formRestaurante").reset();
      document.getElementById("idRestaurante").value = "";
      //selector de categoría
      document.getElementById("idcategoria").value = "";
      document.getElementById("previewImg").classList.add("d-none");
      document.getElementById("modaltitle").innerText = "Nuevo Restaurante";
    const nom_restaurante = document.querySelector("#nom_restaurante").value;
    const descripcion = document.querySelector("#descripcion").value;
    const direccion = document.querySelector("#direccion").value;
    const telefono = document.querySelector("#telefono").value;
    const idcategoria = document.querySelector("#idcategoria").value;
    const img = document.querySelector("#img").files[0];
      new bootstrap.Modal(document.getElementById("modalRestaurante")).show();
    });

    //mostrar datos en la tabla
    async function cargarRestaurantes() {
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
                <td><img src="${restaurante.img}" alt="${restaurante.nom_restaurante}" width="100" class="img-fluid rounded"></td>
                <td>${restaurante.descripcion}</td>
                <td>${restaurante.direccion}</td>
                <td>${restaurante.telefono}</td>
                <td>
                    <button class="btn btn-sm btn-warning btnEditar" data-id="${restaurante.idrestaurante}"><i class="fa fa-edit"></i>Editar</button>
                    <button class="btn btn-sm btn-danger btnEliminar" data-id="${restaurante.idrestaurante}"><i class="fa fa-trash"></i>Eliminar</button>
                </td>
            `;
            tbody.appendChild(tr);
        });

    }
    cargarRestaurantes();

    //cargar categorías en el select
    async function cargarCategorias() {
        const response = await fetch("http://localhost/RutadelSaborChincha123/controllers/Categoria.php?task=getAll");
        const data = await response.json();
        const selectCategoria = document.getElementById("idcategoria");
        data.forEach(categoria => {
            const option = document.createElement("option");
            option.value = categoria.idcategoria;
            option.textContent = categoria.nombre;
            selectCategoria.appendChild(option);
        });
    }
    cargarCategorias();

// Función para registrar un nuevo restaurante

async function crearRestaurante() {
    const form = document.getElementById("formRestaurante");

    // Tomar valores de los inputs
    const nom_restaurante = form.querySelector("[name='nom_restaurante']").value.trim();
    const descripcion = form.querySelector("[name='descripcion']").value.trim();
    const direccion = form.querySelector("[name='direccion']").value.trim();
    const telefono = form.querySelector("[name='telefono']").value.trim();
    const idcategoria = form.querySelector("[name='idcategoria']").value;
    const img = form.querySelector("[name='img']").files[0]; 

    // Validación simple
    if (!nom_restaurante || !descripcion || !direccion || !telefono || !idcategoria || !img) {
        Swal.fire({
            icon: "warning",
            title: "Campos incompletos",
            text: "Todos los campos son obligatorios."
        });
        return;
    }

    // Armar FormData con todos los campos
    const formData = new FormData();
    formData.append("task", "create");
    formData.append("nom_restaurante", nom_restaurante);
    formData.append("descripcion", descripcion);
    formData.append("direccion", direccion);
    formData.append("telefono", telefono);
    formData.append("idcategoria", idcategoria);
    formData.append("img", img);

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
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: result.error || "Error al crear el restaurante."
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




    
  </script>
</body>
</html>
