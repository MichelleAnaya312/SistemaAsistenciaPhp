<?php

if (!empty($_POST["btnmodificar"])) {
    if (
        !empty($_POST["txtid"]) && !empty($_POST["txtnombre"]) && !empty($_POST["txttelefono"])
        && !empty($_POST["txtubicacion"]) && !empty($_POST["txtruc"])
    ) {
        $id = $_POST["txtid"];
        $nombre = $_POST["txtnombre"];
        $telefono = $_POST["txttelefono"];
        $ubicacion = $_POST["txtubicacion"];
        $ruc = $_POST["txtruc"];

        $sql = $conexion->query("UPDATE empresa SET nombre='$nombre', telefono='$telefono', ubicacion= '$ubicacion', ruc='$ruc' WHERE id_empresa=$id");
        if ($sql == true) { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "CORRECTO",
                        type: "success",
                        text: "Los datos de la empresa se han modificado correctamente",
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
                        text: "Error al modificar datos de la empresa",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "No se ha enviado el Identificador",
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

<?php }
