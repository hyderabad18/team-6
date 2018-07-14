<?php $this->load->view('templates/header'); ?>




<section class="container" >
    <div class="col-md-4 col-md-push-3">
        <?php if ($this->session->userdata('is_logged_in')) { ?>
            <div class="featured-box nobg border-only left-separator">
                    
                    
            
            </div>
        <?php } else { ?>
            <form id="loginForm" method="POST">
                <br>
                <?php echo validation_errors('<div class="row"><div class="col-md-12"><div class="alert alert-danger"><i class="fa fa-frown-o"></i>', '</div></div></div>'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                    required="required" title="Please enter you email"
                                    value="<?= set_value('email') ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                    required="required" title="Please enter your password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" value="Sign In" class="btn btn-primary btn-block"
                                name="submit_login"
                                data-loading-text="Loading...">
                    </div>
                    <div class="col-md-6">
                        <a href="<?php echo base_url(); ?>Auth/forgotpassword"
                            class="btn btn-danger btn-block">Forgot
                            Password?</a>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <a href="<?php echo base_url(); ?>auth/registration" class="btn btn-primary btn-block">Signup</a>
                    </div>
                </div>
            </form>
    <?php } ?>
    </div>
    
</scetion>