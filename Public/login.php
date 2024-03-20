<?php require_once '../connectData.php';
    use QTDL\PROJECT\controlUser;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
		integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
		</script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
		</script>
    <title>Login</title>
    <style>
        .help-block{
            color: red;
        }
    </style>
</head>
<body>
    <?php require_once '../Compoinent/header.php';
    $controlUser= new controlUser($PDO);
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $User = $controlUser->getUsertheoTaiKhoan($_POST);
        if($User->checkUser()){
            $_SESSION['id']=$User->id;
            $_SESSION['user_type']=$User->getUserType();
            $_SESSION['hoten']=$User->hoten;
            redirect(BASE_URL_PATH.'index.php');
        }
        else{
            $error='Sai tài khoản hoặc mật khẩu';
        }
       
    }
    ?>
    <div class="container border border-primary rounded mt-5 text-center shadow" style="width: 500px;">
        <div class="row py-1 pl-4" style="background-color: #0066CC;">
            <h4 class="text-white">Đăng nhập</h4>
        </div>
        <form action="" method='post'>
            <table>
                <tr>
                    <td style="padding-left: 80px;">
                        <label class="py-3 pr-3" for="taikhoan">Tài khoản</label> 
                    </td>
                    <td>
                        <input type="text" name='taikhoan' id='taikhoan'>
                    </td>
                </tr>
                
                <tr>
                    <td style="padding-left: 80px;">
                        <label class="pr-3"for="matkhau">Mật khẩu</label>
                    </td>
                    <td>
                        <input type="password" name='matkhau' id='matkhau' autocomplete="on">
                    </td>
                </tr>
            </table>
            <button class="btn btn-primary my-2" type='submit'>Đăng nhập</button>
        </form>
        <td>
            <?php if (isset($error)) : ?>
                <span class="help-block">
                    <strong><?= htmlspecialchars($error) ?></strong>
                </span>
                <?php endif ?>
        </td>
    </div>
    <div style="height: 180px;"></div>
    <!-- <div style=""> -->
          <?php require_once '../Compoinent/footer.php' ?>
    </div>
</body>
</html>