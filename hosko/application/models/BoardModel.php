<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BoardModel extends CI_Model{
    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getBoard($BOARD_SEQ){
        $this->db->where("BOARD_SEQ", $BOARD_SEQ);
        return $this->db->get("TBL_HOSKO_BOARD")->row();
    }
    public function getBoards(){
        $this->db->where("BOARD_DEL_YN", 'Y');
        return $this->db->get("TBL_HOSKO_BOARD")->result();
    }

    public function checkBoardName($BOARD_NAME){
        $this->db->where("BOARD_NAME", $BOARD_NAME);
        return $this->db->get("TBL_HOSKO_BOARD")->row();;
    }

    public function checkBoardKorName($BOARD_KOR_NAME){
        $this->db->where("BOARD_KOR_NAME", $BOARD_KOR_NAME);
        return $this->db->get("TBL_HOSKO_BOARD")->row();;
    }

    public function writeBoard($DATA){
        return $this->db->insert("TBL_HOSKO_BOARD", $DATA);
    }

    public function delBoard($BOARD_SEQ){
        $this->db->where("BOARD_SEQ", $BOARD_SEQ);
        return $this->db->update("TBL_HOSKO_BOARD", array("BOARD_DEL_YN" => 'N'));
    }

    public function getPosts($BOARD_SEQ){
        $this->db->where("POST_BOARD_SEQ", $BOARD_SEQ);
        $this->db->join("TBL_HOSKO_USER AS USER", "USER.USER_SEQ = POST_USER_SEQ", "LEFT");
        $this->db->join("TBL_HOSKO_USER AS ADMIN", "USER.USER_SEQ = POST_ADMIN_SEQ", "LEFT");
        $this->db->join("TBL_HOSKO_BOARD", "BOARD_SEQ = POST_BOARD_SEQ");
        return $this->db->get("TBL_HOSKO_BOARD_POSTS")->result();
    }

    public function getPostsCnt($BOARD_SEQ){
        $this->db->where("POST_BOARD_SEQ", $BOARD_SEQ);
        return $this->db->get("TBL_HOSKO_BOARD_POSTS")->num_rows();
    }

    public function setPost($DATA){
        return $this->db->insert("TBL_HOSKO_BOARD_POSTS", $DATA);
    }
}
