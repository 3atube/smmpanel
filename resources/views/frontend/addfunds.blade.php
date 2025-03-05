@extends('frontend.layouts.app')
@section('scriptFooter')
    @php
        try {
            echo date('Y-m-d', strtotime('-30 days'));
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    @endphp
    <script>
        typeof _addfunds !== 'undefined' && _addfunds.init();
        // app.clipboard('#info_vtb');
        history('{{ date('Y-m-d', strtotime('-30 days')) }}', '{{ date('Y-m-d') }}');
        // app.clipboard('#account_vtb');
        $('.ipt-date').daterangepicker({
            startDate: moment().subtract(30, 'days'),
            endDate: moment(),
            locale: {
                format: 'YYYY/MM/DD'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(30, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                    'month')]
            },

        }, function(start, end, label) {
            var from = start.format('YYYY-MM-DD');
            var to = end.format('YYYY-MM-DD');
            history(from, to)
        });

        function history(from, to) {
            $.ajax({
                url: '{{ route('account.history') }}',
                method: "POST",
                data: {
                    from: from,
                    to: to
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.error) {
                        alert(data.message)
                        return false
                    } else if (data.success) {
                        $('#history').html(data.message)
                    }
                }
            });
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change', '#method-payment', function() {
            $.ajax({
                url: '{{ route('method-payment') }}',
                method: "POST",
                data: {
                    method: $(this).val(),
                },
                beforeSend: function() {},
                success: function(data) {
                    $('#content-method').html(data);
                }
            });
        })
        $(document).on('click', '#payeer-method', function() {

            $.ajax({
                url: '{{ route('account.payeer') }}',
                method: "POST",
                data: {
                    m_amount: $('#m_amount').val(),
                },
                beforeSend: function() {},
                success: function(data) {
                    if (data.success) {
                        console.log(data.link)
                        location.href = data.link
                    } else {
                        return alert(data.error);
                    }
                }
            });
        })
    </script>
@endsection
@section('content')

    <div class="content d-flex flex-column flex-column-fluid">
        <div class="container-fluid" id="kt_content_container">
            <div class="row">
                <div class="col-lg-12">
                    @if (session('proceed'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('payment_success') }}
                        </div>
                    @endif
                    @if (session('payment_error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('payment_error') }}
                        </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    <div class="card shadow-sm mb-5 bg-light">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Choose method</h3>
                            </div>
                        </div>

                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="data-pm-method d-none"></div>
                            <div class="mb-5 form-group">
                                <label class="required form-label">Method</label>
                                <select class="form-control sl-pm-method" id="method-payment">
                                    <option value="">Method</option>
                                    @if (!empty($methods))
                                        @foreach ($methods as $item)
                                            <option {{ old('method_get') == $item->method_get ? 'selected' : '' }}
                                                value="{{ $item->method_get }}">{{ $item->method_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div id="content-method">
                                @include('frontend.methods.manual')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card shadow-sm div-history">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>History</h3>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="mb-5 mx-9 mt-5">
                                <label class="form-label">Filter</label>
                                <input class="form-control ipt-date" />
                            </div>
                            <div class="table-responsive mb-5">
                                <table class="table align-middle table-row-bordered fs-7 gy-3 gs-9">
                                    <thead class="fs-6 fw-bold bg-lighten">
                                        <tr>
                                            <th>Method</th>
                                            <th>Amount</th>
                                            <th>Details</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody id="history"></tbody>
                                </table>
                            </div>
                            <canvas id="chart" style="display: none;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
