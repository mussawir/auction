@extends('layouts.padash')
@section('content')


    <ol class="breadcrumb pull-right">
        <li><a href="{{url('/patient')}}">Dashboard</a></li>
        <li class="active">Thank You</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Thank You<small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-md-12">
            <div class="msg">
                @if(Session::has('success'))
                    <div class="alert alert-success fade in">
                        <strong>Success!</strong>
                        <strong>{{Session::pull('success')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                @elseif(Session::has('error'))
                    <div class="alert alert-danger fade in">
                        <strong>Error!</strong>
                        <strong>{{Session::pull('error')}}</strong>
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="section-container" id="checkout-cart">
        <div class="checkout">
            <form action="checkout_info.html" method="POST" name="form_checkout">
                <!-- BEGIN checkout-header -->
                <div class="checkout-header">
                    <!-- BEGIN row -->
                    <div class="row">
                        <!-- BEGIN col-3 -->
                        <div class="col-md-3 col-sm-3">
                            <div class="step">

                                    <div class="number"><i class="fa fa-check"></i></div>
                                    <div class="info">
                                        <div class="title">Delivery Options</div>
                                    </div>

                            </div>
                        </div>
                        <!-- END col-3 -->
                        <!-- BEGIN col-3 -->
                        <div class="col-md-3 col-sm-3">
                            <div class="step">

                                    <div class="number"><i class="fa fa-check"></i></div>
                                    <div class="info">
                                        <div class="title">Shipping Address</div>
                                    </div>

                            </div>
                        </div>
                        <!-- END col-3 -->
                        <!-- BEGIN col-3 -->
                        <div class="col-md-3 col-sm-3">
                            <div class="step">

                                    <div class="number"><i class="fa fa-check"></i></div>
                                    <div class="info">
                                        <div class="title">Payment</div>
                                    </div>

                            </div>
                        </div>
                        <!-- END col-3 -->
                        <!-- BEGIN col-3 -->
                        <div class="col-md-3 col-sm-3">
                            <div class="step active">

                                    <div class="number"><i class="fa fa-check"></i></div>
                                    <div class="info">
                                        <div class="title">Complete Payment</div>
                                    </div>

                            </div>
                        </div>
                        <!-- END col-3 -->
                    </div>
                    <!-- END row -->
                </div>
                <!-- END checkout-header -->
                <!-- BEGIN checkout-body -->
                <div class="checkout-body">
                    <!-- BEGIN checkout-message -->
                    <div class="checkout-message">
                        <h1>Thank you! <small>Your Payment has been successfully processed with the following details.</small></h1>
                        <div class="table-responsive2">
                            <table class="table table-payment-summary">
                                <tbody>
                                <tr>
                                    <td class="field">Transaction Status</td>
                                    <td class="value">Success</td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-payment-summary">
                                <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Total Products</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trans as $item)
                                    <tr>
                                        <td>{{ $item->m_id }}</td>
                                        <td> {{ $item->total_products }}</td>
                                        <td>
                                            <i class="fa fa-check-circle" aria-hidden="true" style="color:green"></i>
                                            Paid
                                        </td>
                                        <td><a href="{{url('/patient/ecommerce/order/'.$item->m_id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <p class="text-muted text-center m-b-0">Should you require any assistance, you can get in touch with Support Team at (123) 456-7890</p>
                    </div>
                    <!-- END checkout-message -->
                </div>
                <!-- END checkout-body -->
                <!-- BEGIN checkout-footer -->
                <div class="checkout-footer text-center">
                    <a href="{{ URL::to('/patient/ecommerce/pending_orders') }}" class="btn btn-white btn-lg p-l-30 p-r-30 m-l-10">Manage Orders</a>
                </div>
                <!-- END checkout-footer -->
            </form>
        </div>
    </div>
    <!-- END container -->
@endsection

@section('page-scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            App.init();
            Dashboard.init();
        });

        function doDelete(id, elm)
        {
            var q = confirm("Are you sure you want to remove this product from cart?");
            if (q == true) {

                $.ajax({
                    type: "DELETE",
                    url: '{{ URL::to('/patient/ecommerce/remove_product') }}/' + id,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
                    },
                    success: function (result) {
                        /*if (result.status == 'success') {
                         $(elm).closest('tr').fadeOut();
                         $('.msg').html('<div class="alert alert-success"><strong>Manufacturer deleted successfully!</strong></div>').show().delay(5000).hide('slow');
                         } else {
                         $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                         }*/
                        location.reload(true);
                    },
                    error:function (error) {
                        $('.msg').html('<div class="alert alert-danger"><strong>Some error occur. Please try again.</strong></div>').show().delay(5000).hide('slow');
                    }
                });
                return false;
            }
            return false;
        }
    </script>

@endsection