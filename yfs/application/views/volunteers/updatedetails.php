
<form action="updateddata" method="post" class ="col-lg-6 col-lg-offset-3 centered">
  <div class="form-group">
    <label for="preferences">Preferences</label>
    <select class="form-control" id="preferences" name="preferences[]" multiple>
    <option>Health</option>
    <option>Education</option>
    <option>Enablement</option>
    <option>Sports</option>
    <option>Enablement</option>
    </select>
  </div>

  <div class="form-group">
      <label for="latitude">Latitude</label>
      <input type="text" class="form-control" name="latitude" id="latitude"/>
  </div>
  <div class="form-group">
      <label for="longitude">Longitude</label>
      <input type="text" class="form-control" name="longitude" id="longitude"/>
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
