<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $description1; ?></h3>
                   <?php echo $this->session->flashdata('msgdelete'); ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered" align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th colspan="2">Candidate Name</th>
                      <th>Election</th>
                      <th>votes</th>
                      <th colspan="2"">Actions</th>
                    </tr>
                    <?php if ($rowz > 0)
                        {
                            echo $candidates_table;
                        }
                        else
                        {
                 ?>
                <tr>
                    <td colspan="6"><center>No positions to display</center></td>
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