<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
  header('location:login/login.php');
}

?>

<style>
  ul li:nth-child(1) .activo {
    background-color: rgb(11, 150, 214);
  }
</style>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>

<!-- inicio del contenido principal -->
<div class="page-content">

  <h4 class="text-center text-secondary">ASISTENCIA DE EMPLEADOS</h4>

  <?php
  include "../modelo/conexion.php";
  include "../controlador/controlador_eliminar_asistencia.php";

  $sql = $conexion->query("SELECT 
    a.id_asistencia,
    a.id_empleado,
    a.entrada,
    a.salida,
    e.id_empleado AS empleado_id,
    e.nombre AS empleado_nombre,
    e.apellido AS empleado_apellido,
    e.dni AS empleado_dni,
    e.cargo AS empleado_cargo_id,
    c.id_cargo,
    c.nombre AS cargo_nombre
FROM asistencia AS a
INNER JOIN empleado AS e ON a.id_empleado = e.id_empleado
INNER JOIN cargo AS c ON e.cargo = c.id_cargo");
  ?>

  <div class="text-right mb-2">
    <a href="fpdf/ReporteAsistencia.php" target="_blank" class="btn btn-success"><i class="fa-solid fa-file-pdf"></i> Generar Reportes</a>
  </div>

  <div class="text-right mb-2">
    <a href="reporte_asistencia.php" class="btn btn-primary"><i class="fa-solid fa-plus"></i></i> Mas Reportes</a>
  </div>

  <table class="table table-bordered table-hover col-12" id="example">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">EMPLEADO</th>
        <!-- <th scope="col">DNI</th> -->
        <th scope="col">CARGO</th>
        <th scope="col">ENTRADA</th>
        <th scope="col">SALIDA</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($datos = $sql->fetch_object()) { ?>
        <tr>
          <td><?= $datos->id_asistencia ?></td>
          <td><?= $datos->empleado_nombre . " " . $datos->empleado_apellido ?></td>
          <!-- <td><?= $datos->empleado_dni ?></td> -->
          <td><?= $datos->cargo_nombre ?></td>
          <td><?= $datos->entrada ?></td>
          <td><?= $datos->salida ?></td>
          <td>
            <a href="inicio.php?id=<?= $datos->id_asistencia ?>" onclick="advertencia(event)" class="btn btn-danger"><i class="fa-solid fa-trash "></i></a>
          </td>

        </tr>
      <?php }

      ?>

    </tbody>
  </table>

</div>
</div>
<!-- fin del contenido principal -->


<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>