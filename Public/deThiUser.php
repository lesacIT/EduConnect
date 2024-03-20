<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlMon;
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
    
    <div class="main">
            <?php require_once '../Compoinent/header.php' ?>
            <?php 
                    $id = $_SESSION['id'];
                    $controlMon = new controlMon($PDO);
                    $allMon = $controlMon->getMonTheoUser($id);
                            if(!empty($allMon)):?>
                                <?php foreach($allMon as $mon): ?>
                                    <div class="my-2" style="margin-left: 5%;"><a class="text-decoration-none subject " href="<?=BASE_URL_PATH . 'allTest.php?makhoa='.$mon->makhoa.'&mamon=' . $mon->getIdMon() ?>" class='subject'><?=htmlspecialchars($mon->mamon)?> - <?=htmlspecialchars($mon->tenmon)?></a></div> 
                                    <?php endforeach?>
                                <?php else:?>
                                    <div class="my-2" style="margin-left: 5%; font-weight: bold;">Giảng viên này chưa có môn dạy</div>
                                <?php endif?>
                                <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'):?>
                                    <a href="<?=BASE_URL_PATH . 'addMon.php?makhoa=' . $mon->makhoa ?>">Thêm môn học</a>
                                <?php endif?> 
                        </div>
                    </div>
            <script>console.log('<?=$_SESSION['id']?>')</script>
        </div>
            <div class="footer">
            </div>
            <script src="./js/main.js"></script>    
</body>
</html>