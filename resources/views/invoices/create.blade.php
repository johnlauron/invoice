@extends ('layouts.login')

@section ('content')
	<div class="add_company">
		<div class="card drag-content ">
			<div class="row justify-content-center">
			 	<div>
					<div class="col-lg-12 margin-tb">
					
						<div class="pull-left">
							<h2>Add Invoice</h2>
							<br>
						</div>
						<div class="pull-right">
							<a class="btn btn-primary" href="javascript:history.back()"> Back</a>
						</div>
					</div>
					<br>
					<div class="card-body">
						<div class="container parse">
							<div class="invoice-form">
								<form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data" autocomplete="off" multiple />
									{{ csrf_field() }}									
									<div class="col-xs-8 col-sm-8 col-md-8">
										<div class="form-group">
											<strong>Company:</strong>
											<select class="form-control" name="company_id" id="company_id">
												<option value="">--- Choose Company ---</option>
												@foreach ($companies as $company)
													<option value="{{$company->id}}">{{$company->company_name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-xs-8 col-sm-8 col-md-8">
										<div class="form-group">
											<strong>Form :</strong>
											<div class="form">
												
											</div>
										</div>
									</div>
									<div class="col-xs-8 col-sm-8 col-md-8">
										<div class="form-group">
											<strong>Name:</strong>
											<input type="text" name="doc_name" class="form-control" placeholder="Invoice Name">
										</div>
									</div>
									<div class="col-xs-8 col-sm-8 col-md-8">
										<div class="form-group">
											<label for="fileupload">Upload an Invoice</label>
											<input type="file" class="form-control-file" id="fileupload" name="file[]" onchange="readURL(this);" multiple />
											<br>
											<button type="button" onclick="window.location='{{ route("users.dashboard") }}';" class="btn bg-teal btn-lg waves-effect">CANCEL</button>
											<button type="submit" class="btn bg-teal btn-lg waves-effect">SAVE</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container-fluid">
				<div class="card preview">
					<div class="spacing" style="min-height:221px;">
					</div>
					<div class="body wrap-image-content">
							<div id="images-contents">
                   
							</div>
							<div class="images">
									<img id="blah" src="#" alt="invoice image">
							</div>
						{{--  <img id="blah" src="#" alt="invoice image">
						<div id="body-content">
						</div>  --}}
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="{{ asset('js/custom.js') }}"></script>
	<script>
		var flagsUrl = '{{ asset('images/pdf_icon.jpg') }}';
	</script>
@endsection