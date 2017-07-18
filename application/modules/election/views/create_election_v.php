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
                        <form role="form" method="post" action="<?php echo base_url('admin/addelections'); ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Election Title</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title" value="<?php echo set_value('title');?>">
                              <?php echo form_error('title');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Position</label><br>
                              <select name="position" >
                                <?php 
                                  $options = "";
                                  foreach ($select_positions as $key => $value) 
                                  {
                                    # code...
                                    $options .="<option value='{$value->position_id}'>{$value->position_title}</option>";

                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Status</label><br>
                              <select name="status" >
                                <option value="active">Active</option>
                                <option value="upcoming">Upcoming</option>
                                <option value="done">Ended</option>
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Start Date</label>
                              <input type="date" class="form-control" id="exampleInputEmail1" name="start" value="<?php echo set_value('title');?>">
                              <?php echo form_error('start');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">End Date</label>
                              <input type="date" class="form-control"  name="end" value="<?php echo set_value('title');?>">
                              <?php echo form_error('end');?>
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
