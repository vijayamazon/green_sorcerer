<?php
$baseurl=base_url();

?>
<style type="text/css">
  .nav-tabs { border-bottom: 2px solid #DDD; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover { border-width: 0; }
    .nav-tabs > li > a { border: none; color: #666; }
        .nav-tabs > li.active > a, .nav-tabs > li > a:hover { border: none; color: #4285F4 !important; background: transparent; }
        .nav-tabs > li > a::after { content: ""; background: #4285F4; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .nav-tabs > li.active > a::after, .nav-tabs > li:hover > a::after { transform: scale(1); }
.tab-nav > li > a::after { background: #21527d none repeat scroll 0% 0%; color: #fff; }
.tab-pane { padding: 15px 0; }
.tab-content{padding:20px}

.profile-card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }

</style>
<div class="page-container contanier" ng-controller='profileCtrl'>   

<div class="row">
      
<div class="col-md-12 no-padding" style=" margin-top: 20px">
<!-- Nav tabs -->
  <div class="profile-card">
    <!-- Tab panes -->
     <div class="tab-content">
          <div class="box-header">
            <h4>Filter</h4>
          </div>
        <div role="tabpanel" class="tab-pane active">
          <form action="<?php echo $baseurl."cron/Amazon_product_update/update_new/" ?>" >
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                      <label>Filter Date</label>
                      <select class="form-control">
                          <option value="0">-Filter Date</option>
                          <option value="1">This Week</option>
                          <option value="2">Last Week</option>
                          <option value="3">This Month</option>
                          <option value="4">Last Month</option>
                          <option value="5">Today</option>
                          <option value="6">Yesterday</option>
                      </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <label>From Date</label>
                      <input type="date" class="form-control">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                      <label>To Date</label>
                      <input type="date" class="form-control">
                    </div>
                </div>


                <div class="col-md-12">
                  <div class="form-group">
                    <button class="btn btn-primary">Filter</button>
                    <button class="btn btn-danger">Clear Filter</button>
                    <button class="btn btn-success" style="float: right;">Update Now</button>
                  </div>
                </div>
            </div>
              </form>
          </div> 
      </div>
    </div>
  </div>
</div>
</div>



<div class="page-container contanier">   

<div class="row">
      
<div class="col-md-12 no-padding">
<!-- Nav tabs -->
  <div class="profile-card">
    <!-- Tab panes -->
     <div class="tab-content">
          <div class="box-header">
              <h4>Summery</h4>
          </div>
        <div role="tabpanel" class="tab-pane active">
            <div class="row">
              <div class="col-md-12">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Action</th>
                        <th>Laste Updated</th>
                        <th>Number of items</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $counter=0;

                      foreach($result as $d){
                        $counter++;
                        echo "<tr><td>
                          <button class='btn btn-xs btn-primary'><i class='fa fa-eye'></i></button>
                          <button class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button>
                          <button class='btn btn-xs btn-success'><i class='fa fa-download'></i></button>
                          ".$d->id."</td>
                          <td>".$d->created_at."</td>
                          <td>".$d->time_update."</td>
                          </tr>";
                      }

                        ?>
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
</div>


<script type="text/javascript">

  $(document).ready(function () {
    
    console.log("AAAAAAA");
  });

</script>