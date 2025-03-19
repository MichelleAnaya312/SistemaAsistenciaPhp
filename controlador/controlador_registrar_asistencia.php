<?php

if (!empty($_POST["btnentrada"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];

        $consulta = $conexion->query("SELECT COUNT(*) as 'total' FROM empleado where dni='$dni'");
        $id = $conexion->query("SELECT id_empleado FROM empleado where dni='$dni'");

        if ($consulta->fetch_object()->total > 0) {
            $fecha = date("Y-m-d H:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;

            $consultaFecha = $conexion->query("SELECT entrada FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
            $fechaBD =  $consultaFecha->fetch_object()->entrada;

            if ($fechaBD !== null && substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Ya registraste tu entrada",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php } else {
                $sql = $conexion->query("INSERT INTO asistencia (id_empleado,entrada) VALUES ($id_empleado,'$fecha')");

                if ($sql == true) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "CORRECTO",
                                type: "success",
                                text: "Hola, BIENVENIDO",
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
                                text: "Error al registrar ENTRADA",
                                styling: "bootstrap3"
                            });
                        });
                    </script>
            <?php }
            }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "El DNI ingresado no existe",
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
                    text: "Ingrese el DNI",
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
?>


<!-- REGISTRO DE SALIDA -->
<?php

if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtdni"])) {
        $dni = $_POST["txtdni"];

        $consulta = $conexion->query("SELECT COUNT(*) as 'total' FROM empleado WHERE dni='$dni'");
        $id = $conexion->query("SELECT id_empleado FROM empleado WHERE dni='$dni'");

        if ($consulta->fetch_object()->total > 0) {
            $fecha = date("Y-m-d H:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;

            $busqueda = $conexion->query("SELECT id_asistencia, entrada FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");

            while ($datos = $busqueda->fetch_object()) {
                $id_asistencia = $datos->id_asistencia;
                $entradaBD = $datos->entrada;
            }

            if (substr($fecha, 0, 10) != substr($entradaBD, 0, 10)) {
?>
                <script>
                    $(function notificacion() {
                        new PNotify({
                            title: "INCORRECTO",
                            type: "error",
                            text: "Primero debes registrar tu entrada",
                            styling: "bootstrap3"
                        });
                    });
                </script>
                <?php
            } else {
                $consultaFecha = $conexion->query("SELECT salida FROM asistencia WHERE id_empleado=$id_empleado ORDER BY id_asistencia DESC LIMIT 1");
                $fechaBD = $consultaFecha->fetch_object()->salida;

                if ($fechaBD !== null && substr($fecha, 0, 10) == substr($fechaBD, 0, 10)) { ?>
                    <script>
                        $(function notificacion() {
                            new PNotify({
                                title: "INCORRECTO",
                                type: "error",
                                text: "Ya registraste tu salida",
                                styling: "bootstrap3"
                            });
                        });
                    </script>
                    <?php
                } else {
                    $sql = $conexion->query("UPDATE asistencia SET salida='$fecha' WHERE id_asistencia=$id_asistencia");
                    if ($sql == true) { ?>
                        <script>
                            $(function notificacion() {
                                new PNotify({
                                    title: "CORRECTO",
                                    type: "success",
                                    text: "ADIOS, VUELVE PRONTO",
                                    styling: "bootstrap3"
                                });
                            });
                        </script>
                    <?php
                    } else { ?>
                        <script>
                            $(function notificacion() {
                                new PNotify({
                                    title: "INCORRECTO",
                                    type: "error",
                                    text: "Error al registrar SALIDA",
                                    styling: "bootstrap3"
                                });
                            });
                        </script>
            <?php
                    }
                }
            }
        } else { ?>
            <script>
                $(function notificacion() {
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "El DNI ingresado no existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php
        }
    } else { ?>
        <script>
            $(function notificacion() {
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "Ingrese el DNI",
                    styling: "bootstrap3"
                });
            });
        </script>
    <?php
    } ?>

    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>

<?php }
?>