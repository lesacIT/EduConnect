<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlMon;
    use QTDL\PROJECT\controlKhoa;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đề Thi CTU</title>
    <link rel="stylesheet" href="./css/main.css">
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
    
    <div class="main pb-1" style="background-color: #eee;">
        <?php require_once '../Compoinent/header.php' ?>
        <div class="container-fluid" style="width: 95%;">
            <div class="pt-2 mt-2 shadow p-3 mb-5 rounded text-uppercase" style="background-color: white; color:darkblue; font-weight: bold;">Danh Sách Các Khoa</div>
            <div class="shadow p-3 mb-5 rounded" style="background-color: white; color:dark; ">
            <?php 
            $controlKhoa= new controlKhoa($PDO);
            $allKhoa = $controlKhoa->getKhoa();
            foreach($allKhoa as $khoa): ?>
                    <div class='faculty-box' onclick="HandleClick(<?= $khoa->getIdKhoa()?>)">
                        <div class='faculty py-3'><?= htmlspecialchars($khoa->makhoa)?> - <?=htmlspecialchars($khoa->tenkhoa)?></div>
                        <div class='m-4 subject-box' id="<?= $khoa->getIdKhoa()?>">
                            <?php
                            $controlMon= new controlMon($PDO);
                            $makhoa = $khoa->makhoa;
                            $allMon = $controlMon->getMonTheoKhoa($makhoa);
                            if(!empty($allMon)):?>
                                <?php foreach($allMon as $mon): ?>
                                    <div class="shadow-sm p-2 mb-5 bg-white rounded">
                                        <a href="<?=BASE_URL_PATH . 'allTest.php?makhoa='.$makhoa.'&mamon=' . $mon->getIdMon() ?>" class='subject text-decoration-none'>
                                            <?=htmlspecialchars($mon->mamon)?> - <?=htmlspecialchars($mon->tenmon)?></a>
                                    </div> 
                                    <?php endforeach?>
                                <?php else:?>
                                    <div class="shadow-sm p-2 mb-5 bg-white rounded">Khoa này chưa có môn học</div>
                                <?php endif?>
                                <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'):?>
                                    <div class="text-center border border-primary py-1" style="width: 150px; border-radius: 5px;">
                                        <a class="text-decoration-none" href="<?=BASE_URL_PATH . 'addMon.php?makhoa=' . $khoa->makhoa ?>">Thêm môn học</a>
                                    </div>
                                <?php endif?> 
                        </div>
                    </div>
            <?php endforeach?> 
            </div>
        </div>
    </div>

    <?php require_once '../Compoinent/footer.php' ?>
    <script src="./js/main.js"></script>    
</body>
</html>