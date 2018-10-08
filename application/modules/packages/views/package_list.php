<div class="content-wrapper">
    <section class="content-header">
        <h1>
            All Packages
            <a href="<?php echo site_url('at-admin/package/create') ?>">
                <span class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New Packages</span>
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
                                    <th>Package Name</th>
                                    <th>Trip Duration</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                <?php foreach ($packages->result() as $package): ?>
                                <tr>
                                    <td><?php echo ++$no ?></td>
                                    <td><?php echo $package->package_name ?></td>
                                    <td>
                                        <?php echo $package->trip_duration_days ?><br>
                                        <?php echo $package->trip_duration_nights ?>
                                    </td>
                                    <td><?php echo $package->price ?></td>
                                    <td>
                                        <?php
                                            $link_edit = anchor('at-admin/package/'.$package->id, '<i class="fa fa-edit"></i>');
                                            $link_delete = anchor('at-admin/package/delete/'.$package->id, '<i class="fa fa-trash"></i>');
                                            echo $link_edit." ".$link_delete;
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