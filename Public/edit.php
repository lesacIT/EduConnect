<?php
    require_once '../connectData.php';
    use QTDL\PROJECT\controlDeThi;
?>
<?php
    $errors = [];
     if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $controlDethi = new controlDeThi($PDO);
        $controlDethi->fillDeThi($_POST);
        if($controlDethi->validate()){
            $controlDethi->saveDeThi()&&redirect(BASE_URL_PATH . 'allTest.php?makhoa='.$Dethi->makhoa.'&mamon=' . $Dethi->mamon );
        }
        $errors = $controlDethi->getValidationErrors();
     } 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật đề thi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
		integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
		</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
		</script>
        <style>
        .help-block{
            color: red;
        }
    </style>
</head>
<body>
    <?php require_once '../Compoinent/header.php' ?>
    <?php
   
    ?>
    <form action="" method="post">
    <?php require_once '../Compoinent/header.php'; 
    $controlDethi = new controlDeThi($PDO);
    $mamon= isset($_REQUEST['mamon']) ?
    filter_var($_REQUEST['mamon']) : -1;
    $makhoa= isset($_REQUEST['makhoa']) ?
    filter_var($_REQUEST['makhoa']) : -1;
    $maDT = isset($_REQUEST['maDT']) ?
    filter_var($_REQUEST['maDT']) : -1;
    $Dethi = $controlDethi->getDeThiMaDeThi($maDT);
    ?>
        <table class="m-auto py-2 table" style="width:50%;">
            <input type="hidden" name="maDT" value="<?=$Dethi->maDT?>">
            <tr>
                <td class="pt-4">
                    <label for="makhoa">Mã khoa</label>
                </td>
                <td class="pt-4">
                    <input type="text" name='makhoa' id="makhoa" value='<?=$Dethi->makhoa?>'>    
                </td>
            </tr>
            <tr>
                <td>
                    <label for="mamon">Mã môn thi</label>
                </td>
                <td>
                    <input type="text" name='mamon' id="mamon" value='<?=$Dethi->mamon?>'>    
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tenDT">Kỳ thi</label>
                </td>
                <td>
                    <input style="width: 240px;" type="text" name='tenDT' id="tenDT" value='<?=$Dethi->tenDT?>'>
                </td>
                <td>
                    <?php if (isset($errors['tenDT'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['tenDT']) ?></strong>
                        </span>
                        <?php endif ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="ngaythi">Ngày thi</label>
                </td>
                <td>
                    <input type="date" name='ngaythi' id='ngaythi' value="<?=$Dethi->ngaythi?>">
                </td>
                <td>
                    <?php if (isset($errors['ngaythi'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['ngaythi']) ?></strong>
                        </span>
                        <?php endif ?>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="tgthi">Thời gian làm bài</label>
                </td>
                <td>
                    <input type="text" name='tgthi' id="tgthi" value="<?=$Dethi->tgthi?>">
                </td>
                <td>
                    <?php if (isset($errors['tgthi'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['tgthi']) ?></strong>
                        </span>
                        <?php endif ?>
                </td>

            </tr>
            <tr>
                <td>
                    <label for="">Số câu hỏi:</label>
                </td>
                <td>
                    <input type="number" name='socau' value='<?=$Dethi->socau?>'>
                </td>
                <td>
                    <?php if (isset($errors['socau'])) : ?>
                        <span class="help-block">
                            <strong><?= htmlspecialchars($errors['socau']) ?></strong>
                        </span>
                        <?php endif ?>
                </td>
            </tr>
        </table>
        <button class="btn btn-success" style="margin-left: 70%;"  type="submit" name="submit" id="submit" >Cập nhật</button>
    </form>
    <?php
    $error = [];
    ?>
    <script>console.log('<?=$Dethi->tenDT?>')</script>
    <script>console.log('<?=$Dethi->ngaythi?>')</script>
    <script>console.log('<?=$Dethi->tgthi?>')</script>
    <script>console.log('<?=$Dethi->makhoa?>')</script>
    <script>console.log('<?=$Dethi->maDT?>')</script>
    <div style="height: 180px;"></div>
    <?php require_once '../Compoinent/footer.php' ?>
</body>
</html>