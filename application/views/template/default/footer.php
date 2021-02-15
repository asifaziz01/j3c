<?php if(!isset($no_header)){ ?>
<!--Footer-->
<footer>
    <div class="container-fluid footerbg">
      <div class="container">
        <div class="row">
          <div class="col-md-3"> <a href="#" class="footer-logo"> <img class="logo-dark"  src="<?php echo base_url ($this->config->item("template_path").'images/logo.png');?>" alt="Hire A Helper" /> </a>
            <p>We're so confident we have the lowest prices in town, we guarantee it! If you get a written estimate for the exact same job by a provider in your area, we will meet or beat it.</p>
            <div class="about_info">
              <p><i class="fa fa-map-marker" aria-hidden="true"></i> Shahpur, Gorakhpur</p>
              <p><i class="fa fa-envelope" aria-hidden="true"></i> info@just3click.com</p>
              <p><i class="fa fa-phone" aria-hidden="true"></i> +91807186985</p>
            </div>
          </div>
          <div class="col-md-3">
            <h4>Services</h4>
            <ul>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Cleaning</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Electrical</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Plumbing</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Appliances</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Carpentry</a></li>
            </ul>
            <ul>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Geyser Service</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Vehicle Care</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Pest Control</a></li>
              <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i>Panting</a></li>
            </ul>
          </div>
          <div class="col-md-2">
            <h4>Login</h4>
            <ul>
              <li><a href="<?php echo site_url('login/administrator');?>">Administrator/Staff</a></li>
              <li><a href="<?php echo site_url('login');?>">Technician/Customer</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4>Feedback</h4>
            <form action="<?php echo site_url('main/add_feedback');?>" method="post" class="newsletter">
                <?php if(!$this->session->userdata('id')){ ?>
                <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Name" >
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="mobile" placeholder="Mobile" >
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder="Email" >
                </div>
                <?php } ?>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" >
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" placeholder="Message" ></textarea>
                </div>
                <div class="form-actions">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              <!-- /input-group -->
            </form>
          </div>
        </div>
        <div class="top_awro pull-right" id="back-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i> </div>
      </div>
    </div>
    
    <!--Boottom Footer-->
    <div class="container-fluid bottom-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <p class="copyright pull-left">&copy; Just3Click 2020 All Right Reserved</p>
            <ul class="footer-scoails pull-right">
              <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/Footer--> 
  
</div>
<!--/Wrapper End--> 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url ($this->config->item("template_path").'js/jquery.min.js');?>"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url ($this->config->item("template_path").'js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url ($this->config->item("template_path").'js/owlcarousel/owl.carousel.min.js');?>"></script> 
<script src="<?php echo base_url ($this->config->item("template_path").'js/custom.js');?>"></script>
<script>
  /*(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106074231-1', 'auto');
  ga('send', 'pageview');
*/
function showConfirm(url,msg){
	  var conf = confirm(msg);
	  if(conf){
		document.location.href = url;  
	  }
  }

</script>
<?php } ?>
</body>
</html>