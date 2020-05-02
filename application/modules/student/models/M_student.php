<?php

/**
* Model Student
*/
class M_student extends CI_Model
{

	var $table = 'student';
  var $column_order 	= array(
  								null, 
  								'student_name',
  								'student_class',
                  'student_gender', 
  								'student_address', 
  							); 
  var $column_search 	= array(
  								'student_name',
                  'student_class',
                  'student_gender', 
                  'student_address',
  							);
  var $order = array('created_date' => 'DESC'); // default order 




  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

	/* CRUD DATA */
  public function getData()
  {
    $this->_query();

    if($_POST['length'] != -1)
    {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    
    return $query->result_array();
  }

	public function _query()
  {
    $this->db->select("*");
    $this->db->from("student");
    $this->db->where("deleted", config("NOT_DELETED"));

    $i = 0;
 
    foreach ($this->column_search as $item) // loop column 
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {
        if($i===0) // first loop
        {
            $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
            $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
            $this->db->or_like($item, $_POST['search']['value']);
        }

        if(count($this->column_search) - 1 == $i) //last loop
            $this->db->group_end(); //close bracket
      }
      $i++;
    }
     
    if(isset($_POST['order'])) // here order processing
    {
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
  }


  public function count_all()
  {
    $this->db->from($this->table);
    return $this->db->count_all_results();
  }

  public function count_filtered()
  {
    $this->_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function save($post=array(), $users_id=0)
	{
		if (count($post) > 0) 
		{
			//var defined
			$datenow 	= date("Y-m-d H:i:s");

			$data 	= array(
				"student_name" 			=> $post['student_name'], 
				"student_class" 		=> $post['student_class'], 
				"student_gender"		=> $post['student_gender'], 
				"student_address"		=> $post['student_address'], 
				"created_by"				=> $users_id, 
				"created_date"			=> $datenow, 
			);
		
			$this->db->set("student_uuid", "UUID()", FALSE); 
			$saved = $this->db->insert("student", $data);
			
			return $saved;
		}
	}

  public function edit($student_uuid="")
  {
    $result   = array();
    if ($student_uuid !="") 
    {
      $this->db->where("student_uuid", $student_uuid);
      $this->db->where("deleted", config("NOT_DELETED"));
      $query    = $this->db->get("student");
      $result   = $query->row_array();
    }

    return $result;
  }

  public function update($post=array(), $users_id=0)
  {
    if (count($post) > 0) 
    {
      //var defined
      $datenow  = date("Y-m-d H:i:s");

      $data 	= array(
				"student_name"      => $post['student_name'], 
        "student_class"     => $post['student_class'], 
        "student_gender"    => $post['student_gender'], 
        "student_address"   => $post['student_address'], 
				"modified_by"				=> $users_id, 
				"modified_date"			=> $datenow, 
			);
      
      $this->db->where("student_uuid", $post['student_uuid']);
      $update = $this->db->update("student", $data);
      
      return $update;
    }
  }

  public function detail($rowData=array())
  {
  	
  	if (count($rowData) > 0) 
  	{
  		$rowData['created_by']		= $this->changeBy($rowData['created_by']);
  		$rowData['modified_by']	  = ($rowData['modified_by'] == null) ? "" : $this->changeBy($rowData['modified_by']);
  	}

  	return $rowData;
  }

  public function delete($uuid="")
  {
    if ($uuid != "") 
    {
      $this->db->set("deleted", 1);
      $this->db->where("student_uuid", $uuid);
      $delete   = $this->db->update("student");

      return TRUE;
    }

    return FALSE;
  }
	/* END CRUD DATA */

  public function changeBy($users_id=0)
  {
  	$result = "";
  	if ($users_id != null && $users_id > 0) 
  	{
  		$this->db->select("users_name");
  		$this->db->from("users");
  		$this->db->where("users_id", $users_id);
  		$query = $this->db->get()->row_array();

  		$result = $query['users_name'];
  	}

  	return $result;
  }

  public function exportAll($limit=0)
  {
    $this->db->from("student");
    $this->db->where("deleted", config("NOT_DELETED"));
    
    if ($limit > 1) 
    {
      $this->db->limit($limit, 0);
    }

    $query  = $this->db->get();
    $result = $query->result_array();

    return $result;
  }

  public function exportSave($data=array())
  {
    $this->db->insert_batch('student', $data);
  }

	
}