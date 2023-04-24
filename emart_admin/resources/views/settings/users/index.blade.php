@extends('layouts.app')


<?php

error_reporting(E_ALL ^ E_NOTICE);
?>

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">{{trans('lang.user_plural')}}</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.user_table')}}</li>
            </ol>
        </div>
        <div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                            class="fa fa-list mr-2"></i>{{trans('lang.user_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('users.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.user_create')}}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div id="users-table_filter" class="pull-right">
                        <div class="row">
                    <div class="col-sm-9">
                        <label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="first_name">{{ trans('lang.first_name')}}</option>
                                    <option value="last_name">{{ trans('lang.last_name')}}</option>
                                    <option value="email">{{ trans('lang.email')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search"
                                           aria-controls="users-table">
                            </label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">
                                {{trans('lang.search')}}
                            </button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">
                                {{trans('lang.clear')}}
                            </button>
                                </div>

                      </div>


                        <div class="col-sm-3">
                            <select id="pageSize" class="form-control pageSize"  onchange="clickpage(this.value)">
                                    <option value="0">{{trans('lang.select_limit')}}</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                             </select>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive m-t-10">
                        <table id="userTable"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="delete-all"><input type="checkbox" id="is_active"><label
                                            class="col-3 control-label" for="is_active"
                                    ><a id="deleteAll" class="do_not_delete"
                                        href="javascript:void(0)"><i
                                                    class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                <th>{{trans('lang.extra_image')}}</th>
                                <th>{{trans('lang.user_name')}}</th>
                                <th>{{trans('lang.email')}}</th>
                                <th>{{trans('lang.wallet_history')}}</th>
                                <th>{{trans('lang.role')}}</th>

                                <th>{{trans('lang.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody id="append_list1">
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item ">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn"
                                       onclick="prev()" data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" id="users_table_next_btn"
                                       onclick="next()" data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
                                </li>
                            </ul>
                        </nav>

                    </div>

        </div>
    </div>
</div>
</div>
</div>
</div>


@endsection


<!--     <script src="assets/plugins/jquery/jquery.min.js"></script>

   <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
   <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
   <script src="js/jquery.slimscroll.js"></script>

   <script src="js/waves.js"></script>

   <script src="js/sidebarmenu.js"></script>

   <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>

   <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>

   <script src="js/custom.min.js"></script>

   <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>

   <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>

   <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

   <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>

   <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>

   <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>

   <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
   <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
   <script src="assets/plugins/toast-master/js/jquery.toast.js"></script>
   <script src="js/toastr.js"></script>
-->


@section('scripts')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-firestore.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-database.js"></script>
<script type="text/javascript">@include('vendor.notifications.init_firebase')</script>

<script type="text/javascript">

    var database = firebase.firestore();

    var offest = 1;
    var pagesize = 10;
    var pagesizes = 0;

    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    // var ref=[];
    //var refData = database.collection('users').where("role","in",["customer"]);
    var ref = database.collection('users').where("role", "in", ["customer"]);
    // var ref = database.collection('users').where("role","in",["vendor","customer"]);
    var placeholderImage = '';
    var append_list = '';
    // var search = jQuery("#search").val();
    // $(document.body).on('keyup', '#search' ,function(){
    //     search = jQuery(this).val();
    // });
    // if ( search !='') {
    //     ref = refData;
    // }else{
    //     ref = refData.orderBy('createdAt', 'desc');
    // }
    //console.log('createdAt'+JSON.stringify(createdAt));
    $(document).ready(function () {

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });
        pagesizes = getCookie('pagesizes');
        if(pagesizes !=0){

        $('.pageSize option[value='+pagesizes+']').attr('selected','selected');
        var inx = parseInt(offest) * parseInt(pagesizes);
        jQuery("#data-table_processing").show();

        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.limit(pagesizes).get().then(async function (snapshots) {
            html = '';

            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesizes) {
                    jQuery("#data-table_paginate").hide();
                }
                //disableClick();
            }
        });
    }else{
        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();

        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })

        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';
        ref.limit(pagesize).get().then(async function (snapshots) {
            html = '';

            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
                //disableClick();
            }
        });
    }

    });


    function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        snapshots.docs.forEach((listval) => {
            var datas = listval.data();

            datas.id = listval.id;
            alldata.push(datas);
        });
        console.log(alldata);

        /* alldata.sort(function(a, b) {

           var keyA = a.createdAt.seconds,
             keyB = b.createdAt.seconds;

           if (keyA < keyB) return -1;
           if (keyA > keyB) return 1;
           return 0;
     }); */

        var count = 0;
        alldata.forEach((listval) => {

            var val = listval;

            html = html + '<tr>';
            newdate = '';
            var id = val.id;
            var route1 = '{{route("users.edit",":id")}}';
            route1 = route1.replace(':id', id);

            var trroute1 = '{{route("users.walletstransaction",":id")}}';
            trroute1 = trroute1.replace(':id', id);

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

            if (val.profilePictureURL == '') {

                html = html + '<td><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></td>';
            } else {
                html = html + '<td><img class="rounded" style="width:50px" src="' + val.profilePictureURL + '" alt="image"></td>';
            }

            html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.firstName + ' ' + val.lastName + '</td>';


            html = html + '<td>' + val.email + '</td>';
            html = html + '<td data-url="' + trroute1 + '" class="redirecttopage">{{trans("lang.wallet_history")}}</td>';
            html = html + '<td>' + val.role + '</td>';

            html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.id + '" class="do_not_delete" name="user-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
            /* <a id="'+val.id+'" name="vendor-active" href="javascript:void(0)"><i class="fa fa-check"></i></a> */


            html = html + '</tr>';
            count = count + 1;
        });
        return html;
    }

    $("#is_active").click(function () {
        $("#userTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#userTable .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                jQuery("#data-table_processing").show();
                $('#userTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('users').doc(dataId).delete().then(function () {

                        const getStoreName = deleteUserData(dataId);

                        window.location.reload();
                    });

                });

            }
        } else {
            alert('Please Select Any One Record .');
        }
    });

    async function deleteUserData(userId) {


       /* await database.collection('vendor_orders').where('authorID', '==', userId).get().then(async function (snapshotsItem) {
            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('vendor_orders').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });
        await database.collection('items_review').where('CustomerId', '==', userId).get().then(async function (snapshotsItem) {
            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('items_review').doc(item_data.Id).delete().then(function () {

                    });
                });
            }

        });*/

        await database.collection('wallet').where('user_id', '==', userId).get().then(async function (snapshotsItem) {

            if (snapshotsItem.docs.length > 0) {
                snapshotsItem.docs.forEach((temData) => {
                    var item_data = temData.data();

                    database.collection('wallet').doc(item_data.id).delete().then(function () {

                    });
                });
            }

        });


    }

    function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {
            //jQuery("#data-table_processing").show();

            if (jQuery("#selected_search").val() == 'first_name' && jQuery("#search").val().trim() != '') {
                listener = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else if (jQuery("#selected_search").val() == 'last_name' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();

            }
            /* else if(jQuery("#selected_search").val()=='role' && jQuery("#search").val().trim()!=''){

               listener=ref.orderBy('role').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

             } */
            else {
                listener = ref.startAt(end).limit(pagesize).get();
            }

            listener.then((snapshots) => {
                html = '';
                html = buildHTML(snapshots);
                // jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    // if(snapshots.docs.length < pagesize){

                    //     //jQuery("#users_table_previous_btn").hide();
                    // }

                }
            });
        }
    }

    function next() {

        if (start != undefined || start != null) {

            //jQuery("#data-table_processing").hide();
            // listener = ref.startAfter(start).limit(pagesize).get();

            if (jQuery("#selected_search").val() == 'first_name' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else if (jQuery("#selected_search").val() == 'last_name' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

                listener = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();

            }

            /* else if(jQuery("#selected_search").val()=='role' && jQuery("#search").val().trim()!=''){

               listener=ref.orderBy('role').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

             } */
            else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then((snapshots) => {

                html = '';
                html = buildHTML(snapshots);
                console.log(snapshots);
                //jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];


                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);
                }
            });
        }
    }
    function clickpage(value) {
        setCookie('pagesizes', value, 30);
        location.reload();
    }

    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }


    function searchtext() {

        /* var offest=1;
        var pagesize=10;
        var start = null;
        var end = null;
        var endarray=[];
        var inx= parseInt(offest) * parseInt(pagesize); */
        //jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'first_name' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'last_name' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else if (jQuery("#selected_search").val() == 'email' && jQuery("#search").val().trim() != '') {

            wherequery = ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();

        } else {

            wherequery = ref.limit(pagesize).get();
        }

        wherequery.then((snapshots) => {

            html = '';
            html = buildHTML(snapshots);
            //jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
                if (snapshots.docs.length < pagesize) {

                    jQuery("#data-table_paginate").hide();
                } else {

                    jQuery("#data-table_paginate").show();
                }
            }
        });

    }


    /*$(document).on("click","a[name='vendor-active']", function (e) {
            var id = this.id;
            console.log(id);
        database.collection('vendors').doc(id).update({'isActive':true}).then(function(result) {

                    window.location.reload();

        });
    }); */
    $(document).on("click", "a[name='user-delete']", function (e) {
        var id = this.id;

        jQuery("#data-table_processing").show();

        var dataObject = {"data":{ "uid": id } };
        var projectId = '<?php echo env('FIREBASE_PROJECT_ID') ?>';
        jQuery.ajax({
	        url: 'https://us-central1-'+projectId+'.cloudfunctions.net/deleteUser',
	        method: 'POST',
	        contentType: "application/json; charset=utf-8",
	        data: JSON.stringify(dataObject),
	        success: function(data){
	          	console.log('Delete user success:',data.result);
	          	database.collection('users').doc(id).delete().then(function (result) {
		        	const getStoreName = deleteUserData(id);
		        	window.location.reload();
		    	});
	        },
	        error: function(xhr, status, error) {
	        	var responseText = JSON.parse(xhr.responseText);
			  	console.log('Delete user error:',responseText.error);
			}
	    });

    });


</script>

@endsection
