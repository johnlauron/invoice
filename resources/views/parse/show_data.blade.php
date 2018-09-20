@extends('layouts.login')
@section('content')
    
    <div class="card drag-content">
        <div class="row">
        <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="javascript:history.back()"> Back</a>
                </div>
            </div>
        </div>
        <div class="parse-content">
            <div class="container parse">
                <div class="category">
                       <p>{{$parses->parse}}</p>
                </div>
            </div>    
            </table>
        </div>
    </div>
@endsection