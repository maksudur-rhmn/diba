<main id="tg-main" class="tg-main tg-haslayout">
    <div class="container">
        <div class="row">
            <div id="tg-onecolumns" class="tg-onecolumns">
                @php
                    $i = 1;
                @endphp
                @foreach($ambulances as $ambulance)   
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 py-4">
                    <div id="tg-content" class="tg-content">
                        <div class="tg-directpost tg-detailpage">
                            <figure class="tg-directpostimg">
                                <a href="{{ route('front.hos') }}"><img src="{{ asset('uploads/ambulance') }}/{{ $ambulance->ambulance_image }}" alt="image description"></a>
                                @auth
                                <button style="margin-bottom: 20px;" type="button" class="tg-btn" data-toggle="modal" data-target="#exampleModal{{ $i }}">Make An Appointment</button>
                                @endauth
                            </figure>
                            

                            <div class="tg-directinfo">
                                <div class="tg-directposthead">
                                    <h2>{{ $ambulance->name }}</h2>
                                    <div class="tg-subjects"><span>Address:</span>{{ $ambulance->address }}</div>
                                    <div class="tg-subjects"><span>City:</span>{{ $ambulance->relationBetweenCity->name }}</div>
                                    @auth
                                        <div class="tg-subjects"><span>Phone:</span>{{ $ambulance->phone }}</div>
                                    @endauth
                                    @guest
                                    <a href="{{ url('/login') }}" class="tg-btn">Details</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                  
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $i }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Appointment</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="card">
                                          <div class="card-header">
                                              <h2>Provide Your Information</h2>
                                          </div>
                                          <form action="{{ route('appointment.store') }}" method="POST">
                                            @csrf
                                          
                                          <div class="card-body">
                                              <div class="form-group">
                                                  <label>Your Name</label>
                                                  <input type="text" name="name" value="{{ Auth::user()->name }}">
                                              </div>
                                          </div>
                                          <div class="card-body">
                                              <div class="form-group">
                                                  <label>Phone Number</label>
                                                  <input name="phone" type="text" value="{{ Auth::user()->phone }}">
                                              </div>
                                          </div>
                                          <div class="card-body">
                                              <div class="form-group">
                                                <select class="cat" name="appointment_time">
                                                    <option>Select Time Schedule</option>
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                </select>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="item_name" value="{{ $ambulance->name }}">
                                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary">Confirm</button>
                                    </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              @php
                                  $i++
                              @endphp
                @endforeach
            </div>
            {{ $ambulances->links() }}
        </div> 
    </div>
</main>


