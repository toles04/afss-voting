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
                        <form role="form" method="post" action="<?php echo base_url('admin/addpositions'); ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Position Title</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Titlie" name="title" value="<?php echo set_value('title');?>">
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
                                      $options .="<option value='{$value->user_id}'>{$value->user_firstname} {$value->user_lastname}</option>";
                                    }
                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>
                           <div class="form-group">
                              <label>Description</label>
                              <textarea class="form-control" rows="3" placeholder="Enter ..." name="description"><?php echo set_value('description');?></textarea>
                              <?php echo form_error('description');?>
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
