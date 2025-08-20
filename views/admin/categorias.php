<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion De Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet" />

</head>
<body>
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
    <?php include 'dashboard.php'; ?>
    <div class="container my-4 mb-5 mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="h4 mb-0">Gestión de Categorías</h2>
            <button id="btnCategoria" class="btn btn-success btn-sm">
                <i class="fa fa-plus me-3"></i> Nueva Categoría
            </button>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white"><strong>Categorías Registradas</strong></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tabla-Categorias">
                        <colgroup>
                            <col style="width:15%" />
                            <col style="width:65%" />
                            <col style="width:20%" />
                        </colgroup>
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Categoría</th>
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

    <!-- Modal para Categoría -->
    <div class="modal fade" id="modalcategoria" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="formcategoria">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaltitle">Nueva Categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idCategoria" />
                        <div class="mb-3">
                            <label for="categoria" class="form-label">Nombre de la Categoría</label>
                            <input type="text" id="categoria" class="form-control" required />
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
document.addEventListener('DOMContentLoaded', () => {
    const btnCategoria = document.getElementById('btnCategoria');
    const modalCategoria = new bootstrap.Modal(document.getElementById('modalcategoria'));
    const formCategoria = document.getElementById('formcategoria');
    const tablaBody = document.querySelector("#tabla-Categorias tbody");

    function cargarCategorias() {
        fetch('http://localhost/RutadelSaborChincha123/controllers/Categoria.php?task=getAll')
            .then(response => response.json())
            .then(data => {
                tablaBody.innerHTML = '';
                data.forEach(categoria => {
                    tablaBody.innerHTML += `
                        <tr>
                            <td>${categoria.idcategoria}</td>
                            <td>${categoria.nombre}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editarCategoria(${categoria.idcategoria}, '${categoria.nombre}')">
                                    <i class="fa fa-edit"></i> Editar
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="deleteCategoria(${categoria.idcategoria})">    
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error al cargar categorías:', error));
    }

    btnCategoria.addEventListener('click', () => {
        document.getElementById('idCategoria').value = '';
        document.getElementById('categoria').value = '';
        document.getElementById('modaltitle').textContent = 'Nueva Categoría';
        modalCategoria.show();
    });

    formCategoria.addEventListener('submit', (e) => {
        e.preventDefault();
        const idCategoria = document.getElementById('idCategoria').value;
        const categoria = document.getElementById('categoria').value;

        if (categoria.trim() === '') {
            Swal.fire('Error', 'El nombre de la categoría es obligatorio.', 'error');
            return;
        }

        let url = 'http://localhost/RutadelSaborChincha123/controllers/Categoria.php';
        let task = idCategoria ? 'update' : 'create';

        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                task: task,
                idCategoria: idCategoria,
                categoria: categoria
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Éxito', `Categoría ${task === 'create' ? 'creada' : 'actualizada'} correctamente.`, 'success');
                cargarCategorias();
                modalCategoria.hide();
            } else {
                Swal.fire('Error', data.error || 'No se pudo guardar la categoría.', 'error');
            }
        })
        .catch(error => {
            console.error('Error al guardar categoría:', error);
            Swal.fire('Error', 'Ocurrió un error en la operación.', 'error');
        });
    });

    window.editarCategoria = function(id, nombre) {
        document.getElementById('idCategoria').value = id;
        document.getElementById('categoria').value = nombre;
        document.getElementById('modaltitle').textContent = 'Editar Categoría';
        modalCategoria.show();
    }

    window.deleteCategoria = function(idCategoria) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`http://localhost/RutadelSaborChincha123/controllers/Categoria.php?task=delete&idCategoria=${idCategoria}`, {
                        method: 'DELETE'
                    })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Eliminado', data.message, 'success');
                        cargarCategorias();
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error("Error al eliminar categoría:", error);
                    Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
                });
            }
        });
    }

    cargarCategorias();
});
</script>

</body>
</html>
</body>
</html>