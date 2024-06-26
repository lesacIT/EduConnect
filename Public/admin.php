<?php 
require_once '../connectData.php';
use QTDL\PROJECT\controlUser;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quyền admin</title>
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
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $controlUser = new controlUser($PDO);        
        $User = $controlUser->getUsertheoID($id);
        if(isset($_POST['id'])){
            if($User->getUserType()==='user'){
                $User->adminLaw();
                $_POST['id']='';
            }
            else{
                $User->deleteAdminLaw();
                $_POST['id']='';
            }
        }
    }
    ?>
    <?php require_once '../Compoinent/header.php'; ?>
    <?php 
    $controlUser = new controlUser($PDO);
    $allUser = $controlUser->getUser();
    foreach($allUser as $User):?>
        <?php if($User->getUserType()!='admin'): ?>
        <form action="" method='post'>
            <input type="hidden" name='id' id='id' value="<?=$User->id?>">
            <?php if($User->getUserType()==='user'):?>
            <div class="my-3" style="margin-left: 5%;"><?=htmlspecialchars($User->hoten)?> - <button class="btn btn-secondary" type="submit">
                Cấp quyền giáo viên
            </button></div>
            <?php else :?>
            <div class="my-3" style="margin-left: 5%;"><?=htmlspecialchars($User->hoten)?> - <button class="btn btn-secondary" type="submit">
                Xóa quyền giáo viên
            </button></div>
                <?php endif?>
        </form>
        <?php endif?>
    <?php endforeach?>
    <script>console.log('<?=$_POST["id"]?>')</script>
    <div style="min-height: 325px;"></div>
    <?php require_once '../Compoinent/footer.php' ?>

</body>
</html>