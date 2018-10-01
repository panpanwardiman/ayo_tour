<div class="content-wrapper">
    <section class="content-header">
        <h1>New Slider</h1>
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
                            <a href="<?php echo site_url('at-admin/slider') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                            </a>
                        </div>
                    </div>
                    <?php echo form_open_multipart('at-admin/slider/store', 'id="formSubmit"') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <?php echo form_error('image', '<div class="help-block">', '</div>') ?>
                                <i class="help-block">
                                    Only JPG, JPEG, And PNG extension can upload.
                                </i>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value=""></option>
                                    <option value="active">Active</option>
                                    <option value="non active">Non Active</option>
                                </select>
                                <?php echo form_error('status', '<div class="help-block">', '</div>') ?>
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