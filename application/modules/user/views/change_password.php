<div class="content-wrapper">
    <section class="content-header">
        <h1>Change Password</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div style="float: right;">
                            <button type="submit" form="formSubmit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Save</button>
                            <a href="<?php echo site_url('at-admin/user') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa fa-plus-circle"></i> Back to list</span>
                            </a>
                        </div>
                    </div>
                    <?php $id = $this->session->userdata('id') ?>
                    <?php echo form_open('at-admin/user/update_password/'.$id, 'id="formSubmit"') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="First Name">
                                <?php echo form_error('new_password', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="re_enter_new_password">Re-enter New Password</label>
                                <input type="password" class="form-control" id="re_enter_new_password" name="re_enter_new_password" placeholder="Last Name">
                                <?php echo form_error('re_enter_new_password', '<div class="help-block">', '</div>') ?>
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