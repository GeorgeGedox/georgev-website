@extends('layout.app', ['header_class' => 'sticky'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="heading pb-5 pt-2">
                    <h1>Portfolio</h1>
                    <p>Here I list projects that I've worked on and favorites that never went further than the design phase.</p>
                    @include('layout.social')
                </div>
            </div>
            <div class="col-12">
                <div class="gallery row">
                    <div class="img-wrap col-sm-6 col-md-4">
                        <div class="image" style="background-image: url('https://cdn.dribbble.com/users/1515625/screenshots/6626350/flight_booking_2x_2x.png')">
                            <div class="text">
                                <h3>Flight Booking</h3>
                                <span>ui/ux design, branding</span>
                            </div>
                        </div>
                    </div>
                    <div class="img-wrap col-sm-6 col-md-4">
                        <div class="image" style="background-image: url('https://cdn.dribbble.com/users/1515625/screenshots/6626350/flight_booking_2x_2x.png')">
                            <div class="text text-light">
                                <h3>Flight Booking</h3>
                                <span>ui/ux design, branding</span>
                            </div>
                        </div>
                    </div>
                    <div class="img-wrap col-sm-6 col-md-4">
                        <div class="image" style="background-image: url('https://cdn.dribbble.com/users/1515625/screenshots/6626350/flight_booking_2x_2x.png')">
                            <div class="text">
                                <h3>Flight Booking</h3>
                                <span>ui/ux design, branding</span>
                            </div>
                        </div>
                    </div>
                    <div class="img-wrap col-sm-6 col-md-4">
                        <div class="image" style="background-image: url('https://cdn.dribbble.com/users/1515625/screenshots/6626350/flight_booking_2x_2x.png')">
                            <div class="text">
                                <h3>Flight Booking</h3>
                                <span>ui/ux design, branding</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="work-viewer">
        <div class="container-fluid">
            <div class="row">
                <div class="image col-8" style="background-image: url('https://cdn.dribbble.com/users/1515625/screenshots/6626350/flight_booking_2x.png')"></div>
                <div class="info col-4">
                    <h1>Flight Booking</h1>
                    <p><small>ui/ux design, branding</small></p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur saepe similique ut vitae voluptatem. Accusamus consequatur in laborum, nesciunt odio officia quod reiciendis
                        reprehenderit tempore voluptas. Alias, eaque, obcaecati. Quis.</p>
                    <div class="action">
                        <button class="btn btn-primary btn-no-shadow view-close" type="button">Go back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection