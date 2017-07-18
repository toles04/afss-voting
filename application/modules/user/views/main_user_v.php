<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description2; ?></h3>
                  <?php //var_dump($details); 

                  $user_id = $details[0]['user_id'];
                  $user_firstname = $details[0]['user_firstname'];
                  $user_lastname = $details[0]['user_lastname'];
                  $user_othername = $details[0]['user_othername'];
                  $user_email = $details[0]['user_email'];
                  $user_telephone = $details[0]['user_telephone'];
                  $user_gender = $details[0]['user_gender'];
                  $user_type = $details[0]['user_type'];
                  $user_active = $details[0]['user_active'];
                  ?>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="row">
                    <div class="col-md-6">
                    <?php echo $this->session->flashdata('msg'); ?>
                        <form role="form" method="post" action="<?php echo base_url('admin/updateuser/').$user_id; ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Firstname</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Firstname" name="firstname" value="<?php echo $user_firstname; ?>">
                              <?php echo form_error('firstname');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Lastname</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Lastname" name="lastname" value="<?php echo $user_lastname; ?>">
                              <?php echo form_error('lastname');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Othername</label>
                              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Othername" name="othername" value="<?php echo $user_othername; ?>">
                              <?php echo form_error('othername');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Email</label>
                              <input type="Email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" name="email" value="<?php echo $user_email; ?>">
                              <?php echo form_error('email');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Telephone</label>
                              <input type="tel" class="form-control" id="exampleInputEmail1" placeholder="Enter Telephone" name="telephone" value="<?php echo $user_telephone; ?>">
                              <?php echo form_error('telephone');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Gender</label><br>
                              <select name="gender">
                                <?php 
                                   if ($user_gender == "male")
                                   {
                                    echo "<option value='male' selected='selected'>Male</option>
                                          <option value='female'>Female</option>";
                                   } 
                                   else
                                   {
                                    echo "<option value='male'>Male</option>
                                          <option value='female' selected='selected'>Female</option>";
                                   }

                                 ?>
                              </select>
                              <?php echo form_error('gender');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Account Status</label><br>
                              <select name="active">
                                <?php 
                                   if ($user_active == "1")
                                   {
                                    echo "<option value='1' selected='selected'>Active</option>
                                          <option value='0'>Inactive</option>";
                                   } 
                                   else
                                   {
                                    echo "<option value='1'>Active</option>
                                          <option value='0' selected='selected'>Inactive</option>";
                                   }

                                 ?>
                              </select>
                              <?php echo form_error('active');?>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">User Type </label><br>
                              <select name="type">
                                <?php 
                                   if ($user_type == "admin")
                                   {
                                    echo "<option value='admin' selected='selected'>Admin</option>
                                          <option value='basic'>Basic</option>";
                                   } 
                                   else
                                   {
                                    echo "<option value='admin'>Admin</option>
                                          <option value='basic' selected='selected'>Basic</option>";
                                   }

                                 ?>
                              </select>
                              <?php echo form_error('type');?>
                            </div>
                           
                          </div><!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                             <a href="<?php echo base_url('admin/users'); ?>"><button type="button" class="btn btn-danger pull-right">Back</button></a>
                          </div>
                        </form>
                    </div>
                </div>
                
              </div>
    </div>
    <div class="col-md-6">
    </div>
</div>
