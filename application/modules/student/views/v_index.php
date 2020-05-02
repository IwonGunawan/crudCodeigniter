

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
              <?php 
                if($this->session->flashdata('msg')) 
                { 
                  echo '<div class="alert alert-success" role="alert">'.$this->session->flashdata("msg").'</div>';
                }

                if($this->session->flashdata('danger')) 
                { 
                  echo '<div class="alert alert-danger" role="alert">'.$this->session->flashdata("danger").'</div>';
                } 
              ?>

              <div class="card-header">
                  <a href="<?=base_url('student/create'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp; Create New</a>
                  <a href="<?=base_url('student/export');?>" class="btn btn-outline-success"><i class="fa fa-download"></i>&nbsp; Export</a>
                  <a href="<?=base_url('student/import');?>" class="btn btn-outline-warning"><i class="fa fa-upload"></i>&nbsp; Import</a>
              </div>
              <div class="card-body">
                  <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>

                  <nav style="float: right;">
                    <!-- pagination -->
                  </nav>

              </div>
            </div>
        </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->


<script type="text/javascript">
    
  var table;
  $(document).ready(function() 
  {
    //datatables
    table = $('#bootstrap-data-table-export').DataTable({ 
 
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "order": [], //Initial no order.

      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo site_url('student/ajax_list'); ?>",
          "type": "POST"
      },

      //Set column definition initialisation properties.
      "columnDefs": [
      { 
          "targets": [ 0,4 ], //first column / numbering column
          "orderable": false, //set not orderable
      },
      ],

    });
  });
</script>