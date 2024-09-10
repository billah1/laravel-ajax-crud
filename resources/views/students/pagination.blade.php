{{-- table --}}
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
                    <img class="student_image" width="80px" height="50px" src="{{ asset('uploads/students_image/'.$student->photo) }}"  alt="">
                </td>
                <td>
                    <a title="View" href="{{ route('students.show',$student->id ) }}" id="BootModal" class="btn btn-info"><i class="fa-regular fa-eye"></i></a>

                    <a title="Edit" href="{{ route('students.edit',$student->id ) }}"
                        formUrl="{{ route('students.update', $student->id) }}" id="BootModal" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form class="d-inline deleteForm" action="{{ route('students.destroy',$student->id ) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a title="Delete" href="{{ route('students.destroy',$student->id ) }}" class=" btn btn-danger"><i class="fa-regular fa-trash-can"></i></a>
                    </form>


                </td>
            </tr>
            @empty
            <tr ><td colspan="5"><div class=" text-center text-danger"><b> 404 Not Found</b> </div></td></tr>
            @endforelse


        </tbody>
    </table>
    {{ $students->links() }}

</div>
