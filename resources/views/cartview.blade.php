@extends('welcome')
@section('content')

    <div class="site-section">
        <div class="container">
{{--Tampilan untuk menampilkan apa saja yang sudah dimasukkin kedalam cart--}}
            <div class="row mb-5">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="float-md-left mb-4"><h2 class="text-black h5">Shopping Cart</h2></div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <table>
                            <tr>
                                <td>
                                    Id Image
                                </td>
                                <td>
                                    Id User
                                </td>
                                <td>
                                    Title
                                </td>
                                <td>
                                    Caption
                                </td>
                                <td>
                                    Price
                                </td>
                            </tr>
                            {{--tiap data yang telah dimasukkin menggunakan foreach jadi bisa terus bertambah--}}
                            @foreach($cart as $c)
                                <tr>
                                    <td>
                                        {{$c->id}}
                                    </td>
                                    <td>
                                        {{$c->user_id}}
                                    </td>
                                    <td>
                                        {{$c->title}}
                                    </td>
                                    <td>
                                        {{$c->caption}}
                                    </td>
                                    <td>
                                        {{$c->price}}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <p>
                        {{$cart->appends([request()->query])->links()}}
                    </p>
            </div>
        </div>
@endsection