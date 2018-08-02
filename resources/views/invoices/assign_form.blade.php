
@extends('layouts.login')


@section('content')
<div class="container-fluid">
        <div class="card">
                <div class="header">
                    <h2>
                        Form Assign<small>assigning form</small>
                    </h2>
                </div>
                <div class="body wrap-image-content">
                    <div class="info" style="min-height: 141px">
                        <form action="{{route('invoices.update_assign', $invoice->id)}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="form_name" id="form_name">
                            <button class="btn btn-primary">Save</button>
                        </form>
                        <br><br>
                            <div class="row">
                                <form>
                                    <div class="col-md-2">
                                        <div class="select-section" style="width: 227px;">
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
                    </div>
                    @if($extension == 'pdf')
                        <canvas id="the-canvas" style="border:1px solid black"></canvas>
                    @else
                        <img src="{{asset('images/'.$invoice->company_name.'/'.$invoice->file_location)}}" width="100%">
                        <div id="body-content">
                        </div>
                    @endif
                </div>
        </div>
    </div>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
    var url = "https://127.0.0.1:8000/images/<?php echo $invoice->company_name."/".$invoice->file_location?>";
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