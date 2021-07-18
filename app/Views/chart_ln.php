<?php

helper('lnChart');
?>
                <!-- Line Chart -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><?php print $caption; ?></h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="line_chart_<?php print $id; ?>" class="graph"></div>
                        </div>
                    </div>
                </div>
                <!-- #END# Line Chart -->
                <?php


if(!isset($_SESSION['LIB']['MORRIS_CART_LIB'])){
    $_SESSION['LIB']['MORRIS_CART_LIB']='Y';
    $_SESSION['FOOTSYSTEM'].='

<script src="'.site_url("template/adminbsb/plugins/raphael/raphael.min.js").'"></script>
<script src="'.site_url("template/adminbsb/plugins/morrisjs/morris.js").'"></script>
    <script src="'.site_url("template/adminbsb/plugins/flot-charts/jquery.flot.js").'"></script>
    <script src="'.site_url("template/adminbsb/plugins/flot-charts/jquery.flot.pie.js").'"></script>
    <script src="'.site_url("template/adminbsb/plugins/flot-charts/jquery.flot.resize.js").'"></script>
    <script src="'.site_url("template/adminbsb/plugins/flot-charts/jquery.flot.categories.js").'"></script>
    <script src="'.site_url("template/adminbsb/plugins/flot-charts/jquery.flot.time.js").'"></script>';

}

$lc=array(
        'data'=>array(
                array(
                'period'=>'2560',
                '2'=>160,
                '5'=>60,
                ),
                array(
                'period'=>'2561',
                '2'=>170,
                '5'=>70,
                ),
                array(
                'period'=>'2562',
                '2'=>170,
                '5'=>70,
                ),
                array(
                'period'=>'2563',
                '2'=>170,
                '5'=>70,
                ),
                array(
                'period'=>'2564',
                '2'=>170,
                '5'=>70,
                ),
            ),
        'color'=>array(
            'red',
            'blue',
        ),
        'label'=>array(
            'ภาคเหนือ',
            'ภาคใต้',
        ),
);

$_SESSION['FOOTSYSTEM'].='
            <script>
            $(function(){
                lineChart_'.$id.'(\'line_chart_'.$id.'\');
            });
                function lineChart_'.$id.'(element) {Morris.Line({
                    element: element,
                    data: ['.ln_gen_data($data).'],
                    '.ln_gen_param($data).'
            });
}
            </script>
            ';