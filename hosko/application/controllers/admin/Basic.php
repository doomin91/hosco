<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Basic extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 *      http://example.com/index.php/welcome
	 *  - or -
	 *      http://example.com/index.php/welcome/index
	 *  - or -
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

		$this->load->model("UserModel");
		$this->load->model("BasicModel");

	}

	public function managers(){
		$limit = 10;
		$nowpage = "";
		if (!isset($_GET["per_page"])){
			$start = 0;
		}else{
			$start = ($_GET["per_page"]-1)*10;
			$nowpage = $_GET["per_page"];
		}

		$reg_date_start = isset($_GET["reg_date_start"]) ? $_GET["reg_date_start"] : "";
		$reg_date_end = isset($_GET["reg_date_end"]) ? $_GET["reg_date_end"] : "";
		$last_login_start = isset($_POST["last_login_start"]) ? $_POST["last_login_start"] : "";
		$last_login_end = isset($_POST["last_login_end"]) ? $_POST["last_login_end"] : "";
		$user_type = isset($_GET["user_type"]) ? $_GET["user_type"] : "";
		$searchField = isset($_GET["searchField"]) ? $_GET["searchField"] : "";
		$searchString = isset($_GET["searchString"]) ? $_GET["searchString"] : "";

		$wheresql = array(
						"reg_date_start" => $reg_date_start,
						"reg_date_end" => $reg_date_end,
						"last_login_start" => $last_login_start,
						"last_login_end" => $last_login_end,
						"user_type" => $user_type,
						"searchField" => $searchField,
						"searchString" => $searchString,
						"start" => $start,
						"limit" => $limit
						);
		$lists = $this->BasicModel->getManager($wheresql);
		//echo $this->db->last_query();
		$listCount = $this->BasicModel->getManagerCount($wheresql);
		if ($nowpage != ""){
			$pagenum = $listCount-(($nowpage-1)*10);
		}else{
			$pagenum = $listCount;
		}

		$pagination = $this->customclass->pagenavi("/admin/basic/managers", $listCount, 10, 5, $nowpage);
		//print_r($lists);
		$data = array(
					"reg_date_start" => $reg_date_start,
					"reg_date_end" => $reg_date_end,
					"last_login_start" => $last_login_start,
					"last_login_end" => $last_login_end,
					"user_type" => $user_type,
					"searchField" => $searchField,
					"searchString" => $searchString,
					"lists" => $lists,
					"listCount" => $listCount,
					"pagination" => $pagination,
					"pagenum" => $pagenum,
					"start" => $start,
					"limit" => $limit
					);

		$this->load->view("/admin/basic/manager-list", $data);
	}

	public function managerModify($admin_seq){
		$info = $this->BasicModel->getManagerInfo($admin_seq);

		$data = array(
			"info" => $info
		);
		$this->load->view("/admin/basic/manager-modify", $data);
	}

	public function managerModifyProc(){
		//print_r($this->input->post());
		$admin_seq = $this->input->post("admin_seq");
		$admin_id = $this->input->post("admin_id");
		$admin_pw = $this->input->post("admin_pw");
		$admin_name = $this->input->post("admin_name");
		$admin_email = $this->input->post("admin_email");
		$admin_tel = $this->input->post("admin_tel");
		$admin_hp = $this->input->post("admin_hp");
		$admin_permi = $this->input->post("admin_permi");
		$admin_memo = $this->input->post("admin_memo");

		$update_arr = array(
							"ADMIN_ID" => $admin_id,
							"ADMIN_NAME" => $admin_name,
							"ADMIN_EMAIL" => $admin_email,
							"ADMIN_HP" => $admin_hp,
							"ADMIN_TEL" => $admin_tel,
							"ADMIN_MEMO" => $admin_memo,
							"ADMIN_PERMI" => implode("|",$admin_permi)
							);

		if ($admin_pw != ""){
			//array_push($update_arr, "ADMIN_PW" => md5($admin_pw));
			$update_arr["ADMIN_PW"] = md5($admin_pw);
		}

		$result = $this->BasicModel->updateManager($update_arr, $admin_seq);

		if($result){
			echo json_encode(array("code"=>"200", "msg" => "관리자 정보 수정되었습니다."));
		} else {
			echo json_encode(array("code"=>"202", "msg" => "관리자 정보 수정중 문제가 생겼습니다."));
		}
	}

	public function managerWrite(){
		$this->load->view("/admin/basic/manager-write");
	}

	public function managerWriteProc(){
		$admin_id = $this->input->post("admin_id");
		$admin_pw = $this->input->post("admin_pw");
		$admin_name = $this->input->post("admin_name");
		$admin_email = $this->input->post("admin_email");
		$admin_tel = $this->input->post("admin_tel");
		$admin_hp = $this->input->post("admin_hp");
		$admin_permi = $this->input->post("admin_permi");
		$admin_memo = $this->input->post("admin_memo");

		if (is_array($admin_permi) == true){
			$admin_permi = implode("|",$admin_permi);
		}

		$searchId = $this->BasicModel->getManagerById($admin_id);
		if (!empty($searchId)){
			echo json_encode(array("code"=>"202", "msg" => "이미 등록되어 있는 아이디 입니다."));
			exit;
		}


		$insert_arr = array(
							"ADMIN_ID" => $admin_id,
							"ADMIN_PW" => md5($admin_pw),
							"ADMIN_NAME" => $admin_name,
							"ADMIN_EMAIL" => $admin_email,
							"ADMIN_HP" => $admin_hp,
							"ADMIN_TEL" => $admin_tel,
							"ADMIN_MEMO" => $admin_memo,
							"ADMIN_PERMI" => $admin_permi,
							"ADMIN_DEL_YN" => "N",
							"ADMIN_REG_DATE" => date("Y-m-d H:i:s"),
							"ADMIN_REG_ID" => $this->session->userdata("ADMIN_ID"),
							"ADMIN_REG_IP" => $_SERVER["REMOTE_ADDR"]
							);

		$result = $this->BasicModel->insertManager($insert_arr);

		if($result){
			echo json_encode(array("code"=>"200", "msg" => "관리자 정보 등록되었습니다."));
		} else {

		}
	}

	public function managerDeleteProc(){
		$admin_seq = $this->input->post("admin_seq");

		$result = $this->BasicModel->deleteManager($admin_seq);

		if($result){
			echo json_encode(array("code"=>"200", "msg" => "관리자 정보 삭제되었습니다."));
		} else {
			echo json_encode(array("code"=>"202", "msg" => "관리자 정보 삭제중 문제가 생겼습니다."));
		}
	}

	public function siteInfo(){
		$info = $this->BasicModel->getSiteInfo();
		$this->load->view("/admin/basic/site-info");
	}
}
