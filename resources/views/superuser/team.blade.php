@extends('superuser.layouts.master')

@section('title', 'team')

@section('myContent')
    <div class="row my-5">
        <div class="col-8 offset-md-2 my-5">
            <table class="table align-middle mb-0 bg-white" id="table-data"
                <thead class="bg-light">
                  <tr>
                    <th>Name</th>
                    <th>Shop</th>
                    <th>Status</th>
                    <th>Next Due Date</th>
                    <th>
                        Set Duration
                    </th>
                    <th>Address</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($personList as $p )

                    <tr>
                        <td>
                          <div class="d-flex align-items-center">
                            @if ($p->image == null)
                            <img
                            src="{{asset('img/blank-profile.webp')}}"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                            />
                            @else
                            <img
                            src="{{asset('storage/' . $p->image)}}"
                            alt=""
                            style="width: 45px; height: 45px"
                            class="rounded-circle"
                            />
                            @endif
                            <div class="ms-3">
                              <p class="fw-bold mb-1">{{$p->name}}</p>
                              <p class="text-muted mb-0">{{$p->email}}</p>
                            </div>
                          </div>
                        </td>
                        <td>
                            <input type="hidden" name="" id="userId" value="{{$p->id}}">
                          <p class="fw-normal mb-1">Shop Owner</p>
                        </td>
                        <td>
                          @if ($p->user_action === 0)
                          <span class="badge badge-success rounded-pill d-inline">Active</span>
                          @else
                          <span class="badge badge-danger rounded-pill d-inline">Expired Account</span>
                          @endif
                        </td>
                        <td>

                            @if ($p->duration > 0)
                                <p>{{$dayAfter}}</p>
                            @else
                                <p>Your Account Life is expired!</p>
                            @endif
                        </td>
                        <td>
                            {{$p->duration}}
                            <select name="" id="" class="form-control changeDuration">
                                <option value="">set duration</option>
                                <option value="30" @if ($p->duration === 30)
                                    selected
                                @endif>one month</option>
                                <option value="90" @if ($p->duration === 90)
                                    selected
                                @endif>three month</option>
                                <option value="180" @if ($p->duration === 180)
                                    selected
                                @endif>six month</option>
                                <option value="365" @if ($p->duration === 365)
                                    selected
                                @endif>one year</option>
                            </select>
                        </td>
                        <td>{{$p->address}}</td>
                        <td>
                            <select name="" id="" class="form-control changeValue">
                                <option value="">set action</option>
                                <option value="1" @if ($p->user_action === 1)
                                    selected
                                @endif>lock</option>
                                <option value="0" @if ($p->user_action === 0)
                                    selected
                                @endif>unlock</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection

@section('Ajaxpart')
    <script>
        $(document).ready(function(e){
            $('.changeValue').on('change',function(){
                $value=$(this).val();
                $parentNode = $(this).parents("tr");
                $userId = $parentNode.find('#userId').val();
                console.log($userId);

                $data = {
                    'userId' : $userId,
                    'userStatus' : $value
                };
                console.log($data);

                $.ajax({
                    type: 'Get',
                    url:'http://127.0.0.1:8000/superuser/ajax/userStatus',
                    data:$data,
                    success:function(response){
                    },

                    // error : function(request, status, error) {
                    //     var val = request.responseText;
                    //     console.log("error"+val);
                    // },
                })
                location.reload();

            })

            $('.changeDuration').on('change', function(){
                    $value=$(this).val();
                    $parentNode = $(this).parents("tr");
                    $userId = $parentNode.find('#userId').val();

                    $data = {
                    'userId' : $userId,
                    'userDuration' : $value
                    };
                    console.log($data);

                    $.ajax({
                        type: 'Get',
                        url : 'http://127.0.0.1:8000/superuser/ajax/userDuration',
                        data : $data,
                        success:function(response){
                    },
                    })

                    location.reload();
            })

        })
    </script>
@endsection
