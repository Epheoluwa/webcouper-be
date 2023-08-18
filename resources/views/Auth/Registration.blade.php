@include('Layout.Header')
<section class="contact">
    <div class="container">
        <div class="section-title">
            <h2>Registration</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="{{ url('register') }}" method="post" role="form" class="php-email-form">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="text-center"><button type="submit">Register</button></div>
                    <a class="small" href="{{ url('login') }}">Already have an account? Login Here</a>
                </form>
            </div>
        </div>

    </div>
</section>
@include('Layout.Footer')