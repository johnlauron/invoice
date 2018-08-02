@extends('layouts.login')
@section('content')
    <div class="row">
        <div class="col-lg-3 margin-tb">
            <div class="pull-left">
                <h2>Form Design</h2>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($form as $forms)
        <tr>
            <td>{{ $forms->form_name }}</td>
            <td>
                <form action="{{route('dragdrop.delete', $forms->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>


    


@endsection