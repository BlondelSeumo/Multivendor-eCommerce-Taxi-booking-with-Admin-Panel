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

            <h3 class="text-themecolor">{{trans('lang.notifications')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>

                <li class="breadcrumb-item">{{trans('lang.notifications')}}</li>

                <li class="breadcrumb-item active">{{trans('lang.notifications')}}</li>

            </ol>

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
                                            class="fa fa-list mr-2"></i>{{trans('lang.notifications_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('notification/send') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.create_notificaion')}}</a>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">Processing...
                        </div>

                        <div id="users-table_filter" class="pull-right">
                        <div class="row">

                        <div class="col-sm-9">
                            <label>{{trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                    <option value="subject">{{trans('lang.notification_subject')}}</option>
                                </select>
                                <div class="form-group">
                                    <input type="search" id="search" class="search form-control" placeholder="Search">
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


                        <table id="notificationTable"
                               class="display nowrap table table-hover table-striped table-bordered table table-striped"
                               cellspacing="0" width="100%">

                            <thead>

                            <tr>
                                <th class="delete-all"><input type="checkbox" id="is_active"><label
                                            class="col-3 control-label" for="is_active"
                                    ><a id="deleteAll" class="do_not_delete"
                                        href="javascript:void(0)"><i
                                                    class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>

                                <th>{{trans('lang.notification_subject')}}</th>

                                <th>{{trans('lang.notification_message')}}</th>

                                <th>{{trans('lang.date_created')}}</th>

                                <th>{{trans('lang.actions')}}</th>

                            </tr>

                            </thead>

                            <tbody id="append_restaurants">


                            </tbody>

                        </table>
                        <div class="data-table_paginate">
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

@endsection

@section('scripts')
<script type="text/javascript">

    var database = firebase.firestore();
    var offest = 1;
    var pagesize = 10;
    var pagesizes = 0;
    var end = null;
    var endarray = [];
    var start = null;
    var user_number = [];
    var refData = database.collection('notifications');
    var ref = refData.orderBy('createdAt', 'desc');
    var append_list = '';

    $(document).ready(function () {
        pagesizes = getCookie('pagesizes');

        if(pagesizes !=0){

        $('.pageSize option[value='+pagesizes+']').attr('selected','selected');
        var inx = parseInt(offest) * parseInt(pagesizes);
        jQuery("#data-table_processing").show();

        append_list = document.getElementById('append_restaurants');
        append_list.innerHTML = '';
        ref.limit(pagesizes).get().then(async function (snapshots) {
            html = '';

            html = await buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesizes) {
                    jQuery("#data-table_paginate").hide();
                }
            }
        });
    }else{
        var inx = parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();

        append_list = document.getElementById('append_restaurants');
        append_list.innerHTML = '';
        ref.limit(pagesize).get().then(async function (snapshots) {
            html = '';

            html = await buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {
                    jQuery("#data-table_paginate").hide();
                }
            }
        });
    }
    })

    $("#is_active").click(function () {
        $("#notificationTable .is_open").prop('checked', $(this).prop('checked'));

    });

    $("#deleteAll").click(function () {
        if ($('#notificationTable .is_open:checked').length) {
            if (confirm('Are You Sure want to Delete Selected Data ?')) {
                jQuery("#data-table_processing").show();
                $('#notificationTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');

                    database.collection('notifications').doc(dataId).delete().then(function () {

                        window.location.reload();
                    });

                });

            }
        } else {
            alert('Please Select Any One Record .');
        }
    });

    function buildHTML(snapshots) {

        if (snapshots.docs.length < pagesize) {
            jQuery("#data-table_paginate").hide();
        }
        var html = '';
        var number = [];
        var count = 0;

        if (snapshots.docs == "") {
            database.collection('notifications').doc().set({});
        }

        snapshots.docs.forEach(async (listval) => {

            var listval = listval.data();
            var val = listval;

            html = html + '<tr>';
            newdate = '';
            var id = val.id;

            html = html + '<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>';

            html = html + '<td>' + val.subject + '</td>';

            html = html + '<td>' + val.message + '</td>';

            var datatime = '';
            try {

                if (val.createdAt) {
                    var date1 = val.createdAt.toDate().toDateString();
                    datatime = date1
                }

            } catch (err) {

            }

            html = html + '<td>' + datatime + '</td>';

            html = html + '<td class="vendors-action-btn"><a id="' + val.id + '" name="notifications-delete" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

            html = html + '</tr>';
            count = count + 1;
        });
        return html;
    }

    async function next() {
        if (start != undefined || start != null) {
            jQuery("#data-table_processing").hide();

            if (jQuery("#selected_search").val() == 'subject' && jQuery("#search").val().trim() != '') {
                console.log(jQuery("#selected_search").val());

                listener = refData.orderBy('subject').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAfter(start).get();
            } else {
                listener = ref.startAfter(start).limit(pagesize).get();
            }
            listener.then(async (snapshots) => {

                html = '';
                html = await buildHTML(snapshots);
                console.log(snapshots);
                jQuery("#data-table_processing").hide();
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

    async function prev() {
        if (endarray.length == 1) {
            return false;
        }
        end = endarray[endarray.length - 2];

        if (end != undefined || end != null) {
            jQuery("#data-table_processing").show();
            if (jQuery("#selected_search").val() == 'subject' && jQuery("#search").val().trim() != '') {

                listener = refData.orderBy('subject').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').startAt(end).get();
            } else {
                listener = ref.startAt(end).limit(pagesize).get();
            }

            listener.then(async (snapshots) => {
                html = '';
                html = await buildHTML(snapshots);
                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length - 1]), 1);

                    if (snapshots.docs.length < pagesize) {

                        jQuery("#users_table_previous_btn").hide();
                    }

                }
            });
        }
    }

    function searchtext() {

        jQuery("#data-table_processing").show();

        append_list.innerHTML = '';

        if (jQuery("#selected_search").val() == 'subject' && jQuery("#search").val().trim() != '') {
            console.log(jQuery("#search").val());
            wherequery = refData.orderBy('subject').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val() + '\uf8ff').get();
        } else {
            wherequery = ref.limit(pagesize).get();
        }

        wherequery.then((snapshots) => {
            html = '';
            html = buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if (html != '') {
                append_list.innerHTML = html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if (snapshots.docs.length < pagesize) {

                    jQuery("#data-table_paginate").hide();
                } else {

                    jQuery("#data-table_paginate").show();
                }
            }
        });

    }
    function clickpage(value) {
        setCookie('pagesizes', value, 30);
        location.reload();
    }
    function searchclear() {
        jQuery("#search").val('');
        searchtext();
    }

    $(document).on("click", "a[name='notifications-delete']", function (e) {
        var id = this.id;

        jQuery("#data-table_processing").show();
        database.collection('notifications').doc(id).delete().then(function () {
            window.location.reload();
        });
    });
</script>

@endsection
