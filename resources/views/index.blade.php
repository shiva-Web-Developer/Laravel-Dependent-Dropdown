<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Testing</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-6 col-lg-6 m-auto">
            <form>

            
               

                <div class="form-group">
                <label class="col-md-12 control-label">Select Your District<span style="color:red;">*</span></label>
                <select  id="country-dd" name="district_name" class="form-control" required="required">
									<option value="">Select District</option>
										@foreach($result as $district)
											<option value="{{$district->district_name}}">
												{{$district->district_name}}
											</option>
										@endforeach
								</select>
                    </div>



                    <div class="form-group">
                    <label class="col-md-12 control-label">College Name<span style="color:red;">*</span></label>
						<select id="state-dd" class="form-control" name="school_name"></select>
                    </div>


                        <div class="form-group">
                        <label class="col-md-12 control-label">College Code</label>
                        <input type="text" name="school_code" id="no_smu" class="form-control" readonly>
                    </div>

                    

                    <div class="form-group">
                        <label class="col-md-12 control-label">District Code</label>
                        <input type="hidden" name="id" id="nj_gg" class="form-control">
                        <input type="text" name="district_code" id="nj_smu" class="form-control" readonly>
                    </div>


                    <div class="form-group">
                    <label class="col-md-12 control-label">Mobile Number</label>
                    <input type="text" name="mobile_number" id="dd" class="form-control" required>
                </div>

                       
                <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" required>
                </div>
     
                <div class="form-group">
                    <label class="col-md-12 control-label">Fill Captcha Code<span style="color:red;">*</span></label>
                    <input type="text" class="form-control" id="captcha" name="captcha" required="required">
                </div>

                <div class="form-group">
                    <label class="col-md-12 control-label"> <input type="text" 
                    style="height:50px;width:100px;background-color:gray;border:none;" readonly>
                    </label>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>

    	<!-- jq cdn  -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   
   <script>

        $(document).ready(function () {

			// ajax use for the get college list and district code  
            $('#country-dd').on('change', function () {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{url('api/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dd').html('<option value="">Select College</option>');
                        $.each(result.states, function (key, value) {

							$('#nj_smu').val(value.district_code); 

                            $("#state-dd").append('<option value="' + value
                                .school_name + '">' + value.school_name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            }); 

			// use for college code and college mobile number
            $('#state-dd').on('change', function () {
                
                var idState = this.value;
               
                $.ajax({
                    url: "{{url('api/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
						$('#no_smu').val(data.school_code);
						$('#dd').val(data.mobile);
						$('#nj_gg').val(data.id);  
                    }
                });
            });
        });
    </script>


</body>
</html>