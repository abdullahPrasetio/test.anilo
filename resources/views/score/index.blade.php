@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header py-2">
                <h5>Score</h5>
                <p class="text-small text-secondary">Data Score</p>
            </div>
            <div class="card-body">
                <a type="button" class="btn btn-primary text-white mb-5 float-right button-modal" data-toggle="modal" data-target="#staticBackdrop">
                    Add Score
                </a>
                <table class="table table-hover" id="table-scores">
                    <thead>
                        <tr>
                            <th>No </th>
                            <th>Subject</th>
                            <th>Student</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($scores as $score)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $score->subject_name }}</td>
                                <td>{{ $score->name }}</td>
                                <td>{{ $score->score }}</td>
                                <td>
                                    <a href="{{ route('score.edit',$score->id) }}" class="btn btn-warning button-edit" data-toggle="modal" data-target="#staticBackdrop" data-id="{{ $score->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <form action="{{ route('score.destroy',$score->id) }}" class="d-inline" method="POST">
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
                    url: "{{ route('score.create') }}",
                    success: function (data) {
                        $('#modal-body-form').html(data);
                    }
                });
            }
            function editData(id){
                $.ajax({
                    type: 'GET',
                    url:"{{ url('score') }}"+"/"+id+"/"+"edit" ,
                    success: function (data) {
                        $('#modal-body-form').html(data);
                    }
                });
            }
            $('#table-scores').DataTable({
            });
        } );
    </script>
@endpush