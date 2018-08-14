@extends('layouts.login')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Company Info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.no_form_inv') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('invoices.update', $invoices->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Company Name:</strong>
                    <select class="form-control" name="company_id">
                        <option value="{{$invoices->company_id}}">{{$invoices->company_name}}</option>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Invoice Name:</strong>
                    <input type="text" name="invoice_name" value="{{ $invoices->invoice_name }}" class="form-control">
                </div>
            </div>
            @if($invoices->form_name_id == 0)

            @else
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Form :</strong>
                        <select class="form-control" name="form_name_id">
                                <option value="">--- Chooose Form ---</option>
                            @foreach($formname as $form)
                                <option value="{{$form->id}}">{{$form->form_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="fileupload">Upload an Invoice</label>
                        <input type="file" class="form-control-file" id="fileupload" name="file">
                        <br>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <a class="btn btn-primary" href="{{ route('invoices.no_form_inv') }}"> Cancel</a>
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
    <script src="{{asset('js/animation.js')}}"></script>
@endsection