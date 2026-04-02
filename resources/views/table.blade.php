@extends('layouts.template')

@section('styles')
    <style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
    </style>
@endsection


@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Tabel Data</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-stripped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>doni</td>
                        <td>sleman</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>sintong</td>
                        <td>yaya</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>oke</td>
                        <td>sip</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>gas</td>
                        <td>oookk</td>
                    </tr>
                </tbody>
            </table>
        </div>




</div>
@endsection
