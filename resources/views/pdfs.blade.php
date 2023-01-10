<!doctype html>
<html lang="es">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <title>Reports Suntic</title>
    </head>
    <body >
        <div class="container" style="padding-top:40px">

            <div class="row">
                <div class="col-md">

                </div>
                <div class="col-md-10">
                    <h1>OnlyPDF.com</h1>
                    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Nuevo</button>
                    <table id="table_id" class="table table-bordered display">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="min-width:200px">Acciones</th>
                                <th scope="col">Titulo</th>
                                <th scope="col">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pdfs as $key => $item)
                                <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                    <td width="25%">
                                        <button type="button" class="btn btn-info" onclick="showFile('{{ $item->id }}')">Ver</button>
                                        <button type="button" class="btn btn-success" onclick="modalEdit('{{ $item->id }}','{{ $item->title }}','{{ $item->state }}','{{ $item->pdf_code }}')" data-toggle="modal" data-target="#exampleModalEdit">Editar</button>
                                        <button type="button" class="btn btn-danger" onclick="deletepdf('{{ $item->id }}','{{ $item->title }}')">Eliminar</button>
                                    </td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->state }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <!-- Modal -->
                        <form enctype="multipart/form-data" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Titulo</label>
                                            <input type="text" class="form-control" id="title" name="title">

                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Archivo</label>
                                            <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" value="1" checked class="form-check-input" id="exampleCheck1" name="state">
                                            <label class="form-check-label" for="exampleCheck1">Activo</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="btn-register">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form enctype="multipart/form-data" class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Archivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="title">Titulo</label>
                                            <input type="text" class="form-control" id="title-edit" name="title">
                                            <input type="hidden" id="pdf_id" name="pdf_id">
                                            <input type="hidden" id="pdf_code" name="pdf_code">
                                        </div>
                                        <div class="form-group">
                                            <label for="file-edit">Archivo</label>
                                            <input type="file" class="form-control-file" id="file-edit" name="file">
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" value="1" checked class="form-check-input" id="state-edit" name="state">
                                            <label class="form-check-label" for="state-edit">Activo</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="btn-update">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="col-md">

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
      
        <script>
            function modalEdit(id,tit,est,cod){
                $('#title-edit').val(tit);
                $('#state-edit').val(est);
                $('#pdf_id').val(id);
                $('#pdf_code').val(cod);
            }
        </script>
        <script>

            $(document).ready( function () {
                $('#table_id').DataTable();
            } );
            
            $("#btn-register" ).click(function() {

            

                if($('#title').val() == undefined || $('#title').val() == null || $('#title').val() == ''){
                    Swal.fire("Campo title vacio!!", '', 'error')
                
                }else if($('#exampleFormControlFile1').val() == undefined || $('#exampleFormControlFile1').val() == null || $('#exampleFormControlFile1').val() == ''){
                    Swal.fire("Campo file vacio!!", '', 'error')
                }else{

                let formData = new FormData(document.getElementById("exampleModal"));
                let data =  {
                    "_token": $('#token').val(),
                    'title': $('#title').val(),
                    'state': $('#exampleCheck1').val(),
                    'file': $('#exampleFormControlFile1').val()
                };
                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        
                $.ajax({
                    url: "{{ route('pdf_register') }}",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res){
                    msg = JSON.parse(res).response.msg
                    Swal.fire(msg, '', 'success')
                    location.reload();
                }).fail(function(res){
                    
                    Swal.fire("Error Inesperado!! :(", '', 'error')
                    console.log(res)
                });
                }
            });
            function showFile(id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ asset('/pdf/file/') }}/"+id,
                    type: "get",
                    dataType: "html",
                    contentType: false,
                    processData: false
                }).done(function(res){
                    file = JSON.parse(res).response.url;
                    global_path = "{{ asset('storage/') }}";
                    window.open(global_path+"/"+file,'_blank');
                }).fail(function(res){
                    console.log(res)
                });
            }
            $( "#btn-update" ).click(function() {

                if($('#title-edit').val() == undefined || $('#title-edit').val() == null || $('#title-edit').val() == ''){
                    Swal.fire("Campo title vacio!!", '', 'error')
                
                }else if($('#file-edit').val() == undefined || $('#file-edit').val() == null || $('#file-edit').val() == ''){
                    Swal.fire("Campo file vacio!!", '', 'error')
                }else{
                var formData = new FormData(document.getElementById("exampleModalEdit"));
                    $.ajax({
                        url: "{{ route('pdf_update') }}",
                        type: "post",
                        dataType: "html",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    }).done(function(res){
                        msg = JSON.parse(res).response.msg
                        Swal.fire(msg, '', 'success')
                        location.reload();
                    }).fail(function(res){
                        console.log(res)
                    });
                }
            });
            function deletepdf(id,title){
                Swal.fire({
                title: 'Desea eliminar el Archivo '+title+' ?',
                showDenyButton: true,
                denyButtonText: `Cancel`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ asset('/pdf/delete/') }}/"+id,
                        type: "get",
                        dataType: "html",
                        contentType: false,
                        processData: false
                    }).done(function(res){
                        msg = JSON.parse(res).response.msg
                        Swal.fire(msg, '', 'success')
                        location.reload();
                    }).fail(function(res){
                        Swal.fire("Error inesperado! :(", '', 'error')
                        console.log(res)
                    });
                } else if (result.isDenied) {
                    Swal.fire('Archivo no Eliminado!!', '', 'info')
                }
                })
            }
        </script>
    </body>
</html>