<head><title><?php echo $title;?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
.cards{
		margin-bottom:20px;
        margin-left:-50px;
        
	}
	.card{
		padding-top: 10px;

		margin-top:10px;
		box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
		border-radius: 10px !important;
        width:250px;
        height:150px;
	}
	.card-title{
		color: #fff;
		font-weight: bold;
		font-family: 'Source Sans Pro', 'Segoe UI', 'Droid Sans', Tahoma, Arial, sans-serif;
        text-align:center;        
	}
	.card.events-count{
		background-color: #2dbcf1;
        
		cursor: pointer;
	}
	.card.total-beneficiary{
		background-color:#1ebfae;
		cursor: pointer;
	}
	.card.total-volunteers{
		background-color:#f18455;
        cursor: pointer;
	}
	.card-text{
		text-align: center;
		color: #fff;
		font-weight: bold;
		font-size: 5rem;
		padding: 15px;
		font-family: sans-serif, "Times New Roman";
	}
    
</style>
</head>
  <div class="cards">
      <div class="container">
<div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-2">
    <div class="col-sm-6 col-md-4 col-xs-12" width="10px;">
        <div class="card events-count" >
            <div class="card-block">
                <h4 class="card-title" >EVENTS-CONDUCTED</h4>
                <div class="card-text"><?= $events_count ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xs-12">
        <div class="card total-beneficiary" >
            <div class="card-block">
                <h4 class="card-title" >BENEFECIARIES</h4>
                <div class="card-text"><?=  $beneficiary_count ?></div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-4 col-xs-12">
        <div class="card total-volunteers" >
            <div class="card-block">
                <h4 class="card-title">VOLUNTEERS</h4>
                <div class="card-text"><?=  $volunteers_count ?></div>
            </div>
        </div>
    </div>
    <?php if($this->session->session_data['role']=='1'){
          echo "pass";  
        }
        ?>
</div>
</div>
</div>