@extends('students.layouts.app')
@section('content')
<div class="container">
    <div class="row  my-4 vertical-align-center">
        <div class="col-md-6">
            <h2>Create Student Record</h2>
        </div>
        <div class="col-md-6">
            <a title="Create" href="{{ route('students.create') }}" formUrl="{{ route('students.store') }}"
                id="BootModal" class="float-end btn btn-primary ">Create Student</a>

        </div>
    </div>




    {{-- table --}}
    <div class="student-table-parent">
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Class</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $key => $student )
                    <tr>
                        <th>{{ ++$key }}</th>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->class_no }}</td>
                        <td>
                            <img class="student_image" width="80px" height="50px"
                                src="{{ asset('uploads/students_image/'.$student->photo) }}" alt="">
                        </td>
                        <td>
                            <a title="View" href="{{ route('students.show',$student->id ) }}" id="BootModal"
                                class="btn btn-info"><i class="fa-regular fa-eye"></i></a>

                            <a title="Edit" href="{{ route('students.edit',$student->id ) }}"
                                formUrl="{{ route('students.update', $student->id) }}" id="BootModal"
                                class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>

                            <form class="d-inline deleteForm" action="{{ route('students.destroy',$student->id ) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <a title="Delete" href="{{ route('students.destroy',$student->id ) }}"
                                    class=" btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>
                            </form>



                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class=" text-center text-danger"><b> 404 Not Found</b> </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
            {{ $students->links() }}

        </div>
    </div>


</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {

        // csrf protection
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        let formId = "";
        let formUrl = "";
        let dialog = '';

        // bootbox modal show
        $(document).on('click', '#BootModal', function (e) {
            e.preventDefault();

            const modalUrl = $(this).attr('href');
            const modalTitle = $(this).attr('title');
            // form url
            formUrl = $(this).attr('formUrl');

            $.ajax({
                type: "GET",
                url: modalUrl,
                success: function (res) {

                    dialog = bootbox.dialog({
                        title: 'Student ' + modalTitle,
                        message: "<div class='studentContent'></div>",
                        size: 'large',

                    });

                    // push the thml in studentContent div
                    $('.studentContent').html(res);
                    // generate form id
                    formId = "#" + $('.studentContent').find('form').attr('id');
                    // generate form action
                    $(formId).attr('action', formUrl);

                }
            });


        });

        // form submit
        $(document).on('submit', formId, function (e) {
            e.preventDefault();
            let successMsg = '';
            let formData = new FormData($(formId)[0]);

            $.ajax({
                type: "POST",
                url: formUrl,
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(res);
                    formId === '#editForm' ? successMsg = 'Updated' : successMsg =
                    'Created';
                    if (res.status === 200) {
                        dialog.modal('hide');
                        $('.student-table-parent').load(location.href + ' .student-table-parent');
                        toastr.success('Your Student ' + successMsg + ' Successfully!',
                            'Student ' + successMsg + '!')

                    } else {
                        $(formId).find('.error').removeClass('d-none');
                        $(formId).find('.full_name_error').text(res.errors.full_name);
                        $(formId).find('.class_no_error').text(res.errors.class_no);
                        $(formId).find('.photo_error').text(res.errors.photo);
                    }



                }
            });
        });


        // image preview
        $(document).on("change", "#photo", function (e) {
          e.preventDefault();

            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $("#display_image").attr("src", event.target.result);
                };
                reader.readAsDataURL(file);

            }
        });


        // delete
        $(document).on('click', '.deleteForm', function (e) {
            e.preventDefault();

            let csrfToken = $(this).find('input[name="_token"]').val();
            let deleteUrl = $(this).attr('action');

            bootbox.confirm({
                message: " <div class='message text-center'><i class='display-4 text-danger fa-solid fa-question'></i><div class='message-title fs-1 font-weight-bold'>Are you sure?</div> <div class='message-body mt-2'>You won't be able to revert this!</div></div>  ",
                buttons: {

                    cancel: {
                        confirm: {
                            label: 'Yes Delete it!',
                            className: 'btn-success'
                        },
                        label: 'Cancel',
                        className: 'btn-danger'
                    }
                },
                callback: function (result) {
                    if (result) {
                        $.ajax({
                            type: "POST",
                            url: deleteUrl,
                            data: {
                                "_token": csrfToken,
                                "_method": 'DELETE'
                            },
                            success: function (res) {

                                console.log(res);

                                if (res.status === 200) {

                                    $('.table').load(location.href + ' .table');
                                    formId !== '#editForm' || formId !== '#createForm' ? successMsg = 'Deleted' : successMsg = '';
                                    toastr.success('Your Student  ' +successMsg + ' Successfully!', 'Student ' + successMsg + '!')
                                }
                                else
                                {
                                    toastr.error('Incorrect Student ', '404 Not found!')

                                }
                            }
                        });


                    }
                }
            });
            // end confirmation

        })

        // pagination
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            console.log(page);
            $.ajax({
                url: "students/pagination/?page=" + page,
                success: function (res) {
                    $('.student-table-parent').html(res);
                }
            });
        });


    });

</script>
@endsection
