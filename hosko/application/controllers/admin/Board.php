<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Board extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->library('session');
		$this->load->library('pagination');

		$this->load->library('CustomClass');
		//$this->load->library('encrypt');
		$this->load->helper('download');
		$this->load->model("BoardModel");
	}

	/////////////////////
	// 게시판 생성 관리 //
	/////////////////////

	public function board_list(){
		$this->load->view("./admin/board/board-list");
	}

	public function board_write(){
		$this->load->view("./admin/board/board-write");
	}

	public function board_view($BOARD_SEQ){
		$DATA["BOARD"] = $this->BoardModel->getBoard($BOARD_SEQ);
		$this->load->view("./admin/board/board-modify", $DATA);
	}


	public function get_boards(){
		$result = $this->BoardModel->getBoards();
		echo json_encode($result);
	}

	public function del_board(){
		$board_seq = $this->input->post("BOARD_SEQ");

		$result = $this->BoardModel->delBoard($board_seq);

		echo json_encode($result);
	}

	public function regist_board(){
		$board_cate = $this->input->post("board_cate");
		$board_memo = $this->input->post("board_memo");
		$board_name = $this->input->post("board_name");
		$board_name_kor = $this->input->post("board_name_kor");
		$board_group = $this->input->post("board_group");
		$board_admin = $this->input->post("board_admin");
		$fn_secret = $this->input->post("fn_secret");
		$fn_recommand = $this->input->post("fn_recommand");
		$fn_viewpage = $this->input->post("fn_viewpage");
		$fn_spamcheck = $this->input->post("fn_spamcheck");
		$fn_reply = $this->input->post("fn_reply");
		$file_upload = $this->input->post("file_upload");
		$list_view = $this->input->post("list_view");
		$ip_address = $this->customclass->get_client_ip();

		$chk = $this->BoardModel->checkBoardName($board_name);

		if(empty($board_name) || empty($board_name_kor)){
			$resultMsg = array(
				"code" => 202,
				"msg" => "게시판명을 입력해주세요."
			);
			echo json_encode($resultMsg);
			exit;		
		}

		if($chk) {
			$resultMsg = array(
				"code" => 202,
				"msg" => "중복된 게시판명이 존재합니다."
			);
			echo json_encode($resultMsg);
			exit;
		}
		$chk = $this->BoardModel->checkBoardKorName($board_name_kor);
		if($chk) {
			$resultMsg = array(
				"code" => 202,
				"msg" => "중복된 한글 게시판명이 존재합니다."
			);
			echo json_encode($resultMsg);
			exit;
		}
		
		$DATA = array(
		"BOARD_CATEGORY" => $board_cate,
			"BOARD_MEMO" => $board_memo,
			"BOARD_NAME" => $board_name,
			"BOARD_KOR_NAME" => $board_name_kor,
			"BOARD_GROUP" => $board_group,
			"BOARD_ADMIN_ID" => $board_admin,
			"BOARD_FILEUPLOAD_COUNT" => $file_upload,
			"BOARD_LIST_COUNT" => $list_view,
			"BOARD_REG_IP" => $ip_address
		);
		
		$DATA["BOARD_SECRET_FLAG"] = $fn_secret == 'Y' ? $fn_secret : 'N';
		$DATA["BOARD_RECOMMAND_FLAG"] =  $fn_recommand == 'Y' ? $fn_recommand : 'N';
		$DATA["BOARD_BOTTOM_LIST_FLAG"] =  $fn_viewpage == 'Y' ? $fn_viewpage : 'N';
		$DATA["BOARD_SPAM_CHECK_FLAG"] =  $fn_spamcheck == 'Y' ? $fn_spamcheck : 'N';
		$DATA["BOARD_COMMENT_FLAG"] =  $fn_reply == 'Y' ? $fn_reply : 'N';
		
		$return = $this->BoardModel->writeBoard($DATA);
		
		if($return){
			$resultMsg = array(
				"code" => 200,
				"msg" => "\"" . $board_name . "\" 게시판 등록이 완료되었습니다."
			);
		} else {
			$resultMsg = array(
				"code" => 201,
				"msg" => "등록에 실패했습니다. 관리자에게 문의해주세요."
			);
		}

		echo json_encode($resultMsg);
	}

	///////////////////////
	// 생성된 게시판 관리 //
	///////////////////////
	
	public function post_list($BOARD_SEQ){
		$DATA["BOARD_INFO"] = $this->BoardModel->getBoard($BOARD_SEQ);
		$DATA["LIST"] = $this->BoardModel->getPosts($BOARD_SEQ);
		$DATA["LIST_CNT"] = $this->BoardModel->getPostsCnt($BOARD_SEQ);

		$this->load->view("./admin/board/post-list", $DATA);
	}
	
	public function post_view($POST_SEQ){
		$POST_INFO = $this->BoardModel->getPosts($POST_SEQ);
		
		$DATA["BOARD_INFO"] = $this->BoardModel->getBoard($POST_INFO->BOARD_SEQ);
		$DATA["POST_INFO"] = $POST_INFO;
		$this->load->view("./admin/board/post-view", $DATA);
	}

	public function post_write($BOARD_SEQ){
		$DATA["BOARD_INFO"] = $this->BoardModel->getBoard($BOARD_SEQ);
		$DATA["LIST"] = $this->BoardModel->getPosts($BOARD_SEQ);
		$DATA["LIST_CNT"] = $this->BoardModel->getPostsCnt($BOARD_SEQ);

		$this->load->view("./admin/board/post-write", $DATA);
	}

	public function post_regist(){
		$BOARD_SEQ = $this->input->post("board_seq");
		$POST_SUBJECT = $this->input->post("post_subject");
		$POST_CONTENTS = $this->input->post("post_contents");

		$BOARD_INFO = $this->BoardModel->getBoard($BOARD_SEQ);

		if(empty($POST_SUBJECT) || empty($POST_CONTENTS)){
			$returnMsg = array(
				"code" => 202,
				"msg" => "값을 입력해주세요."
			);
			echo json_encode($returnMsg);
			exit;
		}

		$DATA = array(
			"POST_BOARD_SEQ" => $BOARD_SEQ,
			"POST_ADMIN_SEQ" => $BOARD_INFO->BOARD_ADMIN_ID,
			"POST_USER_SEQ" => $this->session->userdata("USER_SEQ"),
			"POST_SUBJECT" => $POST_SUBJECT,
			"POST_CONTENTS" => $POST_CONTENTS,
			"POST_REG_IP" => $this->customclass->get_client_ip()
		);

		$result = $this->BoardModel->setPost($DATA);
		if($result){
			$returnMsg = array(
				"code" => 200,
				"msg" => "등록되었습니다."
			);
		} else {
			$returnMsg = array(
				"code" => 201,
				"msg" => "등록 실패하였습니다."
			);
		}

		echo json_encode($returnMsg);

	}

	
}
