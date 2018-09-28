@extends('layouts.login')

@section('title')
Dashboard
@endsection

@section('extra-css')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
                <div class="header">
                    <h2>
                        Form Design
                    </h2>
                     <div class="padding-title">
                         <div class="pull-right">
                            <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                        </div>
                    </div>
                </div>
                <div class="body wrap-image-content">
                    <div id="images-contents">
                        @foreach($boxes as $boxs)
                           <div class="header-location"> 
                                <input type="text" class="form-control box" placeholder="{{$boxs->category_name}}" style="position:absolute;top:{{ $boxs->yloc }}px;left:{{$boxs->xloc}}px;width:{{$boxs->width}}px;height:{{$boxs->height}}px;text-align:{{$boxs->alignment}};" disabled>
                            </div>
                        @endforeach
                    </div>
                    <div class="images">
                        @if(!empty($files))
                            @if($extension == 'pdf')
                                 <canvas id="the-canvas" style="border:1px solid black"></canvas>
                            @else
                                <img src="{{asset($files->file_location)}}" width="100%" height="100%" style="display: block !important;">
                            @endif
                        @else
                            <img style="width:50px;height:50px;" src="{{asset('images/download.png')}}" />
                        @endif
                    </div>
                </div>
        </div>
    </div>
    
    <script src="{{asset('js/pdf.js')}}"></script>
    <script src="{{asset('js/pdf.worker.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.550/pdf.js"></script>
    <script type="text/javascript">
    // URL of PDF document
        @if(!empty($files)){
            var url = "http://<?php echo $url."/".$files->file_location?>";
        }@else{}
        @endif
    // Asynchronous download PDF
    </script>
    <script src="{{asset('js/pdf-view.js')}}"></script>
@endsection
@section('extra-script')
{{Html::script('bsbmd/plugins/jquery-countto/jquery.countTo.js')}}
{{Html::script('bsbmd/plugins/autosize/autosize.js')}}
{{Html::script('bsbmd/plugins/momentjs/moment.js')}}
{{Html::script('bsbmd/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}
{{Html::script('bsbmd/js/pages/forms/basic-form-elements.js')}}
{{Html::script('bsbmd/plugins/jquery-sparkline/jquery.sparkline.js')}}
{{Html::script('bsbmd/js/pages/index.js')}}
@endsection
