<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Elections</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table class="table table-bordered table-striped" align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th>Position</th>
                      <th colspan="2">Date</th>
                    </tr>
                    <?php if (count($elections_table) > 0)
                        {
                            echo $elections_table;
                        }
                        else
                        {
                 ?>
                <tr>
                    <td colspan="5"><center>No elections to display</center></td>
                </tr>
                <?php } ?>
                  </table>
                </div>
</div><!-- /.box -->