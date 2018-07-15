<!DOCTYPE html>
<html lang="en">
<head>
  <title>YFS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 align="center" >Create Event</h2>
  <?php echo form_open("admin/createEvent",array("class"=>"form-group","role"=>"form"));?>
  <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset-2">
  
        <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="event_name" placeholder="Enter Event Name"  name="event_name">
        </div>

	<div>
	 <div class="form-group">
		<label class="location">Location:</label>
		<input type="text" class="form-control" id="location" placeholder="Enter Location" name="location" >
	</div>
	</div>
    <div class="form-group">
		<label class="type">Type:</label>
		<input type="text" class="form-control" id="type" placeholder="Enter Type" name="type" >
	</div>

    <div class="form-group">
		<label class="type">Description:</label>
		<textarea type="textarea" class="form-control" id="type" placeholder="Enter Description" name="type" ></textarea>
	</div>

   <div class="form-group">
		<label class="Duration">Duration:</label>
		<label class="Start Date">Start Date:</label>
		<input type="date" class="form-control" id="startroom" placeholder="Enter Start Date" name="startdate" >
		<label class="End Date" >End Date:</label>
		<input type="date" class="form-control" id="endroom" placeholder="Enter End Date" name="enddate" >
	</div>
	
   <div class="form-group">
		<label class="Volunteer count" >Volunteer Count:</label>
		<input type="text" class="form-control" id="volcount" placeholder="Enter Volunteer count" name="volcount" >
	</div>
	
  <div class="form-group">
		<label class="Beneficiary count" >Beneficiary Number:</label>
		<input type="text" class="form-control" id="bno" placeholder="Enter count of Beneficiary" name="bno" >
	</div>
  <button type="submit"  class="btn btn-primary ">Create</button>
  <button type="reset" class="btn btn-danger">Reset</button>
   </div>
  <?php echo form_close(); ?>
</div>

</body>
</html>
