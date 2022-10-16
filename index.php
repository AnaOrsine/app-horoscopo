<?php

if(isset($_POST['diaMes'])){

    $rawDataPesq = explode('/',$_POST['diaMes']);
    $dataPesquisa = date('Y-m-d', strtotime('2022-'.$rawDataPesq[1].'-'.$rawDataPesq[0]));
    $dataPesquisa = $dataPesquisa < '2022-01-20' ? date('Y-m-d', strtotime("+1 Year", strtotime($dataPesquisa))) : $dataPesquisa;


    // Transformando arquivo XML em Objeto
    $xml = simplexml_load_file('signos.xml');


    foreach ($xml->signo as $signo) {

        //Tratando data de inicio
        $rawInicio = explode('/',$signo->dataInicio);
        $dataInicio = date('Y-m-d', strtotime('2022-'.$rawInicio[1].'-'.$rawInicio[0]));


        //Tratando data de dataFim
        $rawFim = explode('/',$signo->dataFim);
        $dataFim = $dataInicio == '2022-12-22' ? date('Y-m-d', strtotime("+29 days", strtotime($dataInicio))) : date('Y-m-d', strtotime('2022-'.$rawFim[1].'-'.$rawFim[0]));

        /*
        echo '<br>';
        echo $dataPesquisa.' | '.$dataInicio.' | '.$dataFim;
        echo '<hr>';
        */



        //Valida o periodo da data
        if(  $dataPesquisa >= $dataInicio && $dataPesquisa <= $dataFim ){
           $resultado = $signo;
         //  print_r($resultado);
           
        }

        
    }


}






?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2" >
                
            </div>
            <div class="col-8" >
                <br>
                <div class="row">
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Dia e mes Nascimento</label>
                            <input type="text" class="form-control" name="diaMes" data-mask="00/00" >
                        </div>
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </form>
                </div>
            </div>
            <div class="col-2" >
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <?php if(isset($resultado)) { ?>
                <div class="card" >
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $resultado->signoNome; ?></h5>
                        <br>
                        <h6 class="card-subtitle mb-2 text-muted">Descrição</h6>
                        <p class="card-text"><?php echo $resultado->descricao; ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="col2"></div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>               
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
     
<script>
    jQuery(function($){
        $("#diaMes").mask("99/99");
    });
</script>
  </body>
</html>