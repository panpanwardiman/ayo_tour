<div class="content-wrapper">
    <section class="content-header">
        <h1>New Users</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div style="float: right;">
                            <button type="submit" form="formSubmit" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Save</button>
                            <a href="<?php echo site_url('at-admin/user') ?>">
                                <span class="btn btn-warning btn-sm"><i class="fa  fa-reply"></i> Back to list</span>
                            </a>
                        </div>
                    </div>
                    <?php echo form_open('at-admin/user/update/'.$user->id, 'id="formSubmit"') ?>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name', $user->first_name ) ?>" placeholder="First Name">
                                <?php echo form_error('first_name', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name', $user->last_name ) ?>" placeholder="Last Name">
                                <?php echo form_error('last_name', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user->email ) ?>" placeholder="Email">
                                <?php echo form_error('email', '<div class="help-block">', '</div>') ?>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" class="form-control" id="role">
                                    <option value=""></option>
                                    <option value="administrator"
                                    <?php
                                        if ($user->role == 'administrator') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Administrator</option>
                                    <option value="editor"
                                    <?php
                                        if ($user->role == 'editor') {
                                            echo "selected";
                                        }
                                    ?>
                                    >Editor</option>
                                </select>
                                <?php echo form_error('role', '<div class="help-block">', '</div>') ?>
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