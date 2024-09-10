<form id="editForm" action="{{ route('students.store') }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">
      <label for="full_name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="full_name"  name="full_name" value="{{ $student->full_name }}">
      <div class="full_name_error text-danger error d-none"></div>

    </div>


    <div class="mb-3">
      <label for="class_no" class="form-label">Class No</label>
      <select name="class_no" id="class_no" class="form-select" >
        <option >Select Class</option>
        <option {{ $student->class_no == 1 ? 'Selected' : '' }} value="1">One</option>
        <option {{ $student->class_no == 2 ? 'Selected' : '' }} value="2">Two</option>
        <option {{ $student->class_no == 3 ? 'Selected' : '' }} value="3">Three</option>
        <option {{ $student->class_no == 4 ? 'Selected' : '' }} value="4">Foure</option>
        <option {{ $student->class_no == 5 ? 'Selected' : '' }} value="5">Five</option>
        <option {{ $student->class_no == 6 ? 'Selected' : '' }} value="6">Six</option>
        <option {{ $student->class_no == 7 ? 'Selected' : '' }} value="7">Seven</option>
        <option {{ $student->class_no == 8 ? 'Selected' : '' }} value="8">Eight</option>
        <option {{ $student->class_no == 9 ? 'Selected' : '' }} value="9">Nine</option>
        <option {{ $student->class_no == 10 ? 'Selected' : '' }} value="10">Ten</option>
      </select>
      <div class="class_no_error text-danger error d-none"></div>

    </div>

    <div class="mb-3 ">
        <label for="photo" class="form-label">Choose Photo</label>
        <input name="photo" class="form-control" type="file" id="photo">
        <div class="img_div mt-3">
            <img class="student_image"  id="display_image" width="auto" height="250px" src="{{ asset('uploads/students_image/'.$student->photo) }}"  alt="">
        </div>

        <div class="photo_error text-danger error d-none"></div>

    </div>
    <div class="buttons d-flex  justify-content-end">
        <button type="button" class="bootbox-close-button btn btn-danger me-3 px-3">Cancel</button>
        <button type="submit" class="btn btn-success me-3 px-3">Save</button>

    </div>
  </form>
