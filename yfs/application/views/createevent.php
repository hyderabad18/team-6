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

<a href="http://localhost/team-6/yfs/Admin" class="btn btn-info" role="button">Home</a><br><br>

<div class="container">
  <h2>Create Event</h2>
	<div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
    </div>
	
	
	 <div class="form-group">
		<label class="location">Location:</label>
		<input type="text" class="form-control" id="location" placeholder="Enter Location" name="location" >
	</div>
	
 <div class="form-group">
		<label class="type">Type:</label>
		<input type="text" class="form-control" id="type" placeholder="Enter Type" name="type" >
	</div>
	
	<div class="form-group">
		<label class="duration">Duration</label>
		<input type="text" class="form-control" id="duration" placeholder="Enter Duration" name="duration" >
	</div>
	
   <div class="form-group">
		<label class="Duration">Duration:</label>
		<label class="Start Date">Start Date:</label>
		<input type="text" class="form-control" id="startroom" placeholder="Enter Start Date" name="startdate" >
		<label class="End Date" >End Date:</label>
		<input type="text" class="form-control" id="endroom" placeholder="Enter End Date" name="enddate" >
	</div>
	
   <div class="form-group">
		<label class="Volunteer count" >Volunteer Count:</label>
		<input type="text" class="form-control" id="volcount" placeholder="Enter Volunteer count" name="volcount" >
	</div>
	
  <div class="form-group">
		<label class="Beneficiary count" >Beneficiary Number:</label>
		<input type="text" class="form-control" id="bno" placeholder="Enter count of Beneficiary" name="bno" >
	</div>
  <button type="submit" class="btn btn-primary pull-right">Create</button>
  <button type="reset" class="btn btn-danger pull-right">Reset</button>
   
  </form>
</div>

</body>
</html>
