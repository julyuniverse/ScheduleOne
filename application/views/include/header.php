<?php
// 로그인 상태
if(isset($_COOKIE['m_idx'])) {
	if(!empty($_COOKIE['m_idx'])) {
		$login_status = "Y";
	}else{
		$login_status = "N";
	}
}else{
	$login_status = "N";
}

#print_r($_COOKIE);
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="57x57" href="<?=base_url('assets/img/favicon/apple-icon-57x57.png')?>">
<link rel="apple-touch-icon" sizes="60x60" href="<?=base_url('assets/img/favicon/apple-icon-60x60.png')?>">
<link rel="apple-touch-icon" sizes="72x72" href="<?=base_url('assets/img/favicon/apple-icon-72x72.png')?>">
<link rel="apple-touch-icon" sizes="76x76" href="<?=base_url('assets/img/favicon/apple-icon-76x76.png')?>">
<link rel="apple-touch-icon" sizes="114x114" href="<?=base_url('assets/img/favicon/apple-icon-114x114.png')?>">
<link rel="apple-touch-icon" sizes="120x120" href="<?=base_url('assets/img/favicon/apple-icon-120x120.png')?>">
<link rel="apple-touch-icon" sizes="144x144" href="<?=base_url('assets/img/favicon/apple-icon-144x144.png')?>">
<link rel="apple-touch-icon" sizes="152x152" href="<?=base_url('assets/img/favicon/apple-icon-152x152.png')?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?=base_url('assets/img/favicon/apple-icon-180x180.png')?>">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=base_url('assets/img/favicon/android-icon-192x192.png')?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?=base_url('assets/img/favicon/favicon-16x16.png')?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url('assets/img/favicon/favicon-32x32.png')?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url('assets/img/favicon/favicon-96x96.png')?>">
<link rel="manifest" href="<?=base_url('assets/img/favicon/manifest.json')?>">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?=base_url('assets/img/favicon/ms-icon-144x144.png')?>">
<meta name="theme-color" content="#ffffff">
<!-- Bootstrap CSS -->
<link href="<?=base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
<!-- Bootstrap JS -->
<script src="<?=base_url('assets/js/bootstrap.bundle.js')?>"></script>
<!-- FullCalendar -->
<link href="<?=base_url('assets/fullcalendar-5.7.2/main.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/fullcalendar-5.7.2/main.js')?>"></script>
<!-- Toast UI color-picker -->
<link href="<?=base_url('assets/toastui/color-picker/tui-color-picker.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/toastui/color-picker/tui-color-picker.js')?>"></script>
<!-- billboard -->
<script src="<?=base_url('assets/billboard.js/billboard.pkgd.js')?>"></script>
<link href="<?=base_url('assets/billboard.js/billboard.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/billboard.js/insight.min.css')?>" rel="stylesheet">
<!-- my css, js -->
<link href="<?=base_url('assets/css/index.css')?>" rel="stylesheet">
<script src="<?=base_url('assets/js/lib.js')?>"></script>
<title><?=$title?></title>
</head>
<body>
<!-- parameter -->
<input type="hidden" id="login_status" value="<?=$login_status?>">
<!-- navbar START -->
<nav class="navbar navbar-expand-lg border-bottom navbar-light">
  <div class="container-fluid col-11">
    <a class="navbar-brand" href="http://3.34.44.32/">ScheduleOne</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/calendar">내 달력</a>
        </li>
				<li class="nav-item">
          <a class="nav-link" href="/expenditure">내 지출</a>
        </li>
      </ul>
      <div class="d-flex">
				<?php if($login_status == "N") { ?>
				<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
					로그인/회원가입
				</button>
				<?php }else{ ?>
				<form action="/main/logout" method="post">
					<button type="submit" class="btn btn-warning" onclick="return confirm('로그아웃하시겠어요?');">
				</form>
					로그아웃
				</button>
				<?php } ?>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						<div class="modal-content">
							<div class="modal-header" style="justify-content: center;">
								<h5 class="modal-title" id="exampleModalLabel">ScheduleOne</h5>
							</div>
							<form action="/main/login" method="post">
								<div class="modal-body">
									<div class="mb-3">
										<label for="exampleFormControlInput1" class="form-label">ID</label>
										<input type="text" name="id" class="form-control" id="exampleFormControlInput1" placeholder="ID를 입력해 주세요">
									</div>
								</div>
								<div class="modal-footer" style="justify-content: center;">								
									<button type="submit" class="btn btn-warning">로그인/회원가입</button>
								</div>
							</form>
						</div>
					</div>
				</div>
      </div>
    </div>
  </div>
</nav>
<!-- navbar END -->