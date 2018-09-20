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
                <div class="category">
                    @foreach ($parsing as $pars)
                       <p>{{ $pars->parse }}</p>
                    @endforeach

                </div>
            </div>    
            </table>
        </div>
    </div>
@endsection