@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.currency_create')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                    <li class="breadcrumb-item"><a
                                href="{!! route('currencies') !!}">{{trans('lang.currency_table')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('lang.currency_create')}}</li>
                </ol>
            </div>
        </div>

        <div class="card-body">
            <div id="data-table_processing" class="dataTables_processing panel panel-default"
                 style="display: none;">{{trans('lang.processing')}}</div>
            <div class="error_top" style="display:none"></div>

            <div class="row vendor_payout_create">
                <div class="vendor_payout_create-inner">
                    <fieldset>
                        <legend><i class="mr-3 fa fa-money"></i>{{trans('lang.currency_plural')}}</legend>
                        <div class="form-group row width-100">
                            <label class="col-12 control-label">{{trans('lang.country')}}</label>
                            <div class="col-12">
                              <?php
                              $countries = file_get_contents(asset('countriesdata.json'));
                              $countries = json_decode($countries);
                              $countries = (array)$countries;
                              $newcountries = array();
                              $newcountriesjs = array();
                              foreach ($countries as $keycountry => $valuecountry) {
                                  $newcountries[$valuecountry->code] = $valuecountry;
                                  $newcountriesjs[$valuecountry->countryName] = $valuecountry->code;
                              }
                              ?>
                              <select name="country" id="country">
                                  <?php foreach ($newcountries as $keycy => $valuecy) { ?>
                                      <option value="<?php echo $valuecy->countryName; ?>"><?php echo $valuecy->countryName; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.currency_name')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control currency_name">
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.currency_code')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control currency_code">
                            </div>
                        </div>


                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.currency_symbol')}}</label>
                            <div class="col-7">
                                <input type="text" class="form-control currency_symbol">
                            </div>
                        </div>

                        <div class="form-group row width-50">
                            <label class="col-5 control-label">{{trans('lang.digit_after_decimal_point')}}</label>
                            <div class="col-7">
                                <input type="number" class="form-control decimal_degits" value="0">
                                <div class="form-text text-muted">{{trans('lang.digit_after_decimal_point_help')}}</div>
                            </div>
                        </div>

                        <div class="form-check width-100">
                            <input type="checkbox" class="symbol_at_right" id="symbol_at_right">
                            <label class="col-5 control-label"
                                   for="symbol_at_right">{{trans('lang.symbole_at_right')}}</label>
                        </div>

                        <div class="form-check width-100">
                            <input type="checkbox" class="currency_active" id="currency_active">
                            <label class="col-3 control-label" for="currency_active">{{trans('lang.active')}}</label>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>


        <div class="form-group col-12 text-center btm-btn">
            <button type="button" class="btn btn-primary save_currency_btn"><i
                        class="fa fa-save"></i> {{trans('lang.save')}}</button>
            <a href="{!! url('settings/currencies') !!}" class="btn btn-default"><i
                        class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
        </div>

    </div>
    </div>


@endsection

@section('scripts')
<link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css')}}" rel="stylesheet">

<script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script>

        var database = firebase.firestore();
        var newcountriesjs = '<?php echo json_encode($newcountriesjs); ?>';
        var newcountriesjs = JSON.parse(newcountriesjs);

        function formatState(state) {

            if (!state.id) {
                return state.text;
            }
            var baseUrl = "<?php echo URL::to('/');?>/flags/120/";
            var $state = $(
                '<span><img src="' + baseUrl + '/' + newcountriesjs[state.element.value].toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
            );
            return $state;
        }

        function formatState2(state) {
            if (!state.id) {
                return state.text;
            }

            var baseUrl = "<?php echo URL::to('/');?>/flags/120/"
            var $state = $(
                '<span><img class="img-flag" /> <span></span></span>'
            );
            // Use .text() instead of HTML string concatenation to avoid script injection issues
            $state.find("span").text(state.text);
            $state.find("img").attr("src", baseUrl + "/" + newcountriesjs[state.element.value].toLowerCase() + ".png");

            return $state;
        }
        $(document).ready(function () {
          jQuery("#country").select2({
              templateResult: formatState,
              templateSelection: formatState2,
              placeholder: "Select Country",
              allowClear: true
          });
            $(".save_currency_btn").click(function () {

                var currencyName = $(".currency_name").val();
                var currencyCode = $(".currency_code").val();
                var currencySymbol = $(".currency_symbol").val();
                var decimal_degits = $(".decimal_degits").val();
                var active = $(".currency_active").is(":checked");
                var symbolAtRight = $(".symbol_at_right").is(":checked");
                  var country = $('#country').val();
                var id = "<?php echo uniqid(); ?>";

                if (currencyName == '') {

                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_currency_name_error')}}</p>");

                } else if (currencySymbol == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_currency_symbol_error')}}</p>");

                } else if (decimal_degits < 0) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.digit_after_decimal_point_error')}}</p>");

                } else {
                    if (active) {
                        database.collection('currencies').where('isActive', "==", true).get().then(function (snapshots) {
                            var activeCurrency = snapshots.docs[0].data();
                            var activeCurrencyId = activeCurrency.id;
                            database.collection('currencies').doc(activeCurrencyId).update({'isActive': false});
                            database.collection('currencies').doc(id).set({
                                'id': id,
                                'name': currencyName,
                                'code': currencyCode,
                                'symbol': currencySymbol,
                                'decimal_degits': parseInt(decimal_degits),
                                'isActive': active,
                                'symbolAtRight': symbolAtRight,
                                  'country': country
                            }).then(function (result) {
                                window.location.href = '{{ route("currencies")}}';
                            });

                        });
                    } else {
                        database.collection('currencies').doc(id).set({
                            'id': id,
                            'name': currencyName,
                            'code': currencyCode,
                            'symbol': currencySymbol,
                            'decimal_degits': parseInt(decimal_degits),
                            'isActive': active,
                            'symbolAtRight': symbolAtRight,
                              'country': country
                        }).then(function (result) {
                            window.location.href = '{{ route("currencies")}}';
                        });

                    }

                }

            })

        });

    </script>


@endsection
