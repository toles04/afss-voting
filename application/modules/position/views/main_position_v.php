<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description2; ?></h3>
                  <?php //var_dump($details); 

                  $position_id = $details[0]['position_id'];
                  $position_title = $details[0]['position_title'];
                  $user_firstname = $details[0]['user_firstname'];
                  $user_lastname = $details[0]['user_lastname'];
                  $position_description = $details[0]['position_description'];
                  ?>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->session->flashdata('msg'); ?>
                        <form role="form" method="post" action="<?php echo base_url('admin/updatepost/').$position_id; ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Position Title</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title" value="<?php echo $position_title; ?>">
                              <?php echo form_error('title');?>
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
                                      $selected = "";
                                      if ($value->user_firstname == $user_firstname && $value->user_lastname == $user_lastname) 
                                      {
                                        $selected = "selected";
                                      }
                                      $options .="<option {$selected} value='{$value->user_id}'>{$value->user_firstname} {$value->user_lastname}</option>";
                                    }
                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>
                           <div class="form-group">
                              <label>Description</label>
                              <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"><?php echo $position_description; ?></textarea>
                              <?php echo form_error('description');?>
                            </div>
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             <a href="<?php echo base_url('admin/positions'); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a>
                          </div>
                        </form>
                    </div>
                </div>
                
              </div>
    </div>
    <div class="col-md-6">
      
    </div>
</div>
