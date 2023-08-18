@include('Layout.Header')

<body class="antialiased">
    @include('Layout.Navbar')
    <section id="skills" class="skills">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                    <img src="assets/img/skills.png" class="img-fluid" alt="">
                </div>

                <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4><a href="">{{ $user->username }}</a></h4>
                        <p>Email: {{ $user->email }}</p>
                        <p>Registration Date: {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y ') }}
</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

</body>
@include('Layout.Footer')

</html>