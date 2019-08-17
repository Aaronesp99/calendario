<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CALENDARIO</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<style>
    .row-dias{
        background: #3271a9;
    }
    .row-dias div{
        width: 70px;
        height: 50px;
        color: #fff;
        font-weight: 700;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
    }
    .row-dias2 div{
        width: 70px;
        height: 50px;
        color: #525252;
        font-weight: bold;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
    }

    .row-dias2 div:hover:not(.noDiv){
        background: #f1f1f1;
        color: #2e3756;
        cursor: pointer;
    }
    .calendario{
        box-shadow: 2px 2px 3px #9e9e9e;
    }
    .button{
        border: solid 1.4px;
        text-align: center;
        padding: 8px 11px;
        border-radius: 5px;
    }
    .button:focus{
        outline: none;
    }
    .button-month{
        color: green;
        background: white;
    }
    .button-year{
        color: gray;
        background: white;
    }
    .button-month:hover, .button-year:hover{
        color: white;
    }
    .button-month:hover{
        border: solid 1.4px green;
        background: green;
    }
    .button-year:hover{
        border: solid 1.4px gray;
        background: gray;
    }
</style>
<body>
<?php
setlocale(LC_ALL,"es_ES");

$year = strftime("%Y");
$month = strftime("%m");
$dia = strftime("%d");

if(!empty($_GET)){
    $year = $_GET["year"];
    $month = $_GET["month"];
    $dia = "01";
}

$fecha = $dia."-".$month."-".$year;
$totalMes = date("t", strtotime($fecha));
$inicia = strftime("%u", strtotime("01-".$month."-".$year));

$total = ($inicia + $totalMes - 1);
?>
    <div class="d-flex flex-row justify-content-center" style="margin-top: 100px">
        <div class="calendario">
            <h4 class="text-center my-3">MES: <?php echo ucfirst(strftime("%B", strtotime($fecha))) . "  " . strftime("%Y", strtotime($fecha))?></h4>
            <div class="d-flex flex-row row-dias">
                    <div>LU</div>
                    <div>MA</div>
                    <div>MI</div>
                    <div>JU</div>
                    <div>VI</div>
                    <div>SA</div>
                    <div>DO</div>
            </div>
            <?php 

            $totalDias = 0;
            $totalSemana = 0;
            $nuevoDia = 0;
                for($i = 1; $i<= $total; $i++){
                    $nuevoDia += 1;
                    $totalDias +=1;
                    $color = ($nuevoDia == $dia) ? " style = 'color: #2242b9'" : "style='color: black'";
                    echo ($totalDias == 1 || $totalDias % 8 ==0 )? "<div class='d-flex flex-row row-dias2'>" : "";
                    if($i != $inicia && $inicia != null){
                        echo "<div class='noDiv'></div>"; 
                        $nuevoDia = 0;
                        continue;
                    }else{
                        $inicia = null;
                    }
                    ?>
                    <div <?php echo $color?>><?php echo $nuevoDia?></div>
                    
            <?php
                    if($totalDias % 7 ==0 || $total == $i){ $totalDias = 0; $totalSemana =0; echo "</div>"; }
                    
                }

            if($month == 12){
                $month = 0;
                $year+=1;
            }
            $pathYear = "calendar?year=".($year - 1)."&month=".$month;
            $pathMonth = "calendar?year=".$year."&month=".($month - 1);

            $pathYearMas = "calendar?year=".($year + 1)."&month=".$month;
            $pathMonthMas = "calendar?year=".$year."&month=".($month + 1);

            ?>
            <div class="d-flex flex-row justify-content-around p-3 align-items-center mt-4">
                <div>
                    <a href="<?php echo $pathYear?>"><button class="button button-year"><i class="material-icons align-middle">keyboard_arrow_left</i></button></a>
                    <a href="<?php echo $pathMonth?>"><button class="button button-month"><i class="material-icons align-middle">keyboard_arrow_left</i></button></a>
                </div>
                <div class="text-center">
                    <h5 class="text-success font-weight-bold">Mes</h5>
                    <h5 class="text-secondary font-weight-bold">Año</h5>
                </div>
                <div>
                    <a href="<?php echo $pathMonthMas?>"><button class="button button-month"><i class="material-icons align-middle">keyboard_arrow_right</i></button></a>
                    <a href="<?php echo $pathYearMas?>"><button class="button button-year"><i class="material-icons align-middle">keyboard_arrow_right</i></button></a>
                </div>
            </div>
            <a class="text-center text-decoration-none" href="calendar"><h6 class="text-primary font-weight-bold">Fecha Actual</h6></a>
        <!-- </div> -->
        </div>

    </div>
</body>
</html>