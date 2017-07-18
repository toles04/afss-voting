<div class="row">
    <div class="col-md-8">
    <?php $this->load->view($table_view); ?>
        
                </div>

    <div class="col-md-4">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description2; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="row">
                    <div class="col-md-12">
                    <?php echo $this->session->flashdata('msg'); ?>
                        <form role="form" method="post" action="<?php echo base_url('admin/addcandidates'); ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Election</label><br>
                              <select name="election" >
                                <?php 
                                  $options = "";
                                  foreach ($select_elections as $key => $value) 
                                  {
                                    # code...
                                    
                                      $options .="<option value='{$value->election_id}'>{$value->election_title}</option>";
                                    
                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>
                             <div class="form-group">
                              <label for="exampleInputEmail1">User(s)</label><br>
                              <select name="user" class="form-control">
                                <?php 
                                  $options = "";
                                  foreach ($select_users as $key => $value) 
                                  {
                                    # code...
                                    if ($value->user_type == "basic" && $value->user_active == "1")
                                    {
                                      $options .="<option value='{$value->user_id}'>{$value->user_firstname} {$value->user_lastname}</option>";
                                    }
                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>
                
              </div>
    </div>
</div>
