@include('template.header') 
    <main role="main" class="inner cover">
    @include('partial.flash')
    <form class="form-signin text-left" method="post" action="{{ route('userlogin') }}">
    @csrf
        <h1 class="cover-heading">Please sign in</h1>
        <div class="form-group">
            <label for="Email">Email address</label>
            <input type="email" class="form-control" id="Email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
            <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
        </div>
        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <label>Dont't have a user account? <a href="{{ route('userregister') }}">click to register</a></label>
    </form>
    </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Submited by Kareem Taofk.</p>
        </div>
      </footer>
    </div>
   
@include('template.footer')