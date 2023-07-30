@extends('superuser.layouts.master')

@section('title', 'team')

@section('myContent')
    <div class="row my-5">
        <div class="col-md-8 offset-md-2 my-5">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                  <tr>
                    <th>Name</th>
                    <th>Shop</th>
                    <th>Status</th>
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
                          <p class="fw-normal mb-1">Shop Owner</p>
                          <p class="text-muted mb-0">IT department</p>
                        </td>
                        <td>
                          <span class="badge badge-success rounded-pill d-inline">Active</span>
                        </td>
                        <td>{{$p->address}}</td>
                        <td>
                            <select name="" id="" class="form-control">
                                <option value="">set action</option>
                                <option value="1">lock</option>
                                <option value="0">unlock</option>
                            </select>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection
