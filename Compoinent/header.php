<?php session_start();?>
<div class="header" style="background-color: #0066CC;">
		<div class="border-bottom py-2">
			<h2 class="text-uppercase text-white text-center">Hệ thống quản lý đề thi trắc nghiệm</h2>
		</div>
		
        <div class="navbar-nav nav navbar-expand-md ml-3 py-2" style="font-size: 17px;">
			<a href="<?=BASE_URL_PATH . 'index.php'?>" class="nav-link mr-3 text-white">Trang chủ</a>
			<a href="<?=BASE_URL_PATH . 'allTest.php?makhoa='.'&mamon='?>" class="nav-link mr-3 text-white ">Đề Thi</a>
			<?php if(!empty($_SESSION['id'])&&isset($_SESSION['user_type'])&&$_SESSION['user_type']==='teacher'):?>
			<a href="<?=BASE_URL_PATH . 'deThiUser.php'?>" class="nav-link mr-3 text-white ">Dạy</a>
			<?php endif?>
			<?php if(empty($_SESSION['id'])):?>
				<a href="<?=BASE_URL_PATH.'login.php'?>" class="nav-link mr-3 text-white offset-8" style="padding-left: 65px">Đăng nhập</a>
				<a href="<?=BASE_URL_PATH.'register.php'?>" class="nav-link mr-3 text-white ">Đăng ký</a>
				<?php elseif($_SESSION['user_type']==='admin') :?>
					<a href="<?=BASE_URL_PATH.'admin.php'?>" class="nav-link mr-3 text-white offset-8" style="padding-left: 70px">
						<i class="fa fa-user-circle"></i> <?=htmlspecialchars($_SESSION['hoten'])?></a>
					<a href="<?=BASE_URL_PATH.'logout.php'?>" class="nav-link mr-3 text-white ">Đăng xuất</a>
					<?php else :?>
						<a href="<?=BASE_URL_PATH.'index.php'?>" class="nav-link mr-3 text-white offset-7" style="padding-left: 45px">	
							<i class="fa fa-user-circle"></i> <?=htmlspecialchars($_SESSION['hoten'])?></a>
						<a href="<?=BASE_URL_PATH.'logout.php'?>" class="nav-link mr-3 text-white ">Đăng xuất</a>

					<?php endif?>
			
		</div>
</div>