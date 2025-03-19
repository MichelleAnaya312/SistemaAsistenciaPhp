<?php 
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    
    $sql=$conexion->query("DELETE FROM asistencia WHERE id_asistencia=$id");
    if ($sql == true) {?>
      <script>
            $(function notificacion() {
                new PNotify({
                    title: "CORRECTO",
                    type: "success",
                    text: "Asistencia eliminada correctamente",
                    styling: "bootstrap3"
                });
            });
        </script>

    <?php } else {?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "Error al eliminar asistencia",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php }?>
    
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php }
?>