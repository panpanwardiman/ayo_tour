<div class="content-wrapper">
    <section class="content-header">
        <h1>New Tags</h1>
    </section>
    <section class="content">
        <?php if ($this->session->userdata('message') !== NULL ): ?>
            <?php echo $this->session->userdata('message') ?>
        <?php endif ?>
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div style="float: right;">
                            <button type="submit" form="formSubmit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Save</button>
                            <a href="<?php echo site_url('at-admin/tag') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                            </a>
                        </div>
                    </div>
                    <?php echo form_open('at-admin/tag/store', 'id="formSubmit"') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name') ?>" placeholder="First Name">
                                <?php echo form_error('name', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo set_value('slug') ?>" placeholder="Last Name">
                                <i class="help-block">
                                    The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.<br>
                                    example: wonderful-indonesia
                                </i>
                                <?php echo form_error('slug', '<div class="help-block">', '</div>') ?>
                            </div>
                        </div>
                        <div class="box-footer">
                        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>