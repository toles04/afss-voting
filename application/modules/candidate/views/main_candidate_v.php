<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description2; ?></h3>
                  <?php
                  
                  $candidate_id = $details[0]['candidate_id'];
                  $user_id = $details[0]['user_id'];
                  $election_id = $details[0]['election_id'];
                  
                  ?>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->session->flashdata('msg'); ?>
                        <form role="form" method="post" action="<?php echo base_url('admin/updatecandidate/').$candidate_id; ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Election</label><br>
                              <select name="election" >
                                <?php 
                                  $options = "";
                                  foreach ($select_elections as $key => $value) 
                                  {
                                      $select = "";
                                      if($value->election_id == $election_id)
                                      {
                                        $select ="selected";
                                      }
                                      # code...
                                      $options .="<option {$select} value='{$value->election_id}'>{$value->election_title}</option>";    
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
                                       $select = "";
                                      if($value->user_id == $user_id)
                                      {
                                        $select ="selected";
                                      }
                                      $options .="<option {$select} value='{$value->user_id}'>{$value->user_firstname} {$value->user_lastname}</option>";
                                    }
                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             <a href="<?php echo base_url('admin/candidates'); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a>
                          </div>
                        </form>
                    </div>
                </div>
                
              </div>
    </div>
</div>
