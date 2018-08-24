
@extends('layouts.login')


@section('content')
<div class="container-fluid">
        <div class="card content-drag">
               <div class="header dragdrop">
                    <div class="title-section">
                        <h2>Form Assign <small>Choose Form to assign</small></h2>
                    </div>
                    <div class="padding-title">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="body wrap-image-content">
                    <div class="info" style="min-height: 141px">
                        @if(count($form) == 0)
                        <br>
                            <div class="alert bg-red alert-dismissible" role="alert">
                                <strong>No Form Design Found</strong>
                            </div>
                        @else
                            <form action="{{route('invoices.update_assign', $invoice->id)}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="form_name" id="form_name">
                                <button class="btn btn-primary">Save</button>
                            </form>
                            <br><br>
                            <div class="row">
                                <form>
                                    <div class="col-md-2">
                                        <div class="select-section-assign" style="width: 227px;">
                                            <select class="form-control" id="assign_form" name="assign_form" style="width: 268px;" required>
                                                    <option value="">--- Choose Form ---</option>
                                                @foreach($form as $forms)
                                                    <option value="{{$forms->id}}">{{$forms->form_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif                  
                    </div>
                    @if($extension == 'pdf')
                        <canvas id="the-canvas" style="border:1px solid black"></canvas>
                         <div id="body-content">
                        </div>
                    @else
                        <img src="{{asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" width="100%" style="display: block !important;">
                        <div id="body-content">
                        </div>
                    @endif
                </div>
        </div>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{asset('js/pdf.js')}}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
    var url = "http://app.dude.com/images/<?php echo $invoice->company_name."/".$invoice->file_location?>";
    // Asynchronous download PDF
    </script>
    <script src="{{asset('js/pdf-view.js')}}"></script>
@endsection