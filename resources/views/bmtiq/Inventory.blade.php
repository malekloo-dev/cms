@extends(@env('TEMPLATE_NAME').'.App')
@section('head')
    <style>
        .module_container{padding:0 1em;}
        figure.image{margin:1em;}
        @media (max-width:500px){
            figure.image{
                width:auto !important;
            }
        }
    </style>
@endsection
@section('footer')
@endsection

@section('Content')


    <div class="position-2 wrap t3-sl t3-sl-2 t3-mainbody">


                        <section>
                            <!-- /*style="padding-bottom: 30px;"*/ -->
                            <div class="container">
                                <div class="row">
                                    <div class="sec-title pad wow animated fadeInDown">
                                        <h3>Please Insert Your Information </h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div style="min-height: 600px;" class="panel-body full-height">
                                        <form action="{{ route('inventory.search') }}" method="POST" name="add_content"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group row">


                                                <div class="col-md-5">
                                                    <div style="margin-left: 10px;margin-right: 10px;">
                                                        <label for="name" class=" col-form-label text-md-left">Status:</label>
                                                        <select class="select2 form-control" name="status">
                                                            <option value="4" @isset($data['status']){{ $data['status'] == "4" ? 'selected="selected"' : "" }}@endisset>
                                                                Last Move
                                                            </option>
                                                            <option value="1" @isset($data['status']){{ $data['status'] == "1" ? 'selected="selected"' : "" }}@endisset>
                                                                Import
                                                            </option>
                                                            <option value="2" @isset($data['status']){{ $data['status'] == "2" ? 'selected="selected"' : "" }}@endisset>
                                                                Export Empty/Storage
                                                            </option>
                                                            <option value="3" @isset($data['status']){{ $data['status'] == "3" ? 'selected="selected"' : "" }}@endisset>
                                                                Export Full/Storage
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">


                                            <div class="col-md-5">
                                                    <div style="margin-left: 10px;margin-right: 10px;">
                                                        <label for="extcaseno" class="col-form-label text-md-left">Insert BL or Container
                                                            No.:</label>
                                                        <input type="text" class="form-control"
                                                               name="extcaseno"
                                                               value="{{ $data['extcaseno'] ?? '' }}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <div class="col-md-2">
                                                    <div style="margin-left: 10px;margin-right: 10px;">
                                                        <label for="email" class="col-form-label text-md-left">&nbsp;</label>
                                                        <button type="submit"
                                                                style="width: 100%;line-height: 2.6em"

                                                                class="btn btn-success pull-right mat-btn radius-all  mat-elevation-z">
                                                            Check
                                                        </button>
                                                    </div>

                                                </div>

                                        </form>
                                    </div>


                                    @if (count($statusList) and $data['status']!=4)
                                        <div class="sec-title pad wow animated fadeInDown">
                                            <h3></h3>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>Container No</th>
                                                    <th>Sz/Tp</th>
                                                    <th>Unit Status</th>
                                                    @if ($data['status']==1)
                                                        <th>Vessel Name</th>
                                                        <th>Vessel Voyage</th>
                                                    @endif

                                                    @if ($data['status']==2 or $data['status']==3)
                                                        <th>Received Date</th>
                                                    @else
                                                        <th>Discharge Date</th>
                                                    @endif

                                                    @if ($data['status']==1)
                                                        <th>Gate Out Date</th>
                                                        <th>Stripping Date</th>
                                                    @endif

                                                    {{--<th>Consignee Name</th>--}}
                                                    {{-- <th>Yard Position</th>--}}
                                                    {{--@if (!is_null($statusList['0']->SkuDate1))
                                                        <th>Received Date</th>
                                                    @endif
                                                    @if (!is_null($statusList['0']->gate_out_date))

                                                        <th>Gate Out Date</th>
                                                    @endif--}}

                                                    {{--<th>Stripping Date</th>--}}
                                                    <th>Shipping Line</th>


                                                    {{--<th>WONo</th>
                                                    <th>CurrentWO</th>
                                                    <th>ordertype</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($statusList as $key=>$fields)

                                                    <tr>
                                                        <td>{{$fields->extcaseno}}</td>
                                                        <td>{{$fields->sz_tp}}</td>
                                                        <td>{{$fields->UnitStatus}}</td>
                                                        @if ($data['status']==1)
                                                            <td>{{$fields->VesselDesc}}</td>
                                                            <td>{{$fields->VoyageID}}</td>
                                                        @endif


                                                        <td>
                                                            @if (!is_null($fields->DischargeDt))
                                                                {{date('d/m/Y', strtotime($fields->DischargeDt))}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>

                                                        @if ($data['status']==1)
                                                            <td>
                                                                @if (!is_null($fields->gate_out_date))
                                                                    {{date('d/m/Y', strtotime($fields->gate_out_date))}}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if (!is_null($fields->stripping_date))
                                                                    {{date('d/m/Y', strtotime($fields->stripping_date))}}
                                                                @else
                                                                    -
                                                                @endif

                                                            </td>
                                                        @endif

                                                        {{--<td>{{$fields->ConsigneeNameDL}}</td>--}}
                                                        {{--<td>{{$fields->LocationCode}}</td>--}}
                                                        {{--@if (!is_null($statusList['0']->SkuDate1))
                                                            <td>{{date('d/m/Y h:m', strtotime($fields->SkuDate1))}}</td>
                                                        @endif--}}

                                                        {{--@if (!is_null($statusList['0']->gate_out_date))
                                                            <td>{{date('d/m/Y h:m', strtotime($fields->gate_out_date))}}</td>

                                                        @endif--}}

                                                        {{--<td>{{$fields->stripping_date}}</td>--}}
                                                        {{--<td>{{$fields->shipping_line}}</td>--}}
                                                        <td>{{$fields->ClientName}}</td>

                                                    </tr>

                                                    {{--@if (isset($data['status']))
                                                        @if ($data['status']=='-1')
                                                            @if ($fields->ordertype=='MTR' || $fields->ordertype=='STR' || $fields->ordertype=='STF')
                                                                @break

                                                            @endif

                                                        @endif
                                                        @if ($data['status']=='1')
                                                            @break
                                                        @endif
                                                    @endif--}}


                                                @endforeach


                                                </tbody>
                                            </table>


                                        </div>
                                    @endif
                                    @if (count($statusList) and $data['status']==4)
                                        <div class="sec-title pad wow animated fadeInDown">
                                            <h3></h3>
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    {{--<th>Inventory Id</th>--}}
                                                    <th>Container No</th>
                                                    <th>Sz/Tp</th>
                                                    <th>Unit Status</th>
                                                    <th>Description</th>
                                                    <th>Date</th>
                                                    <th>Vessel Description</th>
                                                    <th>Voyage Id</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($statusList as $key=>$fields)
                                                    <tr>
                                                        {{--<td>{{$fields->inventoryid}}</td>--}}
                                                        <td>{{$fields->ExtCaseNo}}</td>
                                                        <td>{{$fields->sz_tp}}</td>
                                                        <td>{{$fields->UnitStatus}}</td>
                                                        <td>{{$fields->description}}</td>
                                                        <td>
                                                            @if (!is_null($fields->date))
                                                                {{date('d/m/Y', strtotime($fields->date))}}
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td>{{$fields->vesseldescription}}</td>
                                                        <td>{{$fields->VoyageID}}</td>

                                                    </tr>

                                                @endforeach


                                                </tbody>
                                            </table>

                                        </div>
                                    @endif
                                    @if ($isSearch=='1' and count($statusList)==0)
                                        <div class="sec-title pad wow animated fadeInDown">

                                            Result For Container No {{ $data['extcaseno']}} Not found
                                        </div>


                                    @endif


                                </div>
                            </div>
                        </section>

    </div>

@endsection

