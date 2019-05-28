<?php
use Carbon\Carbon;
?>

@extends('layouts.backend.app')

@section('title', 'Category')


@push('css')
<link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }} " rel="stylesheet">
@endpush




@section('content')
<div class="container-fluid">
    <div class="block-header">
        <a class="btn btn-primary waves-effect" href="{{ route('admin.category.create') }}"><i class="material-icons">add</i>
            <span>Add new Category</span> 
        </a>
    </div>
    
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        ALL CATEGORY
                        <span class="badge bg-blue">{{ $categories->count() }}</span>
                    </h2>
                    
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Posts Count</th>
                                    <th>Create at</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>

                            <tfoot>
                                <th>Serial</th>
                                <th>Name</th>
                                <th>Posts Count</th>
                                <th>Create at</th>
                                <th>Action</th>
                            </tfoot>
                          
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                         <td>{{$category->name}}</td>
                                         <td>{{$category->posts->count()}}</td>
                                         <td>{{$category->created_at}}</td>
                                        <td>
                                            <a class="waves-effect btn btn-primary" href="{{ route('admin.category.edit', $category->id) }}"><i class="material-icons">edit</i></a>
                                            
                                            <button 
                                            type="submit" class="waves-effect btn btn-danger" onclick="deleteCategory({{ $category->id}})" ><i class="material-icons">delete</i></button>

                                            <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id) }}" method="post">
                                                @csrf
                                                @method("DELETE")

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
    <!-- #END# Exportable Table -->
</div>
@endsection




@push('js')
    
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }} "></script>
    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }} "></script>

    <script src="{{ asset('assets/backend/js/admin.js') }} "></script>
    <script src="{{ asset('assets/backend/js/pages/index.js') }} "></script>
    <script src="{{ asset('assets/backend/js/demo.js') }} "></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

    <script type="text/javascript">
        function deleteCategory(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
            if (result.value) {
                event.preventDefault();
                document.getElementById("delete-form-"+ id).submit();
            } else if (
                // Read more about handling dismissals
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your  CATEGORY is safe :)',
                'error'
                )
            }
            })
        }
    </script>
    
@endpush



