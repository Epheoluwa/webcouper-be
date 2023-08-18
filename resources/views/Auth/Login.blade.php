@include('Layout.Header')
<section  class="contact">
    <div class="container">
        <div class="section-title">
            <h2>Login</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="{{ url('login') }}" method="post" role="form" class="php-email-form">
                @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    </div>
                   
                    <div class="text-center"><button type="submit">Login</button></div>
                    <a class="small text-center" href="{{ url('register') }}">Don't have an account? Register Here</a>
                </form>
            </div>
        </div>

    </div>
</section>
@include('Layout.Footer')