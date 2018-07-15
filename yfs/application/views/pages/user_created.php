<?php $this->load->view('templates/header');?>
<br>
<section class="container">
        <h1 class="text-center"><b><?php echo $site_name?></b></h1>
    <h2 class="text-center"> Registration<strong> Successful</strong></h2>
            
        <hr class="half-margins"/>


    <div class="row">
        <div class="col-md-12">
            <div class="featured-box nobg border-only">
                <div class="box-content">
                    <i class="fa fa-thumbs-o-up"></i>
                    <h4>Thank you!</h4>
                    <p>Your email is <b><?=$email?></b></p>
                    <p>Your account was successfully created.</p>
                    <p><a href="<?php echo base_url(); ?>auth" class="btn btn-default">Back to Home</a></p>
                </div>
            </div>
        </div>
    </div>
</section>