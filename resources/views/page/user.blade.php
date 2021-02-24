@include('template.mheader') 
<main role="main">
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Welcome to your Dashboard</h1>
        <p class="lead text-muted">Below are the list of companies you added to your profile<p>
        <p>
          <a href="{{ route('addcompany') }}" class="btn btn-primary my-2">Add more companies</a>
        </p>
        @include('partial.flash')
    </div>
  </section>
  <div class="space py-5 bg-light">
    <div class="container">
    <h5>{{ $page == 'dashboardsearch' ? 'Search result for :'. $request->search : ''}}</h5>
      <form class="form-inline mt-2 mt-md-0" method="get" action="{{ route('search') }}">
        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search" value="{{ $request->search ?? '' != '' ? $request->search : '' }}">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <div class="row">
      @forelse ($company as $comp)
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{ $comp->co_name }}</h5>
              <p class="card-text">{{ $comp->co_email }}</p>
              <p class="card-text"><span class="oi oi-icon-name" title="location" aria-hidden="true"></span>{{ $comp->co_loc }}</p>
              <a href="{{ route('editcompany', $comp->cid) }}" class="btn btn-primary">Edit</a>
              <a href="{{ route('removecompany', $comp->cid) }}" class="btn btn-danger">Remove</a>
            </div>
          </div>
        </div>
        @empty
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">No Company added to your List</h5>
              <a href="{{ route('addcompany') }}" class="btn btn-primary">Click to add</a>
            </div>
          </div>
        </div>
        @endforelse
        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form class="form-signin text-left" method="post" action="{{ route('updateuser') }}">
                  @csrf
                    <div class="form-group">
                        <label for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" name="name" placeholder="Enter Name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" class="form-control" id="Email" name="email" placeholder="Enter Email" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Mobile">Mobile</label>
                        <input type="phone" class="form-control" id="Mobile" name="mobile" placeholder="Enter Mobile Number" value="{{ $user->mobile }}" required>
                    </div>

                    <div class="form-group">
                        <label for="Country">Country</label>
                        <input type="text" class="form-control" id="Country" name="country" placeholder="Enter Country" value="{{ $user->country }}" required>
                    </div>
                    
                    <button id="UpdateUserJs" type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Companies</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <p class="modal-title">You have {{ 3 - App\Models\Assignment::userCompanyCount($user->id) }} more companies to add</p>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Company Name</th>
                      <th scope="col">Company Email</th>
                      <th scope="col">Company Location</th>
                      <th scope="col">#</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse ($allcompany as $allcomp)
                    <tr>
                      <td>{{ $allcomp->name }}</td>
                      <td>{{ $allcomp->email }}</td>
                      <td>{{ $allcomp->location }}</td>
                      <th scope="row"><a class="btn btn-success" href="{{ App\Models\Assignment::userCompanyCheck($user->id, $allcomp->id) == 1 ? route('removecompany', $allcomp->id) : route('addcompany', $allcomp->id) }}">{{ App\Models\Assignment::userCompanyCheck($user->id, $allcomp->id) == 1 ? 'Remove' : 'Add' }}</button></th>
                    </tr>
                    @empty
                    <tr>
                      <td>null</td>
                      <td>null</td>
                      <td>null</td>
                      <th scope="row"><a class="btn btn-success" href="">Add/Remove</a></th>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              <form class="form-signin text-left" method="post" action="{{ route('userpassword') }}">
                  @csrf
                    <div class="form-group">
                        <label for="Password">Old Password</label>
                        <input type="password" class="form-control" id="Password" name="oldpassword" placeholder="Password" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="Password">New Password</label>
                        <input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label for="Password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>

</main>   
@include('template.mfooter')