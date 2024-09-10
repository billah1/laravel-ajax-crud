<form id="createForm" action="{{route('students.store')}}" method="POST" enctype="multipart/form-data">

    @csrf

    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="full_name"  name="full_name">
      <div class="full_name_error text-danger error d-none"></div>
    </div>

    <div class="mb-3">
      <label for="class_no" class="form-label">Class No</label>
      <select name="class_no" id="class_no" class="form-select" >
        <option selected>Select Class</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
        <option value="4">Foure</option>
        <option value="5">Five</option>
        <option value="6">Six</option>
        <option value="7">Seven</option>
        <option value="8">Eight</option>
        <option value="9">Nine</option>
        <option value="10">Ten</option>
      </select>
      <div class="class_no_error text-danger error d-none"></div>

    </div>

    <div class="mb-3 ">
        <label for="photo" class="form-label">Choose Photo</label>
        <input name="photo" class="form-control" type="file" id="photo">
          <img id="display_image" width="auto" height="250px" src=""  alt="">
        <div class="photo_error text-danger error d-none"></div>

    </div>
    <div class="buttons d-flex  justify-content-end">
        <button type="button" class="bootbox-close-button btn btn-danger me-3 px-3">Cancel</button>
        <button type="submit" class="btn btn-success me-3 px-3">Save</button>

    </div>
  </form>
