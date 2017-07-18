<section id="contact" class="section green">
<div class="container">
  <div class="row">
    <div class="span4"></div>
    <div class="span4 text-center" >
    
          <h2><b>Alumni</b>AFSS</h2>
           
         <?php echo $this->session->flashdata('verify'); ?>
         <br>      
        <form action="<?php echo base_url('auth/login'); ?>" method="post" role="form" class="Form">
          
            <div class="form-group has-feedback">
              <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo set_value('email');?>" required>
              
              <?php echo form_error('email');?>
            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo set_value('password');?>" required>
              <?php echo form_error('password');?>
            </div>
              <input type="submit" value="Sign In" class="btn btn-theme">
            
        </form>

        <div class="text-left" style="font-size: 14px;">
        <a href="<?php echo base_url('forgot'); ?>">I forgot my password</a><br>
        <a href="<?php echo base_url('register'); ?>" class="text-center">Register a new membership</a>
        </div>
     
    </div>
    <!-- ./span12 -->
    
  </div>
</div>
</section>