@include('template.header') 
    <main role="main" class="inner cover">
    @include('partial.flash')
    <form class="form-signin text-left" method="post" action="{{ route('userregister') }}">
    @csrf
        <h4 class="cover-heading">New User Registeration</h4>
        <div class="form-group">
            <label for="Email">Email address</label>
            <input type="email" class="form-control" id="Email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="Name" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
            <label for="Mobile">Mobile</label>
            <input type="phone" class="form-control" id="Mobile" name="mobile" placeholder="Enter Mobile Number" value="{{ old('mobile') }}" required>
        </div>

        <div class="form-group">
            <label for="Country">Country</label>
            <input type="text" class="form-control" id="Country" name="country" placeholder="Enter Country" value="{{ old('country') }}" required>
        </div>

        <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
            <label for="Password">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <label>Already have a user account? <a href="{{ route('userlogin') }}">click to login</a></label>
    </form>
    </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Submited by Kareem Taofk.</p>
        </div>
      </footer>
    </div>
   
@include('template.footer')