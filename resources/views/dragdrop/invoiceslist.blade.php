@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
                <h2>Invoice's</h2>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="pull-left">
                <div class="choose-company">
                    <form action="{{route('dragdrop.list_createform')}}" method="post">
                        {{ csrf_field() }}
                        <div class="search-section">
                            <div class="select-section" style="width: 227px;float: left;margin-right: 7px;">
                                <select class="form-control" name="select_list" style="width: 268px;">
                                        <option value="">--- Choose Company ---</option>
                                    @foreach($company as $companies)
                                        <option value="{{$companies->id}}">{{$companies->company_name}}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="button-search">
                                <button type="submit" class="btn btn-primary">Go</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card drag-content">
        <div class="invoices-image">
            <div class="container d-content">
                @if(count($invoice) == 0)
                    <div class="alert bg-red alert-dismissible" role="alert">
                        <strong>No Record Found</strong>
                    </div>
                @else
                <div class="row">
                    @foreach($invoice as $invoices)
                    <div class="col-md-3 col-sm-3 col-lg-3">
                        <a href="{{route('dragdrop.createdrag', $invoices->id)}}">
                            @if (pathinfo($invoices->file_location, PATHINFO_EXTENSION) == 'pdf')
                                <p style="color:#000;margin-top: 30px;"><strong>{{$invoices->doc_name}}</strong></p>
                                <img class="draglist" src="{{asset('images/pdf_icon.jpg')}}">
                            @else
                                <p style="color:#000;margin-top:30px;"><strong>{{$invoices->doc_name}}</strong></p>
                                 <img class="draglist" src="{{asset($invoices->file_location)}}">
                            @endif 
                        </a>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection