<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
 
  function listData($table,$name,$value,$value2,$orderBy='ASC',$caracter) {
      $items = array();
      $CI =& get_instance();
      if($orderBy) {
          $CI->db->order_by($value2,$orderBy)->order_by($value,$orderBy);
      }
      $query = $CI->db->select("$name,$value,$value2")->from($table)->get();
      if ($query->num_rows() > 0) {
          foreach($query->result() as $data) {
              $items[$data->$name] = $data->$value.$caracter.$data->$value2;
          }
          $query->free_result();
          return array('0' => 'Selecciona una opcion') + $items;
      }
  }
  
   function listData2($table,$name,$value,$value2,$activo) {
      $items = array();
      $CI =& get_instance();
      //if($orderBy) {
          $CI->db->order_by($value2, 'DESC')->order_by($value, 'DESC');
      //}
      $query = $CI->db->select("'id',$name,$value,$value2,'activo'")->from($table)->where($activo, 1)->get();
      if ($query->num_rows() > 0 ) {
          foreach($query->result() as $data) {
             $items[$data->$name] = $data->$value.'-'.$data->$value2;
          }
          $query->free_result();
          return array('0' => 'Selecciona una opcion') + $items;
      }
  }