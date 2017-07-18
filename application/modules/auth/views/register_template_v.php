<section id="contact" class="section green">
  <div class="container">
    <div class="row">
      <div class="span1"></div>
      <div class="span4 text-center" >
        <div class="text-center"><h2 style="color: white;">Create an Account</h2></div>
            
             
           <?php echo $this->session->flashdata('msg'); ?>
           <br>      
          <form action="<?php echo base_url('auth/register'); ?>" method="post" role="form" class="Form-control" enctype="multipart/form-data">
            
              <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?php echo set_value('firstname');?>" required>
            <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
            <?php echo form_error('firstname');?>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Last name" name="lastname" value="<?php echo set_value('lastname');?>" required>
            <?php echo form_error('lastname');?>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Other name" name="othername" value="<?php echo set_value('othername');?>" >
            <?php echo form_error('othername');?>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email');?>" required>
            <?php echo form_error('email');?>
          </div>
          <div class="form-group has-feedback">
            <input type="tel" class="form-control" placeholder="Telephone No" name="telephone" value="<?php echo set_value('telephone');?>" required>
            <?php echo form_error('telephone');?>
          </div>
          <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="male" class="minimal" checked>
                      Male
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="female" class="minimal">
                      Female
                    </label>
          </div>

          <div class="form-group has-feedback">
            <select name="country" class="form-control" id="country_id" onchange="change_city();">
            <option value="">Select A Country</option>
            <?php 

            foreach ($countries as $key => $value) {
              # code...
              echo "<option value='{$value->id}'>{$value->country}</option>";
            }

            ?>
              
            </select>
          </div>

          <div class="form-group has-feedback">
            <select name="state" class="form-control" id="state_id">
              <option value="">Select A state</option>
            </select>

          </div>

          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo set_value('password');?>" required>
            <?php echo form_error('password');?>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retype password" name="confirm_password" value="<?php echo set_value('confirm_password');?>" required>
            <?php echo form_error('confirm_password');?>
          </div>

          <div class="form-group has-feedback">
            <input type="file" class="form-control" name="user_images">
          </div>
          
            
              <div class="checkbox icheck ">
              <br>
                <label>
                  <input type="checkbox" required> I agree to the <a href="#">terms</a>
                </label>
              </div>
           <!-- /.col -->
           <br>
            <div class="form-group">
              <button type="submit" class="btn btn-theme">Sign Up</button>
           </div>
         
          </form>
          <div class="text-left" style="font-size: 14px;">
            <a href="<?php echo base_url('login'); ?>" class="text-center">I already have an Account</a>
          </div>
       
      </div>
     
      <div class="span6 text-center" style="color: white; font-size: 15em;">
      <br><br><br><br><br><br>
       
      <i class="icon-group"></i>
    
      </div>
      <!-- ./span12 -->
      
    </div>
  </div>
</section>