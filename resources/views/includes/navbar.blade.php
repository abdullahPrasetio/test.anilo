<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
    <a class="navbar-brand" href="#">Anilo Test</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item {{ request()->routeIs('student.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('student.index') }}">Student</a>
        </li>
        <li class="nav-item {{ request()->routeIs('subject.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{route('subject.index') }} ">Subject</a>
        </li>
        <li class="nav-item {{ request()->routeIs('score.index') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('score.index') }}">Score</a>
        </li>
      </ul>
    </div>
  </nav>