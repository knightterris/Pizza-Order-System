@extends('admin.layouts.master')

@section('title', 'Customers Order(Checking) Page')
@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Customers' Order(Checking) Page</h2>

                            </div>
                        </div>
                    </div>

                    <button class="btn btn-outline-dark my-5" onclick="history.back()">Go Back</button>

                    <div class="row col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Order Info</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">Customer Name</div>
                                    <div class="col"> <i class="fa-solid fa-user me-2"></i>
                                        {{ strtoupper($orderList[0]->user_name) }}</div>
                                </div>
                                <div class="row">
                                    <div class="col">Order Code</div>
                                    <div class="col"><i
                                            class="fa-solid fa-qrcode me-2"></i>{{ strtoupper($orderList[0]->order_code) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">Order Date</div>
                                    <div class="col"><i
                                            class="fa-solid fa-calendar-check me-2"></i>{{ strtoupper($orderList[0]->created_at->format('j-F-Y')) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">Total Price</div>
                                    <div class="col"><i
                                            class="fa-solid fa-money-bill-wave me-2"></i>{{ $order->total_price }}Kyats
                                        <small class="text-danger">( Delivery Charges Included )</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2">
                            <thead>
                                <tr class="">
                                    <th></th>
                                    <th class="text-center" style="font-size: 20px;">Order ID</th>

                                    <th class="text-center" style="font-size: 20px;">Product Image</th>
                                    <th class="text-center" style="font-size: 20px;">Product Name</th>
                                    <th class="text-center" style="font-size: 20px;">Order Date</th>

                                    <th class="text-center" style="font-size: 20px;">Quantity</th>
                                    <th class="text-center" style="font-size: 20px;">Amount</th>

                                </tr>
                            </thead>

                            <tbody id="dataList">
                                @foreach ($orderList as $o)
                                    <tr class="tr-shadow text-center">
                                        <td></td>
                                        <td style="font-size: 20px;">{{ $o->id }}</td>

                                        <td style="font-size: 20px;"> <img src="{{ asset('storage/' . $o->product_image) }}"
                                                style="width: 190px; height:100px;"> </td>
                                        <td style="font-size: 20px;">{{ $o->product_name }}</td>
                                        <td style="font-size: 20px;">{{ $o->created_at->format('j-F-Y') }}</td>
                                        <td style="font-size: 20px;">{{ $o->qty }}</td>
                                        <td style="font-size: 20px;">{{ $o->total }}</td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{-- {{ $order->links() }} --}}
                            {{-- {{ $pizzas->appends(request()->query())->links() }} --}}
                        </div>



                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
    @endsection
