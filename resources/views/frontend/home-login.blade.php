@extends('frontend.layouts.app')
@section('scriptFooter')
        <script>typeof _api !== 'undefined' && _api.init();</script>
@endsection
@section('content')
<div id="block_6">
  <div class="new_order-block">
    <div class="bg"></div>
    <div class="divider-top"></div>
    <div class="divider-bottom"></div>
    <div class="container-fluid">
      <div class="row new-order-form">
        <div class="col-lg-8">
          <div
            class="component_form_group component_card component_radio_button"
          >
            <div class="card">
              <form action="/" method="post" id="order-form">
                <div class="component_button_forms">
                  <div class="form-group">
                    <label
                      for="orderform-category"
                      class="control-label"
                      >Category</label
                    >
                    <select
                      class="form-control"
                      id="orderform-category"
                      name="OrderForm[category]"
                      data-select="true"
                      data-select-search="true"
                      data-select-search-placeholder="Search"
                      data-select-container="#select-category-container"
                    >
                      <option value="2" selected>
                        Youtube Subscribe
                      </option>
                    </select>
                    <div
                      id="select-category-container"
                      class="position-relative"
                    ></div>
                  </div>
                  <div class="form-group">
                    <label
                      for="orderform-service"
                      class="control-label"
                      >Service</label
                    >
                    <select
                      class="form-control"
                      id="orderform-service"
                      name="OrderForm[service]"
                      data-select="true"
                      data-select-search="true"
                      data-select-search-placeholder="Search"
                      data-select-container="#select-service-container"
                    ></select>
                    <div
                      id="select-service-container"
                      class="position-relative"
                    ></div>
                  </div>
                  <div
                    class="form-group hidden fields component_service_description"
                    id="service_description"
                  >
                    <label
                      for="service_description"
                      class="control-label"
                      >Description</label
                    >
                    <div class="panel-description"></div>
                  </div>
                  <div id="fields"></div>
                  <div class="form-group">
                    <label for="charge" class="control-label"
                      >Charge</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="charge"
                      value=""
                      readonly
                    />
                  </div>
                </div>
                <input
                  type="hidden"
                  name="_csrf"
                  value="OHn1KM2NhG6ytJOff2sJmvv9MsWED7Nz_pBI1o8Z395hSKxdlP_wAeTE4alLEzv7opBHisg7ixGfxBi5vFWojQ=="
                />
                <div
                  class="new-order-button-submit component_button_submit"
                >
                  <button type="submit" class="btn btn-big-primary">
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection