@extends('layouts.login')

@section('title')
Dashboard
@endsection

@section('extra-css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card content-drag">
        <form action="{{ route('invoices.store_inputs')}}" method="post"> 
        {{ csrf_field() }} 
            <div class="header dragdrop">
                <div class="title-section">
                    <h2>Drag and Drop <small>Fill data</small></h2>
                </div>
                <div class="drag-title">
                    <input type="text" name="form_name" class="form-control button" placeholder="Name of Form" required>
                    <input type="hidden" name="company_name" value="{{$invoice->company_name}}">
                </div>
            </div>
                    <div class="body wrap-image-content">
                        <generate-box id="app"></generate-box>
                        <script src="{{asset('js/app.js')}}"></script>
                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">
                         @if($extension == 'pdf')
                            <canvas id="the-canvas" style="border:1px solid black"></canvas>
                        @else
                            <img src="{{ asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" style="width: 100%;">
                        @endif
                    </div>
            </form>
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
@section('extra-script')

@endsection