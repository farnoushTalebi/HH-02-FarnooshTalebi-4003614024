<?php
$con=mysqli_connect('localhost','farnoush','12345','exc2') or die('con error');
mysqli_set_charset($con,'utf8');
if(isset($_POST['register'])){
	if(!empty($_POST['name'])){
		$query="insert into users (name, family, phone, address, gender, birthDate) values ('{$_POST['name']}', '{$_POST['family']}', '{$_POST['phone']}', '{$_POST['address']}', {$_POST['gender']}, '{$_POST['birthDate']}')";
		mysqli_query($con, $query) or die('query error');
		$msg="کاربر با موفقیت ثبت شد.";
	}
	else
		$error="لطفا نام خود را وارد نمایید.";
}
 elseif(isset($_POST['search'])){
	if(!empty($_POST['sName'])){
		$query="select * from users where name like '%{$_POST['sName']}%'";
		$searchResult=mysqli_query($con, $query) or die('query error');
	}
	else
		$error="لطفا نام موردنظر را وارد نمایید.";
 }
 elseif(isset($_POST['update'])){
	if(!empty($_POST['uName']) && !empty($_POST['uName2'])){
		$query="update users set name='{$_POST['uName2']}' where name='{$_POST['uName']}'";
		mysqli_query($con, $query) or die('query error');
		$msg="کاربر با موفقیت ویرایش شد.";
	}
	else
		$error="لطفا تمامی فیلدها را وارد نمایید.";
 }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>فرنوش طالبی</title>
	<!-- Styles -->
	<link type="text/css" href="css/bootstrap.min.css" rel="stylesheet" />
	<link type="text/css" href="css/style.css" rel="stylesheet" />
	<!-- /Styles -->
</head>
<body class="rtl">
	<div class="container register">
		<div class="row">
			<!-- Right Side Title -->
			<div class="col-12 col-md-3 register-right">
				<img src="https://lh3.googleusercontent.com/proxy/Y0CGe1TvKaivRPOz1P2dPscA9rYzZNxboy6yuHvXQlVKlX5HSIMs3JKJ_kTwLNp7vOhCSIbwJCKCJe1iYmz75smYB8TkxkePdugHNoe7VMbcLprLN8TRqS0LzlhsrGswF__zPWCGixTKP0SkfCNUEbv7MYAymwPUGtoj_fVKBWcINIsmZaTsCbMdVPIZjs2IXnm_W8flqFBpZZNbojAKt272oJvotXhb1RsU4inzVUCHjw" alt=""/>
				<h3>تمرین دوم</h3>
				<p>توسعه اپلیکیشن</p>
				<p>فرنوش طالبی</p>
			</div>
			<!-- /Right Side Title -->
			<!-- Left Side Forms -->
			<div class="col-12 col-md-9">
				<div class="register-left p-3">
					<!-- Tabs Nav-bar -->
					<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ثبت اطلاعات</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="search-tab" data-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false">جستجو</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false" onClick="getUsers()">همه</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">ویرایش</a>
						</li>
					</ul>
					<!-- /Tabs Nav-bar -->
					
					<div class="tab-content" id="myTabContent">
						<!-- Tab 1 -->
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<h3 class="register-heading">ثبت اطلاعات جدید</h3>
							<form action="" method="post">
								<div class="row register-form mx-auto">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<input type="text" name="name" class="form-control" placeholder="* نام" value="" />
										</div>
										<div class="form-group">
											<input type="text" name="birthDate" class="form-control" placeholder=" تاریخ تولد" value="" />
										</div>
										<div class="form-group">
											<textarea name="address" class="form-control" placeholder="آدرس " value=""></textarea>
										</div>
									</div>
									<div class="col-12 col-md-6">
										<div class="form-group">
											<input type="text" name="family" class="form-control" placeholder="نام خانوادگی " value="" />
										</div>
										<div class="form-group">
											<input type="text"  minlength="10" maxlength="11" name="phone" class="form-control" placeholder="شماره تماس" value="" />
										</div>
										<div class="form-group">
											<div class="maxl">
												<label class="radio inline">
													<input type="radio" name="gender" value=1 checked>
													<span> مرد </span>
												</label>
												<label class="radio inline">
													<input type="radio" name="gender" value=0>
													<span>زن </span>
												</label>
											</div>
										</div>
										<input type="submit" name="register" class="btnRegister"  value="ثبت اطلاعات"/>
										<?php
										if(isset($error)){
											echo $error;
										}
										if(isset($msg)){
											echo $msg;
										}
										?>
									</div>
								</div>
							</form>
						</div>
						<!-- /Tab 1 -->
						<!-- Tab 2 -->
						<div class="tab-pane fade show" id="search" role="tabpanel" aria-labelledby="search-tab">
							<h3  class="register-heading">جستجو</h3>
							<form action="" method="post">
								<div class="row register-form mx-auto">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<input type="text" name="sName" class="form-control" placeholder="* نام" value="" />
										</div>
										
										<input type="submit" name="search" class="btnRegister"  value="جستجو"/>
										
									</div>
								</div>
								<div class='sResult'>
									<?php 
									if(isset($searchResult)){
										while($searchUsers=mysqli_fetch_array($searchResult)){
											$gender=($searchUsers['gender']==1)?'مرد':'زن';
											echo "<p>{$searchUsers['name']} {$searchUsers['family']}, {$searchUsers['phone']}, $gender, {$searchUsers['birthDate']}, {$searchUsers['address']}</p>";
										}
									}
									
										if(isset($error)){
											echo $error;
										}
										
									?>
								</div>
							</form>
						</div>
						<!-- /Tab 2 -->
						<!-- Tab 3 -->
						<div class="tab-pane fade show" id="all" role="tabpanel" aria-labelledby="all-tab">
							<h3  class="register-heading">نمایش همه</h3>
							<form action="" method="post">
								<div class="row register-form mx-auto" id="allUsers">
									
								</div>
							</form>
						</div>
						<!-- /Tab 3 -->
						<!-- Tab 4 -->
						<div class="tab-pane fade show" id="update" role="tabpanel" aria-labelledby="update-tab">
							<h3  class="register-heading">به روز رسانی</h3>
							<form action="" method="post">
								<div class="row register-form mx-auto">
									<div class="col-12 col-md-6">
										<div class="form-group">
											<input type="text" name="uName" class="form-control" placeholder="* نام" value="" />
										</div>
										<div class="form-group">
											<input type="text" name="uName2" class="form-control" placeholder="* نام جدید" value="" />
										</div>
										
										<input type="submit" name="update" class="btnRegister"  value="به روز رسانی"/>
										
									</div>
								</div>
								<?php
									if(isset($error)){
										echo $error;
									}
									if(isset($msg)){
										echo $msg;
									}
								?>
								</div>
							</form>
						</div>
						<!-- /Tab 4 -->
					</div>
				</div>
			</div>
			<!-- /Left Side Forms -->
				</div>
	</div>

	<!-- Scripts -->
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
	<!-- /Scripts -->

</body><!-- This template has been downloaded from Webrubik.com -->
</html>
