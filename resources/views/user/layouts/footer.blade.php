<!--Start footer-->
<footer class="footer">
  <div class="container">
    <div class="pull-left">
        Copyright © 2019-{{Carbon\carbon::now()->year}} BE ICT Consult ltd.
    </div>
    <div class="pull-right">
    	<strong><h5>{{Auth::user()->station['station_name']}}</h5></strong>
    </div>
  </div>
</footer>
<!--End footer-->