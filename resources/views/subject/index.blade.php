@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header py-2">
                <h5>Subject</h5>
                <p class="text-small text-secondary">Data Subject</p>
            </div>
            <div class="card-body">
                <a type="button" class="btn btn-primary text-white mb-5 float-right button-modal" data-toggle="modal" data-target="#staticBackdrop">
                    Add Subject
                </a>
                <table class="table table-hover" id="table-subject">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                    <a href="{{ route('subject.edit',$subject->id) }}" class="btn btn-warning button-edit" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $subject->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <form action="{{ route('subject.destroy',$subject->id) }}" class="d-inline" method="POST">
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
                    url: "{{ route('subject.create') }}",
                    success: function (data) {
                        $('#modal-body-form').html(data);
                    }
                });
            }
            function editData(id){
                $.ajax({
                    type: 'GET',
                    url:"{{ url('subject') }}"+"/"+id+"/"+"edit" ,
                    success: function (data) {
                        $('#modal-body-form').html(data);
                    }
                });
            }
            $('#table-subject').DataTable();
        } );
    </script>
@endpush