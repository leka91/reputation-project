@extends('index')

@section('title', '| Dashboard')

@section('content')
    <h2 class="mb-5">What is my locations performance?</h2>

    <div class="row">
        <div class="col">
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="p-3">
                            <i class="fa-solid fa-trophy fa-xl" style="color: #0dd9a6;"></i>
                            <span class="ps-3">
                                Highest Reputation Scores
                            </span>
                        </th>
                        <th scope="col" class="p-3"></th>
                        <th scope="col" class="p-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations['top5'] as $location)
                    <tr>
                        <td class="p-3">
                            <a href="{{ url("dashboard/{$location['organization_id']}/location/{$location['id']}") }}" title="{{ $location['title'] . '-' . $location['address'] }}">
                                {{ \Str::limit($location['title'] . '-' . $location['address'], 55) }}
                            </a>
                        </td>
                        <td class="p-3">
                            <span class="badge" style="background: {{ $location['color'] }}">
                        </td>
                        <td class="p-3">{{ $location['total_score'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="p-3">
                            <i class="fa-solid fa-circle-exclamation fa-xl" style="color: #dd2808;"></i>
                            <span class="ps-3">
                                Lowest Reputation Scores
                            </span>
                        </th>
                        <th scope="col" class="p-3"></th>
                        <th scope="col" class="p-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations['bottom5'] as $location)
                    <tr>
                        <td class="p-3">
                            <a href="{{ url("dashboard/{$location['organization_id']}/location/{$location['id']}") }}" title="{{ $location['title'] . '-' . $location['address'] }}">
                                {{ \Str::limit($location['title'] . '-' . $location['address'], 55) }}
                            </a>
                        </td>
                        <td class="p-3">
                            <span class="badge" style="background: {{ $location['color'] }}">
                        </td>
                        <td class="p-3">{{ $location['total_score'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    
@endsection