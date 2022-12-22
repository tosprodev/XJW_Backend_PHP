<html>
  <head>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<style type="text/css">

    body
    {
        background:#FAE5E5;
    }

    .payment
	{
		border:1px solid #FAE5E5;
		height:280px;
        border-radius:20px;
        background:#fff;
	}
   .payment_header
   {
	   background: #3486eb;
	   padding:20px;
       border-radius:20px 20px 0px 0px;
	   
   }
   
   .check
   {
	   margin:0px auto;
	   width:50px;
	   height:50px;
	   border-radius:100%;
	   background:#fff;
	   text-align:center;
   }
   
   .check i
   {
	   vertical-align:middle;
	   line-height:50px;
	   font-size:30px;
   }

    .content 
    {
        text-align:center;
    }

    .content  h1
    {
        font-size:25px;
        padding-top:25px;
    }

    .content a
    {
        width:200px;
        height:35px;
        color:#FAE5E5;
        border-radius:30px;
        padding:5px 10px;
        background:#61fac7;
        transition:all ease-in-out 0.3s;
    }

    .content a:hover
    {
        text-decoration:none;
        background:#FAE5E5;
    }
   
	</style>
	
	<script type="text/javascript">

        function moveToScreenTwo() {
        ok.moveToNextScreen();
        }
        </script>
  </head>
    
    <body>
		<div class="container">
		<section>
		   <div class="row">
			  <div class="col-md-6 mx-auto mt-5">
				 <div class="payment">
					<div class="payment_header">
					   <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
					</div>
					<div class="content">
					   <h1>Payment Success !</h1>
					   <p>We received your booking.<br/> Go to my booking for more detail.</p>
					   <a type="button" value="Goto Another Activity" onClick="moveToScreenTwo()" />Go to my booking</a>
					</div>
					
				 </div>
			  </div>
		   </div>
		   </section>
		</div>
    </body>
</html>
  