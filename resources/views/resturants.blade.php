@include('Layout.Header')

<body class="antialiased">
  @include('Layout.Navbar')

  <section id="team" class="team section-bg">
    <div class="container">

      <div class="section-title mt-5">
        <h2>Restaurants</h2>
      </div>

      <div class="row justify-content-center mb-5">
        <form action="{{ route('fetchresturants') }}" method="GET">
          <div class="col-lg-12 mt-5 mt-lg-0 d-flex justify-content-center">
            <div class="form-group col-md-8 justify-content-center">
              <input type="text" name="search" class="form-control" id="search" placeholder="Search Restaurants" value="{{ $query ?? '' }}" required>
            </div>
            <div class="form-group col-md-4">
              <div class="text-center"><button class="btn-get-started-two" type="submit">Search</button></div>
            </div>
          </div>
        </form>
      </div>


      <div class="row">
        @foreach ($restaurants as $restaurant)
        <div class="col-lg-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="member d-flex align-items-start">
            <div class="member-info">
              <h4>{{ $restaurant->name }}</h4>
              <span>{{ $restaurant->formatted_address}}</span>
              <p> Rating: {{ $restaurant->rating}} </p>
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