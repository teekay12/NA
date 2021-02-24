@include('template.mheader') 
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h3 class="jumbotron-heading">Add new company</h3>
      <p class="modal-title">You have {{ 3 - App\Models\Assignment::userCompanyCount($user->id) }} more companies to add</p>
      <a href="{{ route('userdash') }}" class="btn btn-success"> Back to dashboard</a>
        @include('partial.flash')
    </div>
  </section>
  <div class="space py-5 bg-light">
    <div class="container">

      <div class="text-center">
        <h5>Update Profile</h5>
        <form class="form-signin text-left" method="post" action="{{ route('addusercompany') }}">
            @csrf
            <div class="form-group">
                <label for="Email">Company Email address</label>
                <input type="email" class="form-control" id="Email" name="email" placeholder="Enter email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="Name">Company Name</label>
                <input type="text" class="form-control" id="Name" name="name" placeholder="Enter Name" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="Country">Company Location</label>
                <input type="text" class="form-control" id="Country" name="location" placeholder="Enter Location" value="{{ old('location') }}" required>
            </div>
                    
            <button id="UpdateUserJs" type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>

    </div>
  </div>

</main>   
@include('template.mfooter')