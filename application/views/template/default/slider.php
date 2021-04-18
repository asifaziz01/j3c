<!--Banner Start-->
<style>
.circle {
    /*background: lightblue;*/
    border:3px double #0F1324;
    border-radius: 50%;
    width: 65px;
    height: 65px;
    color:#0F1324;
    text-shadow:1px 1px 10px #fff, 1px 1px 10px #CCC;
}
</style>
<div class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="first-slide" src="<?php echo base_url($this->config->item('template_path').'images/banner1.jpg');?>" alt="Los Angeles" style="width:100%;">
        </div>
        <div class="carousel-item home_one_banner">
            <img class="second-slide" src="<?php echo base_url($this->config->item('template_path').'images/banner2.jpg');?>" alt="Los Angeles" style="width:100%;">
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript">
/*var textWrapper = document.querySelector('.ml2');
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
  });*/
</script>