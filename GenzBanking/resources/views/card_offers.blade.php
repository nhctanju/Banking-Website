@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Available Card Offers</h2>
    <div class="row">
    <table border="1" cellpadding="20">
        <thead>
            <tr>
                <th> Card Name</th>
                <th>Description</th>
                <th>Annual Fee</th>
                <th>Interest Rate</th>
            </tr>
        </thead>
        <tbody>
            @foreach($offers as $offer)
                <tr>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->description }}</td>
                    <td>{{ $offer->annual_fee }}</td>
                    <td>{{ $offer->interest_rate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

            
               

 
