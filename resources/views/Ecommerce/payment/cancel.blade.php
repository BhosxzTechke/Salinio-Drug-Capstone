@extends('Ecommerce.Layout.ecommerce')

@section('content')



<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning" role="alert">
                <h4 class="alert-heading">Payment Cancelled</h4>
                <p>Your PayPal payment has been cancelled. Your order was not completed.</p>
            </div>

            <div class="card mt-4">
                <div class="card-body text-center">
                    <i class="fa fa-exclamation-circle text-warning" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Transaction Cancelled</h5>
                    <p class="card-text text-muted">
                        You have cancelled the payment process. No charges have been made to your account.
                    </p>
                    
                    <div class="mt-4">
                        {{-- <a href="" class="btn btn-primary me-2">
                            <i class="fa fa-shopping-cart"></i> Return to Cart
                        </a> --}}


                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="fa fa-home"></i> Back to Home
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-subtitle mb-2">What happens next?</h6>
                    <ul class="small text-muted">
                        <li>Your items remain in your shopping cart</li>
                        <li>You can continue shopping and try again</li>
                        <li>No payment has been processed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection