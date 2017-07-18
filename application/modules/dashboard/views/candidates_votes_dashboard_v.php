<div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Candidates Votes</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table class="table table-bordered table-striped" align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th colspan="2">Candidate Name</th>
                      <th>Election</th>
                      <th>votes</th>
                    </tr>
                    <?php if (count($candidates_table) > 0)
                        {
                            echo $candidates_table;
                        }
                        else
                        {
                 ?>
                <tr>
                    <td colspan="5"><center>No candidates votes to display</center></td>
                </tr>
                <?php } ?>
                  </table>
                </div>
</div><!-- /.box -->