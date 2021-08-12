@extends('layouts.master')

@section('title' , 'Course')
@section('master_content')

<div class="row no-gutters">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-info">Course</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Department</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Credit</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="currencyTable">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="text-info">Add Course</h4>
            </div>
            <div class="card-body">
                <form id="catAddForm">
                    <label for="">Department</label>
                    <div class="form-group">
                       <select name="" id="department_id" class="form-control">
                           <option value="">Select A Department</option>
                           @foreach ($departments as $department)
                           <option value="{{ $department->id }}">{{ $department->name }}</option>
                           @endforeach
                       </select>
                        <span class="text-danger" id="departmentError"></span>
                        <div id="response"></div>
                    </div>
                    <label for="">Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Course Name" id="add_cat_name">
                        <span class="text-danger" id="nameError"></span>
                        <div id="response"></div>
                    </div>
                    <label for="">Course Code</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="code" placeholder="Course code" id="add_code_name">
                        <span class="text-danger" id="codeError"></span>
                        <div id="response"></div>
                    </div>
                    <label for="">Course Credit</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="credit" placeholder="Course credit" id="add_credit">
                        <span class="text-danger" id="creditError"></span>
                        <div id="response"></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add Course</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal">Edit course</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="catUpdateForm" >
                    <label for="">Department</label>
                    <div class="form-group">
                       <select name="" id="e_department_id" class="form-control">
                           <option value="">Select A Department</option>
                           @foreach ($departments as $department)
                           <option value="{{ $department->id }}">{{ $department->name }}</option>
                           @endforeach
                       </select>
                        <span class="text-danger" id="departmentsError"></span>
                        <div id="response"></div>
                    </div>
                    <input type="hidden" id="e_id" name="id" value="">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" id="edit_cat_name" name="name" value="" class="form-control">
                    </div>
                    <label for="">Course Code</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="code" placeholder="Course code" id="e_add_code_name">
                        <span class="text-danger" id="codeError"></span>
                        <div id="response"></div>
                    </div>
                    <label for="">Course Credit</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="credit" placeholder="Course credit" id="e_add_credit">
                        <span class="text-danger" id="creditError"></span>
                        <div id="response"></div>
                    </div>
                    <div class="form-group">
                        <button class="form-control btn btn-block btn-info">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@stop
@push('css')
      <!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@endpush
@push('script')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    //fetch
    function table_data_row(data) {
            var	rows = '';
            var i = 0;
            $.each( data, function( key, value ) {
                value.id
                rows = rows + '<tr>';
                rows = rows + '<td>'+ ++i +'</td>';
                rows = rows + '<td>'+value.department.name+'</td>';
                rows = rows + '<td>'+value.name+'</td>';
                rows = rows + '<td>'+value.code+'</td>';
                rows = rows + '<td>'+value.credit+'</td>';
                rows = rows + '<td data-id="'+value.id+'" class="text-center">';
                rows = rows + '<a class="btn btn-sm btn-info text-light" id="editRow" data-id="'+value.id+'" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></a> ';
                rows = rows + '<a class="btn btn-sm btn-danger text-light"  id="deleteRow" data-id="'+value.id+'" ><i class="fa fa-trash"></i></a> ';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            });
            $("#currencyTable").html(rows);
    }
        function getAllcourse(){
            axios.get("{{ route('admin.course.fetch') }}")
            .then(function(res){
               //console.log(res);
                table_data_row(res.data);
             $('.dataTable').DataTable();
            })
        }
        getAllcourse();
        //delete currency
        $('body').on('click','#deleteRow',function (e) {
            e.preventDefault();
             let id = $(this).data('id')
            let url = base_path + '/admin/course/' + id
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mx-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
              axios.delete(url).then(function(r){
                getAllcourse();
                 swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        )
            });
            } else if (
                    /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your file is safe :)',
                    'error'
                )
            }
        })
        });
        //store
        $('body').on('submit','#catAddForm',function(e){
            // console.log('ok');
        e.preventDefault();
        let nameError = $('#nameError')
        let departmentError = $('#departmentError')
        let codeError = $('#codeError')
        let creditError = $('#creditError')
        nameError.text('')
        departmentError.text('')
        codeError.text('')
        creditError.text('')
        axios.post("{{ route('admin.course.store') }}", {
            name: $('#add_cat_name').val(),
            department_id: $('#department_id').val(),
            code: $('#add_code_name').val(),
            credit: $('#add_credit').val(),
        })
        .then(function (response) {
           // console.log(response);
           if(response.data.flag === 'EXISTS'){
            setWaringMessage()
            return null
           }
            getAllcourse();
            nameError.text('')
             $('#add_cat_name').val('')
             $('#department_id').val('')
             $('#add_credit').val('')
             $('#add_code_name').val('')
             setSuccessMessage()

        })
        .catch(function (error) {
            if(error.response.data.errors.name){
                nameError.text(error.response.data.errors.name[0]);
            }
            if(error.response.data.errors.department_id){
                departmentError.text(error.response.data.errors.department_id[0]);
            }
            if(error.response.data.errors.code){
                codeError.text(error.response.data.errors.code[0]);
            }
            if(error.response.data.errors.credit){
                creditError.text(error.response.data.errors.credit[0]);
            }
        });
    });

    //edit
    $('body').on('click','#editRow',function(){
        let id = $(this).data('id')
        let url = base_path + '/admin/course/' + id
       // console.log(url);
        axios.get(url)
            .then(function(res){
                $('#edit_cat_name').val(res.data.name)
                $('#e_department_id').val(res.data.department_id)
                $('#e_id').val(res.data.id)
                $('#e_add_code_name').val(res.data.code)
                $('#e_add_credit').val(res.data.credit)
            })
    })
    //update
    $('body').on('submit','#catUpdateForm',function(e){
        e.preventDefault()
        let id = $('#e_id').val()
        let data = {
            id : id,
            name : $('#edit_cat_name').val(),
            department_id : $('#e_department_id').val(),
            code : $('#e_add_code_name').val(),
            credit : $('#e_add_credit').val(),

        }
        let url = base_path + '/admin/course' + '/'  + id
        axios.put(url,data)
        .then(function(res){
            if(res.data.flag === 'EXISTS'){
            setWaringMessage('Course Code Already Exists!!')
            return null
           }
            getAllcourse();
             $('#editModal').modal('toggle')
             setSuccessMessage('Data Update Successfully!');
            //console.log(res);
        })
    })
</script>
@endpush
