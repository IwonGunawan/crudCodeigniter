
<?php

$action           = "student/save";
$student_uuid     = "";
$student_name     = "";
$student_class    = "";
$student_gender   = "";
$student_address  = "";

if ($page == "Edit") 
{
  $action           = "student/update";
  $student_uuid     = $data['student_uuid'];
  $student_name     = $data['student_name'];
  $student_class    = $data['student_class'];
  $student_gender   = $data['student_gender'];
  $student_address  = $data['student_address'];
}

?>


<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-8">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Student
              </div>

              <form action="<?=base_url($action);?>" method="post" class="form-horizontal">

                <input type="hidden" name="student_uuid" value="<?=$student_uuid;?>">

                <div class="card-body card-block">
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fullname</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="student_name" name="student_name" class="form-control" value="<?=$student_name;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="email-input" class=" form-control-label">Class</label></div>
                          <div class="col-12 col-md-9"><input type="text" id="student_class" name="student_class" class="form-control" value="<?=$student_class;?>" required=""></div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="password-input" class=" form-control-label">Gender</label></div>
                          <div class="col-12 col-md-9">
                            <select name="student_gender" id="student_gender" class="form-control">
                                <option style="display: none;">Please select</option>
                                <option value="M" <?= ($student_gender == "M") ? "selected" : "" ?> >Male</option>
                                <option value="F" <?= ($student_gender == "F") ? "selected" : "" ?> >Female</option>
                            </select>
                          </div>
                      </div>
                      <div class="row form-group">
                          <div class="col col-md-3"><label for="disabled-input" class=" form-control-label">Address</label></div>
                          <div class="col-12 col-md-9">
                            <textarea name="student_address" class="form-control" cols="10" rows="5"><?=$student_address;?></textarea>
                          </div>
                      </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-save"></i> Submit
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm" onclick="history.back(-1)">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                </div>
              </form>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->