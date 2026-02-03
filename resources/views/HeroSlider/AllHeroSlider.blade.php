
@extends('admin_dashboard')
@section('admin')


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
   

                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Hero Section Preview</h5>
                                        <ol class="breadcrumb m-0">
                                                <a href="{{ route('add.heroslider') }}" type="button" class="btn btn-dark">Add Slider</a>
                                        </ol>

                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">This section manages the banner and slider images that appear at the top of your website.</p>
                                        <img src="{{ asset('Banner-presentation.png') }}" height="150px" alt="Hero Section Example">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">


                                        <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>title</th>
                                                    <th>subtitle</th>
                                                    <th>image</th>
                                                    <th>link</th>
                                                    <th>position</th>
                                                    <th>status</th>
                                                    <th>Action</th>

                                                </tr>

                                        </thead>
                                        
                                        
                                            <tbody>

                                            @php $sl = 1 @endphp
                                             @foreach ($ImageData as $data)
                                                <tr>
                                                    <td>{{ $sl++ }}</td>
                                                    <td>{{ $data->title }}</td>
                                                    <td>{{ $data->subtitle }}</td>
                                                    <td><img src="{{ asset($data->image) }}" style="height: 3rem" ></td>
                                                    <td>{{ $data->link }}</td>
                                                    <td>{{ $data->position }}</td>
                                                    <td>{{ $data->is_active == 1 ? 'Active' : 'Inactive' }}</td>

                                                    <td>
                                                        {{-- @if(Auth::user()->can('Delete Imageslider')) --}}
                                                        <a href="{{ route('edit.heroslider', $data->id) }}" class="btn btn-success rounded-pill waves-effect waves-light"><i class="fa-solid fa-square-pen"></i> Edit</a>
                                                        {{-- @endif --}}
                                                        {{-- @if(Auth::user()->can('Edit Imageslider')) --}}
                                                        <a href="{{ route('delete.heroslider', $data->id)}}" class="btn btn-danger rounded-pill waves-effect waves-light" id="delete"  title="Delete Data"><i class="fa-solid fa-trash"></i> Delete</a>
                                                        {{-- @endif --}}
                                                    </td>
                                                </tr>
                                                    @endforeach


                             </tbody>
                                        </table>

                                    </div> <!-- end card body-->
                                </div> <!-- end card -->
                            </div><!-- end col-->
                        </div>
                        <!-- end row-->



                    </div> <!-- end container-fluid -->



       
                        
                    </div> <!-- container -->

                </div> <!-- content -->


            </div>



        </div>
        <!-- END wrapper -->

@endsection
