<?php
require_once '../connectData.php';
use QTDL\PROJECT\controlDeThi;
use QTDL\PROJECT\controlCauHoi;
use QTDL\PROJECT\controlTraLoi;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
		integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
		</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
		</script>
</head>
<body>
<?php require_once '../Compoinent/header.php' ?>
<?php
    $maDT = isset($_REQUEST['maDT']) ?
    filter_var($_REQUEST['maDT']) : -1;
    $controlDeThi = new controlDeThi($PDO);
    $DeThi = $controlDeThi->getDeThiMaDeThi($maDT);
    $soCauTrongDe = $controlDeThi->getSoCauHoi($maDT);
    $controlCauHoi = new controlCauHoi($PDO);
    $allCauHoi = $controlCauHoi->getCauHoiTheoDeThi($maDT);
    if(!empty($allCauHoi)):
?>
        <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
            <a class="my-3 offset-10 btn btn-success" href="<?=BASE_URL_PATH . 'addCauHoi.php?maDT=' . $DeThi->maDT .'&socau='. $soCauTrongDe ?>">Thêm câu hỏi</a>
            <?php endif?> 
            <h4 style="margin-left: 2%;">Số câu: <?=htmlspecialchars($soCauTrongDe)?>/<?=htmlspecialchars($DeThi->socau)?></h4>
            <?php
    $demCauHoi = 1;
    foreach ($allCauHoi as $cauhoi):?>
        <div style="margin-left: 3%;"><?=htmlspecialchars($demCauHoi)?>/: <?=htmlspecialchars($cauhoi->ndCauHoi)?></div>
        <?php 
            $controlTraLoi = new controlTraLoi($PDO);
            $allTraLoi = $controlTraLoi->getTraLoiTheoCauHoi($cauhoi->maCH);
            foreach ($allTraLoi as $TraLoi):?>
            <?php $TraLoi->dapan==1 ? $colorDapAn = 'red' : $colorDapAn = '' ?>
            <div class="ml-5 m-2" style='color:  <?=$colorDapAn?>;'><?=htmlspecialchars($TraLoi->vitri)?>. <?=htmlspecialchars($TraLoi->ndTraLoi)?></div>
            <?php endforeach?>
            <?php $demCauHoi++?>
            <form class="delete" action="<?=BASE_URL_PATH.'deleteCauHoi.php'?>"					
		method="post" style="display: inline;">
        <input type="hidden" name="maDT"
		value="<?=$maDT?>">
        <input type="hidden" name="maCH"
		value="<?=$cauhoi->maCH?>">
            <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
            <a class="my-3 text-decoration-none btn btn-primary" style="margin-left: 3%;" href="<?=BASE_URL_PATH . 'editCauHoi.php?maDT='.$cauhoi->maDT.'&maCH='.$cauhoi->maCH?>">Sửa</a>
            <button class="btn" type='submit'><i style="color: red; font-size: 30px;" class="fa fa-trash"></i></button>
            <?php endif?>
        </form>
        <?php endforeach?>
    <?php else:?>
        <div class="my-3 offset-2" style="min-height: 500px;">Đề Thi chưa có câu hỏi <br>
        <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
            <a class="offset-9 btn btn-success" href="<?=BASE_URL_PATH . 'addCauHoi.php?maDT=' . $DeThi->maDT .'&socau='. $soCauTrongDe ?>">Thêm câu hỏi</a>
        <?php else:?>
            Đợi Admin thêm câu hỏi
            <?php endif?>    
        </div>
    <?php endif?>     
        <?php require_once '../Compoinent/footer.php' ?>
</body>
</html>