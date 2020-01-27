@extends('welcome')
@section('content')
    {{--<div class="bg-light py-3">--}}
        {{--<div class="container">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-12 mb-0"><a href="{{ url('/') }}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Update</strong></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="site-section">
        <div class="container">

            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Delete Category</h2></div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <table>
                            <tr>
                                <td>
                                    Id
                                </td>
                                <td>
                                    Category Name
                                </td>

                            </tr>
                            @foreach($category as $c)
                                <tr>
                                    <td>
                                        {{$c->id}}
                                    </td>
                                    <td>
                                        {{$c->categoryname}}
                                    </td>
                                    <td>
                                        <a href="{{url('/updcategory/'.$c->id)}}">Update</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <p>
                        {{$category->appends([request()->query])->links()}}
                    </p>

                    </div>
                </div>
            </div>
        </div>
@endsection