<?php
    require_once '../connectData.php';
    require_once '../src/searchDethi.php';
    use QTDL\PROJECT\controlDeThi;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả đề thi</title>
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
    <?php require_once '../Compoinent/header.php'; 
    $mamon= isset($_REQUEST['mamon']) ?
    filter_var($_REQUEST['mamon']) : -1;
    $makhoa= isset($_REQUEST['makhoa']) ?
    filter_var($_REQUEST['makhoa']) : -1;
    ?>
    <script>console.log('<?=$_SESSION['id']?>')</script>
    <?php
    $controlDeThi = new controlDeThi($PDO);
    if($mamon<0){
        $allDethi = $controlDeThi->getDeThi();
    }
    else{
        $allDethi = $controlDeThi->getDeThiTheoMon($mamon);
    } 
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $Stringfill = searchDT($_POST['search']);
        $allDethi = $controlDeThi->getDeThiTheoTenMon($Stringfill);
    }
    ?>
    <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
        <div class="offset-10 text-center my-2 py-1" style="width: 120px; border-radius: 5px; ">
            <a class="text-decoration-none btn btn-success" href="<?=BASE_URL_PATH . 'addDeThi.php?makhoa='.$makhoa.'&mamon='.$mamon?>">Thêm Đề Thi</a>
        </div>
    <?php endif?>
    <form class='input-group rounded' action="" method="post" style="width: 500px;">
        <input type="search" style="margin-left: 10%;" name="search" id="search" class="form-control rounded mr-3" placeholder="Search">
        <button class="btn border"><i class="fa fa-search"></i></button>
        <!-- <input type="search" id="site-search" name="search" id="search"> -->
       <!-- Search -->
    </form>
    <table class="offset-1 table my-2" style="width: 80%;">
        <thead>
            <tr>
                <th>Tên đề thi</th>
                <th>Hiệu chỉnh</th> 
            </tr>                    
        </thead>
    <?php foreach($allDethi as $Dethi):?>
               <form class="delete" action="<?=BASE_URL_PATH.'deleteDethi.php'?>"					
		        method="post" style="display: inline;">
                
                    <tr>
                       <td>
                            <a class="text-decoration-none" href="<?=BASE_URL_PATH . 'Test.php?maDT='.$Dethi->maDT.'&tenDT='.$Dethi->tenDT ?>"><?=htmlspecialchars($Dethi->maDT)?> - <?=htmlspecialchars($Dethi->tenDT)?> <br> Ngày thi: <?=htmlspecialchars($Dethi->ngaythi)?> - Thời gian: <?=htmlspecialchars($Dethi->tgthi)?> <br>Số câu: <?=htmlspecialchars($Dethi->getSoCauHoi($Dethi->maDT))?>/<?=htmlspecialchars($Dethi->socau)?>  </a>
                        </td>
                        <input type="hidden" name="maDT"
                        value="<?=$Dethi->maDT?>">
                        <input type="hidden" name="mamon"
                        value="<?=$mamon?>">
                        <input type="hidden" name="makhoa"
                        value="<?=$makhoa?>">
                        <?php if(isset($_SESSION['user_type'])&&$_SESSION['user_type']==='admin'||isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
                            <td>
                                <a class="text-decoration-none font-weight-bold btn btn-primary mr-2" href="<?=BASE_URL_PATH . 'edit.php?makhoa='.$makhoa.'&mamon='.$mamon.'&maDT='.$Dethi->maDT?>">Sửa</a>
                                <span class="font-weight-bold">|</span>
                                <button class="btn" type="submit"><i style="color: red; font-size: 30px;" class="fa fa-trash"></i></button>
                            </td>
                            
                        <?php endif?>  
                    </tr>
                    
                </form>
            
                <br>
        <?php endforeach?>
    </table>
    <div style="min-height: 300px;"></div>
    <script>console.log("<?=$check?>")</script>
    
    <?php require_once '../Compoinent/footer.php' ?>
</body>
</html>