<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtid"]) && !empty($_POST["txtnombre"]) && !empty($_POST["txtapellido"]) && !empty($_POST["txtcargo"])) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $apellido = $_POST["txtapellido"];
        $cargo = $_POST["txtcargo"];

        $sql = $conexion->query("UPDATE empleado SET nombre='$nombre', apellido='$apellido', cargo=$cargo WHERE id_empleado=$id");

        if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "El empleado se ha modificado correctamente",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "Error al modificar empleado",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "ERROR",
                    type: "error",
                    text: "Los campos están vacíos",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php } ?>