<script>
 // $(document).ready(function(){
    
    function voteButton(candidate_idx)
    {

      if (confirm("Are you sure you want this candidate ?"))
      {
          $.post('<?php echo base_url('vote/post_vote'); ?>', { user_id: "<?php echo $this->session->userdata('user_id'); ?>", election_id: "<?php echo $election->election_id; ?>", candidate_id: candidate_idx }, function(data){

          $('#response').html(data);

          $('button').hide();

         }).fail(function() 
         {
            // just in case posting your form failed
            alert( "Vote error." );
        });
      }
      else
      {
        return false;
      }
      return false;
    }

  //});
</script>
<section class="spacer green">
  <div class="container">
    <div class="row">
      <div class="span6 alignright flyLeft">
        <blockquote class="large">
           There's huge space beetween creativity and imagination <cite>Mark Simmons, Nett Media</cite>
        </blockquote>
      </div>
      <div class="span6 aligncenter flyRight">
        <i class="icon-ok icon-10x"></i>
      </div>
    </div>
  </div>
</section>

<section id="blog" class="section">
<div class="container text-center" >
  <div class="row" align="center">
  <h3><?php  echo $election->election_title; ?></h3>
  <?php 

    $numx = count($vote_candidates);
    $val = (12/$numx);

    //var_dump($vote_candidates);


    foreach ($vote_candidates as $key => $value)
    {
      # code...
      ?>
       <div class="span3">
          <div class="home-post">
            <div class="post-image">
              <img class="max-img" src="<?php echo base_url('assets/basic/'); ?>img/blog/img1.jpg" alt="" />
            </div>
            <div class="post-meta">
              <b> <?php  echo $value->user_firstname." ".$value->user_lastname; ?></b>

              <span class="tags">
                <?php if (!$status)
                { ?>
              <button class="btn btn-primary" id ="voteBtn" onclick="voteButton(<?php  echo $value->candidate_id; ?>);"><i class="icon-ok icon-1x"> vote</i></button>
              <?php
              }

             ?>
              </span><span id="response"></span>
            </div>
          </div>
        </div>
      <?php
    }
   ?>
   </div>
  <!-- Three columns -->
</div>
</section>

<!-- end spacer section -->
<!-- section: contact -->

