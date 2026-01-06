@extends('layouts.admin')

@section('title', 'Daftar Users')

@section('content')

<div style="max-width:1000px; margin:0 auto; font-family:Inter, Arial, sans-serif;">

    <h1 style="font-size:26px; margin-bottom:20px;">Daftar Users</h1>

    <div style="
        background:#fff;
        border-radius:10px;
        box-shadow:0 4px 12px rgba(0,0,0,0.05);
        overflow:hidden;
    ">

        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa; text-align:left;">
                    <th style="padding:14px;">Name</th>
                    <th style="padding:14px;">Email</th>
                    <th style="padding:14px;">Role</th>
                    <th style="padding:14px;">Created At</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr style="border-top:1px solid #eee;">
                    <td style="padding:14px;">{{ $user->name }}</td>
                    <td style="padding:14px; color:#555;">{{ $user->email }}</td>
                    <td style="padding:14px;">
                        <span style="
                            padding:4px 10px;
                            border-radius:12px;
                            font-size:12px;
                            background:
                                {{ $user->role === 'Admin' ? '#e6f4ea' : '#eef2ff' }};
                            color:
                                {{ $user->role === 'Admin' ? '#1a8917' : '#3730a3' }};
                        ">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td style="padding:14px; color:#666;">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

@endsection
