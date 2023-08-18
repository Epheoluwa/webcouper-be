@include('Layout.Header')

<body class="antialiased">
    @include('Layout.Navbar')

    <section id="services" class="services section-bg">
        <div class="container mt-5">

            <div class="section-title">
                <h2>All Users</h2>
            </div>

            <div class="row">
                @foreach ($users as $user)
                <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <a href="">{{ $user->username }}</a></h4>
                        <p>Email: {{ $user->email }}</p>
                        <p>Registration Date: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y ') }}
</p>
                        @if($user->is_active == 1)
                        <button class="btn btn-success mt-3 text-white">
                            Active User
                        </button>
                        @else
                        <button class="btn btn-danger mt-3 text-white">
                            Deactivated User
                        </button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section><!-- End Services Section -->
</body>
@include("Layout.Footer")

</html>