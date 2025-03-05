@extends('frontend.layouts.app')
@section('content')
@section('scriptFooter')
<script>
  typeof _tickets !== 'undefined' && _tickets.init();
</script>
@endsection
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card shadow-sm mb-5">
                <div class="card-header">
                    <h3 class="card-title" data-lang="Direct message">Direct message</h3>
                </div>
                <div class="card-body py-5">
                    <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                    </div>
                </div>
            </div>
            <div class="card card-flush  mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-7">
                            <button type="button" class="btn btn-primary btn-sm mb-5"
                                onclick="_tickets._on.click.showModalTicket();" data-lang="Create a ticket">Create a
                                ticket</button>
                            <div class="table-responsive">
                                <table
                                    class="table table-striped table-hover table-row-dashed table-row-gray-400 align-middle gs-2 gy-2"
                                    id="table-tickets">
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr class="bg-lighten"
                                                onclick="window.location.href='{{route('account.view-ticket', $item->id)}}';">
                                                <td>
                                                    <p class="m-0 fs-6 fw-bold">{{ $item->id }} - {{ $item->subject }}
                                                        @if ($item->subject == 'Order')
                                                            ({!! \App\Libraries\Helpers::getRequestTicket($item->request) !!} - {{ $item->order_id }})
                                                        @endif
                                                    </p>
                                                    <p class="m-0 text-gray-700">{{ $item->created_at }}</p>
                                                </td>
                                                <td class="fs-6 text-end"><span
                                                        class="{{ $item->support_new == 2 ? 'text-danger' : 'text-success' }}">{{ $item->status }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $items->links() }}
                        </div>
                        <div class="col-lg-5">
                            <h3 class="mt-4 mb-5 text-primary" data-lang="FAQ">Frequently FAQ's</h3>
                            <div class="accordion" id="kt_accordion_1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" tabindex="-1" id="modal-ticket">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                    <div class="modal-content">
                        <div class="modal-header py-3">
                            <h5 class="modal-title" data-lang="Create a ticket">Create a ticket</h5>
                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                                aria-label="Close">
                                <span class="svg-icon svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                            rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                            transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="mb-5 form-group">
                                <label class="required form-label form-group" data-lang="Subject">Subject</label>
                                <select class="form-select form-control sl-subject" data-kt-select2="true" data-hide-search="true"
                                    onchange="_tickets._on.change.subject(this.value)">
                                    <option value="Order" data-lang="Order">Order</option>
                                    <option value="Payment" data-lang="Payment">Payment</option>
                                    <option value="Other" data-lang="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-5 div-subject-order form-group">
                                <label class="required form-label form-group" data-lang="Order ID">Order ID</label>
                                <input type="text" class="form-select form-control ipt-order-id" />
                            </div>
                            <div class="mb-5 div-subject-order form-group">
                                <label class="required form-label form-group" data-lang="Request">Request</label>
                                <select class="form-select form-control sl-request" data-kt-select2="true" data-hide-search="true">
                                    <option value="1" data-lang="Cancel">Cancel</option>
                                    <option value="2" data-lang="Refill">Refill</option>
                                    <option value="3" data-lang="Speed up">Speed up</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                            <div class="mb-5 form-group">
                                <label class="required form-label form-group" data-lang="Request">Request</label>
                                <textarea rows="5" class="form-select form-control txa-message" placeholder="Your message"></textarea>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary btn-icon w-100"
                                    onclick="_tickets._on.click.add(document.querySelector('.sl-subject').value, document.querySelector('.ipt-order-id').value, document.querySelector('.sl-request').value, document.querySelector('.txa-message').value, false);"
                                    data-lang="Send"><i class="las la-paper-plane fs-2 me-1"></i>Send</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Post-->
    </div>
@endsection
