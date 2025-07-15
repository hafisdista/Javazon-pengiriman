@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-5">Menu Pengiriman</h1>
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('shipping.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Nama :</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email :</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nomor Handphone :</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Daerah :</label>
                        <input type="text" class="form-control" name="region" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Kota :</label>
                        <input type="text" class="form-control" name="city" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Alamat :</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Ulasan :</label>
                        <textarea class="form-control" name="review" rows="3"></textarea>
                    </div>
                </div>
                <button class="btn btn-success w-100" type="submit">Order Now</button>
            </form>
        </div>
    </div>
</div>
@endsection
