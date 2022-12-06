
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_model extends CI_Model
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
		return $tgl.' '.$bulan[$bln].' '.$thn;
	}
	
  public function json_tampil($fields, $table, $where, $start, $limit, $order_by, $shorting, $join)
  {
    $this->db->select("$fields");
    if ($join == 0) {
 
    } else if ($join == 1) {

      $this->db->join('monev', 'monev.id_admin=sub_monev.id_sub_monev');
      $this->db->join('lokal_monev', 'lokal_monev.id_sub_monev=sub_monev.id_sub_monev');
    } else if ($join == 2) {

      $this->db->join('sub_monev', 'sub_monev.id_sub_monev=lokal_monev.id_sub_monev');
      $this->db->join('pengguna', 'pengguna.user_id=lokal_monev.created_by');
      $this->db->join('admin', 'admin.nip_admin=pengguna.user_name');
    } else {
    }
    $this->db->where($where);
    $this->db->order_by($order_by, $shorting);
    $this->db->limit($limit, $start);
    $result = $this->db->get($table);
    return $result->result_array();
  }
  function semua_tampil($table, $where, $join)
  {
    $this->db->from($table);
    if ($join == 0) {
    } else if ($join == 2) {
      $this->db->join('admin', 'admin.id_admin=lokal_monev.id_admin');
      $this->db->join('users', 'users.user_id=lokal_monev.created_by');
      $this->db->join('admin', 'admin.nip_admin=users.user_name');
    } else {
    }
    $this->db->where($where);
    return $this->db->count_all_results();
  }

  public function json_cari($fields, $table, $where, $start, $limit, $order_by, $shorting, $kata_kenci, $like1, $like2, $join)
  {
    $this->db->select("$fields");
    if ($join == 0) {
    } else if ($join == 2) {
      $this->db->join('admin', 'admin.id_admin=lokal_monev.id_admin');
      $this->db->join('users', 'users.user_id=lokal_monev.created_by');
      $this->db->join('admin', 'admin.nip_admin=users.user_name');
    } else {
    }
    $this->db->like($like1, $kata_kenci);
    $this->db->or_like($like2, $kata_kenci);
    $this->db->where($where);
    $this->db->order_by($order_by, $shorting);
    $this->db->limit($limit, $start);
    $result = $this->db->get($table);
    return $result->result_array();
  }
  
  public function json_tampil_cari($fields, $table, $where, $start, $limit, $order_by, $shorting, $join, $fieldlike, $keyword)
  {
    $this->db->select("$fields");
    if ($join == 0) {
      } 
    else if ($join == 2) {
      } 
    else 
      {
      }
    $this->db->like($fieldlike, $keyword);
    $this->db->where($where);
    $this->db->order_by($order_by, $shorting);
    $this->db->limit($limit, $start);
    $result = $this->db->get($table);
    return $result->result_array();
  }
  
  function semua_tampil_cari($table, $where, $join, $fieldlike, $keyword)
  {
    $this->db->from($table);
    if ($join == 0) {
    } else {
    }
    $this->db->like($fieldlike, $keyword);
    $this->db->where($where);
    return $this->db->count_all_results();
  }

  function semua_cari($table, $where, $kata_kenci, $like1, $like2, $join)
  {
    $this->db->from($table);
    if ($join == 0) {
    } else {
    }
    $this->db->like($like1, $kata_kenci);
    $this->db->or_like($like2, $kata_kenci);
    $this->db->where($where);
    return $this->db->count_all_results();
  }

  public function json_cari_like1($fields, $table, $where, $start, $limit, $order_by, $shorting, $kata_kenci, $like1, $join) ///Digunakan untuk mengambil data dengan parameter like hanya 1 field
  {
    $this->db->select("$fields");
    if ($join == 0) {
    } else if ($join == 1) {

      $this->db->join('admin', 'admin.id_admin=lokal_monev.id_admin');
    } else if ($join == 2) {

      $this->db->join('admin', 'admin.id_admin=lokal_monev.id_admin');
      $this->db->join('users', 'users.user_id=lokal_monev.created_by');
      $this->db->join('admin', 'admin.nip_admin=users.user_name');
    } else {
    }
    $this->db->like($like1, $kata_kenci);
    $this->db->where($where);
    $this->db->order_by($order_by, $shorting);
    $this->db->limit($limit, $start);
    $result = $this->db->get($table);
    return $result->result_array();
  }



  function simpan($data, $table)
  {
    $this->db->insert($table, $data);
    return $this->db->insert_id();
  }

  function update($data, $where, $table)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }

  public function hapus($where,$table)
  {
    $this->db->where($where);
    return $this->db->delete($table); 
  }

  

  function view_all($where, $table)
	{
		$this->db->select("*");
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result;
  }
  
  function view_penerima_sanitasi($fields, $where, $table)
	{
		$this->db->select("$fields");
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result;
  }
  
  function view_field($fields, $where, $table)
	{
		$this->db->select("$fields");
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result;
  }
  
  function view_penerima_sanitasi_byid($where, $table)
	{
		$this->db->select("*");
		$this->db->where($where);
		$result = $this->db->get($table);
		return $result;
	}
}