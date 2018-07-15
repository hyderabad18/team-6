<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>YOUTH4SEVA</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" media='screen,print'>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" >
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flaticon.css" >
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/essentials.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datatables.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet" type="text/css"/>
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.chained.min.js"></script>
    
</head>
<script>
function IconTransform(x) {
    x.classList.toggle("change");
}
</script>
<style>
    .wrapper{
        cursor: pointer;
        position:absolute;
        top: 10px;
        left: 34cm;
    }
    .menu-icon-bar1, .menu-icon-bar2, .menu-icon-bar3{
        width: 35px;
        height: 5px;
        background-color: white;
        margin: 6px 0;
    }
    .change .menu-icon-bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-9px, 6px);
    
    }

    .change .menu-icon-bar2 {opacity: 0;}

    .change .menu-icon-bar3 {
        -webkit-transform: rotate(45deg) translate(-8px, -8px);
        transform: rotate(45deg) translate(-8px, -8px);
}
</style>
<body> 
   <div id="wrap">
        <div class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="con tainer">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url();?>"> YSF</a>     
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <?php if($this->session->userdata('is_logged_in')) { ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle js-activated" data-toggle="dropdown">
                            <?php
                                $logged_in=$this->session->userdata('is_logged_in');
                                 echo $this->session->userdata('user_name')." | ";  ?><b class="caret"></b></a>
                              
                        </li>
                        <li><a href="<?php echo base_url();?>auth/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                    <?php } else {?>
                    <li class="<?php if(preg_match("^".base_url()."auth/^",current_url())){ echo " active";}?>">
                        <a href="<?php echo base_url()."auth/";?>"><i class="fa fa-sign-in"></i> Login</a>
                    </li>
                    <?php }?>
                    </ul>
                </div><!--/. navbar-collapse -->
            </div>
        </div>
    <div class="container">
    <script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3Ws7EvlZS2PRlNFZfFrqOnlWM_XHYO1o&callback=initMap"
        type="text/javascript"></script>
