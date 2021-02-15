<!--Banner Start-->
<style>
.circle {
    /*background: lightblue;*/
    border:3px double #FFF;
    border-radius: 50%;
    width: 65px;
    height: 65px;
}
</style>
<section id="banner" class="home-one" style="padding-top:10px;">
<div class="container text-center parallax-section">
    <div class="row text-center">
        <div class="col-md-12">
            <h1 class="panel-heading ml2" style="font-size:3em;padding-bottom:3px;">Home Service on Demand</h1>
            <h1 class="panel-heading" style="font-size:2em;padding-bottom:5px;">Lowest price garranty</h1>
            <p class="caption">We're so confident we have the lowest prices in town, we guarantee it! If you get a written estimate for <br class="hidden-sm hidden-xs" />the exact same job by a provider in your area, we will meet or beat it.</p>
            <form class="form-inline book-now-home">
            <div class="form-group" style="border-right:1px solid #CCC;">
                <select class="form-control" name="service_category" onchange="getAppliance(this.value)">
                <?php
                $categories = $this->appliance_m->get_categories();
                if($categories){
                echo '<option>Select Category</option>';
                foreach($categories as $cat){
                    echo '<option value="'.$cat['id'].'">'.$cat['title'].'</option>';
                }
                }
                ?>
                </select>
            </div>
            <div class="form-group" style="border-right:1px solid #CCC;">
                <select class="form-control" id="aplnce" name="service_appliance">
                <option value="0">Select Appliance</option>
                </select>
            </div>
            <button type="button" onclick="createOptions();" id="step1" class="btn btn-primary booknow btn-skin" disabled>Book now</button>
            </form>
        </div>
        </div>
        <div class="text-center book-now-home" style="margin-top:20px;background-color:transparent;">
        <div class="col-md-4 col-sm-4 col-xs-4 text-center"><div class="circle" style="margin:auto;"><h4 style="margin-top:20px;">Rs 149</h3></div><h4>Lowest <br />Inspection Charge</h4></div>
        <div class="col-md-4 col-sm-4 col-xs-4 text-center"><div class="circle" style="margin:auto;"><h4 style="margin-top:10px;">15 days</h3></div><h4>15 Days <br />Warranty</h4></div>
        <div class="col-md-4 col-sm-4 col-xs-4 text-center"><div class="circle" style="margin:auto;"><h1 style="margin-top:20px;"><i class="fa fa-check" style="color:#fff;"></i></h1></div><h4>Trusted <br />Technicians</h4></div>
        </div>
        <h1 style="font-size:2.5em;padding-top:100px;">Contact Us +91-8107186985</h1>
    </div>
</section>
<script type="text/javascript" language="javascript">
var textWrapper = document.querySelector('.ml2');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({loop: true})
  .add({
    targets: '.ml2 .letter',
    scale: [4,1],
    opacity: [0,1],
    translateZ: 0,
    easing: "easeOutExpo",
    duration: 950,
    delay: (el, i) => 70*i
  }).add({
    targets: '.ml2',
    opacity: 0,
    duration: 1000,
    easing: "easeOutExpo",
    delay: 500
  });
</script>