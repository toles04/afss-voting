<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description2; ?></h3>
                  <?php //var_dump($details); 

                  $election_id = $details[0]['election_id'];
                  $election_title = $details[0]['election_title'];
                  $election_status = $details[0]['status'];
                  $position_title = $details[0]['position_title'];
                  $position_id = $details[0]['position_id'];
                  $start_date = $details[0]['start_date'];
                  $end_date = $details[0]['end_date'];
                  ?>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->session->flashdata('msg'); ?>
                        <form role="form" method="post" action="<?php echo base_url('admin/updateelection/').$election_id; ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Election Title</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title" name="title" value="<?php echo $election_title;?>">
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
                                    $selected = "";
                                    if ($position_title == $value->position_title) 
                                    {
                                      $selected = "selected";
                                    }
                                    $options .="<option {$selected} value='{$value->position_id}'>{$value->position_title}</option>";

                                  }

                                  echo $options;
                                ?>

                              </select>
                              
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Status</label><br>
                              <select name="status" >
                                <?php 
                                  $select = "";
                                  $options = "";

                                  if ($election_status == "done")
                                  {
                                    $options .= "<option value='active'>Active</option>";
                                    $options .= "<option value='upcoming'>Upcoming</option>";
                                    $options .= "<option value='done' selected >Ended</option>";
                                  }
                                  elseif ($election_status == "active")
                                  {
                                    $options .= "<option value='active' selected >Active</option>";
                                    $options .= "<option value='upcoming'>Upcoming</option>";
                                    $options .= "<option value='done'>Ended</option>";
                                  }
                                  else
                                  {
                                    $options .= "<option value='active' selected >Active</option>";
                                    $options .= "<option value='upcoming' selected >Upcoming</option>";
                                    $options .= "<option value='done'>Ended</option>";
                                  }
                                 

                                  echo $options;
                                ?>
                                
                              </select>
                              
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Start Date</label>
                              <input type="date" class="form-control" id="exampleInputEmail1" name="start" value="<?php echo $start_date;?>">
                              <?php echo form_error('start');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">End Date</label>
                              <input type="date" class="form-control"  name="end" value="<?php echo $end_date;?>">
                              <?php echo form_error('end');?>
                            </div>
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             <a href="<?php echo base_url('admin/elections'); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a>
                          </div>
                        </form>
                    </div>
                </div>
                
              </div>
    </div>
</div>
