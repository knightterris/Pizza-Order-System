@extends('admin.layouts.master')

@section('title', 'Order List Page')
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
                                <h2 class="title-1">Order List Page</h2>

                            </div>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col">
                            <h3 class="text-dark d-flex">Search Key : <p class="text-danger mx-3">{{ request('key') }}</p>
                            </h3>

                        </div>

                        <div class="col-3 offset-6">
                            <form action="{{ route('admin#orderList') }}" method="get">
                                @csrf
                                <div class=" d-flex">
                                    <input type="text" name="key" class="form-control rounded-pill"
                                        placeholder="Search Pizza...." value="{{ request('key') }}">
                                    <button type="submit" class="btn btn-outline-dark rounded-circle shadow-sm">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session('createSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('createSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif


                    @if (session('deleteSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deleteSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if (session('updatePizzaSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('updatePizzaSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-2 p-2 my-3 shadow-sm bg-secondary rounded-pill">
                            <h2 class="text-center">
                                <i class="fa-solid fa-pizza-slice me-4" style="color:rgb(219,162,74)"></i>
                                <span style="color:rgb(255, 172, 40)">{{ count($order) }}</span>
                            </h2>
                        </div>
                    </div>


                    @if (session('deletePizzaSuccess'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('deletePizzaSuccess') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('admin#changeStatus') }}" method="get">
                        @csrf
                        <div class="col-6 d-flex my-4">
                            <label for="" class="w-50 fs-5">Filter Order Status</label>
                            <select name="orderStatus" id="orderStatus" class="form-control">
                                <option value="">Filter By &darr;</option>
                                <option value="">All </option>
                                <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending</option>
                                <option value="1" @if (request('orderStatus') == '1') selected @endif>Success</option>
                                <option value="2" @if (request('orderStatus') == '2') selected @endif>Rejected</option>
                            </select>
                            <button class="btn btn-outline-dark" type="submit">Search</button>
                        </div>
                    </form>


                    @if (count($order) != 0)
                        <div class="table-responsive table-responsive-data2 ">
                            <table class="table table-data2">
                                <thead>
                                    <tr class="">

                                        <th class="text-center" style="font-size: 20px;">User ID</th>
                                        <th class="text-center" style="font-size: 20px;">User Name</th>
                                        <th class="text-center" style="font-size: 20px;">Order Code</th>
                                        <th class="text-center" style="font-size: 20px;">Order Date</th>
                                        <th class="text-center" style="font-size: 20px;">Total Amount</th>
                                        <th class="text-center" style="font-size: 20px;">Status</th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id="dataList">

                                    @foreach ($order as $o)
                                        <tr class="tr-shadow text-center">
                                            <input type="hidden" class="orderId" value="{{ $o->id }}">
                                            <td style="font-size: 20px;">{{ $o->user_id }}</td>
                                            <td style="font-size: 20px;">{{ $o->user_name }}</td>
                                            <td style="font-size: 20px;">
                                                <a href="{{ route('admin#listInfo', $o->order_code) }}">
                                                    {{ $o->order_code }}
                                                </a>
                                            </td>
                                            <td style="font-size: 20px;">{{ $o->created_at->format('j-F-Y') }}</td>
                                            <td style="font-size: 20px;">{{ $o->total_price }} Kyats</td>
                                            <td>
                                                <select name="status" class="form-control statusChange text-center">
                                                    <option value="0"
                                                        @if ($o->status == 0) selected @endif>
                                                        Pending
                                                    </option>
                                                    <option value="1"
                                                        @if ($o->status == 1) selected @endif>
                                                        Success
                                                    </option>
                                                    <option value="2"
                                                        @if ($o->status == 2) selected @endif>
                                                        Rejected
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                            <div class="mt-3">
                                {{-- {{ $order->links() }} --}}
                                {{-- {{ $pizzas->appends(request()->query())->links() }} --}}
                            </div>

                        </div>
                    @else
                        <h2 class="text-center text-danger mt-5">There is no such kind of data here!!!<i
                                class="fa-solid fa-face-sad-tear ms-2"></i></h2>

                    @endif

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

@section('scriptSection')

    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     // console.log($status);
            //     $orderState = "";
            //     switch ($status) {
            //         case '0':
            //             $orderState = 0;
            //             break;
            //         case '1':
            //             $orderState = 1;
            //             break;
            //         case '2':
            //             $orderState = 2;
            //             break;
            //         default:
            //             $orderState = "";
            //             break;
            //     }
            //     // console.log($orderState);
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://localhost:8000/order/ajax/status',
            //         data: {
            //             'status': $status
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             $list = '';
            //             for ($i = 0; $i < response.length; $i++) {
            //                 $months = ['January', 'February', 'March', 'April', 'May', 'June',
            //                     'July', 'August', 'September', 'October', 'November',
            //                     'December'
            //                 ];
            //                 $dbDate = new Date(response[$i].created_at);
            //                 $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() +
            //                     "-" + $dbDate.getFullYear();

            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange text-center">
        //                                         <option value="0" selected>
        //                                             Pending
        //                                         </option>
        //                                         <option value="1">
        //                                             Success
        //                                         </option>
        //                                         <option value="2">
        //                                             Rejected
        //                                         </option>
        //                                     </select>

        //                     `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange text-center">
        //                                         <option value="0">
        //                                             Pending
        //                                         </option>
        //                                         <option value="1" selected>
        //                                             Success
        //                                         </option>
        //                                         <option value="2">
        //                                             Rejected
        //                                         </option>
        //                                     </select>

        //                     `;
            //                 } else if (response[$i].status == 2) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange text-center">
        //                                         <option value="0">
        //                                             Pending
        //                                         </option>
        //                                         <option value="1">
        //                                             Success
        //                                         </option>
        //                                         <option value="2" selected>
        //                                             Rejected
        //                                         </option>
        //                                     </select>
        //                     `;
            //                 }




            //                 $list += `
        //                     <tr class="tr-shadow text-center">
        //                                 <input type="hidden" class="orderId" value="${response[$i].id}">
        //                                 <td style="font-size: 20px;">${response[$i].user_id}</td>
        //                                 <td style="font-size: 20px;">${response[$i].user_name}</td>
        //                                 <td style="font-size: 20px;">${response[$i].order_code}</td>
        //                                 <td style="font-size: 20px;">${$finalDate}</td>
        //                                 <td style="font-size: 20px;">${response[$i].total_price}Kyats</td>
        //                                <td>${$statusMessage}</td>
        //                             </tr>
        //                     `;
            //             }
            //             // console.log($list);
            //             $('#dataList').html($list);
            //         }
            //     })
            // })

            //change status
            $('.statusChange').change(function() {
                // $parentNode = $(this).parents("tr");
                // $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                // $qty = Number($parentNode.find('#qty').val());
                // $total = $price * $qty
                // $parentNode.find('#total').html($total + "Kyats");
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();
                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                };
                // console.log($data);

                $.ajax({
                    type: 'get',
                    url: '/order/ajax/change/status',
                    data: $data,
                    dataType: 'json',
                })

            })
        })
    </script>

@endsection
