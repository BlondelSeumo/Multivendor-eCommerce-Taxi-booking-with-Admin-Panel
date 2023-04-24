@include('layouts.app')

@include('layouts.header')



<div class="d-none">

    <div class="bg-primary p-3 d-flex align-items-center">

        <a class="toggle togglew toggle-2" href="#"><span></span></a>

    </div>

</div>

<div class="siddhi-popular">



    <div class="container">

        <div class="search py-5">

            <div class="input-group mb-4">


                <!-- <input type="text" class="form-control form-control-lg input_search border-right-0 food_search" id="inlineFormInputGroup" value=""> -->

                <!-- 	<div class="input-group-prepend">

                        <div class="btn input-group-text bg-white border_search border-left-0 text-primary search_food_btn"><i class="feather-search"></i>

                        </div>

                    </div> -->



            </div>

            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">

                    <a class="nav-link active border-0 bg-light text-dark rounded" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather-home mr-2"></i><span class="restaurant_counts">DINE IN Restaurants</span></a>

                </li>
            </ul>



            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">

                <li class="nav-item" role="presentation">

                </li>

                <!-- <li class="nav-item" role="presentation">

                <a class="nav-link border-0 bg-light text-dark rounded ml-3" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather-disc mr-2"></i>Dishes (23)</a>

                </li> -->

            </ul>



            <div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.Processing')}}...</div>


            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">



                    <div class="container mt-4 mb-4 p-0">

                        <div id="append_list1" class="res-search-list-1"></div>

                        <!-- <div class="row fu-loadmore-btn">
                            <a class="page-link loadmore-btn" href="javascript:void(0);" id="loadmore" onclick="moreload()"  data-dt-idx="0" tabindex="0">Load More</a>
                        </div> -->



                    </div>

                </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">



                <div class="row d-flex align-items-center justify-content-center py-5">

                    <div class="col-md-4 py-5">



                    </div>

                </div>



            </div>



        </div>



    </div>

</div>



@include('layouts.footer')



@include('layouts.nav')


<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script src="https://cdn.firebase.com/libs/geofire/5.0.1/geofire.min.js"></script>
<script type="text/javascript">
    var geoFirestore = new GeoFirestore(firestore);
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then( async function(snapshotsimage){
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    var end = null;
    var endarray=[];
    var start = null;
    var vendorsref= database.collection('vendors').where("enabledDiveInFuture","==",true);
    var RestaurantNearBy = '';
    var DriverNearByRef = database.collection('settings').doc('RestaurantNearBy');
    //var myInterval=setInterval(callRestaurant, 1000);


    var pagesize = 12;
    var nearestRestauantRefnew='';
    var append_list = '';
    var placeholderImageRef = database.collection('settings').doc('placeHolderImage');
    var placeholderImageSrc = '';

    placeholderImageRef.get().then( async function(placeholderImageSnapshots){

        var placeHolderImageData = placeholderImageSnapshots.data();

        placeholderImageSrc = placeHolderImageData.image;

    })

    // function myStopTimer() {
    //        clearInterval(myInterval);
    //    }
    callRestaurant();

    async function callRestaurant() {
        if(address_lat=='' || address_lng=='' || address_lng==NaN || address_lat==NaN || address_lat==null || address_lng==null){
            return false;
        }


        DriverNearByRef.get().then( async function(DriverNearByRefSnapshots){
            var DriverNearByRefData = DriverNearByRefSnapshots.data();
            RestaurantNearBy = parseInt(DriverNearByRefData.radios);

            address_lat=parseFloat(address_lat);
            address_lng=parseFloat(address_lng);
            //myStopTimer();
            getNearestRestaurants();
        })

    }


    async function getNearestRestaurants(){


        if(RestaurantNearBy){
            nearestRestauantRefnew=geoFirestore.collection('vendors').where("enabledDiveInFuture","==",true).near({ center: new firebase.firestore.GeoPoint(address_lat, address_lng), radius: RestaurantNearBy});
        }else{
            nearestRestauantRefnew=geoFirestore.collection('vendors').where("enabledDiveInFuture","==",true);
        }

        nearestRestauantRefnew.get().then( async function(nearestRestauantSnapshot){
            most_popular = document.getElementById('append_list1');
            most_popular.innerHTML='';
            var popularRestauranthtml=buildHTMLNearestRestaurant(nearestRestauantSnapshot);
            if(popularRestauranthtml != ''){

                start = nearestRestauantSnapshot.docs[nearestRestauantSnapshot.docs.length - 1];
                endarray.push(nearestRestauantSnapshot.docs[0]);
                most_popular.innerHTML=popularRestauranthtml;

            }
            jQuery("#data-table_processing").hide();

        })
    }

    // $(document).ready(function() {

    //   $("#data-table_processing").show();

    // 			append_list = document.getElementById('append_list1');

    //     		append_list.innerHTML='';


    // })




    function buildHTMLNearestRestaurant(nearestRestauantSnapshot){
        var html='';
        var alldata=[];
        nearestRestauantSnapshot.docs.forEach((listval) => {
            var datas=listval.data();
            datas.id=listval.id;
            alldata.push(datas);
        });
        var count = 0;
        var popularFoodCount = 0;
        html = html+ '<div class="row">';
        alldata.forEach((listval) => {
            var val=listval;
            var rating = 0;
            var reviewsCount = 0;
            if(val.hasOwnProperty('reviewsSum') && val.reviewsSum != 0 && val.hasOwnProperty('reviewsCount') && val.reviewsCount != 0){
                rating = (val.reviewsSum/val.reviewsCount);
                rating = Math.round(rating * 10) / 10;
                reviewsCount = val.reviewsCount;
            }
            var status='Closed';
            var statusclass="closed";
            if(val.hasOwnProperty('reststatus') && val.reststatus){
                status='Open';
                statusclass="open";
            }

            var vendor_id_single = val.id;
            var view_vendor_details = "{{ route('dyiningvendor',':id')}}";
            view_vendor_details = view_vendor_details.replace(':id', 'id='+vendor_id_single);
            count++;

            html = html+ '<div class="col-md-3 pb-3"><div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm"><div class="list-card-image">';


            if(val.photo){
                photo=val.photo;
            }else{
                photo=placeholderImageSrc;
            }

            html = html +'<div class="member-plan position-absolute"><span class="badge badge-dark '+statusclass+'">'+status+'</span></div><a href="'+view_vendor_details+'"><img alt="#" src="'+photo+'" class="img-fluid item-img w-100"></a></div><div class="p-3 position-relative"><div class="list-card-body"><h6 class="mb-1"><a href="'+view_vendor_details+'" class="text-black">'+val.title+'</a></h6>';

            html = html + '<p class="text-gray mb-1 small"><span class="fa fa-map-marker"></span> '+val.location+'</p>';
            if(rating > 0){
                html = html + '<div class="star position-relative mt-3"><span class="badge badge-success"><i class="feather-star"></i>'+rating+' ('+reviewsCount+'+)</span></div>';
            }




            html = html +'</div>';
            html = html +'</div></div></div>';


        });
        html = html + '</div>';
        return html;
    }


    async function moreload(){
        if(start!=undefined || start!=null){
            jQuery("#data-table_processing").hide();

            listener = nearestRestauantRefnew.startAfter(start).limit(pagesize).get();
            listener.then( async(snapshots) => {

                html='';
                html=await buildHTMLNearestRestaurant(snapshots);
                console.log(snapshots);
                jQuery("#data-table_processing").hide();
                if(html!=''){
                    most_popular.innerHTML +=html;
                    start = snapshots.docs[snapshots.docs.length - 1];

                    if(endarray.indexOf(snapshots.docs[0])!=-1){
                        endarray.splice(endarray.indexOf(snapshots.docs[0]),1);
                    }
                    endarray.push(snapshots.docs[0]);

                    if(snapshots.docs.length < pagesize){

                        jQuery("#loadmore").hide();
                    }else{
                        jQuery("#loadmore").show();
                    }
                }
            });
        }
    }

    async function prev(){
        if(endarray.length==1){
            return false;
        }
        end=endarray[endarray.length-2];

        if(end!=undefined || end!=null){
            jQuery("#data-table_processing").show();
            listener = ref.startAt(end).limit(pagesize).get();

            listener.then(async(snapshots) => {
                html='';
                html=await buildHTML(snapshots);
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

</script>