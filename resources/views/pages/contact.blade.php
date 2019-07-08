<!-- Include main master page -->
@extends('layouts.master')

@section('content')

<div style="height: 100px;"></div>

<h1 class="text-center mb-5"> Contact Us </h1>
<div class="card">
<div class="row">

    <div class="col-4" style="margin: 70px 50px">
                <div >
                        <h3>Contact Us</h3> <br>
                    <p>
                        <i class="fa fa-phone mr-3"></i> + 92 304 8486 653</p>
                    <p>
                        <i class="fa fa-envelope mr-3"></i> info@picknride.com</p>
                    <p>
                        <i class="fa fa-home mr-3"></i> St#11 6th Rd, Rawalpindi</p>
                </div>
    </div>

    <div class="col-6 my-5">
        <div class="card">
                <div class="card-body mt-3 mb-5">
                                   
                <h3> Feedback: </h3> <br>
                <form method="post" action="/user">
                    {{ csrf_field() }}
                
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" id="text"
                        placeholder=" Name">
                    </div>
                
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email"
                        placeholder="Email">
                    </div>

                    <div class="form-group">
                        <textarea name="message" class="form-control" id="message"
                        placeholder="Message" rows="3" cols="5"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-outline-dark font-weight-bold"> Send Message </button>

                </form>

                </div>
        </div>
    </div>

    </div>
</div>


<div class="container-fluid text-center">
 
    <h2> Our Location </h2>
    <div style="height: 500px;" id="map">
    </div> 
</div>


    @endsection