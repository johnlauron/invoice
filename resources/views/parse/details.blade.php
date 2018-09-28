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
            <button type="button" class="btn btn-primary" onclick="print_this('to_print')">Print!</button>
            <div class="container parse">
                <div id="to_print" class="jumbotron">
                    <div class="category">
                    
                        @foreach ($parsing as $pars)
                           <p>{{ $pars->parse }}</p>
                        @endforeach
                    </div>

                </div>
            </div>    
            </table>
        </div>
    </div>
</script>
<script src="{{asset('js/print.js')}}"></script>

@endsection