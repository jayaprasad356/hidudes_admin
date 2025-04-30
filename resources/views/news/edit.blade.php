@extends('layouts.admin')

@section('page-title')
    {{ __('Edit Settings') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item">{{ __('Edit Settings') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('Edit Settings') }}</h5>
            </div>
            <div class="card-body">
        <form action="{{ route('news.update', $news->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="privacy_policy">Privacy Policy</label>
                <textarea name="privacy_policy" id="privacy_policy" class="form-control ckeditor-content" rows="10" required>{!! $news->privacy_policy !!}</textarea>
            </div>

            <div class="form-group">
                <label for="support_mail">Support Mail</label>
                <input type="email" class="form-control" id="support_mail" name="support_mail" value="{{ $news->support_mail }}" required>
            </div>

            <div class="form-group">
                <label for="demo_video">Demo Video</label>
                <input type="text" class="form-control" id="demo_video" name="demo_video" value="{{ $news->demo_video }}" required>
            </div>

            <div class="form-group">
                <label for="minimum_withdrawals">Minimum Withdrawals</label>
                <input type="text" class="form-control" id="minimum_withdrawals" name="minimum_withdrawals" value="{{ $news->minimum_withdrawals }}" required>
            </div>

            <div class="form-group">
                <label for="payment_gateway_type">Payment Gateway Type</label>
                <select class="form-control" id="payment_gateway_type" name="payment_gateway_type" required>
                    <option value="instamojo" {{ $news->payment_gateway_type == 'instamojo' ? 'selected' : '' }}>instamojo</option>
                    <option value="razorpay" {{ $news->payment_gateway_type == 'razorpay' ? 'selected' : '' }}>razorpay</option>
                    <option value="upigateway" {{ $news->payment_gateway_type == 'upigateway' ? 'selected' : '' }}>upigateway</option>
                </select>
            </div>
            
               <div class="form-group">
                <label for="free_coins">Free Coins</label>
                <input type="number" class="form-control" id="free_coins" name="free_coins" value="{{ $news->free_coins }}" required>
            </div>
            
                 <div class="form-group">
                <label for="terms_conditions">Terms & Conditions</label>
                <input type="text" class="form-control" id="terms_conditions" name="terms_conditions" value="{{ $news->terms_conditions }}" required>
            </div>

            <div class="form-group">
                <label for="refund_cancellation">Refund & Cancellation</label>
                <input type="text" class="form-control" id="refund_cancellation" name="refund_cancellation" value="{{ $news->refund_cancellation }}" required>
            </div>

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>
<script src="//cdn.ckeditor.com/4.21.0/full-all/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        CKEDITOR.replace('privacy_policy', {
            extraPlugins: 'colorbutton'
        });
    });
</script>
@endsection
