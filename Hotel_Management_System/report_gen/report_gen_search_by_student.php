<!DOCTYPE html>
<html lang="en">
  <head>
  
<!-- quick search things-->
<style>
.frmSearch {border: 1px solid #eaedeb;background-color: #fdfefe  ;margin: 2px 0px;padding:40px;border-radius:12px;}
#country-list{float: left;list-style:none;margin-top:5px; margin-left:0%;padding:0;width:190px;position: absolute; border-radius:12px;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #eaedeb 1px solid;border-radius:12px;}
</style>

<script src="pay/js/jquery-2.1.4.js" type="text/javascript"></script>
<!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script> -->
<script>
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: "report_gen/quick_search.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
</script>
  
  </head>

  <body class="nav-md">
    

      

            <div class="clearfix"></div>

			<!--
			<p> magics</p>
			-->
<div class="x_panel">
                  <div class="x_title">
                    <h2>Search By Student <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  <!--
                  <div class="x_content">
                    <br />
        
					
					
				   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nice">NIC or Name
                        </label>
                      </div>	
					<br>
					
		<form method="post" action="index.php?tab=report_gen_view_selected_student" id="myForm8" name="myForm4">
         <div class="form-group">
         <input type="text" class="form-control" name="stu" id="stu" required placeholder="Search By Name or NIC..." form="myForm8"\>
        </div>
		    <div class="ln_solid"></div>

		<input type="submit" name="viewbyany" class="btn btn-success" value="Search " form="myForm8"/>
		 <button class="btn btn-primary" type="reset">Reset</button>
	
        </form>
					
                  </div>-->
				  
<div class="frmSearch">

<form method="post" action="index.php?tab=report_gen_view_selected_student" id="myForm8" name="myForm4">
<input type="text" id="search-box" name="search-box" required placeholder="Search By NIC or Name..." form="myForm8" size="60" name="nicpost" autocomplete="off" /> 
		<input type="submit" name="viewbyany" class="btn btn-success" value="Search " form="myForm8"/>
		<button class="btn btn-primary" type="reset">Reset</button>
</form>

<div id="suggesstion-box" align="center"></div>
</div>	
				  
				  
</div>


  </body>
</html>
