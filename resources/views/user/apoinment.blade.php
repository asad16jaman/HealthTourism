@extends('user.layout.app')
@section('title', 'Get Apointment Page')

@push('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .badgg {
            width: 26px;
            height: 26px;
            background: #ff0000;
            text-align: center;
            color: #fff;
            border-radius: 50%;
            font-weight: 900;
        }
        .plustbtn {
            width: 20%;
            text-align: right;
            display: flex;
            justify-content: end;
            margin-top: 35px;
        }
        .plusicon {
            background: #004eff;
            color: #fff;
            padding: 5px;
            font-size: 17px;
            font-size: 900;
            border-radius: 5px;
            height: 29px;
            cursor: pointer;
        }
        .changeBtn{
            width: 20%;
            display: flex;
            justify-content: end;
            align-items: center;
                }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: solid #0052d2 1px !important;
            outline: 0;
        }
    .select2-container--default .select2-selection--multiple{
         border: solid #0052d2 1px !important;
    }
    .prevImg{
            width: 50%;
    height: 82px;
    object-fit: contain;
    }
    </style>
@endpush

@section('content')
    @include('user.partial.header', ['page' => 'apoint'])

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content d-md-flex justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0">
                        <h2>Apointment</h2>
                    </div>
                    <div class="page_link">
                        <a href="/">Home</a>
                        <a href="">Apointment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================About  Area =================-->
    <section class="about-area">
        <div class="container">
            <div class="card shadow">
                <div class="card-header text-white" style="background-color:#2314b7a1 !important">
                    <h3 class="text-center">Patients Apointment Form</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data" id="appointmentForm">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Name*</label>
                                    <input type="text" placeholder="Your Name" value="{{ old('name') }}" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Email*</label>
                                    <input type="email" placeholder="Your Email" value="{{ old('email') }}" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Phone*</label>
                                    <input type="text" placeholder="Your Phone" value="{{ old('phone') }}" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror" id="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Country*</label>
                                    <select name="country_id" class="form-select" id="countrySelect">
                                        <option value="9">BANGLADESH</option>
                                        @foreach ($allCountry as $country)
                                            <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? "selected" : "" }}>{{ $country->country }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="">Service*</label>
                                    <select name="service_id[]" id="" class="form-select select2" multiple="multiple">
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? "selected" : "" }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    <p id="select_error" style="color:red;font-size:12px"></p>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 pesportSection d-none">
                                <div class="form-group">
                                    <label for="">Passport No*</label>
                                    <input type="text" name="passport" value="{{ old('passport') }}"
                                        placeholder="Passport Number"
                                        class="form-control @error('passport') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="col-md-6 col-12 pesportSection d-none">
                                <div class="form-group">
                                    <label for="">Expire Date*</label>
                                    <input type="date" name="exp_date" value="{{ old('exp_date') }}"
                                        class="form-control @error('exp_date') is-invalid @enderror">
                                </div>
                            </div>

                            <div class=" col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="">Address*</label>
                                    <input type="text" value="{{ old('exp_date') }}" placeholder="Your Address"
                                        name="address" class="form-control @error('address') is-invalid @enderror">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3 col-12">
                                <div class="form-group">
                                    <label>Passport : </label> <br>
                                    <input id="passport_input" name="passport_img" style="height:auto;padding:0px;" class="form-control" type="file" accept="image/*">
                                    <p>image (jpeg,jpg,png,webp image only)</p>
                                    @error('passport_img')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <img id="passportPreview" src="{{ asset('assets/user/img/apoin/passport.jpg') }}" class="img-fluid border prevImg" alt="">
                                </div>
                            </div>

                            <div class="col-md-4 col-lg-3 col-12">
                                <div class="form-group">
                                    <label>Prescription : </label> <br>
                                    <input id="prescription_input" name="prescription" style="height:auto;padding:0px;" class="form-control" type="file" accept="image/*">
                                    <p>image (jpeg,jpg,png,webp image only)</p>
                                    @error('prescription')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <img id="prescriptionPreview" src="{{ asset('assets/user/img/apoin/prescription.jpg') }}" class="img-fluid border prevImg" alt="">
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-3 col-12">
                                <div class="form-group">
                                    <label>Report : </label> <br>
                                    <input name="report" id="report_input" style="height:auto;padding:0px;" class="form-control" type="file" accept="image/*">
                                    <p>image (jpeg,jpg,png,webp image only)</p>
                                    @error('report')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <img id="reportPreview" src="{{ asset('assets/user/img/apoin/medical_report.webp') }}" class="img-fluid border prevImg" alt="">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label> Message (if any) </label>
                                    <textarea id="message" name="message"
                                        class="form-control @error('message') is-invalid @enderror" rows="2"
                                        cols="50">{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-none pesportSection">
                            <h4>Companions</h4>
                            <div id="companions-container">
                                <div class="card p-0 mb-3 position-relative companion-item">
                                    <div class="card-body p-1">
                                        <!-- <span class="badgg"> 1</span> -->
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Name*</label>
                                                <input type="text" name="companions[0][name]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Relation*</label>
                                                <input type="text" name="companions[0][relation]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <label>Passport*</label>
                                                <input type="text" name="companions[0][passport]" class="form-control">
                                            </div>
                                            <div class="col-md-3">
                                                <div class="d-flex justify-content-between">
                                                    <div style="width:80%">
                                                        <label>Expire Date*</label>
                                                        <input type="date" name="companions[0][exp_date]"
                                                            class="form-control">
                                                    </div>
                                                    <div class="plustbtn" id="add-companion">
                                                        <i class="ti-plus plusicon"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!--================About Area End =================-->
    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-success">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-dark" id="successModalMessage">
                    
                </div>
            </div>
        </div>
    </div>


    @include('user.partial.footer')
@endsection


@push('script')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        //previewing images
        let report = document.getElementById('report_input');
        let prevImage = document.getElementById('reportPreview');

        report.addEventListener('change',function(e){
            let file = this.files[0];
            if(file){
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    prevImage.src = e.target.result
                }
            }
        })

        let passport = document.getElementById('passport_input');
        let passportprevImage = document.getElementById('passportPreview');

        passport.addEventListener('change',function(e){
            let file = this.files[0];
            if(file){
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    passportprevImage.src = e.target.result
                }
            }
        })

        let prescription = document.getElementById('prescription_input');
        let prescriptionprevImage = document.getElementById('prescriptionPreview');

        prescription.addEventListener('change',function(e){
            let file = this.files[0];
            if(file){
                let reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    prescriptionprevImage.src = e.target.result
                }
            }
        })






        //  Country change event → passport section show/hide
        const countrySelect = document.getElementById('countrySelect');
        const passportSections = document.querySelectorAll('.pesportSection');

        const fieldLabels = {
            name: 'Name',
            email: 'Email',
            phone: 'Phone',
            address: 'Address',
            passport: 'Passport Number',
            exp_date: 'Expire Date',
            'companions.*.name': 'Companion Name',
            'companions.*.relation': 'Companion Relation',
            'companions.*.passport': 'Companion Passport',
            'companions.*.exp_date': 'Companion Expire Date',
        };

        function handlePassportFunc() {
            const chooseId = document.getElementById('countrySelect').value;

            passportSections.forEach(el => {
                if (chooseId != 9) {
                    el.classList.remove('d-none');
                    el.classList.add('d-block');
                } else {
                    el.classList.add('d-none');
                    el.classList.remove('d-block');
                }
            });
        }

        countrySelect.addEventListener('change', handlePassportFunc);

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('appointmentForm');
            const container = document.getElementById('companions-container');
            const addBtn = document.getElementById('add-companion');

            let companionIndex = 1;

            // Companion Add Function
            addBtn.addEventListener('click', function () {
                const html = `
                                                                    <div class="card p-0 mb-3 position-relative companion-item">
                                                                        <div class="card-body p-1">

                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <label>Name*</label>
                                                                                    <input type="text" name="companions[${companionIndex}][name]" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label>Relation*</label>
                                                                                    <input type="text" name="companions[${companionIndex}][relation]" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <label>Passport*</label>
                                                                                    <input type="text" name="companions[${companionIndex}][passport]" class="form-control">
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="d-flex justify-content-between">
                                                                                        <div style="width:80%">
                                                                                            <label>Expire Date*</label>
                                                                                            <input type="date" name="companions[${companionIndex}][exp_date]" class="form-control">
                                                                                        </div>
                                                                                        <div style="width:20%" class="changeBtn">
                                                                                            <button type="button" class="btn btn-danger btn-sm remove_btn remove-companion">-</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                `;
                container.insertAdjacentHTML('beforeend', html);
                companionIndex++;

                container.querySelectorAll('.remove-companion').forEach(btn => {
                    btn.onclick = function () {
                        this.closest('.companion-item').remove();
                    };
                });
            });

            // Form Submit via Axios
            form.addEventListener('submit', async function (e) {
                e.preventDefault();
                // Reset previous errors
                document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
                document.querySelectorAll('.invalid-feedback').forEach(el => el.remove());
                const formData = new FormData(form);
                try {
                    const response = await axios.post("{{ route('apointment') }}", formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                    console.log(response)
                    if (response.data.status === false) {
                        let invalid_errors = response.data.data;
                        showValidationErrors(invalid_errors);
                        if(invalid_errors.service_id){
                            document.getElementById('select_error').innerHTML = invalid_errors.service_id[0]
                        }
                    } else {
                        document.getElementById('passportPreview').src = "{{ asset('assets/user/img/apoin/passport.jpg') }}";
                        document.getElementById('prescriptionPreview').src = "{{ asset('assets/user/img/apoin/prescription.jpg') }}";
                        document.getElementById('reportPreview').src = "{{ asset('assets/user/img/apoin/medical_report.webp') }}";
                        $('.select2').val(null).trigger('change');
                        $('#successModalMessage').text(response.data.message);
                        $('#successModal').modal('show');
                        form.reset();
                        handlePassportFunc();
                       
                    }
                } catch (error) {
                    $('#successModalMessage').text("There is Something Wrong! Try Again Later");
                    $('#successModal').modal('show');
                }
            });
        });

        function formatInputName(key) {
            const parts = key.split('.');
            if (parts.length === 1) return parts[0];
            if (parts[0] === 'files') return 'files[]';
            // companions 
            if (parts[0] === 'companions') {
                const base = parts.shift(); // companions
                return base + '[' + parts.join('][') + ']'; // companions[0][name]
            }
            const base = parts.shift();
            return base + '[' + parts.join('][') + ']';
        }

        function formatErrorMessage(key, message) {
            // companions.0.name → companions.*.name (match)
            const wildcardKey = key.replace(/\.\d+\./, '.*.');

            // getting label name
            if (fieldLabels[wildcardKey]) {
                const label = fieldLabels[wildcardKey];
                // replace field name to custom label name
                return message.replace(/The .* field/, `The ${label} field`);
            }
            return message;
        }

        function showValidationErrors(errors) {
            Object.keys(errors).forEach(function (key) {
                const messages = errors[key];
                // Laravel error key -> HTML name attribute format

                const formattedKey = formatInputName(key);
                console.log(formattedKey)
                const input = document.querySelector(`[name="${formattedKey}"]`);

                if (input) {
                    input.classList.add('is-invalid');

                    const errorDiv = document.createElement('div');
                    errorDiv.classList.add('invalid-feedback');
                    errorDiv.innerText = formatErrorMessage(key, messages[0]);
                    const parent = input.closest('.companion-card') || input.parentElement;
                    parent.appendChild(errorDiv);
                }
            });
        }

        $(document).ready(function() {
            $('.select2').select2({
            placeholder: "Select your Services",
            allowClear: true
            });
        });
    </script>
@endpush