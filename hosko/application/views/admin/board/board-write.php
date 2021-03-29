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
			<h2><i class="fa fa-puzzle-piece" style="line-height: 48px;padding-left: 5px;"></i> <b>게시판 등록 </b></h2>
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
						<form id="board_write_form">
						<table class="table table-custom dataTable userTable">
							<colgroup>
								<col width="15%"/>
								<col width="35%"/>
								<col width="15%"/>
								<col width="35%"/>
							</colgroup>
							<tbody>
								<tr>
									<td>카테고리</td>
									<td>
										<select name="board_cate">
											<option>공지사항</option>
											<option>거기거기</option>
											<option>답글답글</option>
										</select>
									
									</td>
								</tr>
								<tr>
									<td>게시판명</td>
									<td><input type="text" name="board_name"></td>
								</tr>
								<tr>
									<td>게시판명(영어)</td>
									<td><input type="text" name="board_name_kor"></td>
								</tr>
								<tr>
									<td>게시판그룹</td>
									<td>
										<select name="board_group">
											<option>공지사항</option>
											<option>거기거기</option>
											<option>답글답글</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>게시판관리자</td>
									<td><input type="text" name="board_admin"></td>
								</tr>
								<tr>
									<td>기능 체크</td>
									<td>
										<label for="fn"><input type="checkbox" name="fn_secret" value="Y"> 비밀글 기능</label>
										<label for="fn"><input type="checkbox" name="fn_recommand" value="Y"> 추천 기능</label>
										<label for="fn"><input type="checkbox" name="fn_viewpage" value="Y"> 뷰페이지 하단 목록 노출</label>
										<label for="fn"><input type="checkbox" name="fn_spamcheck" value="Y"> 스팸체크 기능</label>
										<label for="fn"><input type="checkbox" name="fn_reply" value="Y"> 댓글 기능</label>
									</td>
								</tr>
								<tr>
									<td>파일 업로드 갯수</td>
									<td>
										<select name="file_upload">
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
											<option>7</option>
											<option>8</option>
											<option>9</option>
											<option>10</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>리스트 출력수</td>
									<td>
										<select name="list_view">
											<option>10</option>
											<option>20</option>
											<option>30</option>
											<option>40</option>
											<option>50</option>
											<option>60</option>
											<option>70</option>
											<option>80</option>
											<option>90</option>
											<option>100</option>
										</select>
									</td>
								</tr>
								<tr>
								<td>메모</td>
									<td><input type="text" name="board_memo"></td>
								</tr>
							</tbody>
						</table>

						<div class="row form-footer">
							<div class="col-sm-offset-2 col-sm-10 text-right">
								<button type="button" class="btn btn-default btn-sm" onclick="write_board()">등록하기</button>
								<a href="/admin/board/board_list"
													class="btn btn-primary btn-sm">목록가기</a>

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
	<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> 
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> 
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<script src=" https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/lang/summernote-ko-KR.min.js"></script> -->

<script>
	function write_board(){
		let form = $("#board_write_form").serializeArray();
		console.log(form);
		$.ajax({
			url:"/admin/board/regist_board",
			type:"post",
			data:form,
			dataType:"json",
			success:function(resultMsg){
				let code = resultMsg["code"];
				let msg = resultMsg["msg"];
				if(code == 200){
					alert(msg);
					location.reload();
				} else {
					alert(msg);
				}
			},
			error:function(e){
				console.log(e);
			}
		})
	}
</script>

</body>
</html>



