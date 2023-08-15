@extends('index')

@section('title', '| Location')

@section('content')

<a href="{{ route('dashboard', $location['organization_id']) }}" class="btn btn-primary mb-4">
    Back
</a>

<h2 class="mb-5">What parameters impact the Reputation Score?</h2>

<div class="row">
    <div class="col">
        <div class="d-flex justify-content-center">
            <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
    <div class="col">
        <div class="d-flex justify-content-center">
            <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
</div>





@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    let reviewsRating = {{ $location['reviews_rating'] }};
    let totalReviews = {{ $location['total_reviews'] }};
    let lastMonthReviews = {{ $location['last_month_reviews'] }};
//`Last Month Reviews ${lastMonthReviews}`
    let xValues1 = [`Reviews Rating ${reviewsRating}`];
    let xValues2 = [`Reviews Number ${totalReviews}`];
//{{ $location['last_month_reviews_percentile'] }}
    let yValues1 = [{{ $location['reviews_rating_percentile'] }}];
    let yValues2 = [{{ $location['total_reviews_percentile'] }}];
    let barColors = ["red"];
    
    new Chart("myChart1", {
        type: "bar",
        data: {
            labels: xValues1,
            datasets: [{
                backgroundColor: barColors,
                data: yValues1
            }]
        }
    });

    new Chart("myChart2", {
        type: "bar",
        data: {
            labels: xValues2,
            datasets: [{
                backgroundColor: barColors,
                data: yValues2
            }]
        }
    });
</script>
@endsection