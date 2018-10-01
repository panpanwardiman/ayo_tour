<div class="content-wrapper">
    <section class="content-header">
        <h1>
            All Articles
            <a href="<?php echo site_url('at-admin/article/create') ?>">
                <span class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> New Articles</span>
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
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Categories</th>
                                    <th>Tags</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0 ?>
                                <?php foreach ($articles->result() as $article): ?>
                                <tr>
                                    <td><?php echo ++$no ?></td>
                                    <td><?php echo ucwords($article->title) ?></td>
                                    <td><?php echo ucwords($article->author) ?></td>
                                    <td><?php echo ucwords($article->category) ?></td>
                                    <td>
                                    <?php $tags = explode(',', $article->tag) ?>
                                        <?php foreach ($tags as $key => $value) :?>
                                            <p class="label label-primary"><i class="fa fa-tags"></i> <?php echo ucwords($tags[$key]) ?></p>
                                    <?php endforeach ?>                                  
                                    </td>
                                    <td>
                                        <?php 
                                            echo ucwords($article->status)."<br>"; 
                                            echo $article->date;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $link_edit = anchor('at-admin/article/'.$article->id, '<i class="fa fa-edit"></i>');
                                            $link_delete = anchor('at-admin/article/delete/'.$article->id, '<i class="fa fa-trash"></i>');
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