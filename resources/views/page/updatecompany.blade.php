@include('template.mheader') 
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h3 class="jumbotron-heading">Editing {{ $company->co_name }} ...</h3>
      <a href="{{ route('userdash') }}" class="btn btn-success"> Back to dashboard</a>
        @include('partial.flash')
    </div>
  </section>
  <div class="space py-5 bg-light">
    <div class="container">

      <div class="text-center">
        <h5>Update Profile</h5>
        <form class="form-signin text-left" method="post" action="{{ route('updateusercompany') }}">
            @csrf
            <div class="form-group">
                <label for="Name">Company Name</label>
                <input type="hidden" name="cid" value="{{ $company->cid }}" >
                <input type="text" class="form-control" id="Name" name="name" placeholder="Enter Name" value="{{ $company->co_name }}" required>
            </div>

            <div class="form-group">
                <label for="Email">Company Email</label>
                <input type="email" class="form-control" id="Email" name="email" placeholder="Enter Company Email" value="{{ $company->co_email }}" required>
            </div>

            <div class="form-group">
                <label for="Location">Company Location</label>
                <input type="text" class="form-control" id="Location" name="location" placeholder="Enter Location" value="{{ $company->co_loc }}" required>
            </div>
                    
            <button id="UpdateUserJs" type="submit" class="btn btn-primary">Update</button>
        </form>

        

      </div>

    </div>
  </div>

</main>   
@include('template.mfooter')