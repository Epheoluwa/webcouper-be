@include('Layout.Header')

<body class="antialiased">
  @include('Layout.Navbar')

  <section id="team" class="team section-bg">
    <div class="container">

      <div class="section-title mt-5">
        <h2>Recipes</h2>
      </div>


      <div class="row justify-content-center mb-5">
        <form action="{{ route('fetchrecipes') }}" method="GET">
          <div class="col-lg-12 mt-5 mt-lg-0 d-flex justify-content-center">
            <div class="form-group col-md-8 justify-content-center">
              <input type="text" name="search" class="form-control" id="search" placeholder="Search recipe" value="{{ $query ?? '' }}" required>
            </div>
            <div class="form-group col-md-4">
              <div class="text-center"><button class="btn-get-started-two" type="submit">Search</button></div>
            </div>
          </div>
        </form>
      </div>

      <div class="row">
        @foreach($searchparams as $search)
        <div class="col-lg-6 mb-4">
          <div class="member d-flex align-items-start">
            @if (isset($search->food->image))
            <div class="pic"><img src="{{ $search->food->image }}" class="img-fluid" alt=""></div>
            @endif

            <div class="member-info">
              <h4>{{ $search->food->label}}</h4>
              <span>{{ $search->food->category}}</span>
              <p>{{ $search->food->nutrients->ENERC_KCAL}} calories</p>
            </div>
          </div>
        </div>
        @endforeach

      </div>

    </div>
  </section><!-- End Team Section -->
</body>
@include('Layout.Footer')

</html>