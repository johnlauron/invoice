@extends('layouts.login')


@section('content')
<div class="card drag-content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Invoice Info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
    </div>
    <div class="invoice-edit">
        <form action="{{ route('invoices.update', $invoices->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
             <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Company Name:</strong>
                        <select class="form-control" name="company_id">
                            <!-- <option value="{{$invoices->company_id}}">{{$invoices->company_name}}</option> -->
                            @foreach ($companies as $company)
                                <option value="{{$company->id}}" @if($company->id==$invoices->company_id) selected='selected' @endif>{{$company->company_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Invoice Name:</strong>
                        <input type="text" name="invoice_name" value="{{ $invoices->doc_name }}" class="form-control">
                        <input type="hidden" name="doc_id" value="{{ $invoices->document_id }}" class="form-control">
                    </div>
                </div>
                @if(empty($invoices->form_name_id))

                @else
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Form :</strong>
                            <select class="form-control" name="form_name_id">
                                    <option value="">--- Chooose Form ---</option>
                                @foreach($formname as $form)
                                    <option value="{{$form->id}}" @if($form->id==$form_id) selected='selected' @endif>{{$form->form_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="fileupload">Upload an Invoice</label>
                            <input type="file" class="form-control-file" id="fileupload" name="file" placeholder="agas">
                            <br>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <a class="btn btn-primary" href="{{ route('invoices.no_form_inv') }}"> Cancel</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <script src="{{asset('js/animation.js')}}"></script>
@endsection