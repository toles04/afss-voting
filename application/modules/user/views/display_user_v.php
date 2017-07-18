<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description1; ?></h3>
                  <?php echo $this->session->flashdata('msgdelete'); ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered" align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th colspan="2">Full Name</th>
                      <th>Email</th>
                      <th>Location</th>
                      <th>Level</th>
                      <th>Status</th>
                      <th colspan="2" style="width: 40px">Actions</th>
                    </tr>
                    <?php if ($rowz > 0)
                        {
                            echo $users_table;
                        }
                        else
                        {
                 ?>
                <tr>
                    <td colspan="4"><center>No positions to display</center></td>
                </tr>
                <?php } ?>
                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">

                    <?php 
                    foreach ($links as $link)
                     {
                        echo "<li>". $link."</li>";
                     } 
                    ?>
                  </ul>
                </div>
              </div>