<div class="content-wrapper">
    <section class="content-header">
        <h1>Edit Service</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div style="float: right;">
                            <button type="submit" form="formSubmit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Update</button>
                            <a href="<?php echo site_url('at-admin/service') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa fa-reply"></i> Back to list</span>
                            </a>
                        </div>
                    </div>
                    <?php echo form_open('at-admin/service/update/'.$service->id, 'id="formSubmit"') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name', $service->name) ?>" placeholder="Name">
                                <?php echo form_error('name', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="status">
                                    <option value=""></option>
                                    <option value="active"
                                    <?php
                                        if ($service->status == 'active') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Active</option>
                                    <option value="non active"
                                    <?php
                                        if ($service->status == 'non active') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Non Active</option>
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