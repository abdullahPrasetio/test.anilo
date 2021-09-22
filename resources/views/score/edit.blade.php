<form action="{{ route('score.update',$score->id) }}" method="post">
    @method("PUT")
    @csrf
    <div class="form-group">
        <label for="student_id">Student</label>
        <select name="student_id" class="form-control" id="student_id">
            @foreach ($students as $item)
                <option value="{{ $item->id }}" {{ $score->student_id==$item->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
        @error('student_id')
            <div class="valid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="subject_id">Student</label>
        <select name="subject_id" class="form-control" id="subject_id">
            @foreach ($subjects as $item)
                <option value="{{ $item->id }}"  {{ $score->subject_id==$item->id ? 'selected' : '' }}>{{ $item->name }}</option>
            @endforeach
        </select>
        @error('subject_id')
            <div class="valid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="score">Score</label>
        <input type="number" max="100" value="{{ $score->score }}"name="score" id="score" placeholder="Type score"class="form-control" value="{{ old('score') }}">
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