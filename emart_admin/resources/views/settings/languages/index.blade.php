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
                <h3 class="text-themecolor">{{trans('lang.languages')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.languages')}}</li>
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
                                                class="fa fa-list mr-2"></i>{{trans('lang.languages')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('settings.app.languages.create') !!}"><i
                                                class="fa fa-plus mr-2"></i>{{trans('lang.language_create')}}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                                 style="display: none;">{{trans('lang.processing')}}</div>

                            <div class="table-responsive m-t-10">
                                <table id="example24"
                                       class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                       cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>{{trans('lang.name')}}</th>
                                        <th>{{trans('lang.flag_image')}}</th>
                                        <th>{{trans('lang.slug')}}</th>
                                        <th>{{trans('lang.active')}}</th>
                                        <th>{{trans('lang.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody id="append_list1">
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
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
        var end = null;
        var endarray = [];
        var start = null;
        var user_number = [];
        var languages = [];
        // var ref=[];
        //var refData = database.collection('users').where("role","in",["customer"]);
        var placeholderImageData='';
        var placeholderImage = '';

        var placeholder = database.collection('settings').doc('placeHolderImage');

        var ref = database.collection('settings').doc('languages');
        var append_list = '';



        $(document).ready(function () {


            $(document.body).on('click', '.redirecttopage', function () {
                var url = $(this).attr('data-url');
                window.location.href = url;
            });

            var inx = parseInt(offest) * parseInt(pagesize);
            jQuery("#data-table_processing").show();



            append_list = document.getElementById('append_list1');
            append_list.innerHTML = '';
            placeholder.get().then(async function (snapshotsimage) {
                placeholderImageData = snapshotsimage.data();
                placeholderImage = placeholderImageData.image;
                //console.log(placeholderImage);
                ref.get().then(async function (snapshots) {
                    html = '';
                    snapshots = snapshots.data();
                    if (snapshots) {
                        snapshots = snapshots.list;
                        languages = snapshots;

                        html = buildHTML(snapshots);
                        if (html != '') {
                            append_list.innerHTML = html;
                        }
                    }
                    jQuery("#data-table_processing").hide();
                });
            });




        });

        function buildHTML(snapshots) {
            var html = '';
            var alldata = [];
            var number = [];
            if (snapshots.length) {
                snapshots.forEach((listval) => {
                    var datas = listval;
                    datas.id = listval.id;
                    alldata.push(datas);
                });
                var count = 0;
                alldata.forEach((listval) => {
                    var val = listval;
                    html = html + '<tr>';
                    newdate = '';
                    var id = val.slug;
                    var route1 = '{{route("settings.app.languages.edit",":id")}}';
                    route1 = route1.replace(':id', id);

                    html = html + '<td data-url="' + route1 + '" class="redirecttopage">' + val.title + '</td>';

                    if ( val.flag == '' || val.flag==undefined ) {

                        html = html + '<td><img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image"></td>';

                    } else {
                        console.log(val.flag);

                        html=html+'<td><img class="rounded" style="width:50px" src="'+ val.flag +'" alt="image"></td>';

                    }

                    html = html + '<td>' + val.slug + '</td>';

                    if (val.isActive) {
                      html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.slug + '" name="isActive"><span class="slider round"></span></label></td>';
                    } else {
                      html = html + '<td><label class="switch"><input type="checkbox" id="' + val.slug + '" name="isActive"><span class="slider round"></span></label></td>';
                    }


                    html = html + '<td class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><a id="' + val.slug + '" class="do_not_delete" name="lang-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

                    html = html + '</tr>';
                    count = count + 1;
                });
            }
            return html;
        }
        /* toggal publish action code start*/
            $(document).on("click","input[name='isActive']",function(e){
                var ischeck=$(this).is(':checked');
                var id=this.id;
                var language_key='';
                ref.get().then(async function (snapshots) {

                    snapshots = snapshots.data();
                    snapshots = snapshots.list;
                    if (snapshots.length) {
                        languages = snapshots;
                    }
                    for (var key in snapshots) {
                        if (snapshots[key]['slug'] == id) {
                            language_key = key;
                        }
                    }
                if(ischeck){
                  languages[language_key]['isActive'] = true;

                 database.collection('settings').doc('languages').update({'list': languages}).then(function (result) {
                  });
                }else{
                  languages[language_key]['isActive'] = false;
                 database.collection('settings').doc('languages').update({'list': languages}).then(function (result) {
                  });
                }
              });
            });

        /*toggal publish action code end*/

        $(document).on("click", "a[name='lang-delete']", function (e) {
            var id = this.id;

            var newlanguage = [];
            languages.forEach((language) => {
                if (id != language.slug) {
                    delete language.id;
                    console.log(language);
                    newlanguage.push(language);
                }
            });
            jQuery("#data-table_processing").show();
            database.collection('settings').doc('languages').update({'list': newlanguage}).then(function (result) {
                jQuery("#data-table_processing").hide();
                window.location.href = '{{ route("settings.app.languages") }}';
            });

        });


    </script>

@endsection
