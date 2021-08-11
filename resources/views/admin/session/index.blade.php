@extends('layouts.master')

@section('title' , 'Session')
@section('master_content')

<div class="row no-gutters">
    <div class="col-12 col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="text-info">Session</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
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
                <h4 class="text-info">Add Session</h4>
            </div>
            <div class="card-body">
                <form id="catAddForm">
                    <label for="">Name</label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Session Name" id="add_cat_name">
                        <span class="text-danger" id="nameError"></span>
                        <div id="response"></div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-success"><i class="fa fa-plus"></i> Add Session</button>
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
                <h4 class="modal-title" id="userCrudModal">Edit session</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="catUpdateForm" >
                    <input type="hidden" id="e_id" name="id" value="">
                    <div class="form-group">
                        <input type="text" id="edit_cat_name" name="name" value="" class="form-control">
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

@push('script')
<script type="text/javascript">
    //fetch
    function table_data_row(data) {
            var	rows = '';
            var i = 0;
            $.each( data, function( key, value ) {
                value.id
                rows = rows + '<tr>';
                rows = rows + '<td>'+ ++i +'</td>';
                rows = rows + '<td>'+value.name+'</td>';
                rows = rows + '<td data-id="'+value.id+'" class="text-center">';
                rows = rows + '<a class="btn btn-sm btn-info text-light" id="editRow" data-id="'+value.id+'" data-toggle="modal" data-target="#editModal">Edit</a> ';
                rows = rows + '<a class="btn btn-sm btn-danger text-light"  id="deleteRow" data-id="'+value.id+'" >Delete</a> ';
                rows = rows + '</td>';
                rows = rows + '</tr>';
            });
            $("#currencyTable").html(rows);
    }
        function getAllsession(){
            axios.get("{{ route('admin.session.fetch') }}")
            .then(function(res){
              //  console.log(res);
                table_data_row(res.data);
              //$('.dataTable').DataTable();
            })
        }
        getAllsession();
        //delete currency
        $('body').on('click','#deleteRow',function (e) {
            e.preventDefault();
             let id = $(this).data('id')
            let url = base_path + '/admin/session/' + id
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
                getAllsession();
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
            console.log('ok');
        e.preventDefault();
        let nameError = $('#nameError')
        nameError.text('')
        axios.post("{{ route('admin.session.store') }}", {
            name: $('#add_cat_name').val(),
        })
        .then(function (response) {
            getAllsession();
            nameError.text('')
             $('#add_cat_name').val('')
             setSuccessMessage()

        })
        .catch(function (error) {
            if(error.response.data.errors.name){
                nameError.text(error.response.data.errors.name[0]);
            }
        });
    });

    //edit
    $('body').on('click','#editRow',function(){
        let id = $(this).data('id')
        let url = base_path + '/admin/session/' + id
       // console.log(url);
        axios.get(url)
            .then(function(res){
                $('#edit_cat_name').val(res.data.name)
                $('#e_id').val(res.data.id)
            })
    })
    //update
    $('body').on('submit','#catUpdateForm',function(e){
        e.preventDefault()
        let id = $('#e_id').val()
        let data = {
            id : id,
            name : $('#edit_cat_name').val(),
        }
        let url = base_path + '/admin/session' + '/'  + id
        axios.put(url,data)
        .then(function(res){
            getAllsession();
             $('#editModal').modal('toggle')
             setSuccessMessage('Data Update Successfully!');
            //console.log(res);
        })
    })
</script>
@endpush
