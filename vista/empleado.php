<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(3) .activo {
    background-color: rgb(11, 150, 214);
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">LISTA DE EMPLEADOS</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/controlador_modificar_empleado.php";
  include "../controlador/controlador_eliminar_empleado.php";


  $sql = $conexion->query("SELECT 
e.id_empleado, 
e.nombre,
e.apellido,
c.id_cargo,
c.nombre as 'nom_cargo'
from empleado AS e 
JOIN cargo AS c ON e.cargo = c.id_cargo");
  ?>

  <a href="registro_empleado.php" class="btn btn-primary btn-rounded mb-2"><i class="fa-solid fa-plus"></i> &nbsp; Registrar</a>

  <div class="text-right mb-2">
    <a href="fpdf/ReporteEmpleado.php" target="_blank" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i> Generar Reportes</a>
  </div>

  <table class="table table-bordered table-hover col-12" id="example">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">APELLIDO</th>
        <th scope="col">CARGO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <tr>
          <td><?= $datos->id_empleado ?></td>
          <td><?= $datos->nombre ?></td>
          <td><?= $datos->apellido ?></td>
          <td><?= $datos->nom_cargo ?></td>
          <td>
            <a href="" data-toggle="modal" data-target="#exampleModal<?= $datos->id_empleado ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
            <a href="empleado.php?id=<?= $datos->id_empleado ?>" onclick="advertencia(event)" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash "></i></a>
          </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?= $datos->id_empleado ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title w-100" id="exampleModalLabel">Modificar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div hidden class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="ID" class="input input__text" name="txtid" value="<?= $datos->id_empleado ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Nombre" class="input input__text" name="txtnombre" value="<?= $datos->nombre ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <input type="text" placeholder="Apellido" class="input input__text" name="txtapellido" value="<?= $datos->apellido ?>">
                  </div>
                  <div class="fl-flex-label mb-4 px-2 col-12">
                    <select name="txtcargo" class="input input__select">
                      <?php
                      $sql2 = $conexion->query("SELECT * FROM cargo");

                      while ($datos2 = $sql2->fetch_object()) { ?>
                        <option <?= $datos->id_cargo == $datos2->id_cargo ? 'selected' : '' ?>
                          value="<?= $datos2->id_cargo ?>">
                          <?= $datos2->nombre ?>
                        </option>

                      <?php }
                      ?>
                    </select>
                  </div>

                  <div class="text-right p-2">
                    <a href="empleado.php" class="btn btn-secondary btn-rounded">Atras</a>
                    <button type="submit" value="ok" name="btnmodificar" class="btn btn-primary btn-rounded">Modificar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      <?php }

      ?>

    </tbody>
  </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>