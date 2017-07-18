<div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Positions</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table class="table table-bordered table-striped" align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th colspan="2">Full Name</th>
                    </tr>
                    <?php if (count($positions_table) > 0)
                        {
                            echo $positions_table;
                        }
                        else
                        {
                 ?>
                <tr>
                    <td colspan="5"><center>No positions to display</center></td>
                </tr>
                <?php } ?>
                  </table>
                </div>
</div><!-- /.box -->