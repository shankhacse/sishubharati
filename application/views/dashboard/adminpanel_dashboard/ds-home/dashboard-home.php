

 <script src="<?php echo base_url(); ?>application/assets/js_scripts/adm_scripts/admindashboard.js"></script> 

    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <h3><?php echo $bodycontent['totalStudent'];?></h3>

              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url();?>admission" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
 <div class="col-lg-3 col-xs-6">
    <!-- Small boxes (Stat box) -->
   <div class="small-box bg-green">
     <div class="inner">
       <h3><?php echo $bodycontent['totalClass'];?></h3>
 
       <p>Total Classes</p>
     </div>
     <div class="icon">
       <i class="ion ion-stats-bars"></i>
     </div>
     <a href="<?php echo base_url();?>classmaster" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
   </div>
 </div>
        <!-- ./col -->
<div class="col-lg-3 col-xs-6">

  <div class="small-box bg-yellow">
    <div class="inner">
      <h3><?php echo $bodycontent['totalSubject'];?></h3>

      <p>Total Subjects</p>
    </div>
    <div class="icon">
      
       <i class="ion ion-stats-bars"></i>
    </div>
    <a href="<?php echo base_url();?>subject" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
  </div>
</div>
        <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
     
     <div class="small-box bg-red">
       <div class="inner">
         <h3><?php echo $bodycontent['sessionData']->year;?></h3>
   
         <p>Academic Year</p>
       </div>
       <div class="icon">
         <i class="ion ion-pie-graph"></i>
       </div>
       <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
     </div>
   </div> 
        <!-- ./col -->
      </div>
      <!-- /.row -->

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <a href="<?php echo base_url();?>message" >
    <button class="btn bg-purple btn-flat margin" style="width: 92%;" ><i class="fa fa-envelope-o"></i>&nbsp;&nbsp; Messages&nbsp;&nbsp;
      <span class="badge " style="color:purple;background-color:#fff; "><?php echo $bodycontent['message'];?></span>
      </button></a>
  </div>
<?php
      if ($bodycontent['userType']=='Superadmin' || $bodycontent['userType']== 'Developer') {
       
?>
  <div class="col-lg-3 col-xs-6">
    <a href="<?php echo base_url();?>paymentsummery" >
    <button class="btn bg-maroon btn-flat margin" style="width: 92%;" ><i class="fa fa-rupee"></i>&nbsp;&nbsp; Payment Summary&nbsp;&nbsp;
     
      </button></a>
  </div>

    <div class="col-lg-3 col-xs-6">
    <a href="<?php echo base_url();?>usercontrol" >
    <button class="btn bg-purple btn-flat margin" style="width: 92%;" ><i class="fa fa-user"></i>&nbsp;&nbsp; User Control&nbsp;&nbsp;
     
      </button></a>
  </div>

      <div class="col-lg-3 col-xs-6">
    <a href="<?php echo base_url();?>paymentsummery/report" >
    <button class="btn bg-olive btn-flat margin" style="width: 92%;" ><i class="fa fa-rupee"></i>&nbsp;&nbsp; Payment Report&nbsp;&nbsp;
     
      </button></a>
  </div>


<?php }?>
  
</div>


   <div class="row">
    <div class="jumbotron" style="background: #f2f2f2;padding: 5px 1px;margin-bottom: 0;color:#D18D8D;text-align: center;margin-top:140px;">
          <h1 style="font-size: 24px;margin-bottom: 20px;">Welcome to Sishubharati Dashboard </h1>

          
      </div>
   </div>

   
<center><br>
    <svg  xmlns="http://www.w3.org/2000/svg"
aria-label="Calendar" role="img"
viewBox="0 0 512 512" style="width: 170px;">
<!-- <script type="text/ecmascript"><![CDATA[
function init() {
  var time = new Date();
  var locale = "en-gb";
  var DD   = time.getDate();
  
  var MMM  = time.toLocaleString(locale, {month:   "short"}).toUpperCase();

  document.getElementById("time").textContent= time;
  document.getElementById("day").textContent= DD;

  document.getElementById("month").textContent= MMM;
  
  // var DDDD = time.toLocaleString(locale, { weekday: "long" });
  // var MM   = time.getMonth() + 1;
  // var MMMM = time.toLocaleString(locale, {month: "long"});
  // var YYYY = time.getFullYear();
}
]]></script> -->

<path d="M512 455c0 32-25 57-57 57H57c-32 0-57-25-57-57V128c0-31 25-57 57-57h398c32 0 57 26 57 57z" fill="#e0e7ec"/>
<path d="M484 0h-47c2 4 4 9 4 14a28 28 0 1 1-53-14H124c3 4 4 9 4 14A28 28 0 1 1 75 0H28C13 0 0 13 0 28v157h512V28c0-15-13-28-28-28z" fill="#dd2f45"/>

<!-- <g fill="#f3aab9">
  <circle cx="470" cy="142" r="14"/>
  <circle cx="470" cy="100" r="14"/>
  <circle cx="427" cy="142" r="14"/>
  <circle cx="427" cy="100" r="14"/>
  <circle cx="384" cy="142" r="14"/>
  <circle cx="384" cy="100" r="14"/>
</g> -->

<text id="month"
  x="32" 
  y="164" 
  fill="#fff" 
  font-family="monospace"
  font-size="140px"
  style="text-anchor: left"></text>

  <text id="year"
  x="400" 
  y="142" 
  fill="#fff" 
  font-family="monospace"
  font-size="60px"
  style="text-anchor: middle"></text>

<text id="day"
  x="256" 
  y="400" 
  fill="#66757f" 
  font-family="monospace"
  font-size="256px"
  style="text-anchor: middle"></text>

<text id="time"
  x="256" 
  y="480" 
  fill="#66757f" 
  font-family="monospace"
  font-size="70px"
  style="text-anchor: middle"></text>
</svg> 
     </center>
  

    </section>
    <!-- /.content -->

