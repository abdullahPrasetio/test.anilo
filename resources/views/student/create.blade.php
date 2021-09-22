<form action="{{ route('student.store') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Type name student"class="form-control">
        @error('name')
            <div class="valid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary float-right mx-2">Submit</button>
        <button type="button" class="btn btn-secondary float-right mx-2" data-dismiss="modal">Close</button>
    </div>
</form>