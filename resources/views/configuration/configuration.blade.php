@extends('layouts.app')

@section('config-menu')
@endsection
@section('content')
    <div class="container">
        <h1>Configuration</h1>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Created</th>
                <th scope="col">Customer</th>
                <th scope="col">Total</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr class="
                    @if($order->status == 'processing')
                        table-danger
                    @endif

                    @if($order->status == 'payed')
                        table-warning
                    @endif

                    @if($order->status == 'shipped')
                        table-success
                    @endif">
                    <th scope="row">{{ $order->id }}</th>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->total() }} €</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

@endsection
