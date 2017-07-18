<div class="row">
  <div class="col-md-6">
    <!-- Elections -->
    <?php $this->load->view($elections_view); ?>
            
  </div>
  <div class="col-md-6">
    <!-- candidate's votes -->
    <?php $this->load->view($candidates_votes_view); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <!-- users -->
    <?php $this->load->view($users_view); ?>
  </div>
  <div class="col-md-4">
    <!-- positions -->
    <?php $this->load->view($positions_view); ?>
  </div>
</div>