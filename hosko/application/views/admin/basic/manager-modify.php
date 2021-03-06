<?php
  include_once dirname(__DIR__)."/admin-header.php";
?>
<script src="/ckeditor/ckeditor.js"></script>
<body class="bg-1">

	<!-- Preloader -->
	<div class="mask"><div id="loader"></div></div>
	<!--/Preloader -->

	<!-- Wrap all page content here -->
	<div id="wrap">

	  <!-- Make page fluid -->
	  <div class="row">

		<!-- Fixed navbar -->

		<?php
			include_once dirname(__DIR__)."/admin-top.php";
		?>
		<!-- Fixed navbar end -->

		<!-- Page content -->
		<div id="content" class="col-md-12">

		  <!-- page header -->
		  <div class="pageheader">
			<h2><i class="fa fa-puzzle-piece" style="line-height: 48px;padding-left: 5px;"></i> <b>회원정보 수정 </b></h2>
			<div class="breadcrumbs">
			  <ol class="breadcrumb">
				<li>관리자 페이지</li>
				<li><a href="index.html">회원관리</a></li>
				<li class="active">회원정보 수정하기</li>
			  </ol>
			</div>

		  </div>
		  <!-- /page header -->

		  <!-- content main container -->
		  <div class="main">

			<!-- row -->
			<div class="row">

			  <!-- col 6 -->
			  <div class="col-md-12">
				<!-- tile -->
				<section class="tile color transparent-black">

					<!-- tile body -->
					<div class="tile-body">
						<form name="form1" id="form1" method="post">
						<input type="hidden" name="admin_seq" value="<?php echo $info->ADMIN_SEQ; ?>">
						<table class="table table-custom dataTable userTable">
							<colgroup>
								<col width="15%"/>
								<col width="35%"/>
								<col width="15%"/>
								<col width="35%"/>
							</colgroup>
							<tbody>
								<tr>
									<th>등록일</th>
									<td><?php echo $info->ADMIN_REG_DATE; ?></td>
									<th>최종 로그인</th>
									<td><?php echo $info->ADMIN_LAST_LOGIN; ?></td>
								</tr>
								<tr>
									<th>아이디</th>
									<td><input type="text" name="admin_id" value="<?php echo $info->ADMIN_ID; ?>" size="50"></td>
									<th>비밀번호</th>
									<td><input type="password" name="admin_pw" value="" size="50"></td>
								</tr>
								<tr>
									<th>이름</th>
									<td><input type="text" name="admin_name" value="<?php echo $info->ADMIN_NAME; ?>" size="50"></td>
									<th>이메일</th>
									<td><input type="text" name="admin_email" value="<?php echo $info->ADMIN_EMAIL; ?>" size="100"></td>
								</tr>
								<tr>
									<th>연락처</th>
									<td><input type="text" name="admin_tel" value="<?php echo $info->ADMIN_TEL; ?>" size="50"></td>
									<th>휴대폰</th>
									<td><input type="text" name="admin_hp" value="<?php echo $info->ADMIN_HP; ?>" size="50"></td>
								</tr>
								<tr>
									<th>관리자 메모</th>
									<td colspan="3">
										<div class="col-lg-2">
											<input type="checkbox" name="admin_permi" value="basic_all" id="admin_permi1" <?php if (strpos($info->ADMIN_PERMI, "basic_all") > -1) echo "checked"; ?>><label for="admin_permi1">&nbsp;기본설정</label><br/>
											<input type="checkbox" name="admin_permi" value="basic_01" id="admin_permi2" <?php if (strpos($info->ADMIN_PERMI, "basic_01") > -1) echo "checked"; ?>><label for="admin_permi2">&nbsp;사이트정보</label><br/>
											<input type="checkbox" name="admin_permi" value="basic_02" id="admin_permi3" <?php if (strpos($info->ADMIN_PERMI, "basic_02") > -1) echo "checked"; ?>><label for="admin_permi3">&nbsp;관리자 설정</label><br/>
											<input type="checkbox" name="admin_permi" value="basic_03" id="admin_permi4" <?php if (strpos($info->ADMIN_PERMI, "basic_03") > -1) echo "checked"; ?>><label for="admin_permi4">&nbsp;접속통계</label><br/>
											<input type="checkbox" name="admin_permi" value="basic_04" id="admin_permi5" <?php if (strpos($info->ADMIN_PERMI, "basic_04") > -1) echo "checked"; ?>><label for="admin_permi5">&nbsp;회원접속 현황</label><br/>
										</div>
										<div class="col-lg-2">
											<input type="checkbox" name="admin_permi" value="user_all" id="admin_permi6" <?php if (strpos($info->ADMIN_PERMI, "user_all") > -1) echo "checked"; ?>><label for="admin_permi6">&nbsp;<b>회원관리</b></label><br/>
											<input type="checkbox" name="admin_permi" value="user_01" id="admin_permi7" <?php if (strpos($info->ADMIN_PERMI, "user_01") > -1) echo "checked"; ?>><label for="admin_permi7">&nbsp;회원목록</label><br/>
											<input type="checkbox" name="admin_permi" value="user_02" id="admin_permi8" <?php if (strpos($info->ADMIN_PERMI, "user_02") > -1) echo "checked"; ?>><label for="admin_permi8">&nbsp;등급관리</label><br/>
											<input type="checkbox" name="admin_permi" value="user_03" id="admin_permi9" <?php if (strpos($info->ADMIN_PERMI, "user_03") > -1) echo "checked"; ?>><label for="admin_permi9">&nbsp;탈퇴회원</label><br/>
											<input type="checkbox" name="admin_permi" value="user_04" id="admin_permi10" <?php if (strpos($info->ADMIN_PERMI, "user_04") > -1) echo "checked"; ?>><label for="admin_permi10">&nbsp;회원분석</label><br/>
											<input type="checkbox" name="admin_permi" value="user_05" id="admin_permi11" <?php if (strpos($info->ADMIN_PERMI, "user_05") > -1) echo "checked"; ?>><label for="admin_permi11">&nbsp;메일발송 관리</label><br/>
											<input type="checkbox" name="admin_permi" value="user_06" id="admin_permi12" <?php if (strpos($info->ADMIN_PERMI, "user_06") > -1) echo "checked"; ?>><label for="admin_permi12">&nbsp;SMS발송 관리</label><br/>
										</div>
										<div class="col-lg-2">
											<input type="checkbox" name="admin_permi" value="consult_all" id="admin_permi13" <?php if (strpos($info->ADMIN_PERMI, "consult_all") > -1) echo "checked"; ?>><label for="admin_permi13">&nbsp;상담관리</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_01" id="admin_permi14" <?php if (strpos($info->ADMIN_PERMI, "consult_01") > -1) echo "checked"; ?>><label for="admin_permi14">&nbsp;QNA 게시판</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_02" id="admin_permi15" <?php if (strpos($info->ADMIN_PERMI, "consult_02") > -1) echo "checked"; ?>><label for="admin_permi15">&nbsp;온라인 상담</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_03" id="admin_permi16" <?php if (strpos($info->ADMIN_PERMI, "consult_03") > -1) echo "checked"; ?>><label for="admin_permi16">&nbsp;방문상담</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_04" id="admin_permi17" <?php if (strpos($info->ADMIN_PERMI, "consult_04") > -1) echo "checked"; ?>><label for="admin_permi17">&nbsp;정기설명회</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_05" id="admin_permi18" <?php if (strpos($info->ADMIN_PERMI, "consult_05") > -1) echo "checked"; ?>><label for="admin_permi18">&nbsp;전화상담이력</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_06" id="admin_permi19" <?php if (strpos($info->ADMIN_PERMI, "consult_06") > -1) echo "checked"; ?>><label for="admin_permi19">&nbsp;HJOSKO 일정</label><br/>
											<input type="checkbox" name="admin_permi" value="consult_07" id="admin_permi20" <?php if (strpos($info->ADMIN_PERMI, "consult_07") > -1) echo "checked"; ?>><label for="admin_permi20">&nbsp;설명회 일정</label><br/>
										</div>
										<div class="col-lg-2">
											<input type="checkbox" name="admin_permi" value="apply_all" id="admin_permi21" <?php if (strpos($info->ADMIN_PERMI, "apply_all") > -1) echo "checked"; ?>><label for="admin_permi21">&nbsp;수속관리</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_01" id="admin_permi22" <?php if (strpos($info->ADMIN_PERMI, "apply_01") > -1) echo "checked"; ?>><label for="admin_permi22">&nbsp;수속신청현황</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_02" id="admin_permi23" <?php if (strpos($info->ADMIN_PERMI, "apply_02") > -1) echo "checked"; ?>><label for="admin_permi23">&nbsp;수속진횅현황</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_03" id="admin_permi24" <?php if (strpos($info->ADMIN_PERMI, "apply_03") > -1) echo "checked"; ?>><label for="admin_permi24">&nbsp;이력서 관리</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_04" id="admin_permi25" <?php if (strpos($info->ADMIN_PERMI, "apply_04") > -1) echo "checked"; ?>><label for="admin_permi25">&nbsp;수속셔류관리</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_05" id="admin_permi26" <?php if (strpos($info->ADMIN_PERMI, "apply_05") > -1) echo "checked"; ?>><label for="admin_permi26">&nbsp;입금 및 환불</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_06" id="admin_permi27" <?php if (strpos($info->ADMIN_PERMI, "apply_06") > -1) echo "checked"; ?>><label for="admin_permi27">&nbsp;수속포기자</label><br/>
											<input type="checkbox" name="admin_permi" value="apply_07" id="admin_permi28" <?php if (strpos($info->ADMIN_PERMI, "apply_07") > -1) echo "checked"; ?>><label for="admin_permi28">&nbsp;출금 및 증명서</label><br/>
										</div>
										<div class="col-lg-2">
											<input type="checkbox" name="admin_permi" value="board_all" id="admin_permi29" <?php if (strpos($info->ADMIN_PERMI, "board_all") > -1) echo "checked"; ?>><label for="admin_permi29">&nbsp;게시판관리</label><br/>
											<input type="checkbox" name="admin_permi" value="board_01" id="admin_permi30" <?php if (strpos($info->ADMIN_PERMI, "board_01") > -1) echo "checked"; ?>><label for="admin_permi30">&nbsp;게시판관리</label><br/>
											<input type="checkbox" name="admin_permi" value="board_02" id="admin_permi31" <?php if (strpos($info->ADMIN_PERMI, "board_021") > -1) echo "checked"; ?>><label for="admin_permi31">&nbsp;게시판목록</label><br/>
										</div>
									</td>
								</tr>
								<tr>
									<th>관리자 메모</th>
									<td colspan="3">
										<textarea name="admin_memo"><?php echo $info->ADMIN_MEMO; ?></textarea>
									</td>
								</tr>
							</tbody>
						</table>
						</form>
						<div class="row form-footer">
							<div class="col-sm-offset-2 col-sm-10 text-right">
								<a href="/admin/basic/managers" class="btn btn-default btn-sm">취소</a>
								<button type="button" class="btn btn-primary btn-sm" id="saveManager">저장</a>
							</div>
						</div>

					</div>
				  <!-- /tile body -->

				</section>
				<!-- /tile -->

			  </div>
			  <!-- /col 12 -->

			</div>
			<!-- /row -->

		  </div>
		  <!-- /content container -->

		</div>
		<!-- Page content end -->

	  </div>
	  <!-- Make page fluid-->

	</div>
	<!-- Wrap all page content end -->

	<?php
		include_once dirname(__DIR__)."/admin-footer.php";
	?>
</body>
</html>
<script type="text/javascript">
	$(function(){
		$(document).on("click", "#saveManager", function(){
			var admin_seq = $("input[name=admin_seq]").val();
			var admin_id = $("input[name=admin_id]").val();
			var admin_pw = $("input[name=admin_pw]").val();
			var admin_name = $("input[name=admin_name]").val();
			var admin_email = $("input[name=admin_email]").val();
			var admin_tel = $("input[name=admin_tel]").val();
			var admin_hp = $("input[name=admin_hp]").val();
			var admin_memo = $("textarea[name=admin_memo]").val();

			var admin_permi = [];
			$.each($("input:checkbox[name=admin_permi]"), function(){
				if ($(this).is(":checked") == true){
					admin_permi.push($(this).val());
				}
			});

			if (admin_pw != ""){
				if (confirm("비밀번호 입력된내용으로 비밀번호가 변경이 됩니다.\n계속 진행 하시겠습니까?")){
				}else{
					return false;
				}
			}

			$.ajax({
				url:"/admin/basic/managerModifyProc",
				type:"post",
				data:{
					"admin_seq" : admin_seq,
					"admin_id" : admin_id,
					"admin_pw" : admin_pw,
					"admin_name" : admin_name,
					"admin_email" : admin_email,
					"admin_tel" : admin_tel,
					"admin_hp" : admin_hp,
					"admin_permi" : admin_permi,
					"admin_memo" : admin_memo
				},
				dataType:"json",
				success:function(resultMsg){
					if (resultMsg.code == "200"){
						alert(resultMsg.msg);
						document.location.href="/admin/basic/managers";
					}else{
						alert(resultMsg.msg);
					}
				},
				error:function(e){
					console.log(e);
				}
			})
		});
	});
</script>
