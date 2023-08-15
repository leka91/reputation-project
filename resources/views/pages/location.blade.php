@extends('index')

@section('title', '| Location')

@section('content')

<a href="{{ route('dashboard', $location['organization_id']) }}" class="btn btn-primary mb-4">
    Back
</a>

<h2>What parameters impact the Reputation Score?</h2>

<p class="mb-5">
    The overall score for location 
    <span class="text-primary">{{ $location['address'] }}</span> 
    is <span style="color: {{ $location['color'] }}; font-weight: bold; font-size: 20px;">{{ $location['total_score'] }}</span> 
</p>

<div class="row">
    <div class="col">
        <div class="d-flex justify-content-center">
            <div id="chart" style="width:100%;max-width:600px"></div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let reviewsRating = {{ $location['reviews_rating'] }};
    let totalReviews = {{ $location['total_reviews'] }};
    let lastMonthReviews = {{ $location['last_month_reviews'] }};

    let reviewsRatingPercentile = {{ $location['reviews_rating_percentile'] }};
    let totalReviewsPercentile = {{ $location['total_reviews_percentile'] }};
    let lastMonthReviewsPercentile = {{ $location['last_month_reviews_percentile'] }};

    let percentiles = [reviewsRatingPercentile, totalReviewsPercentile, lastMonthReviewsPercentile];

    let data = [];

    for (let percentile of percentiles) {
        if (percentile <= 30) {
            data.push({
                "color": '#c20606',
                "label": 'Worst'
            });
        } else if (percentile <= 70) {
            data.push({
                "color": '#ebd300',
                "label": 'Average'
            });
        } else {
            data.push({
                "color": '#42f5bf',
                "label": 'Good'
            });
        }

    }

    let reviewRatingColor = data[0].color;
    let reviewRatingLabel = data[0].label;

    let totalReviewsColor = data[1].color;
    let totalReviewsLabel = data[1].label;

    let lastMonthReviewsColor = data[2].color;
    let lastMonthReviewsLabel = data[2].label;

    let options = {
        series: [{
            name: 'Percentile',
            data: [reviewsRatingPercentile, totalReviewsPercentile, lastMonthReviewsPercentile]
        }],
        chart: {
            height: 350,
            type: 'bar'
        },
        colors: [reviewRatingColor, totalReviewsColor, lastMonthReviewsColor],
        plotOptions: {
            bar: {
                columnWidth: '60%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        xaxis: {
            categories: [
                ['Reviews rating', `${reviewsRating} ${reviewRatingLabel}`],
                ['Total reviews', `${totalReviews} ${totalReviewsLabel}`],
                ['Last month reviews', `${lastMonthReviews} ${lastMonthReviewsLabel}`]
            ],
            labels: {
                style: {
                    colors: [reviewRatingColor, totalReviewsColor, lastMonthReviewsColor],
                    fontSize: '14px'
                }
            }
        }
    };

    let chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
@endsection