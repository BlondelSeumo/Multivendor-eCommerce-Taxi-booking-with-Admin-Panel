@extends('layouts.app')

@section('content')
<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.currency_table')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.currency_table')}}</li>
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
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.currency_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('currencies.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.currency_create')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>

                        <div class="table-responsive m-t-10">


                            <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <th>{{trans('lang.country')}}</th>
                                        <th>{{trans('lang.currency_name')}}</th>

                                        <th>{{trans('lang.currency_symbol')}}</th>

                                        <th>{{trans('lang.currency_code')}}</th>
                                        <th>{{trans('lang.symbole_at_right')}}</th>
                                        <th>{{trans('lang.active')}}</th>
                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>

                                <tbody id="append_list1">


                                </tbody>

                            </table>
                            <div id="data-table_paginate">
                               <nav aria-label="Page navigation example">
                                   <ul class="pagination justify-content-center">
                                    <li class="page-item ">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()"  data-dt-idx="0" tabindex="0">{{trans('lang.previous')}}</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);" id="users_table_next_btn" onclick="next()"  data-dt-idx="2" tabindex="0">{{trans('lang.next')}}</a>
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

</div>

</div>

</div>
</div>



@endsection


@section('scripts')
<script type="text/javascript">

    var database = firebase.firestore();
    var offest=1;
    var pagesize=10;
    var end = null;
    var endarray=[];
    var start = null;
    var ref = database.collection('currencies');

    var append_list = '';

    $(document).ready(function() {

        var inx= parseInt(offest) * parseInt(pagesize);
        jQuery("#data-table_processing").show();

        append_list = document.getElementById('append_list1');
        append_list.innerHTML='';
        ref.limit(pagesize).get().then( async function(snapshots){
            html='';

            html=buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if(html!=''){
                append_list.innerHTML=html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.push(snapshots.docs[0]);
                if(snapshots.docs.length < pagesize){
                    jQuery("#data-table_paginate").hide();
                }
                //disableClick();
            }
        });

    });


    function buildHTML(snapshots){
        var html='';
        var alldata=[];
        var number= [];
        snapshots.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });

        var count = 0;
        alldata.forEach((listval) => {

            var val=listval;

            html=html+'<tr>';

            var id = val.id;
            var route1 =  '{{route("currencies.edit",":id")}}';
            route1 = route1.replace(':id', id);
              if(val.country!=undefined){
                country=val.country;
              }else{
                country='';
              }
            html=html+'<td>'+country+'</td>';
            html=html+'<td>'+val.name+'</td>';
            html=html+'<td>'+val.symbol+'</td>';
            html=html+'<td>'+val.code+'</td>';
            if(val.symbolAtRight){
                html=html+'<td><span class="badge badge-success">Yes</span></td>';
            }else{
                html=html+'<td><span class="badge badge-danger">No</span></td>';
            }

            if (val.isActive) {
              html = html + '<td><label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            } else {
              html = html + '<td><label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label></td>';
            }

          html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="currency-delete" class="" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';

          html=html+'</tr>';
      });
        return html;
    }
    /* toggal publish action code start*/
        $(document).on("click","input[name='isActive']",function(e){
            var ischeck=$(this).is(':checked');
            var id=this.id;
            if(ischeck){
              database.collection('currencies').doc(id).update({'isActive': true}).then(function (result) {
              });
              
              //only 1 currency should active at a time
              database.collection('currencies').where('isActive', "==", true).get().then(function (snapshots) {
                    var activeCurrency = snapshots.docs[0].data();
                    var activeCurrencyId = activeCurrency.id;
                    database.collection('currencies').doc(activeCurrencyId).update({'isActive': false});

                    $("#append_list1 tr").each(function(){
                    	$(this).find(".switch #"+activeCurrencyId).prop('checked',false);
                    });
               });
              
            }else{
              database.collection('currencies').doc(id).update({'isActive': false}).then(function (result) {
              });
            }

        });

    /*toggal publish action code end*/

    function prev(){
      if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];

    if(end!=undefined || end!=null){
        jQuery("#data-table_processing").show();
        if(jQuery("#selected_search").val()=='name' && jQuery("#search").val().trim()!=''){

            listener=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();
        }else{
            listener = ref.startAt(end).limit(pagesize).get();
        }

        listener.then((snapshots) => {
            html='';
            html=buildHTML(snapshots);
            jQuery("#data-table_processing").hide();
            if(html!=''){
                append_list.innerHTML=html;
                start = snapshots.docs[snapshots.docs.length - 1];
                endarray.splice(endarray.indexOf(endarray[endarray.length-1]),1);

                if(snapshots.docs.length < pagesize){

                    jQuery("#users_table_previous_btn").hide();
                }

            }
        });
    }
}


function next(){
  if(start!=undefined || start!=null){

    jQuery("#data-table_processing").hide();

    if(jQuery("#selected_search").val()=='name' && jQuery("#search").val().trim()!=''){

        listener=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();
    }else{
        listener = ref.startAfter(start).limit(pagesize).get();
    }
    listener.then((snapshots) => {

        html='';
        html=buildHTML(snapshots);
        console.log(snapshots);
        jQuery("#data-table_processing").hide();
        if(html!=''){
            append_list.innerHTML=html;
            start = snapshots.docs[snapshots.docs.length - 1];

            if(endarray.indexOf(snapshots.docs[0])!=-1){
                endarray.splice(endarray.indexOf(snapshots.docs[0]),1);
            }
            endarray.push(snapshots.docs[0]);
        }
    });
}
}

function searchclear(){
    jQuery("#search").val('');
    searchtext();
}

function searchtext(){

  jQuery("#data-table_processing").show();

  append_list.innerHTML='';

  if(jQuery("#selected_search").val()=='name' && jQuery("#search").val().trim()!=''){

   wherequery=ref.orderBy('name').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

} else{

    wherequery=ref.limit(pagesize).get();
}

wherequery.then((snapshots) => {
    html='';
    html=buildHTML(snapshots);
    jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length < pagesize){

            jQuery("#data-table_paginate").hide();
        }else{

            jQuery("#data-table_paginate").show();
        }
    }
});

}

$(document).on("click","a[name='currency-delete']", function (e) {

    var id = this.id;
    database.collection('currencies').doc(id).delete().then(function () {
        window.location.reload();
    });


});



</script>

@endsection
