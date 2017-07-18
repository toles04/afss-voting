<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Users</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <table class="table table-bordered table-striped" align="center">
                    <tr>
                      <th style="width: 10px">#</th>
                      <th colspan="2">Full Name</th>
                      <th>Email</th>
                      <th>Level</th>
                      <th>Status</th>
                    </tr>
                    <?php if (count($users_table) > 0)
                        {
                            echo $users_table;
                        }
                        else
                        {
                 ?>
                <tr>
                    <td colspan="6"><center>No users to display</center></td>
                </tr>
                <?php } ?>
                  </table>
                </div>
</div><!-- /.box -->