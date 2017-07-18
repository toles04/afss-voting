<body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="#"><b>Alumni</b>AFSS</a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">FORGOT PASSWORD</p>
        <?php echo $this->session->flashdata('message'); ?>
        <form action="<?php echo base_url('auth/forgot'); ?>" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Enter Email" name="email" value="<?php echo set_value('email');?>" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <?php echo form_error('email');?>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Get Password</button>
            </div><!-- /.col -->
          </div>
        </form>
        <a href="<?php echo base_url(); ?>" class="text-center">Back to Login</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->