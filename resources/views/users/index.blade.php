@extends('layouts.login')

@section('title')
	Dashboard
@endsection

@section('extra-css')
    
    <!-- JQuery DataTable Css -->
    {{ Html::style('bsbmd/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}
@endsection

@section('content')
	<div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                USER ACCOUNTS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Name</th>
                                            <th>Email</th>
                                            <th>Company</th>
                                            <th>Role</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->company_id }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>
                                                    <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!--<button type="button" onclick="window.location='{{ route("users.show",$user->id) }}';" class="btn bg-teal btn-block waves-effect">SHOW</button>-->
                                                        <button type="button" onclick="window.location='{{ route("users.edit",$user->id) }}';" class="btn bg-cyan btn-block  waves-effect">EDIT</button>
                                                        <button type="submit" class="btn bg-red btn-block waves-effect">DELETE</button>

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-script')
        {{Html::script('bsbmd/plugins/jquery-countto/jquery.countTo.js')}}
        {{Html::script('bsbmd/plugins/raphael/raphael.min.js')}}
        {{Html::script('bsbmd/plugins/morrisjs/morris.js')}}
        {{Html::script('bsbmd/plugins/chartjs/Chart.bundle.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.resize.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.pie.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.categories.js')}}
        {{Html::script('bsbmd/plugins/flot-charts/jquery.flot.time.js')}}-->
        {{Html::script('bsbmd/plugins/jquery-sparkline/jquery.sparkline.js')}}
        {{Html::script('bsbmd/js/pages/index.js')}}
        
        
        <!-- Jquery DataTable Plugin Js -->
        {{Html::script('bsbmd/plugins/jquery-datatable/jquery.dataTables.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/jszip.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}
        {{Html::script('bsbmd/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}
        
        
        {{Html::script('bsbmd/js/pages/tables/jquery-datatable.js')}}

@endsection
