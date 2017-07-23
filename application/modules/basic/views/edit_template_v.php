<script>
 // $(document).ready(function(){
    
    function deleteButton()
    {

      if (confirm("Are you sure you want to DELETE your Account ?"))
      {
         window.location.replace('<?php echo base_url('basic/delete_action'); ?>');
      }
      else
      {
        return false;
      }
      return false;
    }

  //});
</script>
<section id="contact" class="section green">
  <div class="container">
    <div class="row">
      <div class="span1"></div>
      <div class="span4 text-center" >
        <div class="text-center"><h2 style="color: white;">Edit Your Account</h2></div>
            
             
           <?php echo $this->session->flashdata('msg'); ?>
           <br>      
          <form action="<?php echo base_url('basic/edit_action'); ?>" method="post" role="form" class="Form-control" enctype="multipart/form-data">
            
              <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="First name" name="firstname" value="<?php echo $user_details->user_firstname; ?>" required>
            <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
            <?php echo form_error('firstname');?>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Last name" name="lastname" value="<?php echo $user_details->user_lastname; ?>" required>
            <?php echo form_error('lastname');?>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Other name" name="othername" value="<?php echo $user_details->user_othername; ?>" >
            <?php echo form_error('othername');?>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" disabled="true" value="<?php echo $user_details->user_email; ?>" required>
            <?php echo form_error('email');?>
          </div>
          <div class="form-group has-feedback">
            <input type="tel" class="form-control" placeholder="Telephone No" name="telephone" value="<?php echo $user_details->user_telephone; ?>" required>
            <?php echo form_error('telephone');?>
          </div>
          

          <div class="form-group has-feedback">
            <input type="file" class="form-control" name="user_images">
            <br>
            <img src="" alt="">
          </div>
           <!-- /.col -->
           <br>
            <div class="form-group">
              <button type="submit" class="btn btn-theme">Update Account</button>
           </div>
         
          </form>
          <div class="text-left" style="font-size: 14px;">
           <button class="btn btn-theme" id="deletebutton" onclick="deleteButton()">Delete</button>
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