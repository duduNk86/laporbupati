<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_crud extends CI_Model
{
	
	function dateBahasaIndo($date){
	$bulan=array(
			'00'=>'',
			'01'=>'Januari',
			'02'=>'Februari',
			'03'=>'Maret',
			'04'=>'April',
			'05'=>'Mei',
			'06'=>'Juni',
			'07'=>'Juli',
			'08'=>'Agustus',
			'09'=>'September',
			'10'=>'Oktober',
			'11'=>'November',
			'12'=>'Desember',
		);
		$pecah=explode('-',$date);
		$tgl=$pecah[2];
		$bln=$pecah[1];
		$thn=$pecah[0];
		
		
    if( count( $pecah ) == 3 ){
		return $tgl.' '.$bulan[$bln].' '.$thn;
    }
    else{
		return 'Tanggal Tidak Valid';
    }
	}

	function dateBahasaIndo1($date){
		$bulan=array(
				'00'=>'',
				'01'=>'Januari',
				'02'=>'Februari',
				'03'=>'Maret',
				'04'=>'April',
				'05'=>'Mei',
				'06'=>'Juni',
				'07'=>'Juli',
				'08'=>'Agustus',
				'09'=>'September',
				'10'=>'Oktober',
				'11'=>'November',
				'12'=>'Desember',
			);
			$pecah=explode('-',$date);
			$sisa1=$pecah[2];
			$bln=$pecah[1];
			$thn=$pecah[0];

			$pecah=explode(' ',$sisa1);
			$tanggal=$pecah[0];
			$jammenitdetik=$pecah[1];

			return $tanggal.' '.$bulan[$bln].' '.$thn.' '.$jammenitdetik;
	}
	function TanggalBahasaIndo($date){
		$bulan=array(
				'00'=>'',
				'01'=>'Januari',
				'02'=>'Februari',
				'03'=>'Maret',
				'04'=>'April',
				'05'=>'Mei',
				'06'=>'Juni',
				'07'=>'Juli',
				'08'=>'Agustus',
				'09'=>'September',
				'10'=>'Oktober',
				'11'=>'November',
				'12'=>'Desember',
			);
			$pecah=explode('-',$date);
			$sisa1=$pecah[2];
			$bln=$pecah[1];
			$thn=$pecah[0];

			$pecah=explode(' ',$sisa1);
			$tanggal=$pecah[0];

			return $tanggal.' '.$bulan[$bln].' '.$thn;
	}
	function dateBahasaIndo0($date){
		$bulan=array(
				'00'=>'',
				'01'=>'Januari',
				'02'=>'Februari',
				'03'=>'Maret',
				'04'=>'April',
				'05'=>'Mei',
				'06'=>'Juni',
				'07'=>'Juli',
				'08'=>'Agustus',
				'09'=>'September',
				'10'=>'Oktober',
				'11'=>'November',
				'12'=>'Desember',
			);
			$pecah=explode('-',$date);
			$sisa1=$pecah[2];
			$bln=$pecah[1];
			$thn=$pecah[0];

			$pecah=explode(' ',$sisa1);
			$tanggal=$pecah[0];
			$jammenitdetik=$pecah[1];

			return $tanggal.' '.$bulan[$bln].' '.$thn;
	}
	function dateBahasaIndo_timeline($date){
		$bulan=array(
				'00'=>'',
				'01'=>'Januari',
				'02'=>'Februari',
				'03'=>'Maret',
				'04'=>'April',
				'05'=>'Mei',
				'06'=>'Juni',
				'07'=>'Juli',
				'08'=>'Agustus',
				'09'=>'September',
				'10'=>'Oktober',
				'11'=>'November',
				'12'=>'Desember',
			);
			$pecah=explode('-',$date);
			$sisa1=$pecah[2];
			$bln=$pecah[1];
			$thn=$pecah[0];

			$pecah=explode(' ',$sisa1);
			$tanggal=$pecah[0];
			$jammenitdetik=$pecah[1];

			return $tanggal.' '.$bulan[$bln].' '.$thn.' ';
	}


	function get_all_1($table_name, $where)
	{
		$this->db->select('*');
        $this->db->where($where);
		$result = $this->db->get($table_name);
		return $result->result_array();
	}

	function get_all_2($where, $table_name, $fields, $order_by){
		$this->db->select("$fields");
		$this->db->where($where);
		$this->db->order_by($order_by);
		return $this->db->get($table_name);
	}

	public function html_all_wonosobo_menuju_smart_city($table, $where, $limit, $start, $fields, $orderby, $keyword){
    $this->db->select("$fields");
    if($keyword <> ''){
      $this->db->like($orderby, $keyword);
    }
    $this->db->where($where);
    $this->db->order_by($orderby, 'DESC');
    $this->db->limit($limit, $start);
    return $this->db->get($table);
	}
	public function html_all($table, $where, $limit, $start, $fields, $orderby, $keyword){
    $this->db->select("$fields");
    if($keyword <> ''){
      $this->db->like($orderby, $keyword);
    }
    $this->db->where($where);
    $this->db->order_by($orderby, 'DESC');
    $this->db->limit($limit, $start);
    return $this->db->get($table);
	}
		
	function opsi($table_name, $where, $fields, $order_by){
		$this->db->select($fields);
		$this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
	}
	
		public function json_all($table, $where, $fields, $order_by)
		{
		$this->db->select("
		$fields
		");
		$this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table);
		return $result->result_array();
		}
		
	public function json($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }

	public function json_join($where, $limit, $start, $table_name, $fields, $order_by) {
		$this->db->select("
		$fields
		");
		$this->db->join('users', 'users.id_users=operator.id_users');
    $this->db->where($where);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function get_by_id($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function seperti($table_name, $where, $fields, $order_by, $like_data) {
		$this->db->select("$fields");
    $this->db->where($where);
		$this->db->like($like_data);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
	public function get_by_id_join($table_name, $where, $fields, $order_by) {
		$this->db->select("$fields");
		$this->db->join('pengguna', 'pengguna.id_pengguna=operator.id_pengguna');
    $this->db->where($where);
		$this->db->order_by($order_by);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
		
  function check_before_save($table_name, $where)
	{
		$this->db->select('*');
    	$this->db->where($where);
		$result = $this->db->get($table_name);
		return $result->result_array();
	}
		
  function save_data($data, $table_name)
	{
		$this->db->insert( $table_name, $data );
		return $this->db->insert_id();
	}
		
  function update_data($data_update, $where, $table_name)
	{
		$this->db->where($where);
		$this->db->update($table_name, $data_update);
	}
	
	function semua_data($where, $table_name) {	
		$this->db->from($table_name);
		$this->db->where($where);
		return $this->db->count_all_results(); 
	}	
	
	function like_data($where, $table_name, $like_data) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($like_data);
		return $this->db->count_all_results(); 
	}	
	
	function count_search($where, $key_word, $table_name, $field) {	
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->like($field, $key_word);
		return $this->db->count_all_results(); 
	}
		
	public function search($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
        $this->db->where($where);
		$this->db->like($field_like, $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }	
		
	public function search_join($table_name, $fields, $where, $limit, $start, $field_like, $key_word, $order_by) {
		$this->db->select("
		$fields
		");
		$this->db->join('pengguna', 'pengguna.id_pengguna=operator.id_pengguna');
    $this->db->where($where);
		$this->db->like($field_like, $key_word);
		$this->db->order_by($order_by);
		$this->db->limit($limit, $start);
		$result = $this->db->get($table_name);
		return $result->result_array();
    }
	
}