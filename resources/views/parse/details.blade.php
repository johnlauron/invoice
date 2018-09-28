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
                <button type="button" class="btn btn-primary" onclick="print_this('to_print')">Print!</button>
                    <div class="category">
                        <div id="to_print" class="jumbotron">
                            <p>{{ $parsing->parse }}</p>
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
</script>
<script src="{{asset('js/print.js')}}"></script>

@endsection