<?php
session_start();
if (isset($_SESSION["cod_usu"])) {
    require_once("../../backend/clase/cliente.class.php");
    $obj_cliente = new cliente;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php require('../public/title.php') ?></title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- DataTables -->
    <link href="../assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



</head>

<body class="">

        <div class="modal" id="add_positivo" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static"></div>
        <div class="modal" id="edit_estudio" tabindex="-1" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static"></div>
        
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <?php require_once('./menu.php'); ?>
    <!-- [ navigation menu ] end -->

    <!-- [ Header ] start -->
    <?php require_once('./topbar.php'); ?>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Clientes En Espera</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <!-- [ Main Content ] start -->
            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-warning">Clientes en estudio de viabilidad</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="bg-dark text-light">
                                                <th>Cedula</th>
                                                <th>Cliente</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>Fijo</th>
                                                <th>Fecha</th>
                                                <th>Opción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $obj_cliente->puntero = $obj_cliente->est_pendiente();
                                            while (($arreglo = $obj_cliente->extraer_dato()) > 0) { ?>
                                                <tr>
                                                    <td><?php echo $arreglo["tipo_cli"] . $arreglo["ced_cli"]; ?></td>
                                                    <td><?php echo $arreglo["nom_cli"]; ?></td>
                                                    <td><?php echo $arreglo["dir_cli"]; ?></td>
                                                    <td><?php echo $arreglo["tel_cli"]; ?></td>
                                                    <td><?php echo $arreglo["tel2_cli"]; ?></td>
                                                    <td><?php echo $obj_cliente->formatearFechaPrimero($arreglo["fec_cli"]); ?></td>
                                                    <td>
                                                        <?php if ($arreglo["estatus_clientes_cod_est_cli"] == 4) { ?>
                                                            <a href="./detalle_contratos.php?cod_cli=<?php echo $arreglo['cod_cli'] ?>" title="Completar Contrato" class="btn  btn-sm btn-info"><i class="fa fa-check"></i></a>
                                                        <?php } else { ?>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#add_positivo" onclick="carga_ajax('<?php echo $arreglo['cod_cli']; ?>','add_positivo','../modal/modal_add_positivo.php');" title="Positivo" class="btn  btn-sm btn-success"><i class="fa fa-check"></i></a>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_estudio" onclick="carga_ajax('<?php echo $arreglo['cod_cli']; ?>','edit_estudio','../modal/modal_edit_estudio.php');" title="Editar" class="btn  btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                                            <!-- <a href="perfil_cliente.php?contrato=<?php echo $arreglo["num_contrato"]; ?>" title="Imprimir" class="btn  btn-sm btn-warning"><i class="fa fa-print"></i></a> -->
                                                            <a href="#" title="Negativo" onclick="addNegativo(<?php echo $arreglo['cod_cli'];?>);" class="btn  btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
            
                <!-- table card-1 end -->
                <!-- table card-2 start -->
                
                <!-- Widget primary-success card end -->

                <!-- prject ,team member start -->
                
                
                <!-- prject ,team member start -->
                <!-- seo start -->
               
               
                <!-- seo end -->

                <!-- Latest Customers start -->
                
                
                <!-- Latest Customers end -->
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="../assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="../assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="../assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="../assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="../assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="../assets/js/vendor-all.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/pcoded.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../modal/idmodal.js"></script>

    <!-- DataTables -->
    <script src="../assets/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
                $('#dataTable2').DataTable();
                $('#dataTable3').DataTable();
                $('#dataTable4').DataTable();
                $('#dataTable5').DataTable();
            });
        </script>

    <!-- Apex Chart -->
    <script src="../assets/js/plugins/apexcharts.min.js"></script>


    <!-- custom-chart js -->
    <script src="../assets/js/pages/dashboard-main.js"></script>

    <!-- Codigo de Funcionamiento -->

    <script>
            const addNegativo = (cod) => {
                console.log(cod);
                Swal.fire({
                    title: '¿Seguro?',
                    text: "El cliente pasara a Estudio Negativo y estara en los estudios que no se pudieron completar",
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, estoy seguro',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            data: "cod_cli="+cod+"&&accion=addNegativo",
                            url: "../../backend/controlador/cliente/cliente.php",
                            type: "POST",
                            success: function(response) {
                                console.log("Creado Exitoso");
                                Swal.fire(
                                    'Estudio Descartado',
                                    '',
                                    'success'
                                )
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire(
                            'No se realizo ningun cambio'
                        )
                    }
                }) 
            }
        </script>

</body>

</html>

<?php
} else {
    header("location: ../../index.php?val=3");
}
?>