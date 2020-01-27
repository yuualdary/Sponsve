@extends('welcome')
@section('content')
    {{--<div class="bg-light py-3">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Update</strong></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--melihat user siapa saja yang masuk ke DB dan bisa melakukan edit--}}
    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Edit Profile</h2></div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <table>
                            <tr>
                                <td>
                                    Id
                                </td>
                                <td>
                                    Nama
                                </td>
                                <td>
                                    Email
                                </td>
                                <td>
                                    Gender
                                </td>
                                <td>
                                    Auth
                                </td>
                            </tr>
                            @foreach($user as $u)
                                <tr>
                                    <td>
                                        {{$u->id}}
                                    </td>
                                    <td>
                                        {{$u->name}}
                                    </td>
                                    <td>
                                        {{$u->email}}
                                    </td>
                                    <td>
                                        {{$u->gender}}
                                    </td>
                                    <td>
                                        <a  href="{{url('/updUser/'.$u->id.'/'.$u->user_id)}}">Edit</a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
            </div>
        </div>
@endsection