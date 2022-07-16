@extends('layouts.frontend.master')

@section('title')
    Registration Form | BIID EXPO & DIALOGUE | AGRITECH BANGLADESH
@endsection
@section('description')
    
@endsection
@section('keywords')
    
@endsection

@section('content')

<div class="page-heading-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Registration Form</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="application-form main-content">
                    @if(Session::has('flash_message_error'))
                        <div class="alert alert-error alert-dismissible fade show" role="alert">
                            <strong>{!! session('flash_message_error') !!}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif   
                    @if(Session::has('flash_message_success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{!! session('flash_message_success') !!}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('registration-form') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Appling of ? : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <select name="event" class="form-control @error('event') is-invalid @enderror">
                                        <option value="">---- Choose Event ----</option>
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('event')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                               <div class="col-md-12">
                                    <label>Company's Name : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <input name="companyName" type="text" class="form-control @error('companyName') is-invalid @enderror">
                                    @error('companyName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                               <div class="col-md-12">
                                    <label>Contact Person: Mr./ Ms. : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <input name="contactName" type="text" class="form-control @error('contactName') is-invalid @enderror">
                                    
                                    @error('evecontactNament')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="row">
                               <div class="col-md-12">
                                    <label>Address : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror">
                                    </textarea>                                        
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>
                           </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>City : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <input name="city" type="text" class="form-control @error('city') is-invalid @enderror">
                                    
                                    @error('city')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Area Code : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <input name="areaCode" type="text" class="form-control @error('areaCode') is-invalid @enderror">
                                    
                                    @error('areaCode')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label>Country : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <select class="form-control @error('country') is-invalid @enderror" id="country" name="country">
                                        <option value="" selected="selected">--- Choose Country ---</option>
                                        <option value="Afghanistan"> Afghanistan</option>
                                        <option value="Albania"> Albania</option>
                                        <option value="Algeria"> Algeria</option>
                                        <option value="American-Samoa"> American-Samoa</option>
                                        <option value="Andorra"> Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla"> Anguilla</option>
                                        <option value="Antigua-and-Barbuda"> Antigua-and-Barbuda</option>
                                        <option value="Argentina"> Argentina</option>
                                        <option value="Armenia"> Armenia</option>
                                        <option value="Ascension-Island"> Ascension-Island</option>
                                        <option value="Australia"> Australia</option>
                                        <option value="Austria"> Austria</option>
                                        <option value="Azerbaijan"> Azerbaijan</option>
                                        <option value="Bahamas"> Bahamas</option>
                                        <option value="Bahrain"> Bahrain</option>
                                        <option value="Bangladesh"> Bangladesh</option>
                                        <option value="Barbados"> Barbados</option>
                                        <option value="Belarus"> Belarus</option>
                                        <option value="Belgium"> Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda"> Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia"> Bolivia</option>
                                        <option value="Bosnia-and-Herzegovina"> Bosnia-and-Herzegovina</option>
                                        <option value="Botswana"> Botswana</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British-Indian-Ocean-Territory"> British-Indian-Ocean-Territory</option>
                                        <option value="Brunei-Darussalam"> Brunei-Darussalam</option>
                                        <option value="Bulgaria"> Bulgaria</option>
                                        <option value="Burkina-Faso"> Burkina-Faso</option>
                                        <option value="Burma">Burma (Myanmar)</option>
                                        <option value="Burundi"> Burundi</option>
                                        <option value="Camaroon"> Camaroon</option>
                                        <option value="Cambodia"> Cambodia</option>
                                        <option value="Cameroon"> Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape-Verde"> Cape-Verde</option>
                                        <option value="Cayman-Islands"> Cayman-Islands</option>
                                        <option value="Central-African-Republic"> Central-African-Republic</option>
                                        <option value="Chad"> Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas-Island"> Christmas-Island</option>
                                        <option value="Cocos-(Keeling)-Islands"> Cocos-(Keeling)-Islands</option>
                                        <option value="Colombia"> Colombia</option>
                                        <option value="Comoros"> Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Cook-Islands"> Cook-Islands</option>
                                        <option value="Costa-Rica"> Costa-Rica</option>
                                        <option value="Cote-D-Ivoire"> Cote-D-Ivoire</option>
                                        <option value="Croatia"> Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech-Republic"> Czech-Republic</option>
                                        <option value="Denmark"> Denmark</option>
                                        <option value="Djibouti"> Djibouti</option>
                                        <option value="Dominica"> Dominica</option>
                                        <option value="Dominican-Republic"> Dominican-Republic</option>
                                        <option value="Ecuador"> Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El-Salvador"> El-Salvador</option>
                                        <option value="Equatorial-Guinea"> Equatorial-Guinea</option>
                                        <option value="Eritrea"> Eritrea</option>
                                        <option value="Estonia"> Estonia</option>
                                        <option value="Ethiopia"> Ethiopia</option>
                                        <option value="Falkland-Islands"> Falkland-Islands</option>
                                        <option value="Faroe-Islands"> Faroe-Islands</option>
                                        <option value="Federated-States-of-Micronesia"> Federated-States-of-Micronesia</option>
                                        <option value="Fiji"> Fiji</option>
                                        <option value="Finland"> Finland</option>
                                        <option value="France">France</option>
                                        <option value="French-Guiana"> French-Guiana</option>
                                        <option value="French-Polynesia"> French-Polynesia</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Georgia"> Georgia</option>
                                        <option value="Germany"> Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibralter"> Gibralter</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland"> Greenland</option>
                                        <option value="Grenada"> Grenada</option>
                                        <option value="Guadeloupe"> Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala"> Guatemala</option>
                                        <option value="Guernsey"> Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-Bissau"> Guinea-Bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Holy-See"> Holy-See</option>
                                        <option value="Honduras"> Honduras</option>
                                        <option value="Hong-Kong"> Hong-Kong</option>
                                        <option value="Hungary"> Hungary</option>
                                        <option value="Iceland"> Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia"> Indonesia</option>
                                        <option value="Iran">Iran</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland"> Ireland</option>
                                        <option value="Isle-of-Man"> Isle-of-Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica"> Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jarvis-Island"> Jarvis-Island</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhistan"> Kazakhistan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati"> Kiribati</option>
                                        <option value="Korea-(Peoples-Republic-of)"> Korea-(Peoples-Republic-of)</option>
                                        <option value="Korea-(Republic-of)"> Korea-(Republic-of)</option>
                                        <option value="Kuwait"> Kuwait</option>
                                        <option value="Kyrgyzstan"> Kyrgyzstan</option>
                                        <option value="Laos">Laos</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon"> Lebanon</option>
                                        <option value="Lesotho"> Lesotho</option>
                                        <option value="Liberia"> Liberia</option>
                                        <option value="Libya">Libya</option>
                                        <option value="Liechtenstein"> Liechtenstein</option>
                                        <option value="Lithuania"> Lithuania</option>
                                        <option value="Luxembourg"> Luxembourg</option>
                                        <option value="Macau">Macau</option>
                                        <option value="Macedonia"> Macedonia</option>
                                        <option value="Madagascar"> Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia"> Malaysia</option>
                                        <option value="Maldives"> Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall-Islands"> Marshall-Islands</option>
                                        <option value="Martinique"> Martinique</option>
                                        <option value="Mauritius"> Mauritius</option>
                                        <option value="Mayotte"> Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Moldavia"> Moldavia</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia"> Mongolia</option>
                                        <option value="Montenegro"> Montenegro</option>
                                        <option value="Montserrat"> Montserrat</option>
                                        <option value="Morocco"> Morocco</option>
                                        <option value="Mozambique"> Mozambique</option>
                                        <option value="Namibia"> Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands"> Netherlands</option>
                                        <option value="Netherlands-Antilles"> Netherlands-Antilles</option>
                                        <option value="New-Caledonia"> New-Caledonia</option>
                                        <option value="New-Zealand"> New-Zealand</option>
                                        <option value="Nicaragua"> Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria"> Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk-Island"> Norfolk-Island</option>
                                        <option value="Northern-Cypress"> Northern-Cypress</option>
                                        <option value="Northern-Mariana-Islands"> Northern-Mariana-Islands</option>
                                        <option value="Norway"> Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan"> Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua-New-Guinea"> Papua-New-Guinea</option>
                                        <option value="Paraguay"> Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines"> Philippines</option>
                                        <option value="Pitcairn"> Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal"> Portugal</option>
                                        <option value="Puerto-Rico"> Puerto-Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion"> Reunion</option>
                                        <option value="Romania"> Romania</option>
                                        <option value="Russian-Federation"> Russian-Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint-Vincent-and-the-Grenadines"> Saint-Vincent-and-the-Grenadines&nbsp;</option>
                                        <option value="San-Marino"> San-Marino</option>
                                        <option value="Sao-Tome-and-Principe"> Sao-Tome-and-Principe</option>
                                        <option value="Saudi-Arabia"> Saudi-Arabia</option>
                                        <option value="Senegal"> Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Serbia-and-Montenegro"> Serbia-and-Montenegro</option>
                                        <option value="Seychelles"> Seychelles</option>
                                        <option value="Sierra-Leone"> Sierra-Leone</option>
                                        <option value="Singapore"> Singapore</option>
                                        <option value="Slovakia"> Slovakia</option>
                                        <option value="Slovenia"> Slovenia</option>
                                        <option value="Solomon-Islands"> Solomon-Islands</option>
                                        <option value="Somalia"> Somalia</option>
                                        <option value="South-Africa"> South-Africa</option>
                                        <option value="South-Georgia"> South-Georgia</option>
                                        <option value="South-Sandwich-Islands"> South-Sandwich-Islands</option>
                                        <option value="Spain"> Spain</option>
                                        <option value="Sri-Lanka"> Sri-Lanka</option>
                                        <option value="St.-Helena"> St.-Helena</option>
                                        <option value="St.-Kitts-and-Nevis"> St.-Kitts-and-Nevis</option>
                                        <option value="St.-Lucia"> St.-Lucia</option>
                                        <option value="St.-Pierre-and-Miquelon"> St.-Pierre-and-Miquelon</option>
                                        <option value="St.-Vincent-and-the-Grenadines"> St.-Vincent-and-the-Grenadines</option>
                                        <option value="Sudan"> Sudan</option>
                                        <option value="Suriname"> Suriname</option>
                                        <option value="Svalbard"> Svalbard</option>
                                        <option value="Swaziland"> Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland"> Switzerland</option>
                                        <option value="Syrian-Arab-Republic"> Syrian-Arab-Republic</option>
                                        <option value="Taiwan">Taiwan</option>
                                        <option value="Tajikistan"> Tajikistan</option>
                                        <option value="Tanzania"> Tanzania</option>
                                        <option value="Thailand"> Thailand</option>
                                        <option value="The-Bahamas"> The-Bahamas</option>
                                        <option value="The-Gambia"> The-Gambia</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau"> Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad-and-Tobago"> Trinidad-and-Tobago</option>
                                        <option value="Tristan-da-Cunha"> Tristan-da-Cunha</option>
                                        <option value="Tunisia"> Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan"> Turkmenistan</option>
                                        <option value="Turks-and-Caicos-Islands"> Turks-and-Caicos-Islands</option>
                                        <option value="Tuvalu"> Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine"> Ukraine</option>
                                        <option value="United-Arab-Emirates"> United-Arab-Emirates</option>
                                        <option value="United-Kingdom"> United-Kingdom</option>
                                        <option value="United States"> United States </option>
                                        <option value="Uruguay"> Uruguay</option>
                                        <option value="Uzbekistan"> Uzbekistan</option>
                                        <option value="Vanuatu"> Vanuatu</option>
                                        <option value="Venezuela"> Venezuela</option>
                                        <option value="Viet-Nam"> Viet-Nam</option>
                                        <option value="Virgin-Islands-(U.K.)"> Virgin-Islands-(U.K.)</option>
                                        <option value="Virgin-Islands-(U.S.)"> Virgin-Islands-(U.S.)</option>
                                        <option value="Wallis-and-Futanu-Islands"> Wallis-and-Futanu-Islands</option>
                                        <option value="Western-Sahara"> Western-Sahara</option>
                                        <option value="Western-Samoa"> Western-Samoa</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Yugoslavia"> Yugoslavia</option>
                                        <option value="Zaire">Zaire</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe"> Zimbabwe</option>
                                    </select>    
                                    @error('country')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                              
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Telephone : </label>
                                    <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror">
                                    
                                    @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Mobile : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror">
                                    
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Email : <span class="text-danger font-10"><i class="fa fa-star"></i> </span></label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>Website : </label>
                                    <input type="text" name="website" class="form-control @error('website') is-invalid @enderror">
                                    
                                    @error('website')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>                                
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <button class="customBtn" type="submit"><span>Submit</span></button>
                            <!-- <a href="" class="apSubmit" type="reset">Reset</a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection