<div class="content-wrapper">
    <section class="content-header">
        <h1>
            All Tags
            <a href="<?php echo site_url('at-admin/tag/create') ?>">
                <span class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New Tags</span>
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
                                    <th>Slug</th>
                                    <!-- <th>Count</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                <?php foreach ($tags->result() as $tag): ?>
                                <tr>
                                    <td><?php echo ++$no ?></td>
                                    <td><?php echo $tag->name ?></td>
                                    <td><?php echo $tag->slug ?></td>
                                    <!-- <td><?php echo $tag->count_tags ?></td> -->
                                    <td>
                                        <?php
                                            $link_edit = anchor('at-admin/tag/'.$tag->id, '<i class="fa fa-edit"></i>');
                                            $link_delete = anchor('at-admin/tag/delete/'.$tag->id, '<i class="fa fa-trash"></i>');
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