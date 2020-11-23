@extends('layouts.app')

@section('style')
    <style>
        body {
            background-color:#1d1d1d !important;
            font-family: "Asap", sans-serif;
            /*margin:10px;*/
            /*font-size:16px;*/
        }
        tr:hover {
            cursor: pointer;
        }

    </style>
@endsection

@section('content')
    <div class="container justify-content-center">
        <div class="card" style="height: 40rem;">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h1>ผู้ดูแลทั้งหมดในระบบ</h1>
                    </div>
                    <div class="col text-right">
                        <a href="{{ route('admin.create') }}" class="btn btn-outline-primary"><h4>เพิ่มผู้ดูแล</h4></a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ชื่อ-นามสกุล</th>
                        <th scope="col">อีเมล</th>
                        <th scope="col">ที่อยู่</th>
                        <th scope="col">เบอร์โทร</th>
                        <th scope="col">วันที่เพิ่มในระบบ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($staffs as $staff)
                        <tr onclick="window.location = '{{ route('admin.show', ['admin' => $staff->id]) }}'">
                            <th scope="row"><?= $i++ ?></th>
                            <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>{{ $staff->address }}</td>
                            <td>{{ $staff->phone_number_1 }}</td>
                            <td>{{ $staff->created_at }}</td>
                        </tr>
                    @endforeach
                    <tr onclick="window.location='{{ route("admin.create") }}'">
                        <td colspan="6" class="text-left">+ เพิ่มผู้ดูแล</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
@endsection
