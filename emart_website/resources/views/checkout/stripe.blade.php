@include('layouts.app')


@include('layouts.header')


<style type="text/css">


    form {

        width: 480px;

        margin: 20px auto;

    }


    .group {

        background: white;

        box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10),
        0 3px 6px 0 rgba(0, 0, 0, 0.08);

        border-radius: 4px;

        margin-bottom: 20px;

    }


    label {

        position: relative;

        color: #8898AA;

        font-weight: 300;

        height: 40px;

        line-height: 40px;

        margin-left: 20px;

        display: block;

    }


    .group label:not(:last-child) {

        border-bottom: 1px solid #F0F5FA;

    }


    label > span {

        width: 20%;

        text-align: right;

        float: left;

    }


    .field {

        background: transparent;

        font-weight: 300;

        border: 0;

        color: #31325F;

        outline: none;

        padding-right: 10px;

        padding-left: 10px;

        cursor: text;

        width: 70%;

        height: 40px;

        float: right;

    }


    .field::-webkit-input-placeholder {
        color: #CFD7E0;
    }

    .field::-moz-placeholder {
        color: #CFD7E0;
    }

    .field:-ms-input-placeholder {
        color: #CFD7E0;
    }


    button {

        float: left;

        display: block;

        background: #666EE8;

        color: white;

        box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10),
        0 3px 6px 0 rgba(0, 0, 0, 0.08);

        border-radius: 4px;

        border: 0;

        margin-top: 20px;

        font-size: 15px;

        font-weight: 400;

        width: 100%;

        height: 40px;

        line-height: 38px;

        outline: none;

    }


    button:focus {

        background: #555ABF;

    }


    button:active {

        background: #43458B;

    }


    .outcome {

        float: left;

        width: 100%;

        padding-top: 8px;

        min-height: 24px;

        text-align: center;

    }


    .success, .error {

        display: none;

        font-size: 13px;

    }


    .success.visible, .error.visible {

        display: inline;

    }


    .error {

        color: #E4584C;

    }


    .success {

        color: #666EE8;

    }


    .success .token {

        font-weight: 500;

        font-size: 13px;

    }

</style>


<div class="siddhi-checkout siddhi-checkout-payment">


    <div class="container position-relative">

        <div class="py-5 row">

            <div class="pb-2 align-items-starrt sec-title col">

                <h2 class="m-0">{{trans('lang.title_here')}}</h2>

                <p class="sub-title">{{trans('lang.lorem_ipsum_message')}}</p>

            </div>

            <div class="col-md-12 mb-3">

                <div>


                    <div class="siddhi-cart-item mb-3 rounded shadow-sm bg-white overflow-hidden">

                        <div class="siddhi-cart-item-profile bg-white p-3">


                            <div class="card card-default payment-wrap">

                                <table class="payment-table">

                                    <thead>

                                    <tr>

                                        <th>

                                            {{trans('lang.pay_with')}}

                                        </th>

                                        <th class="text-right">

                                            {{trans('lang.total')}}

                                        </th>

                                    </tr>

                                    </thead>


                                    <tbody>

                                    <tr>

                                        <td>

                                            {{trans('lang.stripe')}} {{trans('lang.payment')}}

                                        </td>

                                        <td class="text-right payment-buttons">


                                            <form action="<?php echo route('process-stripe'); ?>" method="post">

                                                @csrf

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.user_name')}}</label>
                                                    <div class="col-sm-6">
                                                        <input name="cardholder-name" required type="text"
                                                               placeholder="Cardholder Name" class="form-control"
                                                               value="<?php echo $authorName; ?>"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.address_line1')}}</label>
                                                    <div class="col-sm-6">
                                                        <input name="address_line1" id="address_line1" required
                                                               type="text" placeholder="Address Line 1"
                                                               class="form-control"
                                                               value="<?php echo $cart_order['address_line1']; ?>"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.address_line2')}}</label>
                                                    <div class="col-sm-6">
                                                        <input name="address_line1" id="address_line1" required
                                                               type="text" placeholder="Address Line 2"
                                                               class="form-control"
                                                               value="<?php echo $cart_order['address_line1']; ?>"/>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.landmark')}}</label>
                                                    <div class="col-sm-6">
                                                        <input name="address_line2" id="address_line2" required
                                                               type="text" placeholder="Landmark" class="form-control"
                                                               value="<?php echo $cart_order['address_line2']; ?>"/>
                                                    </div>
                                                </div>


                                                <?php /*                         <div class="col-md-6 form-group">
                      <label class="form-label font-weight-bold small">Address</label>
                    <label>

                      <span>Name</span>
                      <div class="input-group">

                         <input name="address_line1" id="address_line1" required type="text" placeholder="Address" class="form-control" value="<?php echo $cart_order['address_line1']; ?>" />
                      </div>
                    </div>
                    </label> */ ?>



                                                <?php /* <label>

                      <span>Address</span>

                        <input name="address_line1" id="address_line1" required type="text" placeholder="Address" class="field" value="<?php echo $cart_order['address_line1']; ?>" />

                    </label>  */ ?>

                                                <input type="hidden" name="address_zipcode" id="address_zipcode"
                                                       value="<?php echo $cart_order['address_zipcode']; ?>">

                                                <?php /*  <label>

                      <span>Landmark</span>

                        <input name="address_line2"  id="address_line2" required type="text" placeholder="Landmark" class="field" value="<?php echo $cart_order['address_line2']; ?>" />

                    </label> */ ?>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.country')}}</label>
                                                    <div class="col-sm-6">

                                                        <!--     <label>

                                                              <span>Country</span> -->

                                                        <select id="country" class="form-control" required
                                                                name="country">

                                                            <option>{{trans('lang.select_country')}}</option>

                                                            <option value="AF">Afghanistan</option>

                                                            <option value="AX">Aland Islands</option>

                                                            <option value="AL">Albania</option>

                                                            <option value="DZ">Algeria</option>

                                                            <option value="AS">American Samoa</option>

                                                            <option value="AD">Andorra</option>

                                                            <option value="AO">Angola</option>

                                                            <option value="AI">Anguilla</option>

                                                            <option value="AQ">Antarctica</option>

                                                            <option value="AG">Antigua and Barbuda</option>

                                                            <option value="AR">Argentina</option>

                                                            <option value="AM">Armenia</option>

                                                            <option value="AW">Aruba</option>

                                                            <option value="AU">Australia</option>

                                                            <option value="AT">Austria</option>

                                                            <option value="AZ">Azerbaijan</option>

                                                            <option value="BS">Bahamas</option>

                                                            <option value="BH">Bahrain</option>

                                                            <option value="BD">Bangladesh</option>

                                                            <option value="BB">Barbados</option>

                                                            <option value="BY">Belarus</option>

                                                            <option value="BE">Belgium</option>

                                                            <option value="BZ">Belize</option>

                                                            <option value="BJ">Benin</option>

                                                            <option value="BM">Bermuda</option>

                                                            <option value="BT">Bhutan</option>

                                                            <option value="BO">Bolivia</option>

                                                            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>

                                                            <option value="BA">Bosnia and Herzegovina</option>

                                                            <option value="BW">Botswana</option>

                                                            <option value="BV">Bouvet Island</option>

                                                            <option value="BR">Brazil</option>

                                                            <option value="IO">British Indian Ocean Territory</option>

                                                            <option value="BN">Brunei Darussalam</option>

                                                            <option value="BG">Bulgaria</option>

                                                            <option value="BF">Burkina Faso</option>

                                                            <option value="BI">Burundi</option>

                                                            <option value="KH">Cambodia</option>

                                                            <option value="CM">Cameroon</option>

                                                            <option value="CA">Canada</option>

                                                            <option value="CV">Cape Verde</option>

                                                            <option value="KY">Cayman Islands</option>

                                                            <option value="CF">Central African Republic</option>

                                                            <option value="TD">Chad</option>

                                                            <option value="CL">Chile</option>

                                                            <option value="CN">China</option>

                                                            <option value="CX">Christmas Island</option>

                                                            <option value="CC">Cocos (Keeling) Islands</option>

                                                            <option value="CO">Colombia</option>

                                                            <option value="KM">Comoros</option>

                                                            <option value="CG">Congo</option>

                                                            <option value="CD">Congo, Democratic Republic of the Congo
                                                            </option>

                                                            <option value="CK">Cook Islands</option>

                                                            <option value="CR">Costa Rica</option>

                                                            <option value="CI">Cote D'Ivoire</option>

                                                            <option value="HR">Croatia</option>

                                                            <option value="CU">Cuba</option>

                                                            <option value="CW">Curacao</option>

                                                            <option value="CY">Cyprus</option>

                                                            <option value="CZ">Czech Republic</option>

                                                            <option value="DK">Denmark</option>

                                                            <option value="DJ">Djibouti</option>

                                                            <option value="DM">Dominica</option>

                                                            <option value="DO">Dominican Republic</option>

                                                            <option value="EC">Ecuador</option>

                                                            <option value="EG">Egypt</option>

                                                            <option value="SV">El Salvador</option>

                                                            <option value="GQ">Equatorial Guinea</option>

                                                            <option value="ER">Eritrea</option>

                                                            <option value="EE">Estonia</option>

                                                            <option value="ET">Ethiopia</option>

                                                            <option value="FK">Falkland Islands (Malvinas)</option>

                                                            <option value="FO">Faroe Islands</option>

                                                            <option value="FJ">Fiji</option>

                                                            <option value="FI">Finland</option>

                                                            <option value="FR">France</option>

                                                            <option value="GF">French Guiana</option>

                                                            <option value="PF">French Polynesia</option>

                                                            <option value="TF">French Southern Territories</option>

                                                            <option value="GA">Gabon</option>

                                                            <option value="GM">Gambia</option>

                                                            <option value="GE">Georgia</option>

                                                            <option value="DE">Germany</option>

                                                            <option value="GH">Ghana</option>

                                                            <option value="GI">Gibraltar</option>

                                                            <option value="GR">Greece</option>

                                                            <option value="GL">Greenland</option>

                                                            <option value="GD">Grenada</option>

                                                            <option value="GP">Guadeloupe</option>

                                                            <option value="GU">Guam</option>

                                                            <option value="GT">Guatemala</option>

                                                            <option value="GG">Guernsey</option>

                                                            <option value="GN">Guinea</option>

                                                            <option value="GW">Guinea-Bissau</option>

                                                            <option value="GY">Guyana</option>

                                                            <option value="HT">Haiti</option>

                                                            <option value="HM">Heard Island and Mcdonald Islands
                                                            </option>

                                                            <option value="VA">Holy See (Vatican City State)</option>

                                                            <option value="HN">Honduras</option>

                                                            <option value="HK">Hong Kong</option>

                                                            <option value="HU">Hungary</option>

                                                            <option value="IS">Iceland</option>

                                                            <option value="IN">India</option>

                                                            <option value="ID">Indonesia</option>

                                                            <option value="IR">Iran, Islamic Republic of</option>

                                                            <option value="IQ">Iraq</option>

                                                            <option value="IE">Ireland</option>

                                                            <option value="IM">Isle of Man</option>

                                                            <option value="IL">Israel</option>

                                                            <option value="IT">Italy</option>

                                                            <option value="JM">Jamaica</option>

                                                            <option value="JP">Japan</option>

                                                            <option value="JE">Jersey</option>

                                                            <option value="JO">Jordan</option>

                                                            <option value="KZ">Kazakhstan</option>

                                                            <option value="KE">Kenya</option>

                                                            <option value="KI">Kiribati</option>

                                                            <option value="KP">Korea, Democratic People's Republic of
                                                            </option>

                                                            <option value="KR">Korea, Republic of</option>

                                                            <option value="XK">Kosovo</option>

                                                            <option value="KW">Kuwait</option>

                                                            <option value="KG">Kyrgyzstan</option>

                                                            <option value="LA">Lao People's Democratic Republic</option>

                                                            <option value="LV">Latvia</option>

                                                            <option value="LB">Lebanon</option>

                                                            <option value="LS">Lesotho</option>

                                                            <option value="LR">Liberia</option>

                                                            <option value="LY">Libyan Arab Jamahiriya</option>

                                                            <option value="LI">Liechtenstein</option>

                                                            <option value="LT">Lithuania</option>

                                                            <option value="LU">Luxembourg</option>

                                                            <option value="MO">Macao</option>

                                                            <option value="MK">Macedonia, the Former Yugoslav Republic
                                                                of
                                                            </option>

                                                            <option value="MG">Madagascar</option>

                                                            <option value="MW">Malawi</option>

                                                            <option value="MY">Malaysia</option>

                                                            <option value="MV">Maldives</option>

                                                            <option value="ML">Mali</option>

                                                            <option value="MT">Malta</option>

                                                            <option value="MH">Marshall Islands</option>

                                                            <option value="MQ">Martinique</option>

                                                            <option value="MR">Mauritania</option>

                                                            <option value="MU">Mauritius</option>

                                                            <option value="YT">Mayotte</option>

                                                            <option value="MX">Mexico</option>

                                                            <option value="FM">Micronesia, Federated States of</option>

                                                            <option value="MD">Moldova, Republic of</option>

                                                            <option value="MC">Monaco</option>

                                                            <option value="MN">Mongolia</option>

                                                            <option value="ME">Montenegro</option>

                                                            <option value="MS">Montserrat</option>

                                                            <option value="MA">Morocco</option>

                                                            <option value="MZ">Mozambique</option>

                                                            <option value="MM">Myanmar</option>

                                                            <option value="NA">Namibia</option>

                                                            <option value="NR">Nauru</option>

                                                            <option value="NP">Nepal</option>

                                                            <option value="NL">Netherlands</option>

                                                            <option value="AN">Netherlands Antilles</option>

                                                            <option value="NC">New Caledonia</option>

                                                            <option value="NZ">New Zealand</option>

                                                            <option value="NI">Nicaragua</option>

                                                            <option value="NE">Niger</option>

                                                            <option value="NG">Nigeria</option>

                                                            <option value="NU">Niue</option>

                                                            <option value="NF">Norfolk Island</option>

                                                            <option value="MP">Northern Mariana Islands</option>

                                                            <option value="NO">Norway</option>

                                                            <option value="OM">Oman</option>

                                                            <option value="PK">Pakistan</option>

                                                            <option value="PW">Palau</option>

                                                            <option value="PS">Palestinian Territory, Occupied</option>

                                                            <option value="PA">Panama</option>

                                                            <option value="PG">Papua New Guinea</option>

                                                            <option value="PY">Paraguay</option>

                                                            <option value="PE">Peru</option>

                                                            <option value="PH">Philippines</option>

                                                            <option value="PN">Pitcairn</option>

                                                            <option value="PL">Poland</option>

                                                            <option value="PT">Portugal</option>

                                                            <option value="PR">Puerto Rico</option>

                                                            <option value="QA">Qatar</option>

                                                            <option value="RE">Reunion</option>

                                                            <option value="RO">Romania</option>

                                                            <option value="RU">Russian Federation</option>

                                                            <option value="RW">Rwanda</option>

                                                            <option value="BL">Saint Barthelemy</option>

                                                            <option value="SH">Saint Helena</option>

                                                            <option value="KN">Saint Kitts and Nevis</option>

                                                            <option value="LC">Saint Lucia</option>

                                                            <option value="MF">Saint Martin</option>

                                                            <option value="PM">Saint Pierre and Miquelon</option>

                                                            <option value="VC">Saint Vincent and the Grenadines</option>

                                                            <option value="WS">Samoa</option>

                                                            <option value="SM">San Marino</option>

                                                            <option value="ST">Sao Tome and Principe</option>

                                                            <option value="SA">Saudi Arabia</option>

                                                            <option value="SN">Senegal</option>

                                                            <option value="RS">Serbia</option>

                                                            <option value="CS">Serbia and Montenegro</option>

                                                            <option value="SC">Seychelles</option>

                                                            <option value="SL">Sierra Leone</option>

                                                            <option value="SG">Singapore</option>

                                                            <option value="SX">Sint Maarten</option>

                                                            <option value="SK">Slovakia</option>

                                                            <option value="SI">Slovenia</option>

                                                            <option value="SB">Solomon Islands</option>

                                                            <option value="SO">Somalia</option>

                                                            <option value="ZA">South Africa</option>

                                                            <option value="GS">South Georgia and the South Sandwich
                                                                Islands
                                                            </option>

                                                            <option value="SS">South Sudan</option>

                                                            <option value="ES">Spain</option>

                                                            <option value="LK">Sri Lanka</option>

                                                            <option value="SD">Sudan</option>

                                                            <option value="SR">Suriname</option>

                                                            <option value="SJ">Svalbard and Jan Mayen</option>

                                                            <option value="SZ">Swaziland</option>

                                                            <option value="SE">Sweden</option>

                                                            <option value="CH">Switzerland</option>

                                                            <option value="SY">Syrian Arab Republic</option>

                                                            <option value="TW">Taiwan, Province of China</option>

                                                            <option value="TJ">Tajikistan</option>

                                                            <option value="TZ">Tanzania, United Republic of</option>

                                                            <option value="TH">Thailand</option>

                                                            <option value="TL">Timor-Leste</option>

                                                            <option value="TG">Togo</option>

                                                            <option value="TK">Tokelau</option>

                                                            <option value="TO">Tonga</option>

                                                            <option value="TT">Trinidad and Tobago</option>

                                                            <option value="TN">Tunisia</option>

                                                            <option value="TR">Turkey</option>

                                                            <option value="TM">Turkmenistan</option>

                                                            <option value="TC">Turks and Caicos Islands</option>

                                                            <option value="TV">Tuvalu</option>

                                                            <option value="UG">Uganda</option>

                                                            <option value="UA">Ukraine</option>

                                                            <option value="AE">United Arab Emirates</option>

                                                            <option value="GB">United Kingdom</option>

                                                            <option value="US">United States</option>

                                                            <option value="UM">United States Minor Outlying Islands
                                                            </option>

                                                            <option value="UY">Uruguay</option>

                                                            <option value="UZ">Uzbekistan</option>

                                                            <option value="VU">Vanuatu</option>

                                                            <option value="VE">Venezuela</option>

                                                            <option value="VN">Viet Nam</option>

                                                            <option value="VG">Virgin Islands, British</option>

                                                            <option value="VI">Virgin Islands, U.s.</option>

                                                            <option value="WF">Wallis and Futuna</option>

                                                            <option value="EH">Western Sahara</option>

                                                            <option value="YE">Yemen</option>

                                                            <option value="ZM">Zambia</option>

                                                            <option value="ZW">Zimbabwe</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- </label> -->


                                                <?php /* <label>
                      <span>State</span>
                        <input name="state" id="state" required type="text" placeholder="State" class="field" value="" />
                    </label> */ ?>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.state')}}</label>
                                                    <div class="col-sm-6">
                                                        <input name="state" id="state" required type="text"
                                                               placeholder="State" class="form-control" value=""/>
                                                    </div>
                                                </div>


                                                <?php /*  <label>

                      <span>City</span>

                        <input name="city" id="city" required type="text" placeholder="City" class="field" value="<?php echo $cart_order['address_city']; ?>" />

                    </label> */ ?>

                                                <div class="form-group row">
                                                    <label class="col-sm-3 col-form-label">{{trans('lang.city')}}</label>
                                                    <div class="col-sm-6">

                                                        <input name="city" id="city" required type="text"
                                                               placeholder="City" class="form-control"
                                                               value="<?php echo $cart_order['address_city']; ?>"/>
                                                    </div>
                                                </div>


                                                <?php /* <label>
                      <span>Card</span>
                      <div id="card-element" class="field"></div>
                    </label> */ ?>

                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">{{trans('lang.card')}}</label>
                                                    <div class="col-sm-9">

                                                        <div id="card-element" class="field"></div>
                                                    </div>
                                                </div>


                                                <input type="hidden" name="token_id" id="token_id">

                                                <button type="submit">{{trans('lang.pay')}}
                                                    $<?php echo $amount; ?></button>

                                                <div class="outcome">

                                                    <div class="error" role="alert"></div>

                                                    <div class="success">

                                                        Success!

                                                    </div>

                                                </div>

                                            </form>

                                        </td>

                                    </tr>

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


@include('layouts.footer')


<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">


    var stripe = Stripe('<?php echo $stripeKey; ?>');

    var elements = stripe.elements();


    var card = elements.create('card', {

        style: {

            base: {

                iconColor: '#666EE8',

                color: '#31325F',

                lineHeight: '40px',

                fontWeight: 300,

                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',

                fontSize: '15px',


                '::placeholder': {

                    color: '#CFD7E0',

                },

            },

        }

    });


    card.mount('#card-element');

    function setOutcome(result) {

        var successElement = document.querySelector('.success');

        var errorElement = document.querySelector('.error');

        successElement.classList.remove('visible');

        errorElement.classList.remove('visible');


        if (result.token) {
            console.log(result.token.id);

            $("#token_id").val(result.token.id);

            var form = document.querySelector('form');


            $.ajax({

                type: 'POST',

                url: "<?php echo route('process-stripe'); ?>",

                data: {
                    _token: '<?php echo csrf_token() ?>',
                    token_id: result.token.id,
                    name: form.querySelector('input[name=cardholder-name]').value,
                    address_line1: $("#address_line1").val(),
                    address_line2: $("#address_line2").val(),
                    address_city: $("#city").val(),
                    address_state: $("#state").val(),
                    address_country: $("#country").val(),
                    address_zipcode: $("#address_zipcode").val()
                },

                success: function (data) {

                    data = JSON.parse(data);

                    if (data.status == true) {

                        successElement.textContent = data.message;

                        successElement.classList.add('visible');

                        window.location.href = '<?php echo route('success'); ?>';

                    } else {

                        errorElement.textContent = data.message;

                        errorElement.classList.add('visible');

                    }


                },

                error: function (XMLHttpRequest, textStatus, errorThrown) {

                    errorElement.textContent = XMLHttpRequest.responseJSON.message;

                    errorElement.classList.add('visible');

                }

            });


        } else if (result.error) {
            errorElement.textContent = result.error.message;

            errorElement.classList.add('visible');

        }

    }


    card.on('change', function (event) {

        setOutcome(event);

    });


    document.querySelector('form').addEventListener('submit', function (e) {

        e.preventDefault();

        var form = document.querySelector('form');


        var extraDetails = {

            name: form.querySelector('input[name=cardholder-name]').value,

            address_line1: $("#address_line1").val(),

            address_line2: $("#address_line1").val(),

            address_city: $("#city").val(),

            address_state: $("#state").val(),

            address_zip: card.address_zip,

            address_country: $("#country").val(),


        };

        stripe.createToken(card, extraDetails).then(setOutcome);

    });

</script>


@include('layouts.nav')



s