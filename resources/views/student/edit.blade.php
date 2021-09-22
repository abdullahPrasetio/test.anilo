<form action="{{ route('student.update',$student->id) }}" method="post">
    @method("PUT")
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Type name student"class="form-control" value="{{ old("name",$student->name) }}">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary float-right mx-2">Update</button>
        <button type="button" class="btn btn-secondary float-right mx-2" data-dismiss="modal">Close</button>
    </div>
</form>