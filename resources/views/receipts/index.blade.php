@extends('layouts.app')
@section('style')
    <style>
        body {
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
    </style>
@endsection

@section('content')
    <div class="">
        <div class="bg-dark">
            <section class="container-fluid sec2  text-dark">
                <div class="container">
                    <div class="card" style="height: 40rem;">
                        <div class="card-header">
                            <h1>
                                รายการบิล
                            </h1>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th scope="col">ตึก</th>
                                    <th scope="col">ชั้น</th>
                                    <th scope="col">ห้อง</th>
                                    <th scope="col">ประเภท</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                    @if(auth()->check())
                                        <tr>
                                            <td>{{ $bill->room->building->name }}</td>
                                            <td>{{ $bill->room->floor }}</td>
                                            <td>{{ $bill->room->number }}</td>
                                            <td>{{ $bill->room->type->name }}</td>
                                            <td><a href="{{ route("receipt.show.report",['id' => $bill->id]) }}"><button type="button" class="btn btn-outline-success">ออกบิล</button></a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </section>
        </div>





    </div>
@endsection
