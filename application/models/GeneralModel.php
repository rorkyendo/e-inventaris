<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class GeneralModel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  function get_general($table)
  {
    $query = $this->db->get($table);
    return $query->result();
  }

  function get_general_group_by($table,$group_by)
  {
    $query = $this->db->query("SELECT * FROM $table GROUP BY $group_by");
    return $query->result();
  }

  function get_by_id_general_group_by($table,$id,$val,$group_by)
  {
    $query = $this->db->query("SELECT * FROM $table WHERE $id = $val GROUP BY $group_by");
    return $query->result();
  }

  function get_general_order_by($table,$by,$order)
  {
    return $query = $this->db->query("SELECT * FROM $table ORDER BY $by $order")->result();
  }

  function get_by_from_end_date($table,$from,$end,$col){
    return $this->db->query("SELECT * FROM $table WHERE DATE_FORMAT($col,'%Y-%m-%d') >= '$from' and DATE_FORMAT($col,'%Y-%m-%d') <= '$end'")->result();
  }

  function get_by_from_end_date_by_id($table, $from, $end, $col, $id, $val)
  {
    return $this->db->query("SELECT * FROM $table WHERE 
    DATE_FORMAT($col,'%Y-%m-%d') >= '$from' and DATE_FORMAT($col,'%Y-%m-%d') <= '$end' and $id = '$val'")->result();
  }

  function get_by_id_general_order_by($table,$id,$val,$by,$order)
  {
    return $query = $this->db->query("SELECT * FROM $table WHERE $id = $val ORDER BY $by $order")->result();
  }

  function truncate_general($table)
  {
    return $this->db->query("TRUNCATE TABLE $table");
  }

  function count_general($table)
  {
    return $this->db->query("SELECT COUNT(*) as jumlah FROM $table")->row();
  }

  function count_by_id_general($table, $id, $val)
  {
    return $this->db->query("SELECT COUNT(*) as jumlah FROM $table WHERE $id = '$val'")->row();
  }


  function count_by_multi_id_general($table, $id, $val, $id2, $val2)
  {
    return $this->db->query("SELECT COUNT(*) as jumlah FROM $table WHERE $id = '$val' and $id2 = '$val2'")->row();
  }

  function get_by_id_general($table, $id, $val)
  {
    $query = $this->db->where($id, $val)->get($table);
    return $query->result();
  }

  function get_like_general($table, $id, $val)
  {
    $query = $this->db->query("SELECT * FROM $table WHERE $id LIKE '%$val'");
    return $query->result();
  }

  function create_general($table, $data)
  {
    return $this->db->insert($table, $data);
  }

  function update_general($table, $id, $val, $data)
  {
    $this->db->where($id, $val);
    return $this->db->update($table, $data);
  }

  function delete_general($table, $id, $val)
  {
    $this->db->where($id, $val);
    return $this->db->delete($table);
  }

  function limit_general($table, $limit)
  {
    return $this->db->query("SELECT * FROM $table LIMIT $limit")->result();
  }

  function limit_general_order_by($table, $order_by, $order ,$limit)
  {
    return $this->db->query("SELECT * FROM $table ORDER BY $order_by $order LIMIT $limit")->result();
  }

  function limit_by_id_general_order_by($table, $id, $val, $order_by, $order ,$limit)
  {
    return $this->db->query("SELECT * FROM $table WHERE $id = '$val' ORDER BY $order_by $order LIMIT $limit")->result();
  }

  function paginate_general($table,$limit,$start){
    return $this->db->get($table, $limit, $start)->result();
  }

  function paginate_by_id_general($table,$id,$val,$limit,$start)
  {
    $this->db->where($id,$val);
    return $this->db->get($table, $limit, $start)->result();
  }

  function paginate_by_multi_id_general($table, $id, $val, $id2, $val2, $limit, $start)
  {
    $this->db->where($id, $val);
    $this->db->where($id2, $val2);
    return $this->db->get($table, $limit, $start)->result();
  }

  function paginate_by_like_general($table, $id, $val, $limit, $start)
  {
    $this->db->like($id, $val);
    return $this->db->get($table, $limit, $start)->result();
  }

  function getRandomPostLimit($table,$id,$val,$limit){
    return $this->db->query("SELECT * FROM $table WHERE $id != '$val' ORDER BY RAND() LIMIT $limit")->result();
  }

  function get_kode_selects($id,$val)
  {
    return $this->db->query("SELECT * FROM disdik_kode_selects WHERE $id = '$val' and status = 'aktif'")->result();
  }

  function getTrackData($table,$id,$val){
    return $this->db->query("SELECT p1.nama_lengkap_pengguna as dibuat_oleh,t.created_time as dibuat_pada, p2.nama_lengkap_pengguna as diupdate_oleh, t.updated_time as diupdate_pada
    FROM $table t LEFT JOIN v_pengguna p1 ON t.created_by = p1.uuid_pengguna LEFT JOIN v_pengguna p2 ON t.updated_by = p2.uuid_pengguna WHERE t.$id = '$val'")->result();
  }

}
