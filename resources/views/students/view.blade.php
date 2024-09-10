<section class="" >
    <div class="container py-5 ">
      <div class="row d-flex justify-content-center align-items-center ">
        <div class="col-md-12 ">

          <div class="card" style="border-radius: 15px;">
            <div class="card-body text-center">
              <div class="mt-3 mb-4">
                <img src="{{ asset('uploads/students_image/'.$student->photo) }}"
                  class="rounded-circle img-fluid" style="width: 100px;height:100px; object-fit: contain;" />
              </div>
              <h4 class="mb-2 text-capitalize">{{ $student->full_name }}</h4>
              <p class="text-muted mb-4">@ {{ $student->full_name }} <span class="mx-2">|</span> </p>
              <div class="mb-4 pb-2">
                <button type="button" class="btn btn-outline-primary btn-floating">
                  <i class="fab fa-facebook-f fa-lg"></i>
                </button>
                <button type="button" class="btn btn-outline-primary btn-floating">
                  <i class="fab fa-twitter fa-lg"></i>
                </button>
                <button type="button" class="btn btn-outline-primary btn-floating">
                  <i class="fab fa-skype fa-lg"></i>
                </button>
              </div>
              <button type="button" class="btn bootbox-close-button btn-danger btn-rounded btn-lg">--Cancel--</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
