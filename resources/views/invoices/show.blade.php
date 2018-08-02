
@extends('layouts.login')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Invoice info</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('invoices.no_form_inv') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Invoice name : </strong>
                {{ $invoice->invoice_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Company name : </strong>
                {{ $invoice->company_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>File</strong>
            </div>
            <div class="form-group">
                @if($extension == 'pdf')
                    <canvas id="the-canvas" style="border:1px solid black"></canvas>
                @else
                    <img src="{{asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" width="100%" height="100%">
                @endif
            </div>
        </div>

    </div>
    <script src="{{asset('js/pdf.js')}}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
    var url = "http://app.dude.com/images/<?php echo $invoice->company_name."/".$invoice->file_location?>";
    // Asynchronous download PDF
    PDFJS.getDocument(url)
      .then(function(pdf) {
        return pdf.getPage(1);
      })
      .then(function(page) {
        // Set scale (zoom) level
        var scale = 1.5;
        // Get viewport (dimensions)
        var viewport = page.getViewport(scale);
        // Get canvas#the-canvas
        var canvas = document.getElementById('the-canvas');
        // Fetch canvas' 2d context
        var context = canvas.getContext('2d');
        // Set dimensions to Canvas
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        // Prepare object needed by render method
        var renderContext = {
          canvasContext: context,
          viewport: viewport
        };
        // Render PDF page
        page.render(renderContext);
      });
      </script>
@endsection