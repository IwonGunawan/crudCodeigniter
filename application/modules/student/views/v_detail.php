

<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

        <div class="col-lg-10">
          <div class="card">
              <div class="card-header">
                  <strong><?=$page;?></strong> Student
              </div>

                <div class="card-body card-block">
                  <div class="col-md-6">
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Fullname</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['student_name'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Class</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['student_class'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Gender</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['student_gender'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label class=" form-control-label">Address</label></div>
                        <div class="col-12 col-md-9">
                            <p class="form-control-static"><?=$data['student_address'];?></p>
                        </div>
                    </div>
                  </div>

                  <div class="col-md-1"></div>

                  <div class="col-md-5">
                    <div class="row form-group" >
                        <div class="col col-md-4"><label class=" form-control-label">Created By</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['created_by'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Created Date</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['created_date'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Modified By</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['modified_by'];?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-4"><label class=" form-control-label">Modified Date</label></div>
                        <div class="col-12 col-md-8">
                            <p class="form-control-static"><?=$data['modified_date'];?></p>
                        </div>
                    </div>
                  </div>

                      
                </div>
                <div class="card-footer">
                  <button type="reset" class="btn btn-danger btn-sm" onclick="history.back(-1)">
                      <i class="fa fa-ban"></i> Back
                  </button>
                </div>
          </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->