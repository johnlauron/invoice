@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
            </div>
            </br>
            </br>
        </div>
    </div>
    <div class="card drag-content">
         <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
            </div>
        </div>
        <div class="parse-content">
            
            <div class="container parse">
                @if(!empty($parsing->parse))
                <!-- <button type="button" class="btn btn-primary" onclick="print_this('to_print')">Print</button> -->
                <div class="result_buttons">
                    <button type="button" class="btn btn-primary" id="print">Print</button>
                    <button type="button" class="btn btn-success" onclick="return xepOnline.Formatter.Format('pdf',{render:'download', cssStyle:[{fontSize:'30px'},{fontWeight:'bold'}]});">Save as PDF</button>
                </div>
                <div class="white-container" id="pdf_print">
                    <div id="to_print">
                        <pre id="pdf">{{ $parsing->parse }}</pre>
                    </div>
                </div>
                @else
                    <br>
                    <div class="alert bg-red alert-dismissible" role="alert">
                        <strong>No Record Found</strong>
                    </div>
                @endif
            </div>    
            </table>
        </div>
    </div>
<script src="{{asset('js/savepdf.js')}}"></script>
<script src="{{asset('js/xepOnline.jqPlugin.js')}}"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>

@endsection
