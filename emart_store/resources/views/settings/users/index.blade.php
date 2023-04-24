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

                        <li class="breadcrumb-item">{{trans('lang.settings')}}</li>

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

                            <div class="card-body">

                                <h4 class="card-title"><?php echo $customers_list ?></h4>

                                <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                            <div id="users-table_filter" class="pull-right"><label>{{ trans('lang.search_by')}}
                                <select name="selected_search" id="selected_search" class="form-control input-sm">
                                        <option value="first_name">{{ trans('lang.first_name')}}</option>
                                        <option value="last_name">{{ trans('lang.last_name')}}</option>
                                        <option value="email">{{ trans('lang.email')}}</option>
                                </select>
                                <div class="form-group">
                                <input type="search" id="search" class="search form-control" placeholder="Search" aria-controls="users-table"></label>&nbsp;<button onclick="searchtext();" class="btn btn-warning btn-flat">{{ trans('lang.search')}}</button>&nbsp;<button onclick="searchclear();" class="btn btn-warning btn-flat">Clear</button>
                            </div>
                            </div>

                                <div class="table-responsive m-t-10">

                                    <table id="example24" class="display nowrap table table-hover table-striped table-bordered table table-striped" cellspacing="0" width="100%">

                                        <thead>

                                            <tr>

                                                <th>{{trans('lang.extra_image')}}</th>

                                                <th >{{trans('lang.user_name')}}</th>

                                                <th>{{trans('lang.email')}}</th>

                                                <th >{{trans('lang.role')}}</th>
                                                
                                                <th>{{trans('lang.actions')}}</th>

                                            </tr>

                                        </thead>

                                        <tbody id="append_list1">

                                        </tbody>

                                    </table>

                                    <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous" id="users-table_previous">
                                                <a href="javascript:void(0);" id="users_table_previous_btn" onclick="prev()" aria-controls="users-table" data-dt-idx="0" tabindex="0">{{ trans('lang.previous')}}</a>
                                            </li>
                                            <li class="paginate_button">
                                                <a href="javascript:void(0);" id="users_table_next_btn" onclick="next()" aria-controls="users-table" data-dt-idx="2" tabindex="0">{{ trans('lang.next')}}</a>
                                            </li>
                                        </ul>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.0/firebase-database.js"></script>
    <script type="text/javascript">@include('vendor.notifications.init_firebase')</script>

<script type="text/javascript">
 
     var database = firebase.firestore();

    var offest=1;
    var pagesize=10; 
    var end = null;
    var endarray=[];
    var start = null;
    var user_number = [];
// var ref=[];
    var ref = database.collection('users').where("role","in",["vendor","customer"]);
    var placeholderImage = '';
    var append_list = '';

$(document).ready(function() {

    var inx= parseInt(offest) * parseInt(pagesize);
    //jQuery("#data-table_processing").show();
    
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then( async function(snapshotsimage){
      var placeholderImageData = snapshotsimage.data();
      placeholderImage = placeholderImageData.image;
    })

    append_list = document.getElementById('append_list1');
    append_list.innerHTML='';
    ref.limit(pagesize).get().then( async function(snapshots){  
    html='';
    
    html=buildHTML(snapshots);
    //jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        if(snapshots.docs.length<pagesize){
            jQuery("#data-table_paginate").hide();
        }
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
                

           /* alldata.sort(function(a, b) {
                
              var keyA = a.createdAt.seconds,
                keyB = b.createdAt.seconds;
                
              if (keyA < keyB) return -1;
              if (keyA > keyB) return 1;
              return 0;
        }); */

        var count = 0;
        alldata.forEach((listval) => {
            
            var val=listval;
            
                html=html+'<tr>';
                newdate='';
                var id = val.id;
                var route1 =  '{{route("users.edit",":id")}}';
                route1 = route1.replace(':id', id);

                if(val.profilePictureURL == ''){
                  
                      html=html+'<td><img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image"></td>';
                }else{
                  html=html+'<td><img class="rounded" style="width:50px" src="'+val.profilePictureURL+'" alt="image"></td>';
                }
                
                html=html+'<td>'+val.firstName+' '+val.lastName+'</td>';
                
                html=html+'<td>'+val.email+'</td>';
                html=html+'<td>'+val.role+'</td>';
    
                html=html+'<td class="action-btn"><a href="'+route1+'"><i class="fa fa-edit"></i></a><a id="'+val.id+'" name="user-delete" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>';
                /* <a id="'+val.id+'" name="vendor-active" href="javascript:void(0)"><i class="fa fa-check"></i></a> */
                            

                html=html+'</tr>';
                count =count +1;
          });
          return html;      
}

function prev(){
    if(endarray.length==1){
        return false;
    }
    end=endarray[endarray.length-2];
  
  if(end!=undefined || end!=null){
            //jQuery("#data-table_processing").show();
                 
                  if(jQuery("#selected_search").val()=='first_name' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

                    }else if(jQuery("#selected_search").val()=='last_name' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

                    }else if(jQuery("#selected_search").val()=='email' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

                    }
                   /* else if(jQuery("#selected_search").val()=='role' && jQuery("#search").val().trim()!=''){

                      listener=ref.orderBy('role').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAt(end).get();

                    } */
                    else{
                    listener = ref.startAt(end).limit(pagesize).get();
                }
                
                listener.then((snapshots) => {
                html='';
                html=buildHTML(snapshots);
               // jQuery("#data-table_processing").hide();
                if(html!=''){
                    append_list.innerHTML=html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.splice(endarray.indexOf(endarray[endarray.length-1]),1);

                    // if(snapshots.docs.length < pagesize){ 
   
                    //     //jQuery("#users_table_previous_btn").hide();
                    // }
                    
                }
            });
  }
}

function next(){
  if(start!=undefined || start!=null){

        //jQuery("#data-table_processing").hide();
       // listener = ref.startAfter(start).limit(pagesize).get();

            if(jQuery("#selected_search").val()=='first_name' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    }else if(jQuery("#selected_search").val()=='last_name' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    }else if(jQuery("#selected_search").val()=='email' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    }

   /* else if(jQuery("#selected_search").val()=='role' && jQuery("#search").val().trim()!=''){

      listener=ref.orderBy('role').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').startAfter(start).get();

    } */
    else{
          listener = ref.startAfter(start).limit(pagesize).get();
    }
          listener.then((snapshots) => {
            
                html='';
                html=buildHTML(snapshots);
                console.log(snapshots);
                //jQuery("#data-table_processing").hide();
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

  /* var offest=1;
  var pagesize=10;
  var start = null;
  var end = null;
  var endarray=[];
  var inx= parseInt(offest) * parseInt(pagesize); */
  //jQuery("#data-table_processing").show();
  
  append_list.innerHTML='';  

    if(jQuery("#selected_search").val()=='first_name' && jQuery("#search").val().trim()!=''){

      wherequery=ref.orderBy('firstName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

    }else if(jQuery("#selected_search").val()=='last_name' && jQuery("#search").val().trim()!=''){

      wherequery=ref.orderBy('lastName').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

    }else if(jQuery("#selected_search").val()=='email' && jQuery("#search").val().trim()!=''){

      wherequery=ref.orderBy('email').limit(pagesize).startAt(jQuery("#search").val()).endAt(jQuery("#search").val()+'\uf8ff').get();

    }

    else{

    wherequery=ref.limit(pagesize).get();
 }
  
  wherequery.then((snapshots) => {
    html='';
    html=buildHTML(snapshots);
    //jQuery("#data-table_processing").hide();
    if(html!=''){
        append_list.innerHTML=html;
        start = snapshots.docs[snapshots.docs.length - 1];
        endarray.push(snapshots.docs[0]);
        /*if(snapshots.docs.length<pagesize && jQuery("#selected_search").val().trim()!='' && jQuery("#search").val().trim()!=''){*/
        if(snapshots.docs.length < pagesize){ 
   
            jQuery("#data-table_paginate").hide();
        }else{

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
 $(document).on("click","a[name='user-delete']", function (e) {
        var id = this.id;



       
    /* database.collection('users').doc(id).delete().then(function(result){
        window.location.href = '{{ url()->current() }}';
    }); */


});


</script>

@endsection
