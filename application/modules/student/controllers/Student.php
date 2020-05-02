<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Export
require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Student extends CI_Controller 
{
    public function __construct() 
    {
      parent::__construct();

      is_login();

      // library and model
      $this->load->model("M_student");
      $this->load->helper('global');
      $this->load->helper('config');
      $this->load->library('session');
      $this->load->library('excel'); // Import excel
      $this->load->library('uuid');

      // session 
      $this->sess['users_id']    = $this->session->userdata('users_id');
      $this->sess['users_email']      = $this->session->userdata('users_email');
      $this->sess['users_level']      = $this->session->userdata('users_level');
    }
 
    public function index()
    {
      $data["page"]      = "Student";
      $data["content"]   = "student/v_index";
      $this->load->view("app_template", $data);
    } 

    public function ajax_list()
    {
      $list = $this->M_student->getData();
      
      $data = array();
      $no   = $_POST['start'];
      foreach ($list as $key => $row) 
      {
          $no++;
          $content = array();

          $student_uuid = $row['student_uuid'];


          $content[] = $no;
          $content[] = "<a href='".base_url('student/detail/'.$student_uuid)."'>".$row['student_name']."</a>";
          $content[] = $row['student_class'];
          $content[] = $row['student_gender'];

          
          $btn = "
                  <a class='table-action hover-primary' href='".base_url('student/edit/'.$student_uuid)."'><i class='ti-pencil'></i> Edit </a> | 
                  <a class='table-action hover-danger' href='".base_url('student/delete/'.$student_uuid)."' onclick='return confirm(\"DELETE DATA ?\")'><i class='ti-trash'></i> Del</a>
                ";
          $content[]  = $btn;

          $data[] = $content;
      }

      $output = array(
                      "draw" => $_POST['draw'],
                      "recordsTotal" => $this->M_student->count_all(),
                      "recordsFiltered" => $this->M_student->count_filtered(),
                      "data" => $data,
              );
      echo json_encode($output);
    }

    public function detail($student_uuid="") 
    {
      $data["page"]       = "Detail";
      $data["content"]    = "student/v_detail";
      $rowData            = $this->M_student->edit($student_uuid);

      if (count($rowData) > 0) 
      {
        $data["data"]       = $this->M_student->detail($rowData);
        
        $this->load->view("app_template", $data); 
      }
      else 
      {
        redirect(base_url('student'));  
      }
    }

    public function create()
    {
      $data["page"]       = "Create";
      $data["content"]    = "student/v_create";
      
      $this->load->view("app_template", $data);
    }

    public function save()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "student";

      if (count($post) > 0) 
      {
        $process  = $this->M_student->save($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data saved successfully";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function edit($student_uuid="")
    {
      if ($student_uuid != "") 
      {
        $data["page"]       = "Edit";
        $data["content"]    = "student/v_create";
        $data["data"]       = $this->M_student->edit($student_uuid);

        $this->load->view("app_template", $data);
      }
      else
      {
        $this->session->set_flashdata("msg", "Data not found");
        return redirect(base_url("student"));
      }
    }

    public function update()
    {
      $post   = $this->input->post();
      
      $msg  = "Failed, try again!";
      $url  = "student";

      if (count($post) > 0) 
      {
        $process  = $this->M_student->update($post, $this->sess['users_id']);
        if ($process > 0) 
        {
          $msg      = "Data has been changed";
        }
      }

      $this->session->set_flashdata("msg", $msg);  
      redirect(base_url($url));
    }

    public function delete($student_uuid="")
    {
      if ($student_uuid != "") 
      {
        $process = $this->M_student->delete($student_uuid);
        if ($process == TRUE) 
        {
          $msg = "Data deleted";
        }else
        {
          $msg = "Data failed to delete, try again!";
        }
      }
      else
      {
        $msg = "No Data available";
      }

      $this->session->set_flashdata("danger", $msg);
      return redirect(base_url("student"));
    }    
    /* END CRUD */
    

    public function export() 
    {
      $data["page"]       = "Export";
      $data["content"]    = "student/v_export";
      
      $this->load->view("app_template", $data);
    }

    public function exportSubmit()
    {
      $limit = $this->input->post("limit");
      if ($limit > 0 && $limit <=500) 
      {
        $this->exportProcess($limit);
      }
      else
      {
        echo "max limit export";
      }
    }

    public function exportProcess($limit=0)
    {
      $list = $this->M_student->exportAll($limit);
     
      $spreadsheet = new Spreadsheet;

      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A1', 'No')
                  ->setCellValue('B1', 'Fullname')
                  ->setCellValue('C1', 'Class')
                  ->setCellValue('D1', 'Gender')
                  ->setCellValue('E1', 'Address');

      $column = 2;
      $number = 1;
      foreach($list as $row) 
      {
         $spreadsheet->setActiveSheetIndex(0)
                     ->setCellValue('A' . $column, $number)
                     ->setCellValue('B' . $column, $row['student_name'])
                     ->setCellValue('C' . $column, $row['student_class'])
                     ->setCellValue('D' . $column, $row['student_gender'])
                     ->setCellValue('E' . $column, $row['student_address']);

           $column++;
           $number++;

      }

      $writer = new Xlsx($spreadsheet);

      header('Content-Type: application/vnd.ms-excel');
      header('Content-Disposition: attachment;filename="student.xlsx"');
      header('Cache-Control: max-age=0');

      $writer->save('php://output');
    }


    public function import() 
    {
      $data["page"]       = "Import";
      $data["content"]    = "student/v_import";
      
      $this->load->view("app_template", $data);
    }

    public function importSubmit()
    {
      if(isset($_FILES["file_student"]["name"]))
      {
        $path = $_FILES["file_student"]["tmp_name"];

        $object = PHPExcel_IOFactory::load($path);

        foreach($object->getWorksheetIterator() as $worksheet)
        {
          $highestRow     = $worksheet->getHighestRow();

          $highestColumn  = $worksheet->getHighestColumn();

          // show data excel in table 
          $rowTotal   = $highestRow - 1;
          $output = '
                    <h3 align="center">Preview Data</h3>
                    <small>Total Data: '.$rowTotal.'</small>
                    <table class="table table-striped table-bordered">
                     <tr>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Address</th>
                     </tr>';

                    for($row=2; $row<=$highestRow; $row++)
                    {

                       $name         = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                       $class        = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                       $gender       = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                       $address      = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                       
                       $data[] = array(
                                'student_uuid'    => $this->uuid->v4(),
                                'student_name'    => $name,
                                'student_class'   => $class,
                                'student_gender'  => $gender,
                                'student_address' => $address, 
                              );

          $output .= '
                      <tr>
                        <td>'.$name.'</td>
                        <td>'.$class.'</td>
                        <td>'.$gender.'</td>
                        <td>'.$address.'</td>
                        </tr>
                        ';
                    } // end for
        }

    
        $output .= '</table>';


        $result = array(
                "table" => $output, 
                "data"  => json_encode($data),
                "link"  => base_url("student/importSave/".json_encode($data))
              );

        echo json_encode($result);
      }
    }

    public function importSave($data="")
    {
      $list = $this->input->post("text_student");
      $listDecode = json_decode($list, TRUE);

      if (count($listDecode) > 0) 
      {
        $this->M_student->exportSave($listDecode);
        $this->session->set_flashdata("msg", "Import data has been saved!");
      }
      else
      {
        $this->session->set_flashdata("danger", "No data available, try again!");
      }

      return redirect(base_url("student"));
    }

 
}