@extends('admin-view.layouts.app')
@section('content')
<div class="container-fluid">
    <ul class="nav nav-tabs nav-tabs__service">
        <li class="p-b"><a class="btn btn-default" href="{{route('admin.services.add')}}" style="    border: 1px solid #ccc;">NEW SERVICE</a></li>
        <li class="p-b"><button class="btn btn-default m-l" data-toggle="modal" data-target="#modalDiv" data-action="new_category">NEW CATEGORY</button></li>

        <li class="p-b"><button class="btn btn-default m-l" data-toggle="modal" data-target="#modalDiv" data-action="new_subscriptions">ADD SUBSCRIPTIONS</button></li>


        <li class="pull-right">
            <div class="form-inline"><label for="service-search-input" class="service-search__icon"></label>
                <input class="form-control" placeholder="Search for service..." id="priceService" type="text" value="">
            </div>
        </li>
        <li class="pull-right">
            <a data-toggle="modal" data-target="#modalDiv" data-action="import_services">IMPORT FROM API</a>
        </li>
    </ul>

    <div class="sticker-head">
        <table class="service-block__header" id="sticker">
            <thead>
                <th class="checkAll-th service-block__checker null">
                    <div class="checkAll-holder">
                        <input type="checkbox" id="checkAll">
                        <input type="hidden" id="checkAllText" value="order">
                    </div>
                    <div class="action-block">
                        <ul class="action-list">
                            <li><span class="countOrders"></span> service selected</li>
                            <li>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown"> Bulk Operations <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="bulkorder" data-type="active">Activate All</a>
                                            <a class="bulkorder" data-type="deactive">Disable All</a>
                                            <a class="bulkorder" data-type="del_price">Reset All Discounts</a>
                                            <a class="bulkorder" data-type="del_service">Delete All</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </th>
                <th class="service-block__id">ID</th>
                <th class="service-block__service">Service Name</th>
                <th class="service-block__type">
                    Service Type
                </th>
                <th class="service-block__provider">Provider</th>
                <th class="service-block__rate">Price</th>
                <th class="service-block__minorder">Min</th>
                <th class="service-block__minorder">Max</th>
                <th class="service-block__visibility">Status</th>
                <th class="service-block__action text-right"><span id="allServices" class="service-block__hide-all fa fa-compress"></span></th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="service-block__body">
        <div class="service-block__body-scroll">
            <div style="width: 100%; height: 0px;"></div>
            <form action="{{route('admin.multi-action')}}" method="post" id="changebulkForm">
                @csrf
                <div style="" class="category-sortable">
                    @if(count($items)>0)
                    @foreach($items as $item)
                    <div class="categories categories-{{$item->id}}" data-id="{{$item->id}}">
                        <div class=" {{$item->category_type==1 ? 'grey' : ''}} service-block__category ">
                            <div class="service-block__category-title" class="categorySortable" data-category="Facebook" id="category-{{$item->id}}">
                                <div class="service-block__drag handle">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <title>Drag-Handle</title>
                                        <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                                    </svg>
                                </div>
                                {{$item->category_name}}
                                <div class="dropdown-inline">
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Transactions <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_category" data-id="{{$item->id}}">Edit Category </a></li>
                                            @if($item->category_type==2)
                                            <li><a href="{{route('admin.disable-category',[$item->id])}}">Disable Category</a></li>
                                            @elseif($item->category_type==1)
                                            <li><a href="{{route('admin.active-category',[$item->id])}}">Active Category</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                {{$item->platform_id> 0 ? '' : ''}}
                                <div class="service-block__collapse-block">
                                    <div id="collapedAdd-{{$item->id}}" class="service-block__collapse-button" data-category="category-{{$item->id}}"></div>
                                </div>
                            </div>
                            <div class="collapse in">
                                <div class="service-block__packages">
                                    <table id="servicesTableList" class="Servicecategory-{{$item->id}}">
                                        <tbody class="service-sortable">
                                            <div class="serviceSortable" id="Servicecategory-{{$item->id}}" data-id="category-{{$item->id}}">
                                                @php $services = \App\Libraries\Helpers::getServiceByCategoryId($item->id);
                                                @endphp
                                                @if(!empty($services))
                                                @foreach($services as $service)
                                                <tr id="serviceshowcategory-{{$item->id}}" class="service-{{$service->id}} service-info ui-state-default {{ $service->service_type == 1 ? 'grey' : ''}} " data-category="category-{{$item->id}}" data-id="service-{{$service->id}}" data-service="{{$service->service_name}}">
                                                    <td class="service-block__checker">
                                                        <span></span>
                                                        <div class="service-block__checkbox">
                                                            <div class="service-block__drag handle">
                                                                <svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                                        <title>Drag-Handle</title>
                                                                        <path d="M7 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm6-8c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 2c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2zm0 6c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                                                                    </svg>
                                                                </svg>
                                                            </div>
                                                            <input type="checkbox" class="selectOrder" name="service[{{$service->id}}]" value="1" style="border:1px solid #fff">
                                                        </div>
                                                    </td>
                                                    <td class="service-block__id">{{$service->id}}</td>
                                                    <td class="service-block__service">{{$service->service_name}}</td>
                                                    <td class="service-block__type" nowrap="">{{\App\Libraries\Helpers::getServicePackage($service->service_package)}}</td>
                                                    <td class="service-block__provider">{{$service->provider ? $service->provider->api_name : "Manuel"}} @if($service->api_service>0)<div class="service-block__provider-value">{{$service->api_service}}</div>@endif
                                                    </td>
                                                    <td class="service-block__rate">
                                                        @php $api_detail = json_decode($service->api_detail);
                                                        @endphp

                                                        @if($api_detail)<div style="{{$service->service_price>$api_detail->rate ? 'color: green':'color: red'}}">{{$service->service_price}}</div>
                                                        <div class="service-block__provider-value"><i class="fa fa-usd"></i> {{$api_detail->rate}}</div>
                                                        @else
                                                        <div class="service-block__provider-value"><i class="fa fa-usd"></i> {{$service->service_price}}</div>
                                                        @endif
                                                    </td>
                                                    <td class="service-block__minorder">
                                                        <div><span class="service-sync__wrap">{{$service->service_min}}</span></div>
                                                        @if(!empty($api_detail))<div class="service-block__provider-value">{{$api_detail->min}}</div>@endif
                                                    </td>
                                                    <td class="service-block__minorder">
                                                        <div><span class="service-sync__wrap">{{$service->service_max}}</span></div>
                                                        @if(!empty($api_detail))
                                                        <div class="service-block__provider-value">{{$api_detail->max}}</div>
                                                        @endif
                                                    </td>
                                                    <td class="service-block__visibility">{{\App\Libraries\Helpers::getServiceType($service->service_type)}} </td>
                                                    <td class="service-block__action">
                                                        <div class="dropdown pull-right">
                                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle btn-xs-caret" data-toggle="dropdown">Transactions <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li><a style="cursor:pointer;" href="{{route('admin.edit',$service->id)}}">Edit Service</a></li>
                                                                <li><a style="cursor:pointer;" href="{{route('admin.services-desc',$service->id)}}">Edit Desc</a></li>
                                                                <li><a style="cursor:pointer;" data-toggle="modal" data-target="#modalDiv" data-action="edit_description" data-id="{{$service->id}}">Edit Speed per day</a></li>
                                                                <li><a href="{{$service->service_type==1 ? route('admin.service-active',[$service->id]) : route('admin.service-deactive',[$service->id])}}">{{$service->service_type==1? 'Activate Service':'Disable Service'}}</a></li>
                                                                <li><a href="{{route('admin.delete-price',$service->id)}}">Reset Discounts</a></li>
                                                                <li><a href="#" data-toggle="modal" data-target="#confirmChange" data-href="{{route('admin.delete-service',[$service->id])}}">Delete Service</a></li>

                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    <input type="hidden" name="bulkStatus" id="bulkStatus" value="-1">

            </form>
        </div>
    </div>
</div>

<div class="modal modal-center fade" id="confirmChange" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
    <div class="modal-dialog modal-dialog-center" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>Do You Confirm the Transaction?</h4>
                <div align="center">
                    <a class="btn btn-primary" href="" id="confirmYes">Yes</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @if(!empty(request()->service_id))
    @php $service1 = \DB::table('services')->where('id', request()->service_id)->first(); @endphp
    
    .categories,.service-info{
        display: none;
    }
    .categories-{{@$service1->category_id}}, .service-{{@$service1->id}}{
        display: block !important
    }
    @endif
    @media (min-width: 768px) {
        .modal-dialog {
            width: 800px;
        }
    }
</style>
@endsection