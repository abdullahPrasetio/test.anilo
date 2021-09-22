@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header py-2">
                <h5>Student</h5>
                <p class="text-small text-secondary">Data Student</p>
            </div>
            <div class="card-body">
                <a type="button" class="btn btn-primary text-white mb-5 float-right button-modal" data-toggle="modal" data-target="#staticBackdrop">
                    Add Student
                </a>
                <table class="table table-hover" id="table-student">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <a href="{{ route('student.edit',$student->id) }}" class="btn btn-warning button-edit" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $student->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <form action="{{ route('student.destroy',$student->id) }}" class="d-inline" method="POST">
                                        @method("DELETE")
                                        @csrf
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {

            $('.button-modal').on('click',function(e){
                createData()
            });
            $('.button-edit').on('click',function(e){
                let id=$(this).data('id')
                editData(id)
            });
            function createData(){
                $.ajax({
                    type: 'GET',
                    url: "{{ route('student.create') }}",
                    success: function (data) {
                        $('#modal-body-form').html(data);
                    }
                });
            }
            function editData(id){
                $.ajax({
                    type: 'GET',
                    url:"{{ url('student') }}"+"/"+id+"/"+"edit" ,
                    success: function (data) {
                        $('#modal-body-form').html(data);
                    }
                });
            }
            $('#table-student').DataTable();
        } );
    </script>
@endpush