<div class="content-wrapper">
    <section class="content-header">
        <h1>
            All Users
            <a href="<?php echo site_url('at-admin/user/create') ?>">
                <span class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New User</span>
            </a>
        </h1>
    </section>
    <section class="content">
        <?php if ($this->session->userdata('message') !== NULL ): ?>
            <?php echo $this->session->userdata('message') ?>
        <?php endif ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                <?php foreach ($users->result() as $user): ?>
                                <tr>
                                    <td><?php echo ++$no ?></td>
                                    <td><?php echo $user->first_name." ".$user->last_name ?></th>
                                    <td><?php echo $user->email ?></td>
                                    <td><?php echo $user->role ?></td>
                                    <td>
                                        <?php
                                            $link_edit = anchor('at-admin/user/'.$user->id, '<i class="fa fa-edit"></i>');
                                            $link_delete = anchor('at-admin/user/delete/'.$user->id, '<i class="fa fa-trash"></i>');
                                            if ($this->session->userdata('id') == $user->id) {
                                                echo $link_edit;
                                            } else {
                                                echo $link_edit." ".$link_delete;
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
