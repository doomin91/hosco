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
			<h2><i class="fa fa-puzzle-piece" style="line-height: 48px;padding-left: 5px;"></i><b><?php echo $BOARD_INFO->BOARD_NAME;?> 게시글 등록</b></h2>
			<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li>관리자 페이지</li>
				<li>게시판관리</li>
				<li><?php echo $BOARD_INFO->BOARD_NAME;?></li>
				<li>게시글 작성</li>
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
						<form id="post_write_form">
						<table class="table table-custom dataTable userTable">
							<colgroup>
								<col width="15%"/>
								<col width="35%"/>
								<col width="15%"/>
								<col width="35%"/>
							</colgroup>
							<tbody>
								<input type="hidden" name="board_seq" value="<?php echo $BOARD_INFO->BOARD_SEQ ?>">
								<tr>
									<td>제목</td>
									<td><input type="text" name="post_subject" styel="width:100%"></td>
								</tr>
								<tr>
									<td>내용</td>
									<td><textarea type="text" name="post_contents"></textarea></td>
								</tr>

							</tbody>
						</table>

						<div class="row form-footer">
							<div class="col-sm-offset-2 col-sm-10 text-right">
								<button type="button" class="btn btn-default btn-sm" onclick="post_regist()">등록</button>
								<a href="/admin/board/post_list/<?php echo $BOARD_INFO->BOARD_SEQ?>" class="btn btn-primary btn-sm">목록</a>

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
	
<script>
	function post_regist(){
		let form = $("#post_write_form").serializeArray();
		let board_seq = <?php echo $BOARD_INFO->BOARD_SEQ;?>;
		console.log(form);
		$.ajax({
			url:"/admin/board/post_regist",
			type:"post",
			data:form,
			dataType:"json",
			success:function(resultMsg){
				let code = resultMsg["code"];
				let msg = resultMsg["msg"];
				if(code == 200){
					alert(msg);
					location.href="/admin/board/post_list/" + board_seq;
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



